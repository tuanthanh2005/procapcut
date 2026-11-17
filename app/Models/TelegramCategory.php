<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TelegramCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getTelegramIconAttribute(): string
    {
        $icon = trim((string) $this->icon);
        if (str_starts_with($icon, '<svg') || str_contains($icon, '</svg>')) {
            // If category icon is raw SVG, fallback to a clean emoji for Telegram text buttons
            return '📦';
        }
        return $icon ?: '📦';
    }

    public function products(): HasMany
    {
        return $this->hasMany(TelegramProduct::class, 'category_id')->orderBy('sort_order', 'asc');
    }
}
