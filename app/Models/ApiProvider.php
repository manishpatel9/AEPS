<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ApiProvider extends Model
{
    protected $fillable = ['name', 'api_url', 'api_key', 'status'];
    protected $hidden = ['api_key'];
}
