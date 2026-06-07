<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilPerusahaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'jenis' => 'required|in:deskripsi,visi,misi',
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
                'id_admin' => Auth::guard('admin')->id(),
                'nama_perusahaan' => 'PT Berkah Alam Tabantang',
                $request->jenis => $request->deskripsi,
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
    public function saveLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|max:2048',
        ]);

        $profil = ProfilPerusahaan::first();

        // Hapus logo lama kalau ada
        if ($profil && $profil->logo) {
            Storage::disk('public')->delete($profil->logo);
        }

        $path = $request->file('logo')->store('profil', 'public');

        if ($profil) {
            $profil->update(['logo' => $path]);
        } else {
            ProfilPerusahaan::create([
                'id_admin'        => Auth::guard('admin')->id(),
                'nama_perusahaan' => 'PT Berkah Alam Tabantang',
                'logo'            => $path,
            ]);
        }

        return redirect()->route('admin.profil')->with('success', 'Logo berhasil diperbarui.');
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

    // Simpan deskripsi perusahaan
    public function saveHistory(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string',
        ]);

        $profil = ProfilPerusahaan::first();

        if ($profil) {
            $profil->update([
                'deskripsi' => $request->deskripsi,
            ]);
        } else {
            ProfilPerusahaan::create([
                'id_admin' => Auth::guard('admin')->id(),
                'nama_perusahaan' => 'PT Berkah Alam Tabantang',
                'deskripsi' => $request->deskripsi,
            ]);
        }

        return redirect()->route('admin.profil')->with('success', 'Deskripsi perusahaan berhasil disimpan!');
    }
}
