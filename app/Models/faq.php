<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table      = 'faq';
    protected $primaryKey = 'id_faq';
    public $timestamps    = false;

    protected $fillable = [
        'id_admin',
        'id_kategori',  // tambah
        'pertanyaan',
        'jawaban',
        'urutan',       // tambah
    ];

    public function kategori()
    {
        return $this->belongsTo(FaqKategori::class, 'id_kategori', 'id_kategori');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
