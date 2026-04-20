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
        Schema::create('profil_perusahaan', function (Blueprint $table) {
            $table->integer('id_profil', true);
            $table->integer('id_admin')->index('fk_profil_admin');
            $table->string('nama_perusahaan', 150);
            $table->text('sejarah')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_perusahaan');
    }
};
