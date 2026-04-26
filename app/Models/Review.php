<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table      = 'review';
    protected $primaryKey = 'id_review';
    public $timestamps    = false;

    protected $fillable = [
        'id_admin',
        'id_reviewer',
        'pesan',
        'rating',
        'balasan',
    ];

    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class, 'id_reviewer', 'id_reviewer');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
