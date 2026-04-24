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
        Schema::table('dokumen_perusahaan', function (Blueprint $table) {
            $table->dropColumn('legalitas');
            $table->string('icon', 50)->default('bi-patch-check')->after('sertifikat');
        });
    }

    public function down(): void
    {
        Schema::table('dokumen_perusahaan', function (Blueprint $table) {
            $table->string('legalitas')->nullable();
            $table->dropColumn('icon');
        });
    }
};
