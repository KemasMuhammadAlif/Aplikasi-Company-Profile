<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilPerusahaan;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    // Tampilkan halaman profil
    public function index()
    {
        $profil = ProfilPerusahaan::first();
        return view('admin.pages.profil', compact('profil'));
    }

    // Simpan profil baru (visi/misi/sejarah)
    public function store(Request $request)
    {
        $request->validate([
            'jenis'     => 'required|in:sejarah,visi,misi',
            'deskripsi' => 'required|string',
        ]);

        $profil = ProfilPerusahaan::first();

        if ($profil) {
            // Update field yang dipilih
            $profil->update([
                $request->jenis => $request->deskripsi,
            ]);
        } else {
            // Buat profil baru kalau belum ada
            ProfilPerusahaan::create([
                'id_admin'        => Auth::guard('admin')->id(),
                'nama_perusahaan' => 'PT Berkah Alam Tabantang',
                $request->jenis   => $request->deskripsi,
            ]);
        }

        return redirect()->route('admin.profil')->with('success', ucfirst($request->jenis) . ' berhasil disimpan!');
    }

    // Update visi atau misi
    public function update(Request $request)
    {
        $request->validate([
            'field' => 'required|in:visi,misi',
            'value' => 'required|string',
        ]);

        $profil = ProfilPerusahaan::first();

        if ($profil) {
            $profil->update([
                $request->field => $request->value,
            ]);
        }

        return redirect()->route('admin.profil')->with('success', ucfirst($request->field) . ' berhasil diupdate!');
    }

    // Hapus/kosongkan field visi atau misi
    public function destroy(Request $request)
    {
        $request->validate([
            'field' => 'required|in:visi,misi',
        ]);

        $profil = ProfilPerusahaan::first();

        if ($profil) {
            $profil->update([
                $request->field => null,
            ]);
        }

        return redirect()->route('admin.profil')->with('success', ucfirst($request->field) . ' berhasil dihapus!');
    }

    // Simpan sejarah perusahaan
    public function saveHistory(Request $request)
    {
        $request->validate([
            'sejarah' => 'required|string',
        ]);

        $profil = ProfilPerusahaan::first();

        if ($profil) {
            $profil->update([
                'sejarah' => $request->sejarah,
            ]);
        } else {
            ProfilPerusahaan::create([
                'id_admin'        => Auth::guard('admin')->id(),
                'nama_perusahaan' => 'PT Berkah Alam Tabantang',
                'sejarah'         => $request->sejarah,
            ]);
        }

        return redirect()->route('admin.profil')->with('success', 'Sejarah perusahaan berhasil disimpan!');
    }
}
