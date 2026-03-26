@extends('layouts.app')
@section('title', 'Fund Transfers')
@section('page_title', 'Fund Transfer History')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-exchange-alt" style="margin-right:8px;color:#818cf8;"></i>Fund Transfers</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>Reference</th><th>From</th><th>To</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
                <tbody>
                @forelse($transfers as $t)
                    <tr>
                        <td style="font-family:monospace;font-size:12px;">{{ $t->reference_id }}</td>
                        <td>{{ $t->fromUser->name ?? 'N/A' }}</td><td>{{ $t->toUser->name ?? 'N/A' }}</td>
                        <td style="font-weight:700;">₹{{ number_format($t->amount, 2) }}</td>
                        <td><span class="badge badge-{{ $t->status === 'completed' ? 'success' : 'warning' }}">{{ ucfirst($t->status) }}</span></td>
                        <td style="font-size:12px;">{{ $t->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;padding:40px;color:#64748b;">No fund transfers</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $transfers->links() }}</div>
    </div>
</div>
@endsection
