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
        // 1. Telegram Users
        Schema::create('telegram_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('telegram_id')->unique()->index();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->bigInteger('balance')->default(0);
            $table->bigInteger('total_spent')->default(0);
            $table->string('referral_code')->nullable()->index();
            $table->bigInteger('referred_by')->nullable()->index();
            $table->string('step')->nullable();
            $table->json('step_data')->nullable();
            $table->boolean('is_banned')->default(false);
            $table->timestamps();
        });

        // 2. Telegram Categories
        Schema::create('telegram_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->default('📦');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. Telegram Products
        Schema::create('telegram_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('telegram_categories')->onDelete('cascade');
            $table->string('name');
            $table->bigInteger('price');
            $table->bigInteger('original_price')->nullable();
            $table->text('description')->nullable();
            $table->text('guide_text')->nullable();
            $table->string('delivery_type')->default('key_stock'); // 'key_stock', 'static_text', 'manual'
            $table->text('static_content')->nullable();
            $table->integer('sold_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 4. Telegram Product Keys / Stock Pool
        Schema::create('telegram_product_keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('telegram_products')->onDelete('cascade');
            $table->text('account_data');
            $table->boolean('is_used')->default(false);
            $table->bigInteger('used_by_order_id')->nullable()->index();
            $table->timestamps();
        });

        // 5. Telegram Orders
        Schema::create('telegram_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique()->index();
            $table->foreignId('telegram_user_id')->constrained('telegram_users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('telegram_products')->onDelete('cascade');
            $table->string('product_name');
            $table->integer('quantity')->default(1);
            $table->bigInteger('unit_price');
            $table->bigInteger('total_amount');
            $table->string('payment_method')->default('vietqr'); // 'vietqr', 'wallet'
            $table->string('status')->default('pending'); // 'pending', 'completed', 'cancelled', 'expired'
            $table->text('delivered_data')->nullable();
            $table->string('sepay_transaction_id')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        // 6. Telegram Transactions
        Schema::create('telegram_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('telegram_user_id')->constrained('telegram_users')->onDelete('cascade');
            $table->string('type'); // 'deposit', 'purchase', 'referral_bonus', 'admin_adjustment'
            $table->bigInteger('amount');
            $table->bigInteger('balance_before');
            $table->bigInteger('balance_after');
            $table->string('description');
            $table->string('reference_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegram_transactions');
        Schema::dropIfExists('telegram_orders');
        Schema::dropIfExists('telegram_product_keys');
        Schema::dropIfExists('telegram_products');
        Schema::dropIfExists('telegram_categories');
        Schema::dropIfExists('telegram_users');
    }
};
