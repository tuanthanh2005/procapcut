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
            $table->string('canboso_product_id', 100)->nullable()->after('static_content')->index();
            $table->unsignedInteger('canboso_cost_price')->default(0)->after('canboso_product_id');
        });

        Schema::table('telegram_orders', function (Blueprint $table) {
            $table->string('canboso_order_code', 100)->nullable()->after('sepay_transaction_id');
            $table->text('canboso_response')->nullable()->after('canboso_order_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('telegram_products', function (Blueprint $table) {
            $table->dropColumn(['canboso_product_id', 'canboso_cost_price']);
        });

        Schema::table('telegram_orders', function (Blueprint $table) {
            $table->dropColumn(['canboso_order_code', 'canboso_response']);
        });
    }
};
