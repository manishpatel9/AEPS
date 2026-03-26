@extends('layouts.app')
@section('title', 'Bill Payments')
@section('page_title', 'Bill Payments & Recharge')
@section('content')
<div class="form-row">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-file-invoice-dollar" style="margin-right:8px;color:#818cf8;"></i>Pay Bill / Recharge</h3></div>
        <div class="card-body">
            <div class="alert" style="background:rgba(99,102,241,0.08);border:1px solid rgba(99,102,241,0.2);color:#a5b4fc;">
                <i class="fas fa-wallet"></i> Wallet Balance: <strong>₹{{ number_format(auth()->user()->getWalletBalance(), 2) }}</strong>
            </div>
            <form method="POST" action="{{ route('retailer.bill_payments.store') }}">
                @csrf
                <div class="form-group"><label>Service Type</label><select name="service_type" class="form-control" required><option value="electricity">Electricity Bill</option><option value="water">Water Bill</option><option value="dth">DTH Recharge</option><option value="mobile_recharge">Mobile Recharge</option></select></div>
                <div class="form-group"><label>Provider / Biller</label><select name="provider" class="form-control" required><option value="biller_1">State Electricity Board</option><option value="biller_2">BSES Rajdhani Power Limited</option><option value="biller_3">Tata Power</option><option value="biller_4">Jio / Airtel / VI (Recharge)</option><option value="biller_5">Tata Play / Airtel DTH</option></select></div>
                <div class="form-group"><label>Customer Details (Meter/Mobile/Consumer No.)</label><input type="text" name="customer_number" class="form-control" required placeholder="Enter number"></div>
                <div class="form-group"><label>Amount (₹)</label><input type="number" name="amount" class="form-control" required min="10" placeholder="Enter amount to pay"></div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px;"><i class="fas fa-check-circle"></i> Complete Payment</button>
            </form>
        </div>
    </div>

    <div class="card" style="grid-column: span 2;">
        <div class="card-header"><h3><i class="fas fa-history" style="margin-right:8px;color:#818cf8;"></i>Recent Payments</h3></div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead><tr><th>Txn ID</th><th>Service</th><th>Provider</th><th>Customer No</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
                    <tbody>
                    @forelse($payments as $p)
                        <tr>
                            <td style="font-family:monospace;font-size:12px;">{{ $p->transaction_id }}</td>
                            <td><span class="badge badge-info">{{ ucwords(str_replace('_', ' ', $p->service_type)) }}</span></td>
                            <td>{{ ucwords(str_replace('_', ' ', $p->provider)) }}</td>
                            <td>{{ $p->customer_number }}</td>
                            <td style="font-weight:700;">₹{{ number_format($p->amount, 2) }}</td>
                            <td><span class="badge badge-{{ $p->status==='success'?'success':($p->status==='pending'?'warning':'danger') }}">{{ ucfirst($p->status) }}</span></td>
                            <td style="font-size:12px;">{{ $p->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" style="text-align:center;padding:40px;color:#64748b;">No recent payments found.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper">{{ $payments->links() }}</div>
        </div>
    </div>
</div>
@endsection
