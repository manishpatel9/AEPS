<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AepsTransaction;
use App\Models\Settlement;
use App\Models\SupportTicket;
use App\Models\CommissionReport;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $data = [
            'totalUsers' => User::count(),
            'totalRetailers' => User::where('role', 'retailer')->count(),
            'totalDistributors' => User::where('role', 'distributor')->count(),
            'pendingUsers' => User::where('status', 'pending')->count(),
            'todayTransactions' => AepsTransaction::whereDate('created_at', today())->count(),
            'todayVolume' => AepsTransaction::whereDate('created_at', today())->where('status', 'success')->sum('amount'),
            'totalTransactions' => AepsTransaction::count(),
            'totalVolume' => AepsTransaction::where('status', 'success')->sum('amount'),
            'pendingSettlements' => Settlement::where('status', 'pending')->count(),
            'openTickets' => SupportTicket::where('status', 'open')->count(),
            'recentTransactions' => AepsTransaction::with('user', 'bank')->latest()->take(10)->get(),
            'recentUsers' => User::latest()->take(5)->get(),
        ];
        return view('admin.dashboard', $data);
    }

    public function distributor()
    {
        $user = auth()->user();
        $retailerIds = $user->children()->pluck('users.id');

        $data = [
            'walletBalance' => $user->getWalletBalance(),
            'totalRetailers' => $retailerIds->count(),
            'activeRetailers' => User::whereIn('id', $retailerIds)->where('status', 'active')->count(),
            'todayTransactions' => AepsTransaction::whereIn('user_id', $retailerIds)->whereDate('created_at', today())->count(),
            'todayVolume' => AepsTransaction::whereIn('user_id', $retailerIds)->whereDate('created_at', today())->where('status', 'success')->sum('amount'),
            'totalCommission' => CommissionReport::where('user_id', $user->id)->sum('amount'),
            'retailers' => User::whereIn('id', $retailerIds)->with('wallet')->latest()->take(10)->get(),
            'recentTransactions' => AepsTransaction::whereIn('user_id', $retailerIds)->with('user', 'bank')->latest()->take(10)->get(),
        ];
        return view('distributor.dashboard', $data);
    }

    public function retailer()
    {
        $user = auth()->user();
        $data = [
            'walletBalance' => $user->getWalletBalance(),
            'todayTransactions' => $user->aepsTransactions()->whereDate('created_at', today())->count(),
            'todayVolume' => $user->aepsTransactions()->whereDate('created_at', today())->where('status', 'success')->sum('amount'),
            'todayCommission' => $user->aepsTransactions()->whereDate('created_at', today())->where('status', 'success')->sum('commission'),
            'totalTransactions' => $user->aepsTransactions()->count(),
            'totalCommission' => CommissionReport::where('user_id', $user->id)->sum('amount'),
            'recentTransactions' => $user->aepsTransactions()->with('bank')->latest()->take(10)->get(),
            'kycStatus' => $user->profile ? $user->profile->kyc_status : 'pending',
        ];
        return view('retailer.dashboard', $data);
    }
}
