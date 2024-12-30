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
        Schema::create('produk_afiliate_media_afiliates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_afiliate_id')->constrained()->onDelete('cascade');
            $table->foreignId('media_afiliate_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_afiliate_media_afiliates');
    }
};
