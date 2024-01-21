<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'consignee_id',
        'consignor_id',
    ];

    public function consignor(): BelongsTo
    {
        return $this->belongsTo(Consignor::class);
    }

    public function consignee(): BelongsTo
    {
        return $this->belongsTo(Consignee::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
