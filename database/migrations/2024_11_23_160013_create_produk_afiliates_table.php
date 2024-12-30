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
        Schema::create('produk_afiliates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platformAfiliate_id');
            $table->text('nama');
            $table->text('slug');
            $table->text('harga');
            $table->string('penjualan');
            $table->text('link_produk');
            $table->text('link_komisi_ekstra');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_afiliates');
    }
};
