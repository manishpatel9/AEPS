@extends('layouts.app')
@section('title', 'API Logs')
@section('page_title', 'API Logs')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-code" style="margin-right:8px;color:#818cf8;"></i>API Logs</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>ID</th><th>Provider</th><th>Endpoint</th><th>Request</th><th>Response</th><th>Status</th><th>IP</th><th>Date</th></tr></thead>
                <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td><td>{{ $log->apiProvider->name ?? 'N/A' }}</td><td style="font-family:monospace;font-size:12px;">{{ $log->endpoint }}</td>
                        <td><button type="button" class="btn btn-sm btn-secondary" onclick="alert('{{ addslashes(json_encode($log->request_payload)) }}')">View</button></td>
                        <td><button type="button" class="btn btn-sm btn-secondary" onclick="alert('{{ addslashes(json_encode($log->response_payload)) }}')">View</button></td>
                        <td><span class="badge badge-{{ $log->status_code === 200 ? 'success' : 'danger' }}">{{ $log->status_code }}</span></td>
                        <td>{{ $log->ip_address }}</td><td style="font-size:12px;">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="8" style="text-align:center;padding:40px;color:#64748b;">No API logs found</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $logs->links() }}</div>
    </div>
</div>
@endsection
