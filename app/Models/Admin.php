<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $fillable = ['email', 'password'];
    public $timestamps = false;

    protected $hidden = [
        'password'
    ];
}
