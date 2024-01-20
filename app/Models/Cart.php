<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'consignee_id',
        'product_id',
        'quantity',
        'total',
    ];

    public function consignee(): BelongsTo
    {
        return $this->belongsTo(Consignee::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
