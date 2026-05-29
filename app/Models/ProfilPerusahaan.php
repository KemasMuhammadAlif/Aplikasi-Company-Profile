<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPerusahaan extends Model
{
    protected $table      = 'profil_perusahaan';
    protected $primaryKey = 'id_profil';
    public $timestamps    = false;

    protected $fillable = [
        'id_admin',
        'nama_perusahaan',
        'sejarah',
        'visi',
        'misi',
        'logo',
    ];
}
