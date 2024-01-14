<?php

namespace App\Enums;

enum ProductStatus: string
{
    case Listed = 'listed';
    case Unlisted = 'unlisted';
    case OutOfStock = 'out_of_stock';
    case Draft = 'draft';

    public function variety()
    {
        return match($this) {
            self::Listed => 'success',
            self::Unlisted => 'warning',
            self::OutOfStock => 'danger',
            self::Draft => 'info',
        };
    }
}
