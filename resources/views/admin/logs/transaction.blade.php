@extends('layouts.app')
@section('title', 'Transaction Logs')
@section('page_title', 'Transaction Logs')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-exchange-alt" style="margin-right:8px;color:#818cf8;"></i>Transaction Logs</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>Txn ID</th><th>User ID</th><th>Type</th><th>Amount</th><th>Status</th><th>Message</th><th>Date</th></tr></thead>
                <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td style="font-family:monospace;">{{ $log->transaction_id ?? '-' }}</td>
                        <td>{{ $log->user_id ?? 'System' }}</td>
                        <td><span class="badge badge-info">{{ $log->transaction_type }}</span></td>
                        <td style="font-weight:700;">₹{{ number_format($log->amount, 2) }}</td>
                        <td><span class="badge badge-{{ $log->status === 'success' ? 'success' : ($log->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($log->status) }}</span></td>
                        <td style="font-size:12px;">{{ $log->message }}</td>
                        <td style="font-size:12px;">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:#64748b;">No transaction logs found</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $logs->links() }}</div>
    </div>
</div>
@endsection
