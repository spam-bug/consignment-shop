<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    protected $fillable = [
        'consignee_id',
        'consignor_id',
        'order_id',
        'reference_number',
        'total',
        'status',
    ];

    protected $casts = [
        'status' => TransactionStatus::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->reference_number = static::generateUniqueReferenceNumber();
        });
    }

    private static function generateUniqueReferenceNumber()
    {
        $referenceNumber = Str::random(12);

        if (static::where('reference_number', $referenceNumber)->count()) {
            return static::generateUniqueReferenceNumber();
        }

        return $referenceNumber;
    }
}
