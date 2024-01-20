<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Shipped = 'shipped';
    case Received = 'received';
    case Cancelled = 'cancelled';

    public function variety()
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Shipped => 'info',
            self::Received => 'success',
            self::Cancelled => 'danger',
        };
    }
}