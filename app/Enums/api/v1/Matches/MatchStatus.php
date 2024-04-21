<?php

namespace App\Enums\api\v1\Matches;

use Illuminate\Support\Facades\Lang;

enum MatchStatus: int
{
    case SCHEDULED = 1;
    case PLAYING = 2;
    case COMPLETED = 3;
    case POSTPONED = 4;
    case CANCELED = 5;

    public static function label(MatchStatus $status): string
    {
        return match ($status) {
            static::SCHEDULED => Lang::get('match.scheduled'),
            static::PLAYING => Lang::get('match.playing'),
            static::COMPLETED => Lang::get('match.completed'),
            static::POSTPONED => Lang::get('match.postponed'),
            static::CANCELED => Lang::get('match.canceled'),
        };
    }
}
