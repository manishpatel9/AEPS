<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    protected $fillable = ['txn_id', 'status', 'service_type', 'amount', 'details'];
    protected $casts = ['amount' => 'decimal:2'];
}
