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
        Schema::create('cart', function (Blueprint $table) {
            $table->id('id_cart');
            $table->enum('status', ['ESPERA', 'FINALIZADO', 'ABANDONADO']);

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('user');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_product');
        Schema::dropIfExists('cart');
    }
};
