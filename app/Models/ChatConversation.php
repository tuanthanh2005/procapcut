<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatConversation extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'is_ai_enabled',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
