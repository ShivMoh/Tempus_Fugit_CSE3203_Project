<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    public $table = 'logs';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'message',
        'employee_id'
    ];

    protected $casts = [
        'id'=>'string',
        'message'=>'string',
        'employee_id'=>'string'
    ];
}
