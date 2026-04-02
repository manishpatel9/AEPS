@extends('layouts.app')
@section('title', 'Retailers of ' . $distributor->name)
@section('page_title', 'Retailers under ' . $distributor->name)
@section('content')
<div class="card">
    <div class="card-header">
        <h3>{{ $distributor->name }} — Retailers ({{ $retailers->total() }})</h3>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary btn-sm">Back to Users</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>Name</th><th>Email</th><th>Mobile</th><th>Wallet</th><th>KYC</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                @forelse($retailers as $r)
                    <tr>
                        <td style="font-weight:600;">{{ $r->name }}</td>
                        <td>{{ $r->email }}</td>
                        <td>{{ $r->mobile }}</td>
                        <td>₹{{ number_format($r->wallet->balance ?? 0, 2) }}</td>
                        <td><span class="badge badge-{{ ($r->profile->kyc_status ?? 'pending')==='verified'?'success':'warning' }}">{{ ucfirst($r->profile->kyc_status ?? 'pending') }}</span></td>
                        <td><span class="badge badge-{{ $r->status==='active'?'success':($r->status==='pending'?'warning':'danger') }}">{{ ucfirst($r->status) }}</span></td>
                        <td><a href="{{ route('admin.users.edit', $r->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:#64748b;">No retailers found</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $retailers->links() }}</div>
    </div>
</div>
@endsection
