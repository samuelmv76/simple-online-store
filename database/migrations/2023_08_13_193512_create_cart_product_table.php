<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->id();

            // Relación con peripherals
            $table->foreignId('peripheral_id')->constrained('peripherals')->onDelete('cascade');

            // Relación con carts
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade');

            $table->integer('count_product');
            $table->float('price_product');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_product');
    }
};
