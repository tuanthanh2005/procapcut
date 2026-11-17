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
        'telegram_icon',
        'image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getTelegramDisplayIconAttribute(): string
    {
        // 1. Ưu tiên emoji tùy chỉnh riêng cho Telegram nếu có
        if (!empty($this->telegram_icon)) {
            return $this->telegram_icon;
        }

        // 2. Nếu icon không phải là thẻ SVG (là emoji bình thường), dùng trực tiếp
        $icon = trim((string) $this->icon);
        if (!empty($icon) && !str_starts_with($icon, '<svg') && !str_contains($icon, '</svg>')) {
            return $icon;
        }

        // 3. Nếu icon là mã SVG mà chưa nhập telegram_icon, tự động gợi ý emoji đẹp theo tên
        $lower = mb_strtolower($this->name, 'UTF-8');
        if (str_contains($lower, 'capcut')) return '✂️';
        if (str_contains($lower, 'gemini')) return '✨';
        if (str_contains($lower, 'gpt') || str_contains($lower, 'openai') || str_contains($lower, 'chatgpt')) return '🤖';
        if (str_contains($lower, 'claude')) return '✴️';
        if (str_contains($lower, 'canva')) return '🎨';
        if (str_contains($lower, 'youtube') || str_contains($lower, 'netflix') || str_contains($lower, 'spotify')) return '🍿';
        if (str_contains($lower, 'cursor') || str_contains($lower, 'codex')) return '💻';
        if (str_contains($lower, 'grok') || str_contains($lower, 'x.ai')) return '⚡';
        if (str_contains($lower, 'kling') || str_contains($lower, 'video')) return '🎬';
        if (str_contains($lower, 'suno') || str_contains($lower, 'audio') || str_contains($lower, 'nhạc')) return '🎵';
        if (str_contains($lower, 'office') || str_contains($lower, 'microsoft') || str_contains($lower, 'windows')) return '🪟';
        if (str_contains($lower, 'adobe')) return '🖌️';
        if (str_contains($lower, 'vpn')) return '🛡️';
        return '📁';
    }

    public function products(): HasMany
    {
        return $this->hasMany(TelegramProduct::class, 'category_id')->orderBy('sort_order', 'asc');
    }
}
