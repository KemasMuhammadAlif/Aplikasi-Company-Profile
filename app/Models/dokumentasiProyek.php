<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiProyek extends Model
{
    protected $table      = 'dokumentasi_proyek';
    protected $primaryKey = 'id_dok_proyek';
    public $timestamps    = false;

    protected $fillable = [
        'id_proyek',
        'dokumentasi',
    ];

    // Relasi ke proyek
    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id_proyek', 'id_proyek');
    }
}