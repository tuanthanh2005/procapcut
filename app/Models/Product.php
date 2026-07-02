<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'slug', 'name', 'category', 'category_label', 'icon', 'image_path', 'rating',
    'review_count', 'sold', 'tag', 'description', 'default_price', 'default_slashed',
    'seo_title', 'seo_desc', 'seo_keywords', 'features', 'options'
])]
class Product extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'features' => 'array',
            'options' => 'array',
            'rating' => 'float',
            'review_count' => 'integer',
            'default_price' => 'integer',
            'default_slashed' => 'integer'
        ];
    }

    /**
     * Get the reviews for this product.
     */
    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class)->latest();
    }
}
