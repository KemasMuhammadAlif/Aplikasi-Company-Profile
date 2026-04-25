<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        // TODO: ambil dari database
        // $profil = Profil::first();
        $profil = null;

        return view('admin.profil', compact('profil'));
    }

    public function store(Request $request)
    {
        // TODO: simpan visi & misi ke database
    }

    public function update(Request $request)
    {
        // TODO: update field visi atau misi
        // $request->field  → 'visi' atau 'misi'
        // $request->value  → teks baru
    }

    public function destroy(Request $request)
    {
        // TODO: hapus/kosongkan field
        // $request->field  → 'visi' atau 'misi'
    }

    public function saveHistory(Request $request)
    {
        // TODO: simpan sejarah perusahaan
        // $request->sejarah → HTML dari editor
    }
}