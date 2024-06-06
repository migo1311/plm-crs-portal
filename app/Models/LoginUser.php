<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginUser extends Model
{
    use HasFactory;

    protected $table = 'login_users';

    protected $fillable = [
        'password',
        'role_id',
        'user_type',
        'active'
    ];
}
