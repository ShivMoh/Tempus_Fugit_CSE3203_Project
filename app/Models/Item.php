<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $table = 'items';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'selling_price',
        'cost_price',
        'total_sold',
        'stock_count',
        'image_url',
        'category_id',
        'supplier_id',
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'selling_price' => 'float',
        'cost_price' => 'float',
        'total_sold' => 'integer',
        'stock_count' => 'integer',
        'image_url' => 'string',
        'category_id' => 'string',
        'supplier_id' => 'string',
    ];
}
