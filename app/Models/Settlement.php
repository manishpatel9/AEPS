<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $fillable = ['user_id', 'utr', 'amount', 'status', 'settlement_date', 'remarks'];
    protected $casts = ['amount' => 'decimal:2', 'settlement_date' => 'date'];
    public function user() { return $this->belongsTo(User::class); }
}
