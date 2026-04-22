<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;

class LayananController extends Controller
{
    // Tampilkan semua layanan
    public function index()
    {
        $services = Layanan::latest('id_layanan')->get();
        return view('admin.layanan', compact('services'));
    }

    // Tampilkan form tambah layanan
    public function create()
    {
        return view('admin.layanan-create');
    }

    // Simpan layanan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi'    => 'nullable|string',
        ]);

        Layanan::create([
            'id_admin'     => Auth::guard('admin')->id(),
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $service = Layanan::findOrFail($id);
        return view('admin.layanan-edit', compact('service'));
    }

    // Update layanan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi'    => 'nullable|string',
        ]);

        Layanan::findOrFail($id)->update([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil diupdate!');
    }

    // Hapus layanan
    public function destroy($id)
    {
        Layanan::findOrFail($id)->delete();
        return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil dihapus!');
    }
}