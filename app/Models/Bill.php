<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    
    public $table = 'bills';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'gross_cost',
        'net_cost',
        'discount',
        'duty_and_vat',
        'delivery_fee',
        'employee_id',
        'customer_id'
    ];

    protected $casts = [
        'id' => 'string',
        'gross_cost' => 'float',
        'net_cost' => 'float',
        'discount' => 'float',
        'duty_and_vat' => 'float',
        'delivery_fee' => 'float',
        'employee_id' => 'string',
        'customer_id' => 'string'
    ];
}
