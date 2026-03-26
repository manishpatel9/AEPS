<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DeviceMapping extends Model
{
    protected $fillable = ['user_id', 'device_id', 'device_model', 'serial_number', 'status'];
    public function user() { return $this->belongsTo(User::class); }
}
