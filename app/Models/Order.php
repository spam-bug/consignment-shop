<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Events\DamagedProductReportDurationReminder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'reference_number',
        'consignee_id',
        'consignor_id',
        'total',
        'status',
        'is_damage_reported',
        'add_proof_of_damage',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'add_proof_of_damage' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->reference_number = static::generateUniqueReferenceNumber();
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function consignor(): BelongsTo
    {
        return $this->belongsTo(Consignor::class);
    }

    public function consignee(): BelongsTo
    {
        return $this->belongsTo(Consignee::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
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

    public function sendDamagedProductReportDurationReminder()
    {
        event(new DamagedProductReportDurationReminder($this));
    }
}
