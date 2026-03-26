<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    protected $fillable = ['txn_id', 'request', 'response', 'status', 'api_provider_id'];
    public function apiProvider() { return $this->belongsTo(ApiProvider::class); }
}
