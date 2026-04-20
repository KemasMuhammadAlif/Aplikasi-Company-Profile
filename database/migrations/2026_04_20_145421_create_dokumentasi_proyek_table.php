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
        Schema::create('dokumentasi_proyek', function (Blueprint $table) {
            $table->integer('id_dok_proyek', true);
            $table->integer('id_proyek')->index('fk_doku_proyek');
            $table->string('dokumentasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi_proyek');
    }
};
