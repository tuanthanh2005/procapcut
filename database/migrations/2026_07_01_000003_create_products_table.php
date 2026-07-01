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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('category');
            $table->string('category_label');
            $table->string('icon');
            $table->float('rating')->default(5.0);
            $table->integer('review_count')->default(0);
            $table->string('sold')->default('0');
            $table->string('tag')->nullable();
            $table->integer('default_price');
            $table->integer('default_slashed');
            $table->string('seo_title')->nullable();
            $table->text('seo_desc')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->json('features')->nullable();
            $table->json('options')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
