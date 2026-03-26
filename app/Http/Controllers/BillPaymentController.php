<?php

namespace App\Http\Controllers;

use App\Models\BillPayment;
use App\Models\ServiceCharge;
use App\Models\LedgerEntry;
use App\Models\TransactionLog;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class BillPaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $payments = $user->isAdmin()
            ? BillPayment::with('user')->latest()->paginate(20)
            : $user->billPayments()->latest()->paginate(20);
        return view('bill_payments.index', compact('payments'));
    }

    public function create()
    {
        return view('bill_payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_type' => 'required|in:electricity,water,gas,mobile_recharge,dth',
            'operator' => 'required|string',
            'customer_id' => 'required|string',
            'amount' => 'required|numeric|min:10',
        ]);

        $user = auth()->user();
        $wallet = $user->wallet;

        if (!$wallet || $wallet->balance < $request->amount) {
            return back()->with('error', 'Insufficient wallet balance.');
        }

        $apiSuccess = rand(1, 10) <= 8;

        $payment = BillPayment::create([
            'user_id' => $user->id,
            'service_type' => $request->service_type,
            'operator' => $request->operator,
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
            'status' => $apiSuccess ? 'success' : 'failed',
            'response' => $apiSuccess ? 'Payment processed successfully' : 'Payment failed',
        ]);

        if ($apiSuccess) {
            $opening = $wallet->balance;
            $wallet->balance -= $request->amount;
            $wallet->save();

            LedgerEntry::create([
                'wallet_id' => $wallet->id, 'transaction_type' => 'debit',
                'amount' => $request->amount, 'opening_balance' => $opening,
                'closing_balance' => $wallet->balance, 'reference_id' => 'BP' . $payment->id,
                'description' => ucfirst($request->service_type) . ' payment - ' . $request->operator,
            ]);
        }

        TransactionLog::create([
            'txn_id' => 'BP' . $payment->id,
            'status' => $apiSuccess ? 'success' : 'failed',
            'service_type' => 'bill_payment',
            'amount' => $request->amount,
        ]);

        ActivityLog::create([
            'user_id' => $user->id, 'action' => 'bill_payment',
            'description' => ucfirst($request->service_type) . " payment of ₹{$request->amount} - " . ($apiSuccess ? 'Success' : 'Failed'),
            'ip_address' => $request->ip(),
        ]);

        return $apiSuccess
            ? back()->with('success', "₹{$request->amount} {$request->service_type} payment successful!")
            : back()->with('error', 'Payment failed. Please try again.');
    }
}
