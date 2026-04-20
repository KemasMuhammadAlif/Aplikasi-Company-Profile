<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table      = 'admin';
    protected $primaryKey = 'id_admin';

    // Nonaktifkan timestamps karena tabel tidak punya created_at/updated_at
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'nama_admin',
    ];

    protected $hidden = [
        'password',
    ];
}