@extends('layouts.app')
@section('title', 'KYC Approvals')
@section('page_title', 'KYC Document Management')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-id-card" style="margin-right:8px;color:#818cf8;"></i>User KYC Documents</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>User</th><th>Document Type</th><th>Document Number</th><th>File</th><th>Status</th><th>Submitted On</th><th>Actions</th></tr></thead>
                <tbody>
                @forelse($documents as $doc)
                    <tr>
                        <td style="font-weight:600;">{{ $doc->user->name ?? 'N/A' }}<br><small style="color:#64748b;font-weight:400;">{{ $doc->user->email ?? '' }}</small></td>
                        <td>{{ strtoupper($doc->document_type) }}</td><td style="font-family:monospace;">{{ $doc->document_number }}</td>
                        @php
                            $kycPath = $doc->document_path ?? $doc->file_path;
                        @endphp
                        <td>
                            @if($kycPath && \Illuminate\Support\Facades\Storage::disk('public')->exists($kycPath))
                                <a href="{{ asset('storage/' . $kycPath) }}" target="_blank" rel="noopener" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i> View</a>
                            @else
                                <span style="color:#94a3b8;">No file</span>
                            @endif
                        </td>
                        <td><span class="badge badge-{{ $doc->status === 'verified' ? 'success' : ($doc->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($doc->status) }}</span></td>
                        <td style="font-size:12px;">{{ $doc->created_at->format('d M Y') }}</td>
                        <td style="display:flex;gap:6px;">
                            @if($doc->status === 'pending')
                                <form method="POST" action="{{ route('admin.kyc.update', $doc->id) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="verified">
                                    <button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                </form>
                                <form method="POST" action="{{ route('admin.kyc.update', $doc->id) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:#64748b;">No KYC documents found</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $documents->links() }}</div>
    </div>
</div>
@endsection
