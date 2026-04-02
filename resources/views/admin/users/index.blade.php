@extends('layouts.app')
@section('title', 'Manage Users')
@section('page_title', 'User Management')
@section('content')
<div class="card">
    <div class="card-header">
        <h3><i class="fas fa-users" style="margin-right:8px;color:#818cf8;"></i>All Users</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add User</a>
    </div>
    <div class="card-body">
        <form method="GET" style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap;">
            <input type="text" name="search" class="form-control" style="max-width:250px;" placeholder="Search name/email/mobile" value="{{ request('search') }}">
            <select name="role" class="form-control" style="max-width:160px;"><option value="">All Roles</option><option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option><option value="distributor" {{ request('role')=='distributor'?'selected':'' }}>Distributor</option><option value="retailer" {{ request('role')=='retailer'?'selected':'' }}>Retailer</option></select>
            <select name="status" class="form-control" style="max-width:160px;"><option value="">All Status</option><option value="active" {{ request('status')=='active'?'selected':'' }}>Active</option><option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option><option value="suspended" {{ request('status')=='suspended'?'selected':'' }}>Suspended</option></select>
            <button class="btn btn-secondary btn-sm"><i class="fas fa-search"></i> Filter</button>
        </form>
        <div class="table-responsive">
            <table>
                <thead><tr><th>Name</th><th>Email</th><th>Mobile</th><th>Role</th><th>Retailers</th><th>Distributor</th><th>Wallet</th><th>KYC</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                @forelse($users as $u)
                    <tr>
                        <td style="font-weight:600;">{{ $u->name }}</td><td>{{ $u->email }}</td><td>{{ $u->mobile }}</td>
                        <td><span class="badge badge-{{ $u->role==='admin'?'primary':($u->role==='distributor'?'info':'warning') }}">{{ ucfirst($u->role) }}</span></td>
                        <td>
                            @if($u->role === 'distributor')
                                <a href="{{ route('admin.users.distributor_retailers', $u->id) }}">{{ $u->retailer_count ?? 0 }} retailers</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $u->parents->first() ? $u->parents->first()->name . ' (' . $u->parents->first()->mobile . ')' : '-' }}</td>
                        <td style="font-weight:600;">₹{{ number_format($u->wallet->balance ?? 0, 2) }}</td>
                        <td><span class="badge badge-{{ ($u->profile->kyc_status ?? 'pending')==='verified'?'success':'warning' }}">{{ ucfirst($u->profile->kyc_status ?? 'pending') }}</span></td>
                        <td><span class="badge badge-{{ $u->status==='active'?'success':($u->status==='pending'?'warning':'danger') }}">{{ ucfirst($u->status) }}</span></td>
                        <td style="display:flex;gap:6px;">
                            <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i></a>
                            @if($u->status === 'pending')
                                <form method="POST" action="{{ route('admin.users.approve', $u->id) }}" style="display:inline;">@csrf<button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button></form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" style="text-align:center;padding:40px;color:#64748b;">No users found</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $users->links() }}</div>
    </div>
</div>
@endsection
