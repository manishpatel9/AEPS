@extends('layouts.simple')

@section('title','Team - RudraxPay')

@section('content')
<div class="hero page-animate" style="padding-top:28px;">
    <div class="hero-left">
        <h1 style="font-size:36px;">Our Team</h1>
        <p style="max-width:680px;">A small, focused team building reliable fintech for local retailers. We believe in fast support and continuous improvement.</p>
    </div>
    <div class="hero-right">
        <div class="card">
            <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:12px">
                <div class="feature"><strong>Super Admin</strong><div style="color:var(--muted)">Leadership & product</div></div>
                <div class="feature"><strong>Engineering</strong><div style="color:var(--muted)">Platform & integrations</div></div>
                <div class="feature"><strong>Operations</strong><div style="color:var(--muted)">Onboarding & support</div></div>
                <div class="feature"><strong>Partnerships</strong><div style="color:var(--muted)">Channel growth</div></div>
            </div>
        </div>
    </div>
</div>
@endsection
