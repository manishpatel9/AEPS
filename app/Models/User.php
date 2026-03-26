<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'mobile', 'aadhaar_hash', 'aadhaar_last4',
        'device_fingerprint', 'role', 'status', 'password',
    ];

    protected $hidden = ['password', 'remember_token', 'aadhaar_hash'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile() { return $this->hasOne(Profile::class); }
    public function wallet() { return $this->hasOne(Wallet::class); }
    public function kycDocuments() { return $this->hasMany(KycDocument::class); }
    public function aepsTransactions() { return $this->hasMany(AepsTransaction::class); }
    public function settlements() { return $this->hasMany(Settlement::class); }
    public function commissionReports() { return $this->hasMany(CommissionReport::class); }
    public function billPayments() { return $this->hasMany(BillPayment::class); }
    public function supportTickets() { return $this->hasMany(SupportTicket::class); }
    public function deviceMappings() { return $this->hasMany(DeviceMapping::class); }
    public function loginLogs() { return $this->hasMany(LoginLog::class); }
    public function activityLogs() { return $this->hasMany(ActivityLog::class); }
    public function reversals() { return $this->hasMany(Reversal::class); }

    // Hierarchy
    public function children()
    {
        return $this->belongsToMany(User::class, 'user_relations', 'parent_id', 'child_id');
    }

    public function parents()
    {
        return $this->belongsToMany(User::class, 'user_relations', 'child_id', 'parent_id');
    }

    public function isAdmin() { return $this->role === 'admin'; }
    public function isDistributor() { return $this->role === 'distributor'; }
    public function isRetailer() { return $this->role === 'retailer'; }

    public function getWalletBalance()
    {
        return $this->wallet ? $this->wallet->balance : 0;
    }
}
