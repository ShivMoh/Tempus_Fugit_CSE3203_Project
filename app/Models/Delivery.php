<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;


    public $table = 'deliveries';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'date_shippped',
        'bill_id',
        'address_id',
        'contact_id'
    ];

    protected $casts = [
        'id' => 'string',
        'date_shippped' => 'datetime',
        'bill_id' => 'string',
        'address_id' => 'string',
        'contact_id' => 'string'
    ];
}
