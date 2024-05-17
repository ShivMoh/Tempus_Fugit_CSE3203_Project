<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    public $table = 'customers';
    public $timestamps = true;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'contact_id',
        'payment_id'
    ];

    protected $casts = [
        'id'=>'string',
        'first_name'=>'string',
        'last_name'=>'string',
        'contact_id'=>'string',
        'payment_id'=>'string'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
