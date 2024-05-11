<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stadium extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stadiums';

    protected $fillable = [
        'name',
        'capacity',
        'status',
        'location',
        'description',
        'contact_number',
        'email',
        'website',
        'owner',
        'surface_type',
        'opening_time',
        'closing_time',
        'architect',
        'seating_details',
        'amenities',
        'accessibility_features',
        'social_media_links',
    ];

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable')->latestOfMany();
    }

}
