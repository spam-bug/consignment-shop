<?php

namespace App\Models;

use App\Enums\ContractStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contract extends Model
{
    protected $fillable = [
        'consignor_id',
        'generated_contract',
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

    protected function generatedContract(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset($value),
        );
    }

    protected function signedContract(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset($value),
        );
    }
}
