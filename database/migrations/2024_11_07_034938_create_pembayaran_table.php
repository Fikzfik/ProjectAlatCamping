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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_penyewaan');
            $table->foreign('id_penyewaan')->references('id_penyewaan')->on('penyewaans')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal_pembayaran');
            $table->decimal('jumlah_pembayaran', 10, 2);
            $table->enum('metode_pembayaran', ['transfer', 'tunai', 'kartu kredit']);
            $table->enum('status_pembayaran', ['lunas', 'belum lunas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
