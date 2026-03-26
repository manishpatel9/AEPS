@extends('layouts.simple')

@section('title','About RudraxPay')

@section('content')
<div class="hero page-animate" style="padding-top:28px;">
    <div class="hero-left">
        <h1 style="font-size:36px;">About RudraxPay</h1>
        <p style="max-width:680px;">RudraxPay is built to empower local retailers with digital financial tools — AEPS, payments, remittances and business support. Our mission is to extend financial access to the last mile.</p>
        <div style="margin-top:18px;">
            <a href="{{ route('services') }}" class="cta">Explore Services</a>
        </div>
    </div>
    <div class="hero-right">
        <div class="card">
            <h3 style="margin-bottom:8px">Our Values</h3>
            <ul style="color:var(--muted);line-height:1.9">
                <li><strong>Trust:</strong> Security and compliance are core to our services.</li>
                <li><strong>Accessibility:</strong> Bring banking to neighbourhood stores.</li>
                <li><strong>Growth:</strong> Help partners earn and scale sustainably.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
