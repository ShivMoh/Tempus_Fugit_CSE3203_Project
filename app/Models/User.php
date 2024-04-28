<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'users';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'email',
        'password',
        'user_role_id',
        'employee_id'
    ];

    protected $casts = [
        'id'=>'string',
        'email' => 'string',
        'password' => 'hashed',
        'user_type_id' => 'integer',
        'employee_id' => 'integer'
    ];
}
