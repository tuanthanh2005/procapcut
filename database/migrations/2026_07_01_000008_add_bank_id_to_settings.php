<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('settings')->updateOrInsert(
            ['key' => 'bank_id'],
            ['value' => 'MB', 'created_at' => now(), 'updated_at' => now()]
        );
        
        // Ensure bank_name is MB Bank
        DB::table('settings')->where('key', 'bank_name')->update(['value' => 'MB Bank']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')->where('key', 'bank_id')->delete();
    }
};
