<?php

namespace App\Enums;

enum ProductCategory: string
{
    case Clothes = 'clothes';
    case Books = 'books';
    case Furniture = 'furniture';
    case Instrument = 'instrument';
    case Shoe = 'shoe';
}
