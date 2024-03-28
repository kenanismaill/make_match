<?php
declare(strict_types=1);

namespace App\Enums\api\v1\User;

enum UserType: int
{
    case ADMIN = 1;
    case SUBSCRIBER = 2;
    case VIP = 3;
    case INACTIVE = 4;
    case BANNED = 5;

    public const INVALID_STATUS = [
        self::BANNED,
        self::INACTIVE,
    ];

    public static function isInvalidUser(int $userStatus): bool
    {
        return in_array($userStatus, self::INVALID_STATUS);
    }
}
