<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // 'id' será clave primaria estándar
            $table->enum('status', ['ESPERA', 'FINALIZADO', 'ABANDONADO']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // relación estándar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_product'); // si quieres puedes quitar esto, ya se borra con su migración
        Schema::dropIfExists('carts');
    }
};
