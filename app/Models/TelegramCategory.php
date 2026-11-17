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
            // Tự động gán emoji đẹp tương ứng theo tên danh mục khi danh mục dùng mã SVG
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
        return $icon ?: '📁';
    }

    public function products(): HasMany
    {
        return $this->hasMany(TelegramProduct::class, 'category_id')->orderBy('sort_order', 'asc');
    }
}
