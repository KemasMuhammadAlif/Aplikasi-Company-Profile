<?php

// app/Http/Middleware/RestrictAdminByIP.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictAdminByIP
{
    protected $allowedIPs = [
        '127.0.0.1',
        '10.170.14.164',
    ];

    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->ip(), $this->allowedIPs)) {
            abort(403, 'Akses ditolak. IP kamu tidak diizinkan.');
        }

        return $next($request);
    }
}
