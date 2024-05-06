<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $table = 'payments';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'cash',
        'amount'
    ];

    protected $casts = [
        'id' => 'string',
        'cash' => 'boolean',
        'amount' => 'integer'
    ];
}
