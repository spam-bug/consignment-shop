<?php

namespace App\Models;

use App\Models\Concerns\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Sluggable, SoftDeletes;

    protected $table = "categories";

    protected $fillable = [
        'name',
    ];

    public function sluggable(): string
    {
        return 'name';
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
