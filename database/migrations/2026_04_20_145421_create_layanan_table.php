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
        Schema::create('layanan', function (Blueprint $table) {
            $table->integer('id_layanan', true);
            $table->integer('id_admin')->index('fk_layanan_admin');
            $table->string('nama_layanan', 100);
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
