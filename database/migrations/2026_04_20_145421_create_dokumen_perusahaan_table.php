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
        Schema::create('dokumen_perusahaan', function (Blueprint $table) {
            $table->integer('id_dok_perusahaan', true);
            $table->integer('id_profil')->index('fk_dokumen_profil');
            $table->string('legalitas');
            $table->string('sertifikat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_perusahaan');
    }
};
