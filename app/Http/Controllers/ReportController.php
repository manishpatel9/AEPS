<?php

namespace App\Http\Controllers;

use App\Models\Settlement;
use App\Models\CommissionReport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function settlements()
    {
        $user = auth()->user();
        $settlements = $user->isAdmin()
            ? Settlement::with('user')->latest()->paginate(20)
            : $user->settlements()->latest()->paginate(20);
        return view('reports.settlements', compact('settlements'));
    }

    public function commissions()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $reports = CommissionReport::with('user')->latest()->paginate(20);
            $totalCommission = CommissionReport::sum('amount');
        } else {
            $reports = CommissionReport::where('user_id', $user->id)->latest()->paginate(20);
            $totalCommission = CommissionReport::where('user_id', $user->id)->sum('amount');
        }

        return view('reports.commissions', compact('reports', 'totalCommission'));
    }

    public function requestSettlement(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:100']);
        $user = auth()->user();
        $wallet = $user->wallet;

        if (!$wallet || $wallet->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance for settlement.');
        }

        Settlement::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Settlement request of ₹' . number_format($request->amount, 2) . ' submitted.');
    }
}
