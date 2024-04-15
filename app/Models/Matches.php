<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matches extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'matches';

    protected $fillable = [
        'start_date',
        'location',
        'result',
        'home_team',
        'away_team',
    ];


    public function homeTeam(): HasOneThrough
    {
        return $this->hasOneThrough(
            Team::class,
            MatchTeam::class,
            'match_id', // Foreign key on the MatchTeam table
            'id', // Local key on the Team table
            'id', // Local key on the Matches table
            'home_team' // Foreign key on the MatchTeam table
        );
    }

    public function awayTeam(): HasOneThrough
    {
        return $this->hasOneThrough(
            Team::class,
            MatchTeam::class,
            'match_id', // Foreign key on the MatchTeam table
            'id', // Local key on the Team table
            'id', // Local key on the Matches table
            'away_team' // Foreign key on the MatchTeam table
        );
    }
}

