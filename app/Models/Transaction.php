<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $table = 'transactions';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'count',
        'total_cost',
        'item_id',
        'bill_id'
    ];

    protected $casts = [
        'id' => 'string',
        'count' => 'integer',
        'total_cost' => 'float',
        'item_id' => 'string',
        'bill_id' => 'string'
    ];
}
