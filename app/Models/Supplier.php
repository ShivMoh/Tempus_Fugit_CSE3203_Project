<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;


    public $table = 'suppliers';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'description',
        'image_url',
        'insurance_fee',
        'processing_fee',
        'shipping_fee'
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'description' => 'string',
        'image_url' => 'string',
        'insurance_fee' => 'float',
        'processing_fee' => 'float',
        'shipping_fee' => 'float'
    ];
}
