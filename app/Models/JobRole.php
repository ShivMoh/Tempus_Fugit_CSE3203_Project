<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRole extends Model
{
    use HasFactory;

    public $table = 'job_roles';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'title'
    ];

    protected $casts = [
        'id'=>'string',
        'title'=>'string'
    ];
}
