<?php

namespace App\Enums;

enum UserStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';

    public function getVariant()
    {
        return match($this) {
            self::Active => 'info',
            self::Inactive => 'danger',
        };
    }
}
