<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LedgerEntry extends Model
{
    protected $fillable = [
        'wallet_id', 'transaction_type', 'amount', 'opening_balance',
        'closing_balance', 'reference_id', 'description',
    ];
    protected $casts = ['amount' => 'decimal:2', 'opening_balance' => 'decimal:2', 'closing_balance' => 'decimal:2'];
    public function wallet() { return $this->belongsTo(Wallet::class); }
}
