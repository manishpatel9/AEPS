@extends('layouts.simple')

@section('title','Welcome - RudraxPay')

@section('content')
<div class="hero page-animate" style="padding-top:28px;">
    <div class="hero-left">
        <h1 style="font-size:36px;">Welcome to RudraxPay</h1>
        <p style="max-width:680px;">Your professional AEPS platform for secure cash withdrawals, balance enquiries, bill payments, and retailer services.</p>
        <div style="margin-top:18px;">
            <a href="{{ route('home') }}" class="cta">Go to Home</a>
        </div>
    </div>
    <div class="hero-right">
        <div class="card">
            <h3 style="margin-bottom:8px;">Why RudraxPay</h3>
            <div class="grid">
                <div class="feature"><strong>Fast Onboarding</strong><div style="color:var(--muted);margin-top:6px;">Quick KYC and activation for retailers.</div></div>
                <div class="feature"><strong>Secure Platform</strong><div style="color:var(--muted);margin-top:6px;">Role-based access with audit trails.</div></div>
                <div class="feature"><strong>Reliable Support</strong><div style="color:var(--muted);margin-top:6px;">Dedicated support for daily operations.</div></div>
            </div>
        </div>
    </div>
</div>
@endsection
