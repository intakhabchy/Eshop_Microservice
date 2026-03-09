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
        Schema::table('product_stock_outs', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained();
            $table->integer('quantity');
            $table->enum('reference_type',['order','return'])->default('order');
            $table->integer('reference_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_stock_outs', function (Blueprint $table) {
            //
        });
    }
};
