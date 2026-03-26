<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class KycDocument extends Model
{
    protected $fillable = [
        'user_id', 'aadhaar_hash', 'aadhaar_last4', 'bank_id',
        'amount', 'status', 'document_type', 'document_path', 'document_number', 'txn_time',
    ];
    protected $casts = ['txn_time' => 'datetime'];
    public function user() { return $this->belongsTo(User::class); }
}
