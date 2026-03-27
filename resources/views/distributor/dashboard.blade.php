@extends('layouts.app')
@section('title', 'Distributor Dashboard')
@section('page_title', 'Distributor Dashboard')
@section('page_subtitle', 'Monitor retailers, track wallet movement, and keep commissions growing.')
@section('page_actions')
    <a href="{{ route('distributor.add_funds') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i> Add Funds</a>
    <a href="{{ route('reports.commissions') }}" class="btn btn-secondary btn-sm"><i class="fas fa-chart-line"></i> View Commissions</a>
@endsection
@section('content')
    @include('partials.dashboard-analytics')
@endsection
@section('scripts')
    @include('partials.dashboard-analytics-scripts')
@endsection
