<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ← tambah ini

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        \App\Models\Admin::create([
            'username'   => 'admin',
            'password'   => bcrypt('password123'),
            'nama_admin' => 'Administrator',
        ]);

        // Profil Perusahaan
        DB::table('profil_perusahaan')->insert([
            'id_admin'        => 1,
            'nama_perusahaan' => 'PT Berkah Alam Tabantang',
            'sejarah'         => 'Perusahaan konstruksi profesional.',
            'visi'            => 'Menjadi perusahaan konstruksi terbaik.',
            'misi'            => 'Memberikan layanan konstruksi berkualitas tinggi.',
        ]);
    }
}