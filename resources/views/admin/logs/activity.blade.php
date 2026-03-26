@extends('layouts.app')
@section('title', 'Activity Logs')
@section('page_title', 'User Activity Logs')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-history" style="margin-right:8px;color:#818cf8;"></i>Activity Logs</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>User</th><th>Module</th><th>Action</th><th>Description</th><th>IP Address</th><th>Date</th></tr></thead>
                <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->user->name ?? 'System' }}</td>
                        <td><span class="badge badge-info">{{ ucfirst($log->module) }}</span></td>
                        <td><span class="badge badge-primary">{{ $log->action }}</span></td>
                        <td style="font-size:13px;max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $log->description }}">{{ $log->description }}</td>
                        <td style="font-family:monospace;">{{ $log->ip_address }}</td>
                        <td style="font-size:12px;">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;padding:40px;color:#64748b;">No activity logs found</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $logs->links() }}</div>
    </div>
</div>
@endsection
