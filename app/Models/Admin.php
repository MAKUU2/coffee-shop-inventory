<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}
