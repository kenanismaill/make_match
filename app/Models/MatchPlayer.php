<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchPlayer extends Pivot
{
    use SoftDeletes;

    protected $table = 'match_player';

    protected $fillable = [
        'match_id',
        'player_id',
        'score',
        'has_accepted_match'
    ];

    protected $casts = [
        'has_accepted_match' => 'boolean',
    ];


    public function match(): BelongsTo
    {
        return $this->belongsTo(Matches::class,'match_id') ;
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }
}
