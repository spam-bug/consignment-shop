<?php

namespace App\Models;

use App\Enums\ContractStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contract extends Model
{
    protected $fillable = [
        'consignor_id',
        'generated_contract',
        'uploaded_consignee_contract',
        'uploaded_consignor_contract',
        'signed_contract',
        'status',
        'expired_at',
    ];

    protected $casts = [
        'status' => ContractStatus::class,
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'contract_has_products');
    }

    public function consignor(): BelongsTo
    {
        return $this->belongsTo(Consignor::class);
    }

    public function consignee(): BelongsTo
    {
        return $this->belongsTo(Consignee::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->toFormattedDateString(),
        );
    }

    protected function expiredAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->toFormattedDateString(),
        );
    }
}
