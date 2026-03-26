@extends('layouts.app')

@section('title', 'Request Detail')
@section('page_title', 'Request Detail')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Request #{{ $req->id }}</h3>
    </div>
    <div class="card-body">
        <dl style="display:grid;grid-template-columns:1fr 2fr;gap:12px;">
            <dt>Name</dt><dd>{{ $req->name }}</dd>
            <dt>Phone</dt><dd>{{ $req->phone }}</dd>
            <dt>Role</dt><dd>{{ $req->role }}</dd>
            <dt>Message</dt><dd style="white-space:pre-wrap;">{{ $req->message }}</dd>
            <dt>IP Address</dt><dd>{{ $req->ip_address }}</dd>
            <dt>User Agent</dt><dd style="word-break:break-word;">{{ $req->user_agent }}</dd>
            <dt>Submitted At</dt><dd>{{ $req->created_at->format('Y-m-d H:i:s') }}</dd>
        </dl>
        <div style="margin-top:16px;">
            <a href="{{ route('admin.general_requests') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
