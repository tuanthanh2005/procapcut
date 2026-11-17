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
        Schema::table('telegram_products', function (Blueprint $table) {
            $table->unsignedInteger('canboso_stock')->default(0)->after('canboso_cost_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('telegram_products', function (Blueprint $table) {
            $table->dropColumn('canboso_stock');
        });
    }
};
