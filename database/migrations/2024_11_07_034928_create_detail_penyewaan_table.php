<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_penyewaans', function (Blueprint $table) {
            $table->id('id_detail_penyewaan');
            $table->integer('jumlah_barang');
            $table->decimal('harga_sewa', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id_barang')->on('barangs')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_penyewaan');
            $table->foreign('id_penyewaan')->references('id_penyewaan')->on('penyewaans')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_keranjang')->nullable(); // Membuat kolom nullable
            $table->foreign('id_keranjang')->references('id_keranjang')->on('keranjangs')->onDelete('set null')->onUpdate('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penyewaan');
    }
};
