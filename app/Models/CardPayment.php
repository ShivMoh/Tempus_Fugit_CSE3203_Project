<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardPayment extends Model
{
    use HasFactory;

    public $table = 'card_payments';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'payment_id',
        'card_id'
    ];

    protected $casts = [
        'id' => 'string',
        'payment_id'=>'string',
        'card_id'=>'string'
    ];
}
