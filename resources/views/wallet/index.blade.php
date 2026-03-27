@extends('layouts.app')
@section('title', 'Wallet')
@section('page_title', 'My Wallet')
@section('content')
<div class="stats-grid">
    <div class="stat-card purple"><div class="stat-icon"><i class="fas fa-wallet"></i></div><div class="stat-value" data-number="{{ (float) ($wallet->balance ?? 0) }}" data-decimals="2" data-prefix="₹">₹{{ number_format($wallet->balance ?? 0, 2) }}</div><div class="stat-label">Available Balance</div></div>
    <div class="stat-card blue"><div class="stat-icon"><i class="fas fa-piggy-bank"></i></div><div class="stat-value" data-number="{{ (float) ($wallet->asset_balance ?? 0) }}" data-decimals="2" data-prefix="₹">₹{{ number_format($wallet->asset_balance ?? 0, 2) }}</div><div class="stat-label">Asset Balance</div></div>
    <div class="stat-card green"><div class="stat-icon"><i class="fas fa-check-circle"></i></div><div class="stat-value">{{ ucfirst($wallet->status ?? 'active') }}</div><div class="stat-label">Wallet Status</div></div>
</div>

<div class="card">
    <div class="card-header"><h3><i class="fas fa-book" style="margin-right:8px;color:#818cf8;"></i>Ledger Entries</h3></div>
    <div class="card-body">
        <div class="table-responsive">
            <table>
                <thead><tr><th>Date</th><th>Type</th><th>Amount</th><th>Opening</th><th>Closing</th><th>Reference</th><th>Description</th></tr></thead>
                <tbody>
                @forelse($ledger as $entry)
                    <tr>
                        <td style="font-size:12px;">{{ $entry->created_at->format('d M Y H:i') }}</td>
                        <td><span class="badge badge-{{ $entry->transaction_type === 'credit' ? 'success' : 'danger' }}">{{ ucfirst($entry->transaction_type) }}</span></td>
                        <td style="font-weight:700;color:{{ $entry->transaction_type === 'credit' ? '#34d399' : '#f87171' }};">{{ $entry->transaction_type === 'credit' ? '+' : '-' }}₹{{ number_format($entry->amount, 2) }}</td>
                        <td>₹{{ number_format($entry->opening_balance, 2) }}</td>
                        <td>₹{{ number_format($entry->closing_balance, 2) }}</td>
                        <td style="font-family:monospace;font-size:12px;">{{ $entry->reference_id ?? '-' }}</td>
                        <td style="font-size:13px;">{{ $entry->description }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:#64748b;">No ledger entries yet</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $ledger->links() }}</div>
    </div>
</div>
@endsection
