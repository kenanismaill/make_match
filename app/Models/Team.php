<?php

namespace App\Models;

use App\Enums\api\v1\Team\TeamType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type'
    ];

    protected $casts = [
        'type' => TeamType::class
    ];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_player')
            ->using(TeamPlayer::class)
            ->withPivot(['is_owner'])
            ->withTimestamps();
    }
}
