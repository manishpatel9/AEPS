@extends('layouts.app')
@section('title', 'Create User')
@section('page_title', 'Create New User')
@section('content')
<div style="max-width:600px;">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-user-plus" style="margin-right:8px;color:#818cf8;"></i>Create User</h3></div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="form-group"><label>Full Name</label><input type="text" name="name" class="form-control" required value="{{ old('name') }}"></div>
                <div class="form-row">
                    <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" required value="{{ old('email') }}"></div>
                    <div class="form-group"><label>Mobile</label><input type="text" name="mobile" class="form-control" maxlength="10" required value="{{ old('mobile') }}"></div>
                </div>
                <div class="form-row">
                    <div class="form-group"><label>Role</label><select name="role" class="form-control" required id="roleSelect"><option value="retailer">Retailer</option><option value="distributor">Distributor</option><option value="admin">Admin</option></select></div>
                    <div class="form-group"><label>Password</label><input type="password" name="password" class="form-control" required minlength="6"></div>
                </div>
                <div class="form-group" id="parentGroup">
                    <label>Parent Distributor (for Retailers)</label>
                    <select name="parent_id" class="form-control"><option value="">-- None --</option>@foreach($distributors as $d)<option value="{{ $d->id }}">{{ $d->name }} ({{ $d->mobile }})</option>@endforeach</select>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;"><i class="fas fa-save"></i> Create User</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function(){
            $('select[name="parent_id"]').select2({
                placeholder: '-- None --', allowClear: true, width: '100%'
            });

            // Show/hide parent selector depending on role
            $('#roleSelect').on('change', function(){
                if ($(this).val() === 'retailer') { $('#parentGroup').show(); } else { $('#parentGroup').hide(); }
            }).trigger('change');
        });
    </script>
@endsection
