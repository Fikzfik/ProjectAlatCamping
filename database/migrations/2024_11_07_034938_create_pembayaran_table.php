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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->string('order_id', 255);
            $table->unsignedBigInteger('id_penyewaan');
            $table->foreign('id_penyewaan')->references('id_penyewaan')->on('penyewaans')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal_pembayaran');
            $table->decimal('jumlah_pembayaran', 10, places: 2);
            // Tambahkan metode pembayaran Midtrans seperti 'gopay' ke enum
            $table->enum('metode_pembayaran', ['unknown','credit_card', 'gopay', 'shopeepay', 'qris', 'bca', 'bni', 'bri', 'mandiri', 'echannel', 'permata','cmib', 'danamon', 'akulaku', 'indomaret', 'alfamart', 'uob_ezpay', 'dana']);
            $table->enum('status_pembayaran', ['lunas', 'capture', 'settlement', 'pending', 'deny', 'expire', 'cancel']);
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
