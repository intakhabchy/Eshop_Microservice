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
            $table->integer('user_id');
            $table->integer('cart_id');
            $table->string('tracking_id');
            $table->text('shipping_address');
            $table->double('total_price');
            $table->double('vat');
            $table->double('payable_price');
            $table->enum('delivery_status',['pending','on_the_way','delivered'])->default('pending');
            $table->enum('payment_status',['due','paid'])->default('due');
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
