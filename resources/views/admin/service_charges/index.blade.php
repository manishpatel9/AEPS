@extends('layouts.app')
@section('title', 'Service Charges')
@section('page_title', 'Service Charge Management')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-receipt" style="margin-right:8px;color:#818cf8;"></i>Service Charges</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.service_charges.store') }}" style="display:flex;gap:12px;margin-bottom:24px;flex-wrap:wrap;align-items:flex-end;">
            @csrf
            <div class="form-group" style="margin:0;"><label>Service Type</label><select name="service_type" class="form-control" required><option value="cash_withdrawal">Cash Withdrawal</option><option value="balance_enquiry">Balance Enquiry</option><option value="mini_statement">Mini Statement</option><option value="bill_payment">Bill Payment</option><option value="mobile_recharge">Mobile Recharge</option></select></div>
            <div class="form-group" style="margin:0;"><label>Amount (₹)</label><input type="number" name="amount" class="form-control" step="0.01" required></div>
            <div class="form-group" style="margin:0;"><label>Percentage (%)</label><input type="number" name="percentage" class="form-control" step="0.01" value="0"></div>
            <div class="form-group" style="margin:0;"><label>Min Amount</label><input type="number" name="min_amount" class="form-control" value="0"></div>
            <div class="form-group" style="margin:0;"><label>Max Amount</label><input type="number" name="max_amount" class="form-control" value="0"></div>
            <button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add</button>
        </form>
        <div class="table-responsive">
            <table>
                <thead><tr><th>Service</th><th>Amount</th><th>%</th><th>Min</th><th>Max</th><th>Status</th></tr></thead>
                <tbody>
                @forelse($charges as $c)
                    <tr><td style="font-weight:600;">{{ ucwords(str_replace('_',' ',$c->service_type)) }}</td><td>₹{{ $c->amount }}</td><td>{{ $c->percentage }}%</td><td>₹{{ $c->min_amount }}</td><td>₹{{ $c->max_amount }}</td><td><span class="badge badge-{{ $c->status==='active'?'success':'danger' }}">{{ ucfirst($c->status) }}</span></td></tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;padding:40px;color:#64748b;">No charges</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
