<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    public $table = 'contacts';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'primary_number',
        'secondary_number',
        'email'
    ];

    protected $casts = [
        'id'=>'string',
        'primary_number'=>'string',
        'secondary_number'=>'string',
        'email'=>'string'
    ];
}
