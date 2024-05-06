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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('stock');
            $table->integer('min_qty');
            $table->integer('max_qty');
            $table->integer('day_to_expiration');
            $table->time('start_pickup');
            $table->time('end_pickup');
            $table->double('rating');
            $table->integer('order_count');
            $table->integer('normal_price');
            $table->integer('current_price');
            $table->foreignId('mitra_id');
            $table->foreignId('food_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
