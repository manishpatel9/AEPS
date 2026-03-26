@extends('layouts.app')
@section('title', 'Cash Withdrawal')
@section('page_title', 'AEPS Cash Withdrawal')
@section('content')
<div style="max-width:700px;">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-money-bill-wave" style="margin-right:8px;color:#818cf8;"></i>Cash Withdrawal</h3></div>
        <div class="card-body">
            <div class="alert" style="background:rgba(99,102,241,0.08);border:1px solid rgba(99,102,241,0.2);color:#a5b4fc;">
                <i class="fas fa-info-circle"></i> Wallet Balance: <strong>₹{{ number_format(auth()->user()->getWalletBalance(), 2) }}</strong>
            </div>
            <form method="POST" action="{{ route('retailer.aeps.cash_withdrawal.process') }}">
                @csrf
                <div class="form-group">
                    <label><i class="fas fa-id-card" style="margin-right:6px;"></i>Aadhaar Number</label>
                    <input type="text" name="aadhaar_number" class="form-control" placeholder="Enter 12-digit Aadhaar number" maxlength="12" pattern="[0-9]{12}" required>
                    <small style="color:#64748b;font-size:12px;">Aadhaar is stored as encrypted hash only</small>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-university" style="margin-right:6px;"></i>Select Bank</label>
                    <select name="bank_id" class="form-control" required>
                        <option value="">-- Choose Bank --</option>
                        @foreach($banks as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->bank_name }} ({{ $bank->iin_number }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-rupee-sign" style="margin-right:6px;"></i>Amount (₹)</label>
                    <input type="number" name="amount" class="form-control" placeholder="Min ₹100, Max ₹10,000" min="100" max="10000" step="100" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-fingerprint" style="margin-right:6px;"></i>Biometric Authentication</label>
                    <div style="padding:30px;text-align:center;border:2px dashed rgba(99,102,241,0.3);border-radius:14px;background:rgba(99,102,241,0.05);">
                        <i class="fas fa-fingerprint" style="font-size:48px;color:#818cf8;margin-bottom:12px;display:block;"></i>
                        <p style="color:#94a3b8;font-size:13px;">Fingerprint capture simulated for demo</p>
                        <small style="color:#64748b;">In production, connect biometric device SDK here</small>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px;font-size:15px;">
                    <i class="fas fa-paper-plane"></i> Process Cash Withdrawal
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
