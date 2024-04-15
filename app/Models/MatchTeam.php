<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchTeam extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $table = 'match_team';

    protected $fillable = [
        'match_id',
        'home_team',
        'away_team',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(
            Matches::class,
            'match_id',
            'id'
        );
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(
            Team::class,
            'home_team',
            'id'
        );
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(
            Team::class,
            'away_team',
            'id'
        );
    }
}

