@extends('layouts.simple')

@section('title','Services - RudraxPay')

@section('content')
<div class="hero page-animate" style="padding-top:28px;">
    <div class="hero-left">
        <h1 style="font-size:36px;">Services</h1>
        <p style="max-width:680px;">RudraxPay provides a full suite of digital financial services for retailers and customers. We make financial services accessible in your neighbourhood.</p>
        <div style="margin-top:18px;">
            <a href="{{ route('home') }}#contact" class="cta">Get Started</a>
        </div>
    </div>
    <div class="hero-right">
        <div class="card">
            <div class="grid">
                <div class="feature"><strong>Biometric Cash Withdrawal</strong><div style="color:var(--muted);margin-top:6px">Fast, secure cash withdrawals using Aadhaar verification.</div></div>
                <div class="feature"><strong>Balance Enquiry</strong><div style="color:var(--muted);margin-top:6px">Instant account balance checks for customers.</div></div>
                <div class="feature"><strong>Mini Statements</strong><div style="color:var(--muted);margin-top:6px">Quick mini statement printing for convenience.</div></div>
                <div class="feature"><strong>Bill Payments</strong><div style="color:var(--muted);margin-top:6px">Utility and other bill collections with receipt generation.</div></div>
                <div class="feature"><strong>Money Transfer</strong><div style="color:var(--muted);margin-top:6px">Fast domestic money transfers through trusted rails.</div></div>
                <div class="feature"><strong>Insurance & Travel</strong><div style="color:var(--muted);margin-top:6px">Additional services to diversify revenue streams.</div></div>
            </div>
        </div>
    </div>
</div>
@endsection
