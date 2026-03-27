@extends('layouts.app')
@section('title', 'Retailer Dashboard')
@section('page_title', 'Retailer Dashboard')
@section('page_subtitle', 'Run AEPS services faster with live balances, commissions, and transaction tracking.')
@section('page_actions')
    <a href="{{ route('retailer.aeps.cash_withdrawal') }}" class="btn btn-primary btn-sm"><i class="fas fa-money-bill-wave"></i> Cash Withdrawal</a>
    <a href="{{ route('retailer.aeps.transactions') }}" class="btn btn-secondary btn-sm"><i class="fas fa-receipt"></i> View Transactions</a>
@endsection
@section('content')
    @include('partials.dashboard-analytics')

    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));gap:20px;margin-bottom:30px;">
        <a href="{{ route('retailer.aeps.cash_withdrawal') }}" class="stat-card purple dynamic-card" style="text-decoration:none;cursor:pointer;">
            <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
            <div class="stat-value" style="font-size:18px;">Cash Withdrawal</div>
            <div class="stat-label">AEPS Cash Withdrawal Service</div>
            <div class="stat-meta" style="margin-top:14px;color:#64748b;">Serve cash-out requests quickly from one place.</div>
        </a>
        <a href="{{ route('retailer.aeps.balance_enquiry') }}" class="stat-card blue dynamic-card" style="text-decoration:none;cursor:pointer;">
            <div class="stat-icon"><i class="fas fa-search-dollar"></i></div>
            <div class="stat-value" style="font-size:18px;">Balance Enquiry</div>
            <div class="stat-label">Check Bank Account Balance</div>
            <div class="stat-meta" style="margin-top:14px;color:#64748b;">Confirm balances before the next customer request.</div>
        </a>
        <a href="{{ route('retailer.aeps.mini_statement') }}" class="stat-card green dynamic-card" style="text-decoration:none;cursor:pointer;">
            <div class="stat-icon"><i class="fas fa-list-alt"></i></div>
            <div class="stat-value" style="font-size:18px;">Mini Statement</div>
            <div class="stat-label">Last 5 Transaction Details</div>
            <div class="stat-meta" style="margin-top:14px;color:#64748b;">Print a recent activity summary for customers.</div>
        </a>
    </div>
@endsection
@section('scripts')
    @include('partials.dashboard-analytics-scripts')
@endsection
