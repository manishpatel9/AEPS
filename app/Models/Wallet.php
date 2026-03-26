<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'balance', 'asset_balance', 'status'];
    protected $casts = ['balance' => 'decimal:2', 'asset_balance' => 'decimal:2'];
    public function user() { return $this->belongsTo(User::class); }
    public function ledgerEntries() { return $this->hasMany(LedgerEntry::class); }
}
