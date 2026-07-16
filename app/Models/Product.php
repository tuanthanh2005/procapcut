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

    /**
     * Get the real rating dynamically calculated from reviews.
     */
    public function getRealRatingAttribute(): float
    {
        $avg = $this->reviews()->avg('rating');
        return $avg ? (float)round($avg, 1) : 5.0;
    }

    /**
     * Get the real reviews count dynamically calculated from reviews.
     */
    public function getRealReviewCountAttribute(): int
    {
        return $this->reviews()->count();
    }

    /**
     * Get the real quantity sold dynamically calculated from completed orders.
     */
    public function getRealSoldAttribute(): int
    {
        $optionIds = collect($this->options)->pluck('id')->toArray();
        if (empty($optionIds)) {
            return 0;
        }

        return (int) \App\Models\Order::whereIn('status', ['completed', 'processing'])
            ->get()
            ->sum(function ($order) use ($optionIds) {
                $count = 0;
                if (is_array($order->items)) {
                    foreach ($order->items as $item) {
                        if (isset($item['id']) && in_array($item['id'], $optionIds)) {
                            $count += ($item['quantity'] ?? 1);
                        }
                    }
                }
                return $count;
            });
    }
}
