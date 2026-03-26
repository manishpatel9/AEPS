@extends('layouts.app')
@section('title', 'Device Mappings')
@section('page_title', 'Biometric Device Mappings')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-fingerprint" style="margin-right:8px;color:#818cf8;"></i>Device Mappings</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.device_mappings.store') }}" style="display:flex;gap:12px;margin-bottom:24px;flex-wrap:wrap;align-items:flex-end;">
            @csrf
            <div class="form-group" style="margin:0;"><label>User ID</label><input type="number" name="user_id" class="form-control" required></div>
            <div class="form-group" style="margin:0;"><label>Device ID</label><input type="text" name="device_id" class="form-control" required></div>
            <div class="form-group" style="margin:0;"><label>Model</label><input type="text" name="device_model" class="form-control"></div>
            <div class="form-group" style="margin:0;"><label>Serial</label><input type="text" name="serial_number" class="form-control"></div>
            <button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Map Device</button>
        </form>
        <div class="table-responsive">
            <table>
                <thead><tr><th>User</th><th>Device ID</th><th>Model</th><th>Serial</th><th>Status</th><th>Mapped On</th></tr></thead>
                <tbody>
                @forelse($devices as $d)
                    <tr><td>{{ $d->user->name ?? 'N/A' }}</td><td style="font-family:monospace;">{{ $d->device_id }}</td><td>{{ $d->device_model ?? '-' }}</td><td>{{ $d->serial_number ?? '-' }}</td><td><span class="badge badge-{{ $d->status==='active'?'success':'danger' }}">{{ ucfirst($d->status) }}</span></td><td style="font-size:12px;">{{ $d->created_at->format('d M Y') }}</td></tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;padding:40px;color:#64748b;">No devices mapped</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
