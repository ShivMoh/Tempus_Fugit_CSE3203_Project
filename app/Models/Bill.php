<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bill extends Model
{
    use HasFactory;
    
    public $table = 'bills';
    public $timestamps = true;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'gross_cost',
        'net_cost',
        'discount',
        'duty_and_vat',
        'delivery_free',
        'user_id',
        'customer_id'
    ];

    protected $casts = [
        'id' => 'string',
        'gross_cost' => 'float',
        'net_cost' => 'float',
        'discount' => 'float',
        'duty_and_vat' => 'float',
        'delivery_free' => 'float',
        'user_id' => 'string',
        'customer_id' => 'string'
    ];

    // If ID = empty, create id.
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
