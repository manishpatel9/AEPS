<?php

namespace App\Http\Controllers;

use App\Mail\KycStatusUpdated;
use App\Mail\WelcomeAccountCreated;
use App\Models\User;
use App\Models\Bank;
use App\Models\ApiProvider;
use App\Models\ServiceCharge;
use App\Models\DeviceMapping;
use App\Models\Settlement;
use App\Models\SupportTicket;
use App\Models\CommissionReport;
use App\Models\Reversal;
use App\Models\Wallet;
use App\Models\Profile;
use App\Models\UserRelation;
use App\Models\LoginLog;
use App\Models\AuditLog;
use App\Models\TransactionLog;
use App\Models\ActivityLog;
use App\Models\ApiLog;
use App\Models\AepsTransaction;
use App\Models\KycDocument;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    // ========== USER MANAGEMENT ==========
    public function users(Request $request)
    {
        $query = User::query();
        if ($request->role) $query->where('role', $request->role);
        if ($request->status) $query->where('status', $request->status);
        if ($request->search) $query->where(function($q) use ($request) {
            $q->where('name', 'like', "%{$request->search}%")
              ->orWhere('email', 'like', "%{$request->search}%")
              ->orWhere('mobile', 'like', "%{$request->search}%");
        });
        $users = $query->with('wallet', 'profile', 'parents')
            ->withCount(['children as retailer_count' => function($q){ $q->where('role', 'retailer'); }])
            ->latest()
            ->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show retailers under a distributor
     */
    public function distributorRetailers($id)
    {
        $distributor = User::findOrFail($id);
        if ($distributor->role !== 'distributor') abort(404);

        $retailers = User::whereHas('parents', function($q) use ($id) {
            $q->where('parent_id', $id);
        })->where('role', 'retailer')->with('wallet', 'profile')->latest()->paginate(20);

        return view('admin.users.distributor_retailers', compact('distributor', 'retailers'));
    }

    public function createUser()
    {
        $distributors = User::where('role', 'distributor')->where('status', 'active')->get();
        return view('admin.users.create', compact('distributors'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|string|size:10|unique:users',
            'role' => 'required|in:admin,distributor,retailer',
            'password' => 'required|min:6',
        ]);

        $plainPassword = $request->password;

        $user = User::create([
            'name' => $request->name, 'email' => $request->email,
            'mobile' => $request->mobile, 'role' => $request->role,
            'status' => 'active', 'password' => Hash::make($plainPassword),
            'email_verified_at' => now(),
        ]);

        Wallet::create(['user_id' => $user->id, 'balance' => 0]);
        Profile::create(['user_id' => $user->id, 'kyc_status' => 'pending']);

        if ($request->parent_id) {
            UserRelation::create(['parent_id' => $request->parent_id, 'child_id' => $user->id]);
        }

        AuditLog::create([
            'user_id' => auth()->id(), 'action' => 'create_user',
            'entity_type' => 'User', 'entity_id' => $user->id,
            'new_values' => json_encode($user->toArray()),
            'ip_address' => $request->ip(),
        ]);

        app()->terminating(function () use ($user, $plainPassword) {
            try {
                Mail::to($user->email)->send(new WelcomeAccountCreated($user, $plainPassword));
            } catch (\Throwable $mailException) {
                Log::warning('Welcome mail could not be sent after admin user creation for ' . $user->email . ': ' . $mailException->getMessage());
            }
        });

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function editUser($id)
    {
        $user = User::with('profile', 'wallet')->findOrFail($id);
        $distributors = User::where('role', 'distributor')->where('status', 'active')->get();
        return view('admin.users.edit', compact('user', 'distributors'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|string|size:10|unique:users,mobile,' . $id,
            'role' => 'required|in:admin,distributor,retailer',
            'status' => 'required|in:active,inactive,suspended,pending',
            'parent_id' => 'nullable|exists:users,id',
        ]);

        $oldValues = $user->toArray();
        $user->update($request->only('name', 'email', 'mobile', 'role', 'status'));
        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        // Handle parent distributor mapping for retailer/agent-like roles
        $oldParent = $user->parents()->first();
        $oldParentId = $oldParent ? $oldParent->id : null;

        if ($request->filled('parent_id')) {
            $parentId = $request->parent_id;
            $distributor = User::find($parentId);
            if (!$distributor || $distributor->role !== 'distributor') {
                return redirect()->back()->withErrors(['parent_id' => 'Selected distributor is invalid.'])->withInput();
            }

            // Remove any existing parent relations for this child, then add the new one
            UserRelation::where('child_id', $user->id)->delete();
            UserRelation::create(['parent_id' => $distributor->id, 'child_id' => $user->id]);
        } else {
            // If parent_id blank, remove existing relation (unassign)
            if ($request->has('parent_id')) {
                UserRelation::where('child_id', $user->id)->delete();
            }
        }

        // Log mapping change if distributor changed
        $newParent = $user->parents()->first();
        $newParentId = $newParent ? $newParent->id : null;
        if ($oldParentId !== $newParentId) {
            $desc = '';
            if ($oldParentId && $newParentId) {
                $desc = "Admin " . auth()->user()->name . " changed distributor for user {$user->email} from {$oldParent->name} to {$newParent->name}";
            } elseif ($newParentId) {
                $desc = "Admin " . auth()->user()->name . " assigned distributor {$newParent->name} to user {$user->email}";
            } else {
                $desc = "Admin " . auth()->user()->name . " unassigned distributor from user {$user->email}";
            }

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'map_distributor',
                'description' => $desc,
                'ip_address' => $request->ip(),
            ]);
        }

        AuditLog::create([
            'user_id' => auth()->id(), 'action' => 'update_user',
            'entity_type' => 'User', 'entity_id' => $user->id,
            'old_values' => json_encode($oldValues),
            'new_values' => json_encode($user->toArray()),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 'active']);
        return back()->with('success', 'User approved successfully.');
    }

    // ========== BANK MANAGEMENT ==========
    public function banks()
    {
        $banks = Bank::latest()->paginate(20);
        return view('admin.banks.index', compact('banks'));
    }

    public function storeBank(Request $request)
    {
        $request->validate(['bank_name' => 'required|string', 'iin_number' => 'required|string|unique:banks']);
        Bank::create($request->only('bank_name', 'iin_number', 'status'));
        return back()->with('success', 'Bank added successfully.');
    }

    public function updateBank(Request $request, $id)
    {
        $bank = Bank::findOrFail($id);
        $bank->update($request->only('bank_name', 'iin_number', 'status'));
        return back()->with('success', 'Bank updated successfully.');
    }

    public function deleteBank($id)
    {
        Bank::findOrFail($id)->delete();
        return back()->with('success', 'Bank deleted.');
    }

    // ========== API PROVIDERS ==========
    public function apiProviders()
    {
        $providers = ApiProvider::latest()->paginate(20);
        return view('admin.api_providers.index', compact('providers'));
    }

    public function storeApiProvider(Request $request)
    {
        $request->validate(['name' => 'required', 'api_url' => 'required|url']);
        $data = $request->only('name', 'api_url', 'status');
        if ($request->api_key) $data['api_key'] = encrypt($request->api_key);
        ApiProvider::create($data);
        return back()->with('success', 'API Provider added.');
    }

    public function updateApiProvider(Request $request, $id)
    {
        $provider = ApiProvider::findOrFail($id);
        $data = $request->only('name', 'api_url', 'status');
        if ($request->api_key) $data['api_key'] = encrypt($request->api_key);
        $provider->update($data);
        return back()->with('success', 'API Provider updated.');
    }

    // ========== SERVICE CHARGES ==========
    public function serviceCharges()
    {
        $charges = ServiceCharge::latest()->paginate(20);
        return view('admin.service_charges.index', compact('charges'));
    }

    public function storeServiceCharge(Request $request)
    {
        $request->validate(['service_type' => 'required', 'amount' => 'required|numeric|min:0']);
        ServiceCharge::create($request->only('service_type', 'amount', 'percentage', 'min_amount', 'max_amount', 'status'));
        return back()->with('success', 'Service charge added.');
    }

    public function updateServiceCharge(Request $request, $id)
    {
        ServiceCharge::findOrFail($id)->update($request->only('service_type', 'amount', 'percentage', 'min_amount', 'max_amount', 'status'));
        return back()->with('success', 'Service charge updated.');
    }

    // ========== DEVICE MAPPINGS ==========
    public function deviceMappings()
    {
        $devices = DeviceMapping::with('user')->latest()->paginate(20);
        return view('admin.device_mappings.index', compact('devices'));
    }

    public function storeDeviceMapping(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id', 'device_id' => 'required|unique:device_mappings']);
        DeviceMapping::create($request->only('user_id', 'device_id', 'device_model', 'serial_number', 'status'));
        return back()->with('success', 'Device mapped.');
    }

    // ========== SETTLEMENTS ==========
    public function settlements()
    {
        $settlements = Settlement::with('user')->latest()->paginate(20);
        return view('admin.settlements.index', compact('settlements'));
    }

    public function processSettlement(Request $request, $id)
    {
        $settlement = Settlement::findOrFail($id);
        $settlement->update(['status' => $request->status, 'settlement_date' => now(), 'utr' => 'UTR' . rand(100000, 999999)]);
        return back()->with('success', 'Settlement updated.');
    }

    // ========== COMMISSION REPORTS ==========
    public function commissionReports()
    {
        $reports = CommissionReport::with('user')->latest()->paginate(20);
        return view('admin.commission_reports.index', compact('reports'));
    }

    // ========== REVERSALS ==========
    public function reversals()
    {
        $reversals = Reversal::with('user')->latest()->paginate(20);
        return view('admin.reversals.index', compact('reversals'));
    }

    public function processReversal(Request $request, $id)
    {
        $reversal = Reversal::findOrFail($id);
        $reversal->update(['status' => $request->status, 'settlement_date' => now()]);
        return back()->with('success', 'Reversal processed.');
    }

    // ========== KYC ==========
    public function kycDocuments()
    {
        $documents = KycDocument::with('user')->latest()->paginate(20);
        return view('admin.kyc.index', compact('documents'));
    }

    public function updateKyc(Request $request, $id)
    {
        $doc = KycDocument::findOrFail($id);
        $doc->update(['status' => $request->status]);
        if ($doc->user && $doc->user->profile) {
            $doc->user->profile->update(['kyc_status' => $request->status === 'verified' ? 'verified' : 'rejected']);
        }

        if ($doc->user && $doc->user->email) {
            $kycUser = $doc->user;
            $kycStatus = $request->status;

            app()->terminating(function () use ($kycUser, $kycStatus) {
                try {
                    Mail::to($kycUser->email)->send(new KycStatusUpdated($kycUser, $kycStatus));
                } catch (\Throwable $mailException) {
                    Log::warning('KYC status mail could not be sent to ' . $kycUser->email . ': ' . $mailException->getMessage());
                }
            });
        }

        return back()->with('success', 'KYC status updated.');
    }

    // ========== SUPPORT TICKETS ==========
    public function supportTickets(Request $request)
    {
        $query = SupportTicket::with('user');

        if ($request->q) {
            $s = $request->q;
            $query->where(function($q) use ($s) {
                $q->where('subject', 'like', "%{$s}%")
                  ->orWhere('description', 'like', "%{$s}%")
                  ->orWhere('ticket_id', 'like', "%{$s}%")
                  ->orWhereHas('user', function($u) use ($s) {
                      $u->where('name', 'like', "%{$s}%")
                        ->orWhere('email', 'like', "%{$s}%")
                        ->orWhere('mobile', 'like', "%{$s}%");
                  });
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        $tickets = $query->latest()->paginate(20)->appends($request->only(['q','status','priority']));
        return view('admin.support_tickets.index', compact('tickets'));
    }

    public function replyTicket(Request $request, $id)
    {
        $request->validate(['admin_reply' => 'required|string', 'status' => 'required']);
        SupportTicket::findOrFail($id)->update([
            'admin_reply' => $request->admin_reply,
            'status' => $request->status,
        ]);
        return back()->with('success', 'Ticket updated.');
    }

    // ========== LOGS ==========
    public function loginLogs()
    {
        $logs = LoginLog::with('user')->latest()->paginate(20);
        return view('admin.logs.login', compact('logs'));
    }

    public function auditLogs()
    {
        $logs = AuditLog::with('user')->latest()->paginate(20);
        return view('admin.logs.audit', compact('logs'));
    }

    public function transactionLogs()
    {
        $logs = TransactionLog::latest()->paginate(20);
        return view('admin.logs.transaction', compact('logs'));
    }

    public function activityLogs()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(20);
        return view('admin.logs.activity', compact('logs'));
    }

    public function apiLogs()
    {
        $logs = ApiLog::latest()->paginate(20);
        return view('admin.logs.api', compact('logs'));
    }

    // ========== GENERAL REQUESTS (CONTACTS) ==========
    public function generalRequests(Request $request)
    {
        $query = Contact::query();
        if ($request->search) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%")
                  ->orWhere('message', 'like', "%{$s}%");
            });
        }
        $requests = $query->latest()->paginate(20);
        return view('admin.general_requests.index', compact('requests'));
    }

    public function showGeneralRequest($id)
    {
        $req = Contact::findOrFail($id);
        return view('admin.general_requests.show', compact('req'));
    }
}
