@extends('layouts.app')
@section('title', 'Distributor Dashboard')
@section('page_title', 'Distributor Dashboard')
@section('page_subtitle', 'Monitor retailers, track wallet movement, and keep commissions growing.')
@section('page_actions')
    <a href="{{ route('distributor.add_funds') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Add Funds</a>
    <a href="{{ route('reports.commissions') }}" class="btn btn-secondary btn-sm"><i class="fas fa-chart-line"></i> View Commissions</a>
@endsection
@section('content')
<div class="stats-grid">
    <div class="stat-card purple"><div class="stat-icon"><i class="fas fa-wallet"></i></div><div class="stat-value">₹{{ number_format($walletBalance) }}</div><div class="stat-label">Wallet Balance</div></div>
    <div class="stat-card blue"><div class="stat-icon"><i class="fas fa-store"></i></div><div class="stat-value">{{ $totalRetailers }}</div><div class="stat-label">Total Retailers</div></div>
    <div class="stat-card green"><div class="stat-icon"><i class="fas fa-exchange-alt"></i></div><div class="stat-value">{{ $todayTransactions }}</div><div class="stat-label">Today's Transactions</div></div>
    <div class="stat-card amber"><div class="stat-icon"><i class="fas fa-coins"></i></div><div class="stat-value">₹{{ number_format($totalCommission) }}</div><div class="stat-label">Total Commission</div></div>
</div>

<div class="card">
    <div class="card-header"><h3><i class="fas fa-users" style="margin-right:8px;color:#818cf8;"></i>My Retailers</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>Name</th><th>Mobile</th><th>Status</th><th>Wallet</th></tr></thead>
                <tbody>
                @forelse($retailers as $r)
                    <tr>
                        <td>{{ $r->name }}</td><td>{{ $r->mobile }}</td>
                        <td><span class="badge badge-{{ $r->status === 'active' ? 'success' : 'warning' }}">{{ ucfirst($r->status) }}</span></td>
                        <td style="font-weight:700;">₹{{ number_format($r->wallet->balance ?? 0, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="text-align:center;padding:40px;color:#64748b;">No retailers yet</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
