<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_review`(IN `p_id_admin` INT, IN `p_id_reviewer` INT, IN `p_pesan` TEXT)
    BEGIN
        INSERT INTO review(id_admin, id_reviewer, pesan)
        VALUES(p_id_admin, p_id_reviewer, p_pesan);
    END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_review");
    }
};
