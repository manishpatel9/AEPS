<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\LedgerEntry;
use App\Models\FundTransfer;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $wallet = $user->wallet;
        $ledger = LedgerEntry::where('wallet_id', $wallet->id)->latest()->paginate(20);
        return view('wallet.index', compact('wallet', 'ledger'));
    }

    public function addFunds()
    {
        $users = [];
        $user = auth()->user();
        if ($user->isAdmin()) {
            $users = User::where('role', '!=', 'admin')->where('status', 'active')->get();
        } elseif ($user->isDistributor()) {
            $users = $user->children()->where('status', 'active')->get();
        }
        return view('wallet.add_funds', compact('users'));
    }

    public function processAddFunds(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $sender = auth()->user();
        $senderWallet = $sender->wallet;
        $receiver = User::findOrFail($request->user_id);
        $receiverWallet = $receiver->wallet;

        if (!$senderWallet || $senderWallet->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance.');
        }

        $refId = 'FT' . date('YmdHis') . rand(1000, 9999);

        // Debit sender
        $senderOpening = $senderWallet->balance;
        $senderWallet->balance -= $request->amount;
        $senderWallet->save();

        LedgerEntry::create([
            'wallet_id' => $senderWallet->id, 'transaction_type' => 'debit',
            'amount' => $request->amount, 'opening_balance' => $senderOpening,
            'closing_balance' => $senderWallet->balance, 'reference_id' => $refId,
            'description' => "Fund transfer to {$receiver->name}",
        ]);

        // Credit receiver
        $receiverOpening = $receiverWallet->balance;
        $receiverWallet->balance += $request->amount;
        $receiverWallet->save();

        LedgerEntry::create([
            'wallet_id' => $receiverWallet->id, 'transaction_type' => 'credit',
            'amount' => $request->amount, 'opening_balance' => $receiverOpening,
            'closing_balance' => $receiverWallet->balance, 'reference_id' => $refId,
            'description' => "Fund received from {$sender->name}",
        ]);

        FundTransfer::create([
            'from_user_id' => $sender->id, 'to_user_id' => $receiver->id,
            'amount' => $request->amount, 'reference_id' => $refId,
            'status' => 'completed', 'remarks' => $request->remarks,
        ]);

        ActivityLog::create([
            'user_id' => $sender->id, 'action' => 'fund_transfer',
            'description' => "Transferred ₹{$request->amount} to {$receiver->name}",
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', "₹{$request->amount} transferred successfully to {$receiver->name}.");
    }

    public function fundTransfers()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $transfers = FundTransfer::with('fromUser', 'toUser')->latest()->paginate(20);
        } else {
            $transfers = FundTransfer::where('from_user_id', $user->id)
                ->orWhere('to_user_id', $user->id)
                ->with('fromUser', 'toUser')->latest()->paginate(20);
        }
        return view('wallet.fund_transfers', compact('transfers'));
    }
}
