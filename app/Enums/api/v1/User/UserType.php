<?php declare(strict_types=1);

namespace App\Enums\api\v1\User;

use BenSampo\Enum\Enum;

final class UserType extends Enum
{
    const ADMIN = 1;
    const SUBSCRIBER = 2;
    const VIP = 3;
    const INACTIVE = 4;
    const BANNED = 5;

    public static array $invlaidUser = [
        self::INACTIVE,
        self::BANNED
    ];
}
