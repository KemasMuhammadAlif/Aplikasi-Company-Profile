<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenPerusahaan;

class SertifikatController extends Controller
{
    // Tampilkan semua sertifikat
    public function index()
    {
        $certificates = DokumenPerusahaan::latest('id_dok_perusahaan')->get();
        return view('admin.sertifikat', compact('certificates'));
    }

    // Tampilkan form tambah sertifikat
    public function create()
    {
        return view('admin.sertifikat-create');
    }

    // Simpan sertifikat baru
    public function store(Request $request)
    {
        $request->validate([
            'legalitas'  => 'required|string|max:255',
            'sertifikat' => 'required|string|max:255',
        ]);

        DokumenPerusahaan::create([
            'id_profil'  => 1, // sesuaikan dengan id_profil perusahaan
            'legalitas'  => $request->legalitas,
            'sertifikat' => $request->sertifikat,
        ]);

        return redirect()->route('admin.sertifikat')->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $cert = DokumenPerusahaan::findOrFail($id);
        return view('admin.sertifikat-edit', compact('cert'));
    }

    // Update sertifikat
    public function update(Request $request, $id)
    {
        $request->validate([
            'legalitas'  => 'required|string|max:255',
            'sertifikat' => 'required|string|max:255',
        ]);

        DokumenPerusahaan::findOrFail($id)->update([
            'legalitas'  => $request->legalitas,
            'sertifikat' => $request->sertifikat,
        ]);

        return redirect()->route('admin.sertifikat')->with('success', 'Sertifikat berhasil diupdate!');
    }

    // Hapus sertifikat
    public function destroy($id)
    {
        DokumenPerusahaan::findOrFail($id)->delete();
        return redirect()->route('admin.sertifikat')->with('success', 'Sertifikat berhasil dihapus!');
    }
}