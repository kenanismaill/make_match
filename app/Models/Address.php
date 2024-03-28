<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'country',
        'city',
        'street',
        'state',
        'postal_code',
        'latitude',
        'longitude',
    ];

    public function fullAddress(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => ucfirst($attributes['street']) . ' ' .
                $attributes['postal_code'] . ' ' .
                ucfirst($attributes['state']) . ' ' .
                ucfirst($attributes['city']) . ' ' .
                ucfirst($attributes['country']) . ' '
            ,
        );
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
