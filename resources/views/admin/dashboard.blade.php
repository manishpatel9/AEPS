@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('page_title', 'Admin Dashboard')
@section('page_subtitle', 'Track users, transactions, and system health with a clean command center view.')
@section('page_actions')
    <a href="{{ route('admin.users') }}" class="btn btn-secondary btn-sm"><i class="fas fa-users"></i> Manage Users</a>
    <a href="{{ route('admin.support_tickets') }}" class="btn btn-primary btn-sm"><i class="fas fa-ticket-alt"></i> Review Tickets</a>
@endsection
@section('content')
<div class="stats-grid">
    <div class="stat-card purple dynamic-card"><div class="card-accent"></div><div class="stat-icon"><i class="fas fa-users"></i></div><div class="stat-value">{{ $totalUsers }}</div><div class="stat-label">Total Users</div></div>
    <div class="stat-card blue dynamic-card"><div class="card-accent"></div><div class="stat-icon"><i class="fas fa-store"></i></div><div class="stat-value">{{ $totalRetailers }}</div><div class="stat-label">Retailers</div></div>
    <div class="stat-card green dynamic-card"><div class="card-accent"></div><div class="stat-icon"><i class="fas fa-exchange-alt"></i></div><div class="stat-value">{{ $todayTransactions }}</div><div class="stat-label">Today's Transactions</div></div>
    <div class="stat-card amber dynamic-card"><div class="card-accent"></div><div class="stat-icon"><i class="fas fa-rupee-sign"></i></div><div class="stat-value">₹{{ number_format($todayVolume) }}</div><div class="stat-label">Today's Volume</div></div>
</div>
<div class="stats-grid">
    <div class="stat-card blue dynamic-card"><div class="card-accent"></div><div class="stat-icon"><i class="fas fa-building"></i></div><div class="stat-value">{{ $totalDistributors }}</div><div class="stat-label">Distributors</div></div>
    <div class="stat-card purple dynamic-card"><div class="card-accent"></div><div class="stat-icon"><i class="fas fa-user-clock"></i></div><div class="stat-value">{{ $pendingUsers }}</div><div class="stat-label">Pending Approvals</div></div>
    <div class="stat-card green dynamic-card"><div class="card-accent"></div><div class="stat-icon"><i class="fas fa-chart-line"></i></div><div class="stat-value">{{ $totalTransactions }}</div><div class="stat-label">Total Transactions</div></div>
    <div class="stat-card amber dynamic-card"><div class="card-accent"></div><div class="stat-icon"><i class="fas fa-ticket-alt"></i></div><div class="stat-value">{{ $openTickets }}</div><div class="stat-label">Open Tickets</div></div>
</div>

<div class="card">
    <div class="card-header"><h3><i class="fas fa-history" style="margin-right:8px;color:#818cf8;"></i>Recent Transactions</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>Txn ID</th><th>User</th><th>Type</th><th>Bank</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
                <tbody>
                @forelse($recentTransactions as $txn)
                    <tr>
                        <td style="font-family:monospace;font-size:12px;">{{ $txn->transaction_id }}</td>
                        <td>{{ $txn->user->name ?? 'N/A' }}</td>
                        <td><span class="badge badge-info">{{ ucwords(str_replace('_', ' ', $txn->service_type)) }}</span></td>
                        <td>{{ $txn->bank->bank_name ?? 'N/A' }}</td>
                        <td style="font-weight:700;">₹{{ number_format($txn->amount, 2) }}</td>
                        <td><span class="badge badge-{{ $txn->status === 'success' ? 'success' : ($txn->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($txn->status) }}</span></td>
                        <td style="font-size:12px;">{{ $txn->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:#64748b;">No transactions yet</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
