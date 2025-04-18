<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->text('url_imagen');
        
            $table->foreignId('peripheral_id')->constrained('peripherals')->onDelete('cascade');
        
            $table->timestamps();
        });        
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
