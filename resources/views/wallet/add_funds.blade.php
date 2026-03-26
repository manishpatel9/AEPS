@extends('layouts.app')
@section('title', 'Add Funds')
@section('page_title', 'Add Funds')
@section('content')
<div style="max-width:600px;">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-paper-plane" style="margin-right:8px;color:#818cf8;"></i>Transfer Funds to User</h3></div>
        <div class="card-body">
            <div class="alert" style="background:rgba(99,102,241,0.08);border:1px solid rgba(99,102,241,0.2);color:#a5b4fc;">
                <i class="fas fa-wallet"></i> Your Balance: <strong>₹{{ number_format(auth()->user()->getWalletBalance(), 2) }}</strong>
            </div>
            <form method="POST" action="{{ auth()->user()->isAdmin() ? route('admin.add_funds.process') : route('distributor.add_funds.process') }}">
                @csrf
                <div class="form-group">
                    <label>Select User</label>
                    <select name="user_id" class="form-control" required>
                        <option value="">-- Choose User --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ ucfirst($u->role) }}) - {{ $u->mobile }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Amount (₹)</label>
                    <input type="number" name="amount" class="form-control" placeholder="Enter amount" min="1" required>
                </div>
                <div class="form-group">
                    <label>Remarks (Optional)</label>
                    <input type="text" name="remarks" class="form-control" placeholder="Add a note">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px;">
                    <i class="fas fa-paper-plane"></i> Transfer Funds
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
