@extends('layouts.app')
@section('title', 'Manage Tickets')
@section('page_title', 'Support Tickets Management')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-ticket-alt" style="margin-right:8px;color:#818cf8;"></i>Support Tickets</h3></div>
    <div class="card-body">
        <div style="margin-bottom:12px;display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
            <form method="GET" action="" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                <input type="text" name="q" placeholder="Search ticket id, subject, user..." value="{{ request('q') }}" class="form-control" style="min-width:220px;" />
                <select name="status" class="form-control" style="width:150px;">
                    <option value="">All Status</option>
                    <option value="open" {{ request('status')=='open'?'selected':'' }}>Open</option>
                    <option value="in_progress" {{ request('status')=='in_progress'?'selected':'' }}>In Progress</option>
                    <option value="resolved" {{ request('status')=='resolved'?'selected':'' }}>Resolved</option>
                    <option value="closed" {{ request('status')=='closed'?'selected':'' }}>Closed</option>
                </select>
                <select name="priority" class="form-control" style="width:150px;">
                    <option value="">All Priority</option>
                    <option value="low" {{ request('priority')=='low'?'selected':'' }}>Low</option>
                    <option value="medium" {{ request('priority')=='medium'?'selected':'' }}>Medium</option>
                    <option value="high" {{ request('priority')=='high'?'selected':'' }}>High</option>
                    <option value="critical" {{ request('priority')=='critical'?'selected':'' }}>Critical</option>
                </select>
                <button class="btn btn-sm btn-secondary" type="submit">Filter</button>
                <a href="{{ route('admin.support_tickets') }}" class="btn btn-sm btn-light">Reset</a>
            </form>
        </div>
        <div class="table-responsive">
            <table>
                <thead><tr><th>Ticket ID</th><th>User</th><th>Subject</th><th>Description</th><th>Priority</th><th>Status</th><th>Date</th><th>Action</th></tr></thead>
                <tbody>
                @forelse($tickets as $t)
                    <tr>
                        <td style="font-family:monospace;">#{{ $t->ticket_id }}</td>
                        <td>{{ $t->user->name ?? 'N/A' }}</td>
                        <td style="font-weight:600;">{{ $t->subject }}</td>
                        <td style="font-size:12px;max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $t->description }}">{{ $t->description }}</td>
                        <td><span class="badge badge-{{ $t->priority==='high'?'danger':($t->priority==='medium'?'warning':'info') }}">{{ ucfirst($t->priority) }}</span></td>
                        <td><span class="badge badge-{{ $t->status==='closed'?'success':($t->status==='open'?'danger':'warning') }}">{{ ucfirst($t->status) }}</span></td>
                        <td style="font-size:12px;">{{ $t->created_at->format('d M Y') }}</td>
                        <td>
                            @if($t->status !== 'closed')
                            <form method="POST" action="{{ route('admin.support_tickets.reply', $t->id) }}" style="display:flex;gap:8px;align-items:center;">
                                @csrf @method('PUT')
                                <textarea name="admin_reply" class="form-control" placeholder="Write a reply (optional)" style="height:40px;max-width:420px;min-width:180px;">{{ old('admin_reply', $t->admin_reply) }}</textarea>
                                <select name="status" class="form-control" style="padding:6px;font-size:12px;width:130px;">
                                    <option value="in_progress" {{ $t->status=='in_progress'?'selected':'' }}>In Progress</option>
                                    <option value="closed">Close</option>
                                </select>
                                <button class="btn btn-sm btn-primary" style="padding:6px 10px;"><i class="fas fa-save"></i></button>
                            </form>
                            @else
                            <span style="color:#64748b;font-size:12px;">Closed</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" style="text-align:center;padding:40px;color:#64748b;">No support tickets</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $tickets->links() }}</div>
    </div>
</div>
@endsection
