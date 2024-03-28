<?php

namespace App\Enums\api\v1\Team;

use App\Traits\api\v1\Enums\EnumNamesTrait;

enum TeamType: int
{
    case MEDIUM = 1;
    case LARGE = 2;

    public static function capacity(self $type): int
    {
        return match ($type->value) {
            self::MEDIUM->value => 6,
            self::LARGE->value => 12,
            default => 0,
        };
    }
}
