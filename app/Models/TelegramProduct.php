<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TelegramProduct extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'original_price',
        'description',
        'guide_text',
        'delivery_type',
        'static_content',
        'sold_count',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'integer',
        'original_price' => 'integer',
        'sold_count' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(TelegramCategory::class, 'category_id');
    }

    public function keys(): HasMany
    {
        return $this->hasMany(TelegramProductKey::class, 'product_id');
    }

    public function availableKeys(): HasMany
    {
        return $this->hasMany(TelegramProductKey::class, 'product_id')->where('is_used', false);
    }

    public function getStockCountAttribute(): int
    {
        if ($this->delivery_type === 'static_text') {
            return 9999;
        }
        return $this->availableKeys()->count();
    }

    public function getFormattedPriceAttribute(): string
    {
        if ($this->price >= 1000) {
            $k = $this->price / 1000;
            return (floor($k) == $k ? (int)$k : number_format($k, 1)) . 'k';
        }
        return number_format($this->price, 0, ',', '.') . 'đ';
    }
}
