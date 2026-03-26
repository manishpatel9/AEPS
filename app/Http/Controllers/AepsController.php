<?php

namespace App\Http\Controllers;

use App\Models\AepsTransaction;
use App\Models\Bank;
use App\Models\Wallet;
use App\Models\LedgerEntry;
use App\Models\ApiLog;
use App\Models\TransactionLog;
use App\Models\CommissionReport;
use App\Models\ServiceCharge;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AepsController extends Controller
{
    public function cashWithdrawal()
    {
        $banks = Bank::where('status', 'active')->get();
        return view('aeps.cash_withdrawal', compact('banks'));
    }

    public function processCashWithdrawal(Request $request)
    {
        $request->validate([
            'aadhaar_number' => 'required|string|size:12',
            'bank_id' => 'required|exists:banks,id',
            'amount' => 'required|numeric|min:100|max:10000',
        ]);

        $user = auth()->user();
        $wallet = $user->wallet;

        if (!$wallet || $wallet->balance < $request->amount) {
            return back()->with('error', 'Insufficient wallet balance.');
        }

        $txnId = 'TXN' . date('YmdHis') . rand(1000, 9999);
        $aadhaarHash = hash('sha256', $request->aadhaar_number);
        $aadhaarLast4 = substr($request->aadhaar_number, -4);
        $charge = ServiceCharge::where('service_type', 'cash_withdrawal')->where('status', 'active')->first();
        $serviceCharge = $charge ? $charge->amount : 0;
        $commission = max($serviceCharge * 0.5, 2); // 50% of charge or min ₹2

        // Simulate API call
        $apiSuccess = rand(1, 10) <= 8; // 80% success rate for demo
        $rrn = $apiSuccess ? rand(100000000000, 999999999999) : null;

        // Log API call
        ApiLog::create([
            'txn_id' => $txnId,
            'request' => json_encode(['aadhaar' => '****' . $aadhaarLast4, 'bank_id' => $request->bank_id, 'amount' => $request->amount]),
            'response' => json_encode(['status' => $apiSuccess ? 'success' : 'failed', 'rrn' => $rrn]),
            'status' => $apiSuccess ? 'success' : 'failed',
        ]);

        $transaction = AepsTransaction::create([
            'user_id' => $user->id,
            'transaction_id' => $txnId,
            'service_type' => 'cash_withdrawal',
            'bank_id' => $request->bank_id,
            'aadhaar_hash' => $aadhaarHash,
            'aadhaar_last4' => $aadhaarLast4,
            'amount' => $request->amount,
            'commission' => $apiSuccess ? $commission : 0,
            'charge' => $apiSuccess ? $serviceCharge : 0,
            'status' => $apiSuccess ? 'success' : 'failed',
            'response_message' => $apiSuccess ? 'Transaction successful' : 'Transaction failed at bank end',
            'rrn' => $rrn,
        ]);

        if ($apiSuccess) {
            $openingBalance = $wallet->balance;
            $wallet->balance -= ($request->amount - $commission);
            $wallet->save();

            LedgerEntry::create([
                'wallet_id' => $wallet->id,
                'transaction_type' => 'debit',
                'amount' => $request->amount,
                'opening_balance' => $openingBalance,
                'closing_balance' => $wallet->balance,
                'reference_id' => $txnId,
                'description' => 'AEPS Cash Withdrawal',
            ]);

            LedgerEntry::create([
                'wallet_id' => $wallet->id,
                'transaction_type' => 'credit',
                'amount' => $commission,
                'opening_balance' => $wallet->balance,
                'closing_balance' => $wallet->balance,
                'reference_id' => $txnId,
                'description' => 'Commission on Cash Withdrawal',
            ]);

            CommissionReport::create([
                'user_id' => $user->id,
                'transaction_id' => $txnId,
                'amount' => $commission,
                'type' => 'cash_withdrawal',
                'transaction_date' => today(),
            ]);
        }

        TransactionLog::create([
            'txn_id' => $txnId,
            'status' => $apiSuccess ? 'success' : 'failed',
            'service_type' => 'cash_withdrawal',
            'amount' => $request->amount,
            'details' => $apiSuccess ? 'Cash withdrawal processed successfully' : 'Cash withdrawal failed',
        ]);

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'aeps_cash_withdrawal',
            'description' => "Cash withdrawal of ₹{$request->amount} - " . ($apiSuccess ? 'Success' : 'Failed'),
            'ip_address' => $request->ip(),
        ]);

        if ($apiSuccess) {
            return back()->with('success', "Cash Withdrawal of ₹{$request->amount} successful! RRN: {$rrn}. Commission: ₹{$commission}");
        }
        return back()->with('error', 'Transaction failed at bank end. Please try again.');
    }

    public function balanceEnquiry()
    {
        $banks = Bank::where('status', 'active')->get();
        return view('aeps.balance_enquiry', compact('banks'));
    }

    public function processBalanceEnquiry(Request $request)
    {
        $request->validate([
            'aadhaar_number' => 'required|string|size:12',
            'bank_id' => 'required|exists:banks,id',
        ]);

        $user = auth()->user();
        $txnId = 'BE' . date('YmdHis') . rand(1000, 9999);
        $aadhaarLast4 = substr($request->aadhaar_number, -4);
        $balance = rand(500, 100000); // Simulated
        $apiSuccess = rand(1, 10) <= 9;

        $transaction = AepsTransaction::create([
            'user_id' => $user->id,
            'transaction_id' => $txnId,
            'service_type' => 'balance_enquiry',
            'bank_id' => $request->bank_id,
            'aadhaar_hash' => hash('sha256', $request->aadhaar_number),
            'aadhaar_last4' => $aadhaarLast4,
            'amount' => 0,
            'status' => $apiSuccess ? 'success' : 'failed',
            'response_message' => $apiSuccess ? "Balance: ₹" . number_format($balance, 2) : 'Enquiry failed',
        ]);

        TransactionLog::create([
            'txn_id' => $txnId, 'status' => $apiSuccess ? 'success' : 'failed',
            'service_type' => 'balance_enquiry', 'amount' => 0,
        ]);

        if ($apiSuccess) {
            return back()->with('success', "Account Balance: ₹" . number_format($balance, 2) . " (Aadhaar: ****{$aadhaarLast4})");
        }
        return back()->with('error', 'Balance enquiry failed. Please try again.');
    }

    public function miniStatement()
    {
        $banks = Bank::where('status', 'active')->get();
        return view('aeps.mini_statement', compact('banks'));
    }

    public function processMiniStatement(Request $request)
    {
        $request->validate([
            'aadhaar_number' => 'required|string|size:12',
            'bank_id' => 'required|exists:banks,id',
        ]);

        $user = auth()->user();
        $txnId = 'MS' . date('YmdHis') . rand(1000, 9999);
        $aadhaarLast4 = substr($request->aadhaar_number, -4);

        // Simulated mini statement
        $statements = [];
        for ($i = 0; $i < 5; $i++) {
            $statements[] = [
                'date' => now()->subDays(rand(1, 30))->format('d/m/Y'),
                'narration' => ['ATM/WDL', 'UPI/CR', 'NEFT/CR', 'POS/DR', 'INT/CR'][rand(0, 4)],
                'amount' => rand(100, 50000),
                'type' => ['Cr', 'Dr'][rand(0, 1)],
            ];
        }

        AepsTransaction::create([
            'user_id' => $user->id,
            'transaction_id' => $txnId,
            'service_type' => 'mini_statement',
            'bank_id' => $request->bank_id,
            'aadhaar_hash' => hash('sha256', $request->aadhaar_number),
            'aadhaar_last4' => $aadhaarLast4,
            'amount' => 0,
            'status' => 'success',
            'response_message' => json_encode($statements),
        ]);

        return back()->with('success', 'Mini Statement retrieved successfully.')->with('statements', $statements)->with('aadhaar_last4', $aadhaarLast4);
    }

    public function transactions()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $transactions = AepsTransaction::with('user', 'bank')->latest()->paginate(20);
        } elseif ($user->isDistributor()) {
            $retailerIds = $user->children()->pluck('users.id');
            $transactions = AepsTransaction::whereIn('user_id', $retailerIds)->with('user', 'bank')->latest()->paginate(20);
        } else {
            $transactions = $user->aepsTransactions()->with('bank')->latest()->paginate(20);
        }
        return view('aeps.transactions', compact('transactions'));
    }
}
