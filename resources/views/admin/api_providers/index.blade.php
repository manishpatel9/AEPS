@extends('layouts.app')
@section('title', 'API Providers')
@section('page_title', 'API Provider Management')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-plug" style="margin-right:8px;color:#818cf8;"></i>API Providers</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.api_providers.store') }}" style="display:flex;gap:12px;margin-bottom:24px;flex-wrap:wrap;align-items:flex-end;">
            @csrf
            <div class="form-group" style="margin:0;"><label>Name</label><input type="text" name="name" class="form-control" required></div>
            <div class="form-group" style="margin:0;"><label>API URL</label><input type="url" name="api_url" class="form-control" required></div>
            <div class="form-group" style="margin:0;"><label>API Key</label><input type="text" name="api_key" class="form-control" placeholder="Optional"></div>
            <div class="form-group" style="margin:0;"><label>Status</label><select name="status" class="form-control"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
            <button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</button>
        </form>
        <div class="table-responsive">
            <table>
                <thead><tr><th>Name</th><th>API URL</th><th>Status</th><th>Created</th></tr></thead>
                <tbody>
                @forelse($providers as $p)
                    <tr><td style="font-weight:600;">{{ $p->name }}</td><td style="font-family:monospace;font-size:12px;">{{ $p->api_url }}</td><td><span class="badge badge-{{ $p->status==='active'?'success':'danger' }}">{{ ucfirst($p->status) }}</span></td><td style="font-size:12px;">{{ $p->created_at->format('d M Y') }}</td></tr>
                @empty
                    <tr><td colspan="4" style="text-align:center;padding:40px;color:#64748b;">No API providers</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $providers->links() }}</div>
    </div>
</div>
@endsection
