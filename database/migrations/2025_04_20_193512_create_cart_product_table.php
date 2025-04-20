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

            // Clave foránea hacia peripherals.id
            $table->unsignedBigInteger('peripheral_id');
            $table->foreign('peripheral_id')->references('id')->on('peripherals')->onDelete('cascade');

            // Clave foránea hacia carts.id
            $table->unsignedBigInteger('cart_id');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');

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
