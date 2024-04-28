<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;


    public $table = 'addresses';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'line_1',
        'line_2',
        'city',
        'state',
        'country',
    ];

    protected $casts = [
        'id'=>'string',
        'line_1'=>'string',
        'line_2'=>'string',
        'city'=>'string',
        'state'=>'string',
        'country'=>'string',
    ];
}
