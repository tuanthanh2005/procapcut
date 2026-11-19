<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TelegramOrder extends Model
{
    protected $fillable = [
        'order_code',
        'telegram_user_id',
        'product_id',
        'product_name',
        'quantity',
        'unit_price',
        'total_amount',
        'payment_method',
        'status',
        'delivered_data',
        'sepay_transaction_id',
        'paid_at',
        'expires_at',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'integer',
        'total_amount' => 'integer',
        'paid_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function telegramUser(): BelongsTo
    {
        return $this->belongsTo(TelegramUser::class, 'telegram_user_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(TelegramProduct::class, 'product_id')->withTrashed();
    }

    public function keys(): HasMany
    {
        return $this->hasMany(TelegramProductKey::class, 'used_by_order_id');
    }
}
