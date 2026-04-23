<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\DokumentasiProyek;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Tampilkan semua proyek
    public function index()
    {
        $projects = Proyek::with('thumbnail')->latest('tanggal')->get();
        return view('admin.project', compact('projects'));
    }

    // Tampilkan form tambah proyek
    public function create()
    {
        return view('admin.project-create');
    }

    // Simpan proyek baru + upload foto
    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek'   => 'required|string|max:150',
            'lokasi'        => 'nullable|string|max:150',
            'tanggal'       => 'nullable|date',
            'deskripsi'     => 'nullable|string',
            'dokumentasi'   => 'nullable|array',
            'dokumentasi.*' => 'image|max:2048',
        ]);

        // Simpan data proyek
        $proyek = Proyek::create([
            'id_admin'    => Auth::guard('admin')->id(),
            'nama_proyek' => $request->nama_proyek,
            'lokasi'      => $request->lokasi,
            'tanggal'     => $request->tanggal,
            'deskripsi'   => $request->deskripsi,
        ]);

        // Upload foto dokumentasi (bisa lebih dari 1)
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $foto) {
                $path = $foto->store('dokumentasi', 'public');

                DokumentasiProyek::create([
                    'id_proyek'   => $proyek->id_proyek,
                    'dokumentasi' => $path,
                ]);
            }
        }

        return redirect()->route('admin.project')->with('success', 'Proyek berhasil ditambahkan!');
    }

    // Hapus proyek
    public function destroy($id)
    {
        $proyek = Proyek::with('dokumentasi')->findOrFail($id);

        // Hapus file foto dari storage
        foreach ($proyek->dokumentasi as $dok) {
            Storage::disk('public')->delete($dok->dokumentasi);
        }

        $proyek->delete();

        return redirect()->route('admin.project')->with('success', 'Proyek berhasil dihapus!');
    }
}