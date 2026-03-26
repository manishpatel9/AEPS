<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CommissionReport extends Model
{
    protected $fillable = ['user_id', 'transaction_id', 'amount', 'type', 'transaction_date'];
    protected $casts = ['amount' => 'decimal:2', 'transaction_date' => 'date'];
    public function user() { return $this->belongsTo(User::class); }
}
