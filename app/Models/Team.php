<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type'
    ];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(TeamUser::class)
            ->withPivot(['is_owner'])
            ->withTimestamps();
    }
}
