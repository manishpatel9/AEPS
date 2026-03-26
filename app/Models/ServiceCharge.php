<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ServiceCharge extends Model
{
    protected $fillable = ['service_type', 'amount', 'percentage', 'min_amount', 'max_amount', 'status'];
}
