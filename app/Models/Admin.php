<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $casts = [
        'permissions' => 'array',
    ];
}
