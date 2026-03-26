@extends('layouts.app')
@section('title', 'Banks')
@section('page_title', 'Bank Management')
@section('content')
<div class="card">
    <div class="card-header"><h3><i class="fas fa-university" style="margin-right:8px;color:#818cf8;"></i>Banks</h3></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.banks.store') }}" style="display:flex;gap:12px;margin-bottom:24px;flex-wrap:wrap;align-items:flex-end;">
            @csrf
            <div class="form-group" style="margin:0;"><label>Bank Name</label><input type="text" name="bank_name" class="form-control" required placeholder="e.g. State Bank of India"></div>
            <div class="form-group" style="margin:0;"><label>IIN Number</label><input type="text" name="iin_number" class="form-control" required placeholder="e.g. 607094"></div>
            <div class="form-group" style="margin:0;"><label>Status</label><select name="status" class="form-control"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
            <button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Bank</button>
        </form>
        <div class="table-responsive">
            <table>
                <thead><tr><th>ID</th><th>Bank Name</th><th>IIN</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                @forelse($banks as $bank)
                    <tr>
                        <td>{{ $bank->id }}</td><td style="font-weight:600;">{{ $bank->bank_name }}</td><td style="font-family:monospace;">{{ $bank->iin_number }}</td>
                        <td><span class="badge badge-{{ $bank->status==='active'?'success':'danger' }}">{{ ucfirst($bank->status) }}</span></td>
                        <td>
                            <form method="POST" action="{{ route('admin.banks.update', $bank->id) }}" style="display:inline;">@csrf @method('PUT')
                                <input type="hidden" name="bank_name" value="{{ $bank->bank_name }}"><input type="hidden" name="iin_number" value="{{ $bank->iin_number }}">
                                <input type="hidden" name="status" value="{{ $bank->status==='active'?'inactive':'active' }}">
                                <button class="btn btn-sm btn-{{ $bank->status==='active'?'danger':'success' }}"><i class="fas fa-{{ $bank->status==='active'?'ban':'check' }}"></i></button>
                            </form>
                            <form method="POST" action="{{ route('admin.banks.delete', $bank->id) }}" style="display:inline;" onsubmit="return confirm('Delete this bank?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;padding:40px;color:#64748b;">No banks</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $banks->links() }}</div>
    </div>
</div>
@endsection
