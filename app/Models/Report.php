<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public $table = 'reports';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'x_data',
        'y_data',
    ];

    protected $casts = [
        'id'=>'string',
        'x_data'=>'string',
        'y_data'=>'string'
    ];
}
