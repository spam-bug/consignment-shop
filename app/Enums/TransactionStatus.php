<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';

    public function variety()
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Paid => 'success',
        };
    }
}