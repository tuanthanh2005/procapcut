<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TelegramUser extends Model
{
    protected $fillable = [
        'telegram_id',
        'first_name',
        'last_name',
        'username',
        'balance',
        'total_spent',
        'referral_code',
        'referred_by',
        'step',
        'step_data',
        'is_banned',
    ];

    protected $casts = [
        'step_data' => 'array',
        'is_banned' => 'boolean',
        'balance' => 'integer',
        'total_spent' => 'integer',
        'telegram_id' => 'integer',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(TelegramOrder::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(TelegramTransaction::class);
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(TelegramUser::class, 'referred_by', 'telegram_id');
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(TelegramUser::class, 'referred_by', 'telegram_id');
    }

    public function getFullNameAttribute(): string
    {
        $name = trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
        return $name ?: ($this->username ? '@' . $this->username : 'User #' . $this->telegram_id);
    }
}
