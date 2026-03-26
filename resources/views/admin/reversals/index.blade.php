@extends('layouts.app')
@section('title', 'Reversals')
@section('page_title', 'Reversal / Refund Management')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-undo" style="margin-right:8px;color:#818cf8;"></i>Reversals (Fphum Handling)</h3></div>
    <div class="card-body"><div class="table-responsive"><table>
        <thead><tr><th>Txn Log ID</th><th>User</th><th>Type</th><th>Status</th><th>Settlement Date</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($reversals as $r)
            <tr><td style="font-family:monospace;">{{ $r->txn_log_id ?? '-' }}</td><td>{{ $r->user->name ?? 'N/A' }}</td><td>{{ $r->type ?? '-' }}</td>
                <td><span class="badge badge-{{ $r->status==='completed'?'success':($r->status==='pending'?'warning':'danger') }}">{{ ucfirst($r->status) }}</span></td>
                <td>{{ $r->settlement_date ? $r->settlement_date->format('d M Y') : '-' }}</td>
                <td>@if($r->status==='pending')<form method="POST" action="{{ route('admin.reversals.process', $r->id) }}" style="display:inline;">@csrf @method('PUT')<input type="hidden" name="status" value="completed"><button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button></form>@endif</td>
            </tr>
        @empty
            <tr><td colspan="6" style="text-align:center;padding:40px;color:#64748b;">No reversals</td></tr>
        @endforelse
        </tbody>
    </table></div><div class="pagination-wrapper">{{ $reversals->links() }}</div></div>
</div>
@endsection
