@extends('layouts.app')

@section('title', 'General Requests')
@section('page_title', 'General Requests')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>General Requests</h3>
        <form method="GET" style="display:flex;gap:8px;align-items:center;" action="{{ route('admin.general_requests') }}">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name, phone or message">
            <button class="btn btn-primary">Search</button>
        </form>
    </div>
    <div class="card-body">
        @if($requests->count())
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Message</th>
                            <th>IP</th>
                            <th>User Agent</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->name }}</td>
                            <td>{{ $r->phone }}</td>
                            <td>{{ $r->role }}</td>
                            <td style="max-width:320px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $r->message }}</td>
                            <td>{{ $r->ip_address }}</td>
                            <td style="max-width:240px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $r->user_agent }}</td>
                            <td>{{ $r->created_at->format('Y-m-d H:i') }}</td>
                            <td><a href="{{ route('admin.general_requests.show', $r->id) }}" class="btn btn-sm btn-primary">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper">{{ $requests->withQueryString()->links() }}</div>
        @else
            <div class="empty-state">
                <i class="fas fa-envelope-open-text"></i>
                <p>No general requests found.</p>
            </div>
        @endif
    </div>
</div>
@endsection
