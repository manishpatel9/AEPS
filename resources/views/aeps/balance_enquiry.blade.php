@extends('layouts.app')
@section('title', 'Balance Enquiry')
@section('page_title', 'AEPS Balance Enquiry')
@section('content')
<div style="max-width:700px;">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-search-dollar" style="margin-right:8px;color:#38bdf8;"></i>Balance Enquiry</h3></div>
        <div class="card-body">
            <form method="POST" action="{{ route('retailer.aeps.balance_enquiry.process') }}">
                @csrf
                <div class="form-group">
                    <label>Aadhaar Number</label>
                    <input type="text" name="aadhaar_number" class="form-control" placeholder="Enter 12-digit Aadhaar" maxlength="12" pattern="[0-9]{12}" required>
                </div>
                <div class="form-group">
                    <label>Select Bank</label>
                    <select name="bank_id" class="form-control" required>
                        <option value="">-- Choose Bank --</option>
                        @foreach($banks as $bank)<option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>@endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div style="padding:30px;text-align:center;border:2px dashed rgba(14,165,233,0.3);border-radius:14px;background:rgba(14,165,233,0.05);">
                        <i class="fas fa-fingerprint" style="font-size:48px;color:#38bdf8;margin-bottom:12px;display:block;"></i>
                        <p style="color:#94a3b8;font-size:13px;">Biometric verification (simulated)</p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px;background:var(--gradient-2);">
                    <i class="fas fa-search"></i> Check Balance
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
