<?php

namespace App\Models;

use App\Enums\ProductStatus;
use App\Models\Category;
use App\Models\Concerns\Sluggable;
use App\Models\Consignor;
use App\Models\ProductDamageRecord;
use App\Models\ProductStockRecord;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Sluggable, SoftDeletes;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'description',
        'price',
        'stock',
        'stock_threshold',
        'photos',
        'status',
    ];

    protected $casts = [
        'status' => ProductStatus::class,
        'photos' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function consignor(): BelongsTo
    {
        return $this->belongsTo(Consignor::class);
    }

    public function stockRecords(): HasMany
    {
        return $this->hasMany(ProductStockRecord::class);
    }

    public function damageRecords(): HasMany
    {
        return $this->hasMany(ProductDamageRecord::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value, 2),
            set: fn ($value) => str_replace(",", "", $value)
        );
    }

    protected function unitPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => "₱" . number_format($attributes['price'], 2),
            set: fn ($value) => $this->attributes['price'] = $value
        );
    }

    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => "₱" . number_format(($attributes['price'] * $attributes['stock']), 2)
        );
    }

    protected function categoryName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $this->category ? $this->category->name : 'Other'
        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->toFormattedDateString()
        );
    }

    public function sluggable(): string
    {
        return 'name';
    }

    public function isLowOnStock(): bool
    {
        return $this->stock_threshold > $this->stock;
    }
}
