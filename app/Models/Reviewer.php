<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    protected $table      = 'reviewer';
    protected $primaryKey = 'id_reviewer';
    public $timestamps    = false;

    protected $fillable = [
        'nama',
        'email',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_reviewer', 'id_reviewer');
    }
}