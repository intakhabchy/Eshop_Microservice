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
        Schema::create('ssl_commerz_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('store_id');
            $table->string('store_password');
            $table->boolean('sandbox')->default(true);

            $table->string('success_url')->nullable();
            $table->string('fail_url')->nullable();
            $table->string('cancel_url')->nullable();
            $table->string('ipn_url')->nullable();
            $table->string('init_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ssl_commerz_credentials');
    }
};
