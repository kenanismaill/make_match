<?php

namespace App\Models;

use App\Enums\api\v1\Matches\MatchStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matches extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'matches';

    protected $fillable = [
        'start_date',
        'location',
        'status',
        'result',
        'home_team',
        'away_team',
    ];

    protected $casts = [
        'status' => MatchStatus::class,
    ];

    public function result(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => is_null($value) ? '0-0' : $value
        );
    }

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

