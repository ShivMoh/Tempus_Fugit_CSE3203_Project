<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $table = 'employees';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'dob',
        'job_role_id',
        'contact_id',
        'address_id'
    ];

    protected $casts = [
        'id'=>'string',
        'first_name'=>'string',
        'last_name'=>'string',
        'dob'=>'string',
        'job_role_id'=>'integer',
        'contact_id'=>'integer',
        "address_id"=>'integer'
    ];
}
