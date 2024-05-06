<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $table = 'order_items';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'amount',
        'item_id',
        'order_id'
    ];

    protected $casts = [
        'id' => 'string',
        'amount' => 'integer',
        'item_id'=>'string',
        'order_id'=>'string'
    ];
}
