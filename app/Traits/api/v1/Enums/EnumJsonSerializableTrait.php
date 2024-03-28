<?php
declare(strict_types=1);

namespace App\Traits\api\v1\Enums;

trait EnumJsonSerializableTrait
{
    use EnumArraySerializableTrait;

    public static function jsonSerialize(): string
    {
        return json_encode(static::array());
    }
}
