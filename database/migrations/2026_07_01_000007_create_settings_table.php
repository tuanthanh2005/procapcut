<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default bank values
        DB::table('settings')->insert([
            ['key' => 'bank_name', 'value' => 'MB Bank', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'bank_account_no', 'value' => '0987654321', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'bank_account_name', 'value' => 'TRAN THI THUY TRANG', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'sepay_webhook_token', 'value' => 'CAPCUTSTORESECURETOKEN2026', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
