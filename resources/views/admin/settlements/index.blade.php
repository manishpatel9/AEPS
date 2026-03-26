@extends('layouts.app')
@section('title', 'Settlements')
@section('page_title', 'Settlement Management')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-money-check" style="margin-right:8px;color:#818cf8;"></i>Settlements</h3></div>
    <div class="card-body"><div class="table-responsive"><table>
        <thead><tr><th>User</th><th>Amount</th><th>UTR</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($settlements as $s)
            <tr><td>{{ $s->user->name ?? 'N/A' }}</td><td style="font-weight:700;">₹{{ number_format($s->amount, 2) }}</td><td style="font-family:monospace;">{{ $s->utr ?? '-' }}</td>
                <td><span class="badge badge-{{ $s->status==='completed'?'success':($s->status==='pending'?'warning':'danger') }}">{{ ucfirst($s->status) }}</span></td>
                <td style="font-size:12px;">{{ $s->settlement_date ? $s->settlement_date->format('d M Y') : '-' }}</td>
                <td>@if($s->status==='pending')<form method="POST" action="{{ route('admin.settlements.process', $s->id) }}" style="display:inline;">@csrf @method('PUT')<input type="hidden" name="status" value="completed"><button class="btn btn-success btn-sm"><i class="fas fa-check"></i> Approve</button></form>@endif</td>
            </tr>
        @empty
            <tr><td colspan="6" style="text-align:center;padding:40px;color:#64748b;">No settlements</td></tr>
        @endforelse
        </tbody>
    </table></div><div class="pagination-wrapper">{{ $settlements->links() }}</div></div>
</div>
@endsection
