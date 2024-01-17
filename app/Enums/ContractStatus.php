<?php

namespace App\Enums;

enum ContractStatus: string
{
    case Pending = 'pending';
    case Approve = 'approve';
    case Rejected = 'rejected';
    case Expired = 'expired';
}