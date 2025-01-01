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
        Schema::create('review_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id');
            $table->foreignId('pesanan_id');
            $table->foreignId('user_id');
            $table->integer('bintang')->nullable();
            $table->text('hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_produks');
    }
};
