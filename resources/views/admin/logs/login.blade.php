@extends('layouts.app')
@section('title', 'Login Logs')
@section('page_title', 'User Login Logs')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-sign-in-alt" style="margin-right:8px;color:#818cf8;"></i>Login Logs</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>User</th><th>IP Address</th><th>User Agent</th><th>Status</th><th>Date & Time</th></tr></thead>
                <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->user->name ?? 'Unknown' }}<br><small style="color:#64748b;">{{ $log->user->email ?? '' }}</small></td>
                        <td style="font-family:monospace;">{{ $log->ip_address }}</td>
                        <td style="font-size:12px;max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $log->user_agent }}">{{ $log->user_agent }}</td>
                        <td><span class="badge badge-{{ $log->status === 'success' ? 'success' : 'danger' }}">{{ ucfirst($log->status) }}</span></td>
                        <td style="font-size:12px;">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;padding:40px;color:#64748b;">No login logs found</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $logs->links() }}</div>
    </div>
</div>
@endsection
