<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait Sluggable
{
    public function initializeSluggable()
    {
        $this->fillable[] = 'slug';
    }

    public static function bootSluggable()
    {
        static::creating(function ($model) {
            $model->slug = $model->generateUniqueSlug();
        });

        static::updating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model);
        });
    }

    public static function findBySlug(string $slug)
    {
        return static::where('slug', $slug)->first();
    }

    private function generateUniqueSlug($model = null)
    {
        $slug = Str::slug($this->{$this->sluggable()});
        
        if (!is_null($model) && $model->slug === $slug) {
            return $model->slug;
        }

        $existingSlugCount = static::where("slug", "LIKE", "%{$slug}%")->count();

        return $existingSlugCount ? "{$slug}-{$existingSlugCount}" : $slug;
    }

    public abstract function sluggable(): string;
}