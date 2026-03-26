<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Reversal extends Model
{
    protected $fillable = ['txn_log_id', 'user_id', 'type', 'status', 'settlement_date', 'remarks'];
    protected $casts = ['settlement_date' => 'date'];
    public function user() { return $this->belongsTo(User::class); }
}
