<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index()
    {
        $ulasans = collect([
            (object) [
                'id_testimoni' => 1,
                'text_testimoni' => 'To become the global cornerstone of industrial innovation, bridging the gap between traditional engineering and modern sustainable practices.',
                'nama_klien' => 'Budi Santoso',
                'nama_perusahaan' => 'PT Maju Bersama',
                'jabatan_klien' => 'Direktur Utama',
                'foto_klien' => null,
            ],
            (object) [
                'id_testimoni' => 2,
                'text_testimoni' => 'Pelayanan yang sangat profesional dan hasil pekerjaan memuaskan. Tim PT BAT benar-benar mengerti kebutuhan klien dan memberikan solusi terbaik.',
                'nama_klien' => 'Siti Rahayu',
                'nama_perusahaan' => 'CV Karya Mandiri',
                'jabatan_klien' => 'Manajer Proyek',
                'foto_klien' => null,
            ],
            (object) [
                'id_testimoni' => 3,
                'text_testimoni' => 'Kami sangat puas dengan kualitas konstruksi yang dikerjakan. Tepat waktu, sesuai anggaran, dan hasilnya melebihi ekspektasi kami.',
                'nama_klien' => 'Ahmad Fauzi',
                'nama_perusahaan' => 'PT Nusantara Jaya',
                'jabatan_klien' => 'CEO',
                'foto_klien' => null,
            ],
            (object) [
                'id_testimoni' => 4,
                'text_testimoni' => 'Sistem manajemen proyek mereka sangat terstruktur. Komunikasi berjalan lancar dan setiap tahap pekerjaan dilaporkan secara transparan.',
                'nama_klien' => 'Dewi Kurnia',
                'nama_perusahaan' => 'PT Infratech Indonesia',
                'jabatan_klien' => 'Head of Engineering',
                'foto_klien' => null,
            ],
        ]);

        return view('admin.ulasan', compact('ulasans'));
    }

    public function update(Request $request, $id)
    {
        // TODO: Testimoni::findOrFail($id)->update($request->all());
        return redirect()->route('admin.ulasan')->with('success', 'Ulasan berhasil diperbarui.');
    }
}