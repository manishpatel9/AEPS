<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BillPayment extends Model
{
    protected $fillable = ['user_id', 'device_serial', 'operator', 'service_type', 'amount', 'customer_id', 'status', 'response'];
    protected $casts = ['amount' => 'decimal:2'];
    public function user() { return $this->belongsTo(User::class); }
}
