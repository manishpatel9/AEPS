@extends('layouts.app')
@section('title', 'Commission Report')
@section('page_title', 'Commission Report')
@section('content')
<div class="card">
    <div class="card-header">
        <h3><i class="fas fa-coins" style="margin-right:8px;color:#818cf8;"></i>Commission Earnings</h3>
        <div style="font-size:14px;color:#34d399;font-weight:700;">Total Earned: ₹{{ number_format($totalCommission, 2) }}</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>Transaction Ref</th><th>Type</th><th>Transaction Date</th><th>Commission Earned</th></tr></thead>
                <tbody>
                @forelse($reports as $r)
                    <tr>
                        <td style="font-family:monospace;">{{ $r->transaction_id ?? '-' }}</td>
                        <td><span class="badge badge-info">{{ ucwords(str_replace('_', ' ', $r->type ?? '-')) }}</span></td>
                        <td style="font-size:12px;">{{ $r->transaction_date ? \Carbon\Carbon::parse($r->transaction_date)->format('d M Y H:i:s') : '-' }}</td>
                        <td style="font-weight:700;color:#34d399;">₹{{ number_format($r->amount, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="text-align:center;padding:40px;color:#64748b;">No commission logs found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $reports->links() }}</div>
    </div>
</div>
@endsection
