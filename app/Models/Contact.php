<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'name', 'phone', 'role', 'message', 'ip_address', 'user_agent'
    ];
}
