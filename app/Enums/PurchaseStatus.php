<?php

namespace App\Enums;

enum PurchaseStatus: string
{
    case UNPAID = 'unpaid';
    case PAID = 'paid';
    case CANCELED = 'canceled';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
