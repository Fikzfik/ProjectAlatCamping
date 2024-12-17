<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // Primary key (id)
            $table->string('judul'); // Kolom untuk judul blog
            $table->text('konten'); // Kolom untuk konten
            $table->date('tanggal'); // Kolom untuk tanggal
            $table->string('foto')->nullable(); // Kolom untuk menyimpan path foto (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
