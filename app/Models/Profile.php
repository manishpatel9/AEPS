<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'business_name', 'shop_name', 'address', 'city',
        'state', 'pincode', 'pan_number', 'gst_number', 'kyc_status', 'profile_photo',
    ];
    public function user() { return $this->belongsTo(User::class); }
}
