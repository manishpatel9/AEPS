<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ServiceCharge extends Model
{
    protected $fillable = [
        'service_type', 'commission_type',
        'amount', 'percentage',
        'master_distributor', 'distributor', 'agent',
        'min_amount', 'max_amount', 'status'
    ];
}
