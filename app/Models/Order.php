<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $table = 'orders';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'gross_cost',
        'net_cost',
        'discount',
        'duty_and_vat',
        'insurance_fee',
        'processing_fee',
        'shipping_fee', 
        'order_date',
        'date_arrived',
        'received',
        'employee_id',
        'supplier_id',
        'item_id'
    ];

    protected $casts = [
        'id' => 'string',
        'gross_cost' => 'float',
        'net_cost' => 'float',
        'discount' => 'float',
        'duty_and_vat' => 'float',
        'insurance_fee' => 'float',
        'processing_fee' => 'float',
        'shipping_fee' => 'float', 
        'order_date' => 'datetime',
        'date_arrived' => 'datetime',
        'received' => 'boolean',
        'employee_id' => 'string',
        'supplier_id' => 'string',
        'item_id' => 'string'
    ];
}
