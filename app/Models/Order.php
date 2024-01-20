<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'reference_number',
        'consignee_id',
        'consignor_id',
        'total',
        'status',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
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

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
