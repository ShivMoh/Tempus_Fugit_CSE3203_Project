<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;


    public $table = 'cards';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'card_holder',
        'card_number',
        'security_pin',
        'expirary_date',
        'company_card'
    ];

    protected $casts = [
        'id' => 'string',
        'card_holder' => 'string',
        'card_number' => 'string',
        'security_pin' => 'string',
        'expirary_date' => 'string',
        'company_card' => 'boolean'
    ];
}
