@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('page_title', 'Admin Dashboard')
@section('page_subtitle', 'Track users, transactions, and system health with a clean command center view.')
@section('page_actions')
    <a href="{{ route('admin.users') }}" class="btn btn-secondary btn-sm"><i class="fas fa-users"></i> Manage Users</a>
    <a href="{{ route('admin.support_tickets') }}" class="btn btn-primary btn-sm"><i class="fas fa-ticket-alt"></i> Review Tickets</a>
@endsection
@section('content')
    @include('partials.dashboard-analytics')
@endsection
@section('scripts')
    @include('partials.dashboard-analytics-scripts')
@endsection
