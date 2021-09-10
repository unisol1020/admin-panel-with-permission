<?php


namespace App\Enums;


class Methods
{
    protected static $enum = [
        'index'   => 0b10000,
        'store'   => 0b01000,
        'show'    => 0b00100,
        'update'  => 0b00010,
        'destroy' => 0b00001
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
