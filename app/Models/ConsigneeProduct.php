<?php

namespace App\Models;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsigneeProduct extends Model
{
    protected $fillable = [
        'consignee_id',
        'product_id',
        'stock',
        'stock_threshold',
        'total',
    ];
    
    public function info(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->toFormattedDateString()
        );
    }
}
