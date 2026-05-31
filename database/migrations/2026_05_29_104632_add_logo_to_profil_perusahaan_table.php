<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('profil_perusahaan', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('misi');
        });
    }

    public function down()
    {
        Schema::table('profil_perusahaan', function (Blueprint $table) {
            $table->dropColumn('logo');
        });
    }
};
