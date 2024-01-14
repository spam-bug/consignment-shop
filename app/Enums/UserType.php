<?php

namespace App\Enums;

enum UserType: string
{
    case Admin = 'admin';
    case Consignee = 'consignee';
    case Consignor = 'consignor';
}
