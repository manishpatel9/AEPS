<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeAccountCreated;
use App\Models\Profile;
use App\Models\User;
use App\Models\UserRelation;
use App\Models\Wallet;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DistributorController extends Controller
{
    public function createRetailer()
    {
        return view('distributor.create_retailer');
    }

    public function storeRetailer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|string|size:10|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $plainPassword = $request->password;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'role' => 'retailer',
            'status' => 'active',
            'password' => Hash::make($plainPassword),
            'email_verified_at' => now(),
        ]);

        Wallet::create(['user_id' => $user->id, 'balance' => 0]);
        Profile::create(['user_id' => $user->id, 'kyc_status' => 'pending']);

        // Link retailer to current distributor
        UserRelation::updateOrCreate([
            'parent_id' => auth()->id(),
            'child_id' => $user->id,
        ], [
            'parent_id' => auth()->id(),
            'child_id' => $user->id,
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_retailer',
            'description' => "Created retailer {$user->email}",
            'ip_address' => $request->ip(),
        ]);

        app()->terminating(function () use ($user, $plainPassword) {
            try {
                Mail::to($user->email)->send(new WelcomeAccountCreated($user, $plainPassword));
            } catch (\Throwable $ex) {
                Log::warning('Welcome mail could not be sent for new retailer ' . $user->email . ': ' . $ex->getMessage());
            }
        });

        return redirect()->route('distributor.dashboard')->with('success', 'Retailer created and linked to your account.');
    }
}
