@extends('layouts.app')
@section('title', 'Edit User')
@section('page_title', 'Edit User: ' . $user->name)
@section('content')
<div style="max-width:600px;">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-user-edit" style="margin-right:8px;color:#818cf8;"></i>Edit User</h3></div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf @method('PUT')
                <div class="form-group"><label>Full Name</label><input type="text" name="name" class="form-control" value="{{ $user->name }}" required></div>
                <div class="form-row">
                    <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="{{ $user->email }}" required></div>
                    <div class="form-group"><label>Mobile</label><input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}" required></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>Role</label><select name="role" class="form-control" required><option value="retailer" {{ $user->role==='retailer'?'selected':'' }}>Retailer</option><option value="distributor" {{ $user->role==='distributor'?'selected':'' }}>Distributor</option><option value="admin" {{ $user->role==='admin'?'selected':'' }}>Admin</option></select></div>
                    <div class="form-group"><label>Status</label><select name="status" class="form-control" required><option value="active" {{ $user->status==='active'?'selected':'' }}>Active</option><option value="pending" {{ $user->status==='pending'?'selected':'' }}>Pending</option><option value="suspended" {{ $user->status==='suspended'?'selected':'' }}>Suspended</option><option value="inactive" {{ $user->status==='inactive'?'selected':'' }}>Inactive</option></select></div>
                </div>
                <div class="form-group"><label>New Password (leave blank to keep current)</label><input type="password" name="password" class="form-control" minlength="6"></div>
                <div style="display:flex;gap:12px;"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update User</button><a href="{{ route('admin.users') }}" class="btn btn-secondary">Cancel</a></div>
            </form>
        </div>
    </div>
</div>
@endsection
