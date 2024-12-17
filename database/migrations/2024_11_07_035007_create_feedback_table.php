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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id('id_feedback');
            $table->date('tanggal_feedback');
            $table->integer('rating')->check('rating >= 1 AND rating <= 5');
            $table->text('komentar');
            $table->timestamps();

            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id_barang')->on('barangs')->onDelete('cascade')->onUpdate('cascade');

            // Menambahkan id_penyewaan sebagai referensi penyewaan
            $table->unsignedBigInteger('id_penyewaan');
            $table->foreign('id_penyewaan')->references('id_penyewaan')->on('penyewaans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
