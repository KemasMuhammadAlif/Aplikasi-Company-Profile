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
        Schema::table('faq', function (Blueprint $table) {
            $table->integer('id_kategori')->nullable()->after('id_faq');
            $table->integer('urutan')->default(0)->after('jawaban');
        });
    }

    public function down(): void
    {
        Schema::table('faq', function (Blueprint $table) {
            $table->dropColumn(['id_kategori', 'urutan']);
        });
    }
};
