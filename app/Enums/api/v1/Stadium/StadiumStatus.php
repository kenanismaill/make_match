<?php

namespace App\Enums\api\v1\Stadium;

enum StadiumStatus: int
{
    case UNDER_REVIEW = 1;
    case APPROVED = 2;
    case CLOSED = 3;
    case BANNED_BY_ADMIN = 4;
    case CLOSED_BY_MANAGER = 5;

    public function label(): string
    {
        return match($this) {
            static::UNDER_REVIEW => __('stadium_status.UNDER_REVIEW'),
            static::APPROVED => __('stadium_status.APPROVED'),
            static::CLOSED => __('stadium_status.CLOSED'),
            static::BANNED_BY_ADMIN => __('stadium_status.BANNED_BY_ADMIN'),
            static::CLOSED_BY_MANAGER => __('stadium_status.CLOSED_BY_MANAGER'),
        };
    }
}
