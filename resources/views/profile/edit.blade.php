@extends('layouts.app')
@section('title', 'My Profile')
@section('page_title', 'My Profile & KYC')
@section('content')
<div class="form-row">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-user-cog" style="margin-right:8px;color:#818cf8;"></i>Personal Details</h3></div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin:0;padding-left:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf @method('PUT')
                <div class="form-group"><label>Full Name</label><input type="text" name="name" class="form-control" value="{{ $user->name }}" required></div>
                <div class="form-group"><label>Email Address</label><input type="email" name="email" class="form-control" value="{{ $user->email }}" required></div>
                <div class="form-group"><label>Mobile Number</label><input type="text" class="form-control" value="{{ $user->mobile }}" readonly style="background:rgba(15,23,42,0.5);opacity:0.7;"></div>
                <div class="form-group"><label>Date of Birth</label><input type="date" name="dob" class="form-control" value="{{ $user->profile->dob ?? '' }}"></div>
                <div class="form-group"><label>Address</label><textarea name="address" class="form-control">{{ $user->profile->address ?? '' }}</textarea></div>
                <div class="form-row">
                    <div class="form-group"><label>City</label><input type="text" name="city" class="form-control" value="{{ $user->profile->city ?? '' }}"></div>
                    <div class="form-group"><label>State</label><input type="text" name="state" class="form-control" value="{{ $user->profile->state ?? '' }}"></div>
                    <div class="form-group"><label>Pincode</label><input type="text" name="pincode" class="form-control" value="{{ $user->profile->pincode ?? '' }}"></div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Profile</button>
            </form>
        </div>
    </div>

    <div>
        <div class="card" style="margin-bottom:24px;">
            <div class="card-header"><h3><i class="fas fa-lock" style="margin-right:8px;color:#818cf8;"></i>Change Password</h3></div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf @method('PUT')
                    <div class="form-group"><label>Current Password</label><input type="password" name="current_password" class="form-control" required></div>
                    <div class="form-group"><label>New Password</label><input type="password" name="password" class="form-control" required minlength="6"></div>
                    <div class="form-group"><label>Confirm New Password</label><input type="password" name="password_confirmation" class="form-control" required></div>
                    <button type="submit" class="btn btn-secondary" style="width:100%;justify-content:center;">Update Password</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-id-card" style="margin-right:8px;color:#818cf8;"></i>KYC Documents</h3>
                <span class="badge badge-{{ ($user->profile->kyc_status ?? 'pending')==='verified'?'success':'warning' }}">{{ ucfirst($user->profile->kyc_status ?? 'pending') }}</span>
            </div>
            <div class="card-body">
                @if(isset($user->profile->kyc_status) && $user->profile->kyc_status === 'verified')
                    <div class="alert alert-success">Your KYC is fully verified.</div>
                @else
                    <form method="POST" action="{{ route('profile.kyc.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label>Document Type</label><select name="document_type" class="form-control" required><option value="aadhaar">Aadhaar Card</option><option value="pan">PAN Card</option><option value="voter_id">Voter ID</option></select></div>
                        <div class="form-group"><label>Document Number</label><input type="text" name="document_number" class="form-control" required></div>
                        <div class="form-group"><label>Upload Document Image</label><input type="file" name="document" class="form-control" required accept="image/*,.pdf" style="padding:8px;"></div>
                        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;"><i class="fas fa-upload"></i> Upload KYC Document</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
