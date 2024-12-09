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
        Schema::create('menus', function (Blueprint $table) {
            $table->id('id_menu');
            $table->unsignedBigInteger('id_level')->nullable();
            $table->foreign('id_level')->references('id_level')->on('levels')->onDelete('cascade');
            $table->string('menu_link')->nullable();
            $table->string('menu_icon')->nullable();
            $table->string('parent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
