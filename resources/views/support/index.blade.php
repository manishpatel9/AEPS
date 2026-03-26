@extends('layouts.app')
@section('title', 'Support Center')
@section('page_title', 'Support Tickets')
@section('content')
<div class="form-row">
    <div class="card">
        <div class="card-header"><h3><i class="fas fa-plus-circle" style="margin-right:8px;color:#818cf8;"></i>Create New Ticket</h3></div>
        <div class="card-body">
            <form method="POST" action="{{ route('support.store') }}">
                @csrf
                <div class="form-group"><label>Subject</label><input type="text" name="subject" class="form-control" required placeholder="Brief description of the issue"></div>
                <div class="form-group"><label>Priority</label><select name="priority" class="form-control"><option value="low">Low</option><option value="medium" selected>Medium</option><option value="high">High</option></select></div>
                <div class="form-group"><label>Description</label><textarea name="description" class="form-control" required placeholder="Provide details about your query or issue..."></textarea></div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;"><i class="fas fa-paper-plane"></i> Submit Ticket</button>
            </form>
        </div>
    </div>

    <div class="card" style="grid-column: span 2;">
        <div class="card-header"><h3><i class="fas fa-ticket-alt" style="margin-right:8px;color:#818cf8;"></i>My Tickets</h3></div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead><tr><th>Ticket ID</th><th>Subject</th><th>Priority</th><th>Status</th><th>Submitted On</th></tr></thead>
                    <tbody>
                    @forelse($tickets as $t)
                        <tr>
                            <td style="font-family:monospace;">#{{ $t->ticket_id }}</td>
                            <td style="font-weight:600;">{{ $t->subject }}</td>
                            <td><span class="badge badge-{{ $t->priority==='high'?'danger':($t->priority==='medium'?'warning':'info') }}">{{ ucfirst($t->priority) }}</span></td>
                            <td><span class="badge badge-{{ $t->status==='closed'?'success':($t->status==='open'?'danger':'warning') }}">{{ ucfirst(str_replace('_', ' ', $t->status)) }}</span></td>
                            <td style="font-size:12px;">{{ $t->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="text-align:center;padding:40px;color:#64748b;">You haven't submitted any tickets yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper">{{ $tickets->links() }}</div>
        </div>
    </div>
</div>
@endsection
