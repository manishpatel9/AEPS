@extends('layouts.simple')

@section('title','Features - RudraxPay')

@section('content')
<div class="hero page-animate" style="padding-top:28px;">
    <div class="hero-left">
        <h1 style="font-size:36px;">Platform Features</h1>
        <p style="max-width:680px;">Designed for retailers — intuitive dashboard, realtime settlement reporting, secure transaction logs and lightweight device integration.</p>
    </div>
    <div class="hero-right">
        <div class="card">
            <h3>Highlights</h3>
            <div style="margin-top:12px;display:grid;gap:10px">
                <div class="feature"><strong>Realtime Reporting</strong><div style="color:var(--muted)">Track transactions and settlements instantly.</div></div>
                <div class="feature"><strong>Role-based Access</strong><div style="color:var(--muted)">Admin, distributor and retailer roles with tailored views.</div></div>
                <div class="feature"><strong>Secure Logs</strong><div style="color:var(--muted)">Audit trails and API logs for compliance.</div></div>
            </div>
        </div>
    </div>
</div>
@endsection
