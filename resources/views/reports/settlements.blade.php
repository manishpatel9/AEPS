@extends('layouts.app')
@section('title', 'Settlements')
@section('page_title', 'My Settlements')
@section('content')
<div class="form-row">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-university" style="margin-right:8px;color:#818cf8;"></i>Request Settlement</h3></div>
        <div class="card-body">
            <div class="alert" style="background:rgba(99,102,241,0.08);border:1px solid rgba(99,102,241,0.2);color:#a5b4fc;">
                <i class="fas fa-piggy-bank"></i> Settlable Balance: <strong>₹{{ number_format(auth()->user()->wallet->asset_balance ?? 0, 2) }}</strong>
            </div>
            <form method="POST" action="{{ route('reports.settlement.request') }}">
                @csrf
                <div class="form-group"><label>Bank Account Number</label><input type="text" name="bank_account" class="form-control" required placeholder="Enter Account Number"></div>
                <div class="form-group"><label>IFSC Code</label><input type="text" name="ifsc_code" class="form-control" required placeholder="Enter IFSC Code" style="text-transform:uppercase;"></div>
                <div class="form-group"><label>Amount (₹)</label><input type="number" name="amount" class="form-control" required min="100" max="{{ auth()->user()->wallet->asset_balance ?? 0 }}" placeholder="Min ₹100"></div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px;"><i class="fas fa-paper-plane"></i> Submit Request</button>
            </form>
        </div>
    </div>

    <div class="card" style="grid-column: span 2;">
        <div class="card-header"><h3><i class="fas fa-list" style="margin-right:8px;color:#818cf8;"></i>Settlement History</h3></div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead><tr><th>Date</th><th>Amount</th><th>Bank Account</th><th>IFSC</th><th>UTR</th><th>Status</th></tr></thead>
                    <tbody>
                    @forelse($settlements as $s)
                        <tr>
                            <td style="font-size:12px;">{{ $s->created_at->format('d M Y H:i') }}</td>
                            <td style="font-weight:700;">₹{{ number_format($s->amount, 2) }}</td>
                            <td style="font-family:monospace;">{{ substr($s->bank_account, 0, 2) }}******{{ substr($s->bank_account, -4) }}</td>
                            <td>{{ $s->ifsc_code }}</td>
                            <td style="font-family:monospace;">{{ $s->utr ?? '-' }}</td>
                            <td><span class="badge badge-{{ $s->status==='completed'?'success':($s->status==='pending'?'warning':'danger') }}">{{ ucfirst($s->status) }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="text-align:center;padding:40px;color:#64748b;">No settlement requests found.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper">{{ $settlements->links() }}</div>
        </div>
    </div>
</div>
@endsection
