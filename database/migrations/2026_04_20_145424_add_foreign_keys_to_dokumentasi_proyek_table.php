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
        Schema::table('dokumentasi_proyek', function (Blueprint $table) {
            $table->foreign(['id_proyek'], 'fk_doku_proyek')->references(['id_proyek'])->on('proyek')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumentasi_proyek', function (Blueprint $table) {
            $table->dropForeign('fk_doku_proyek');
        });
    }
};
