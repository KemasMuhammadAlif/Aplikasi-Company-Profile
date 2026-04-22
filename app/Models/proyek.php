<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table      = 'proyek';
    protected $primaryKey = 'id_proyek';
    public $timestamps    = false;

    protected $fillable = [
        'id_admin',
        'nama_proyek',
        'lokasi',
        'tanggal',
        'deskripsi',
    ];

    // Relasi ke admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    // Relasi ke dokumentasi (1 proyek bisa banyak foto)
    public function dokumentasi()
    {
        return $this->hasMany(DokumentasiProyek::class, 'id_proyek', 'id_proyek');
    }

    // Ambil foto pertama sebagai thumbnail
    public function thumbnail()
    {
        return $this->hasOne(DokumentasiProyek::class, 'id_proyek', 'id_proyek');
    }
}