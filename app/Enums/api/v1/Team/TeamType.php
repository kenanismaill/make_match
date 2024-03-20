<?php declare(strict_types=1);

namespace App\Enums\api\v1\Team;

use BenSampo\Enum\Enum;

final class TeamType extends Enum
{
    const MEDIUM = 1;
    const LARGE = 2;

    public static $capacity = [
        self::MEDIUM => 6,
        self::LARGE => 12
    ];
}