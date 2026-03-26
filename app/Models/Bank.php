<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['bank_name', 'iin_number', 'status'];
}
