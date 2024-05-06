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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->dateTime('date');
            $table->integer('qty');
            $table->integer('total_food_price');
            $table->integer('voucher_nominal');
            $table->integer('coin_nominal');
            $table->integer('grand_nominal');
            $table->integer('status'); // 0 for waiting payment, 1 for waiting pickup, 2 for waiting review, 3 for all complete, 9 for fail
            $table->integer('notification'); // 0 for off, 1 for on, 2 for sent
            $table->string('snap_token')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('food_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
