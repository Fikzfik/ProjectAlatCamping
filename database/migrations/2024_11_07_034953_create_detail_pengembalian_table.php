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
            $table->decimal('biaya_kerusakan', 10, 2);
            $table->timestamps();
            $table->unsignedBigInteger('id_pengembalian');
            $table->foreign('id_pengembalian')->references('id_pengembalian')->on('pengembalians')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_pembayaran');
            $table->foreign('id_pembayaran')->references('id_pembayaran')->on('pembayarans')->onDelete('cascade')->onUpdate('cascade');
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
