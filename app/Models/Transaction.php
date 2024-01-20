<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->toFormattedDateString(),
        );
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
