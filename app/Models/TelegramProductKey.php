<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TelegramProductKey extends Model
{
    protected $fillable = [
        'product_id',
        'account_data',
        'is_used',
        'used_by_order_id',
    ];

    protected $casts = [
        'is_used' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(TelegramProduct::class, 'product_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(TelegramOrder::class, 'used_by_order_id');
    }
}
