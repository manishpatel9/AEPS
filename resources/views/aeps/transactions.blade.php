@extends('layouts.app')
@section('title', 'AEPS Transactions')
@section('page_title', 'Transaction History')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-exchange-alt" style="margin-right:8px;color:#818cf8;"></i>All AEPS Transactions</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>Txn ID</th><th>Type</th>@if(auth()->user()->isAdmin())<th>User</th>@endif<th>Bank</th><th>Amount</th><th>Commission</th><th>Status</th><th>RRN</th><th>Date</th></tr></thead>
                <tbody>
                @forelse($transactions as $txn)
                    <tr>
                        <td style="font-family:monospace;font-size:12px;">{{ $txn->transaction_id }}</td>
                        <td><span class="badge badge-info">{{ ucwords(str_replace('_', ' ', $txn->service_type)) }}</span></td>
                        @if(auth()->user()->isAdmin())<td>{{ $txn->user->name ?? 'N/A' }}</td>@endif
                        <td>{{ $txn->bank->bank_name ?? '-' }}</td>
                        <td style="font-weight:700;">₹{{ number_format($txn->amount, 2) }}</td>
                        <td style="color:#34d399;">₹{{ number_format($txn->commission, 2) }}</td>
                        <td><span class="badge badge-{{ $txn->status === 'success' ? 'success' : ($txn->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($txn->status) }}</span></td>
                        <td style="font-family:monospace;font-size:12px;">{{ $txn->rrn ?? '-' }}</td>
                        <td style="font-size:12px;">{{ $txn->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="9" style="text-align:center;padding:40px;color:#64748b;">No transactions found</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $transactions->links() }}</div>
    </div>
</div>
@endsection
