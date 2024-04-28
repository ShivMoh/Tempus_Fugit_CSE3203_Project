<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $table = 'customers';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'contact_id',
    ];

    protected $casts = [
        'id'=>'string',
        'first_name'=>'string',
        'last_name'=>'string',
        'contact_id'=>'string',
    ];
}
