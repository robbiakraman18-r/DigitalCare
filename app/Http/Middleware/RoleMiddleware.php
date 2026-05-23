<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Ambil user yang sedang login saat ini
        $user = Auth::user();

        // 3. Periksa apakah role user ada di dalam daftar $roles yang diizinkan rute
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika login sukses tapi role tidak sesuai (misal: dokter mau coba masuk ke admin)
        abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
    }
}