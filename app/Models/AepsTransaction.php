<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AepsTransaction extends Model
{
    protected $fillable = [
        'user_id', 'transaction_id', 'service_type', 'bank_id', 'aadhaar_hash',
        'aadhaar_last4', 'amount', 'commission', 'charge', 'status',
        'response_message', 'rrn', 'api_provider_id', 'device_fingerprint',
    ];
    protected $casts = ['amount' => 'decimal:2', 'commission' => 'decimal:2', 'charge' => 'decimal:2'];
    public function user() { return $this->belongsTo(User::class); }
    public function bank() { return $this->belongsTo(Bank::class); }
    public function apiProvider() { return $this->belongsTo(ApiProvider::class); }
}
