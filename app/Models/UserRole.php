<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    public $table = 'user_roles';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'type'
    ];

    protected $casts = [
        'id'=>'string',
        'type'=>'string'
    ];
}
