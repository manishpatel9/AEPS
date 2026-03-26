@extends('layouts.app')
@section('title', 'Audit Logs')
@section('page_title', 'System Audit Logs')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-clipboard-list" style="margin-right:8px;color:#818cf8;"></i>Audit Logs</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>ID</th><th>User</th><th>Action</th><th>Table</th><th>Record ID</th><th>IP</th><th>Date</th></tr></thead>
                <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td><td>{{ $log->user->name ?? 'System' }}</td>
                        <td><span class="badge badge-primary">{{ $log->action }}</span></td>
                        <td style="font-family:monospace;">{{ $log->table_name }}</td>
                        <td>{{ $log->record_id }}</td>
                        <td>{{ $log->ip_address }}</td>
                        <td style="font-size:12px;">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:#64748b;">No audit logs found</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $logs->links() }}</div>
    </div>
</div>
@endsection
