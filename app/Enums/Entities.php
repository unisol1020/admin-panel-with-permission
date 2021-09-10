<?php


namespace App\Enums;


class Entities
{
    protected static $enum = [
        'user',
        'reseller',
        'role',
        'reseller_hash',
    ];

    public static function all(): array
    {
        return self::$enum;
    }

    public static function get(string $key): ?string
    {
        return self::$enum[$key] ?? null;
    }
}
