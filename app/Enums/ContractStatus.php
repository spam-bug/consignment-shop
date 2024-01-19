<?php

namespace App\Enums;

enum ContractStatus: string
{
    case Pending = 'pending';
    case UnderReview = 'under review';
    case Approve = 'approve';
    case Rejected = 'rejected';
    case Expired = 'expired';

    public function variety()
    {
        return match($this) {
            self::Pending => 'warning',
            self::UnderReview => 'info',
            self::Approve => 'success',
            self::Rejected, self::Expired => 'danger',
        };
    }
}