@extends('layouts.app')
@section('title', 'Commission Reports')
@section('page_title', 'Commission Reports')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-chart-bar" style="margin-right:8px;color:#818cf8;"></i>Commission Reports</h3></div>
    <div class="card-body"><div class="table-responsive"><table>
        <thead><tr><th>User</th><th>Transaction</th><th>Amount</th><th>Type</th><th>Date</th></tr></thead>
        <tbody>
        @forelse($reports as $r)
            <tr><td>{{ $r->user->name ?? 'N/A' }}</td><td style="font-family:monospace;font-size:12px;">{{ $r->transaction_id ?? '-' }}</td><td style="font-weight:700;color:#34d399;">₹{{ number_format($r->amount, 2) }}</td><td>{{ ucwords(str_replace('_',' ',$r->type ?? '-')) }}</td><td style="font-size:12px;">{{ $r->transaction_date ? \Carbon\Carbon::parse($r->transaction_date)->format('d M Y') : '-' }}</td></tr>
        @empty
            <tr><td colspan="5" style="text-align:center;padding:40px;color:#64748b;">No commission reports</td></tr>
        @endforelse
        </tbody>
    </table></div><div class="pagination-wrapper">{{ $reports->links() }}</div></div>
</div>
@endsection
