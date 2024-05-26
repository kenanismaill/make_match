<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'size'
    ];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_player')
            ->using(TeamPlayer::class)
            ->withPivot(['is_owner'])
            ->withTimestamps();
    }

    public function homeMatches(): BelongsToMany
    {
        return $this->belongsToMany(
            Matches::class,
            'match_team',
            'home_team',
            'match_id'
        );
    }

    public function awayMatches(): BelongsToMany
    {
        return $this->belongsToMany(
            Matches::class,
            'match_team',
            'away_team',
            'match_id'
        );
    }
}
