<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqKategori extends Model
{
    protected $table      = 'faq_kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = ['nama_kategori', 'urutan'];

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'id_kategori', 'id_kategori')
                    ->orderBy('urutan');
    }
}