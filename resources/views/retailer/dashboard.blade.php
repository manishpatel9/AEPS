@extends('layouts.app')
@section('title', 'Retailer Dashboard')
@section('page_title', 'Retailer Dashboard')
@section('page_subtitle', 'Run AEPS services faster with live balances, commissions, and transaction tracking.')
@section('page_actions')
    <a href="{{ route('retailer.aeps.cash_withdrawal') }}" class="btn btn-primary btn-sm"><i class="fas fa-money-bill-wave"></i> Cash Withdrawal</a>
    <a href="{{ route('retailer.aeps.transactions') }}" class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i> View Transactions</a>
@endsection
@section('content')
<div class="stats-grid">
    <div class="stat-card purple"><div class="stat-icon"><i class="fas fa-wallet"></i></div><div class="stat-value">₹{{ number_format($walletBalance) }}</div><div class="stat-label">Wallet Balance</div></div>
    <div class="stat-card blue"><div class="stat-icon"><i class="fas fa-exchange-alt"></i></div><div class="stat-value">{{ $todayTransactions }}</div><div class="stat-label">Today's Transactions</div></div>
    <div class="stat-card green"><div class="stat-icon"><i class="fas fa-rupee-sign"></i></div><div class="stat-value">₹{{ number_format($todayVolume) }}</div><div class="stat-label">Today's Volume</div></div>
    <div class="stat-card amber"><div class="stat-icon"><i class="fas fa-coins"></i></div><div class="stat-value">₹{{ number_format($todayCommission) }}</div><div class="stat-label">Today's Commission</div></div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(300px, 1fr));gap:20px;margin-bottom:30px;">
    <a href="{{ route('retailer.aeps.cash_withdrawal') }}" class="stat-card purple" style="text-decoration:none;cursor:pointer;">
        <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
        <div class="stat-value" style="font-size:18px;">Cash Withdrawal</div>
        <div class="stat-label">AEPS Cash Withdrawal Service</div>
    </a>
    <a href="{{ route('retailer.aeps.balance_enquiry') }}" class="stat-card blue" style="text-decoration:none;cursor:pointer;">
        <div class="stat-icon"><i class="fas fa-search-dollar"></i></div>
        <div class="stat-value" style="font-size:18px;">Balance Enquiry</div>
        <div class="stat-label">Check Bank Account Balance</div>
    </a>
    <a href="{{ route('retailer.aeps.mini_statement') }}" class="stat-card green" style="text-decoration:none;cursor:pointer;">
        <div class="stat-icon"><i class="fas fa-list-alt"></i></div>
        <div class="stat-value" style="font-size:18px;">Mini Statement</div>
        <div class="stat-label">Last 5 Transaction Details</div>
    </a>
</div>

<div class="card">
    <div class="card-header"><h3><i class="fas fa-history icon-accent" style="margin-right:8px;"></i>Recent Transactions</h3><a href="{{ route('retailer.aeps.transactions') }}" class="btn btn-sm btn-secondary">View All</a></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>Txn ID</th><th>Type</th><th>Bank</th><th>Amount</th><th>Commission</th><th>Status</th><th>Date</th></tr></thead>
                <tbody>
                @forelse($recentTransactions as $txn)
                    <tr>
                        <td style="font-family:monospace;font-size:12px;">{{ $txn->transaction_id }}</td>
                        <td><span class="badge badge-info">{{ ucwords(str_replace('_', ' ', $txn->service_type)) }}</span></td>
                        <td>{{ $txn->bank->bank_name ?? 'N/A' }}</td>
                        <td style="font-weight:700;">₹{{ number_format($txn->amount, 2) }}</td>
                        <td class="text-success" style="font-weight:600;">₹{{ number_format($txn->commission, 2) }}</td>
                        <td><span class="badge badge-{{ $txn->status === 'success' ? 'success' : ($txn->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($txn->status) }}</span></td>
                        <td class="text-muted" style="font-size:12px;">{{ $txn->created_at->format('d M H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-muted" style="text-align:center;padding:40px;">No transactions yet. Start with Cash Withdrawal!</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
