<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id(); // primary key, auto-increment
            $table->string('name'); // Nama store
            $table->text('address'); // Alamat store
            $table->string('phone_number')->nullable(); // Nomor telepon (opsional)
            $table->string('email')->nullable(); // Email (opsional)
            $table->string('latitude')->nullable(); // Koordinat latitude (opsional)
            $table->string('longitude')->nullable(); // Koordinat longitude (opsional)
            $table->string('image_url')->nullable(); // URL gambar store (opsional)
            $table->boolean('is_active')->default(true); // Status store aktif
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
