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
        Schema::create('detail_pengembalians', function (Blueprint $table) {
            $table->id('id_detail_pengembalian');
            $table->string('kondisi_barang');
            $table->timestamps();
            $table->unsignedBigInteger('id_detail_penyewaan');
            $table->foreign('id_detail_penyewaan')->references('id_detail_penyewaan')->on('detail_penyewaans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengembalian');
    }
};
