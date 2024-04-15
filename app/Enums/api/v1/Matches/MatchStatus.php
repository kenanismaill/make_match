<?php

namespace App\Enums\api\v1\Matches;

enum MatchStatus: Int
{
    case SCHEDULED = 1;
    case PLAYING = 2;
    case COMPLETED = 3;
    case POSTPONED = 4;
    case CANCELED = 5;

    public function label(): string
    {
        return match($this) {
            //todo:: make trans
            static::SCHEDULED => 'Scheduled',
            static::PLAYING => 'In Progress',
            static::COMPLETED => 'Suspended',
            static::POSTPONED => 'Canceled by user',
            static::CANCELED => 'Canceled by user',
        };
    }
}
