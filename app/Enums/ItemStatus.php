<?php

namespace App\Enums;

enum ItemStatus: string
{
    case ACTIVE = 'active';
    case NONACTIVE = 'non-active';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels()
    {
        $labels = [];
        foreach (self::cases() as $case) {
            $labels[$case->value] = $case->name;
        }
        return $labels;
    }
}
