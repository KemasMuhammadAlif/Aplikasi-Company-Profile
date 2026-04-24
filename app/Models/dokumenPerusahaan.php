<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPerusahaan extends Model
{
    protected $table      = 'dokumen_perusahaan';
    protected $primaryKey = 'id_dok_perusahaan';
    public $timestamps    = false;

    protected $fillable = [
        'id_profil',
        'sertifikat',
        'icon',
    ];
}
