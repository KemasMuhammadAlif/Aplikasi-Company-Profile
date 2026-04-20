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
        Schema::table('profil_perusahaan', function (Blueprint $table) {
            $table->foreign(['id_admin'], 'fk_profil_admin')->references(['id_admin'])->on('admin')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_perusahaan', function (Blueprint $table) {
            $table->dropForeign('fk_profil_admin');
        });
    }
};
