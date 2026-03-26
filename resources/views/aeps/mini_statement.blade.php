@extends('layouts.app')
@section('title', 'Mini Statement')
@section('page_title', 'AEPS Mini Statement')
@section('content')
<div style="max-width:700px;">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-list-alt" style="margin-right:8px;color:#34d399;"></i>Mini Statement</h3></div>
        <div class="card-body">
            @if(session('statements'))
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> Mini Statement for Aadhaar ****{{ session('aadhaar_last4') }}</div>
                <div class="table-responsive">
                    <table>
                        <thead><tr><th>Date</th><th>Narration</th><th>Amount</th><th>Type</th></tr></thead>
                        <tbody>
                        @foreach(session('statements') as $s)
                            <tr>
                                <td>{{ $s['date'] }}</td><td>{{ $s['narration'] }}</td>
                                <td style="font-weight:700;">₹{{ number_format($s['amount'], 2) }}</td>
                                <td><span class="badge badge-{{ $s['type'] === 'Cr' ? 'success' : 'danger' }}">{{ $s['type'] }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <hr style="border-color:var(--border-color);margin:20px 0;">
            @endif

            <form method="POST" action="{{ route('retailer.aeps.mini_statement.process') }}">
                @csrf
                <div class="form-group"><label>Aadhaar Number</label><input type="text" name="aadhaar_number" class="form-control" placeholder="Enter 12-digit Aadhaar" maxlength="12" required></div>
                <div class="form-group"><label>Select Bank</label>
                    <select name="bank_id" class="form-control" required>
                        <option value="">-- Choose Bank --</option>
                        @foreach($banks as $bank)<option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>@endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div style="padding:30px;text-align:center;border:2px dashed rgba(16,185,129,0.3);border-radius:14px;background:rgba(16,185,129,0.05);">
                        <i class="fas fa-fingerprint" style="font-size:48px;color:#34d399;margin-bottom:12px;display:block;"></i>
                        <p style="color:#94a3b8;font-size:13px;">Biometric verification (simulated)</p>
                    </div>
                </div>
                <button type="submit" class="btn btn-success" style="width:100%;justify-content:center;padding:14px;">
                    <i class="fas fa-file-alt"></i> Get Mini Statement
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
