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
        Schema::table('review', function (Blueprint $table) {
            $table->foreign(['id_admin'], 'fk_review_admin')->references(['id_admin'])->on('admin')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_reviewer'], 'fk_review_reviewer')->references(['id_reviewer'])->on('reviewer')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('review', function (Blueprint $table) {
            $table->dropForeign('fk_review_admin');
            $table->dropForeign('fk_review_reviewer');
        });
    }
};
