<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->index(['user_id', 'id'], 'chat_messages_user_id_id_index');
            $table->index(['session_id', 'user_id', 'id'], 'chat_messages_session_user_id_index');
            $table->index(['sender', 'is_read'], 'chat_messages_sender_is_read_index');
        });

        Schema::table('chat_conversations', function (Blueprint $table) {
            $table->index(['user_id', 'session_id'], 'chat_conversations_user_session_index');
        });
    }

    public function down(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropIndex('chat_messages_user_id_id_index');
            $table->dropIndex('chat_messages_session_user_id_index');
            $table->dropIndex('chat_messages_sender_is_read_index');
        });

        Schema::table('chat_conversations', function (Blueprint $table) {
            $table->dropIndex('chat_conversations_user_session_index');
        });
    }
};
