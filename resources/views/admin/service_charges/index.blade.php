@extends('layouts.app')
@section('title', 'Set Service Charges')
@section('page_title', 'Set Service Charges')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-receipt" style="margin-right:8px;color:#818cf8;"></i>Service Charges</h3></div>
    <div class="card-body">
        <div id="sc-flash" style="display:none;margin-bottom:12px;"></div>
        <form id="service-charges-form" method="POST" action="{{ route('admin.service_charges.store') }}">
            @csrf
            <div class="table-responsive" style="margin-bottom:18px;">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Operator</th>
                            <th>Commission Type</th>
                            <th>Master Distributor</th>
                            <th>Distributor</th>
                            <th>Agent</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($charges as $c)
                        <tr>
                            <td style="font-weight:600;">{{ ucwords(str_replace('_',' ',$c->service_type)) }}</td>
                            <td style="width:220px;">
                                <select name="charges[{{ $c->service_type }}][type]" class="form-control">
                                    <option value="percent" {{ (isset($c->commission_type) && $c->commission_type=='percent') ? 'selected' : '' }}>Percent (%)</option>
                                    <option value="flat" {{ (isset($c->commission_type) && $c->commission_type=='flat') ? 'selected' : '' }}>Flat (₹)</option>
                                </select>
                            </td>
                            <td><input type="number" step="0.01" name="charges[{{ $c->service_type }}][master_distributor]" class="form-control" value="{{ $c->master_distributor ?? 0 }}"></td>
                            <td><input type="number" step="0.01" name="charges[{{ $c->service_type }}][distributor]" class="form-control" value="{{ $c->distributor ?? 0 }}"></td>
                            <td><input type="number" step="0.01" name="charges[{{ $c->service_type }}][agent]" class="form-control" value="{{ $c->agent ?? 0 }}"></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="text-align:center;padding:40px;color:#64748b;">No charges</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div style="color:#64748b;font-size:13px;">Tip: Use Percent (%) for percentage-based commission, or Flat (Rs) for fixed amounts.</div>
                <div>
                    <a href="{{ route('admin.service_charges') }}" class="btn btn-secondary">Close</a>
                    <button id="sc-submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const form = document.getElementById('service-charges-form');
    const flash = document.getElementById('sc-flash');
    const submitBtn = document.getElementById('sc-submit');

    function showFlash(message, type='success'){
        flash.style.display = 'block';
        flash.innerHTML = '<div class="alert alert-' + (type==='success'? 'success':'danger') + '">' + message + '</div>';
        window.scrollTo({ top: flash.getBoundingClientRect().top + window.scrollY - 80, behavior: 'smooth' });
    }

    form.addEventListener('submit', function(e){
        e.preventDefault();
        submitBtn.disabled = true;
        flash.style.display = 'none';

        const fd = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: fd,
            credentials: 'same-origin'
        }).then(async res => {
            submitBtn.disabled = false;
            if (res.ok) {
                const data = await res.json();
                showFlash(data.message || 'Service charges saved.', 'success');
            } else if (res.status === 422) {
                const err = await res.json();
                const messages = [];
                if (err.errors) {
                    Object.values(err.errors).forEach(arr => { messages.push(arr.join(' ')); });
                } else if (err.message) {
                    messages.push(err.message);
                }
                showFlash(messages.join('<br>'), 'error');
            } else {
                let text = await res.text();
                showFlash('An unexpected error occurred. ' + (text || ''), 'error');
            }
        }).catch(err => {
            submitBtn.disabled = false;
            showFlash('Network error: ' + err.message, 'error');
        });
    });
});
</script>
@endsection
