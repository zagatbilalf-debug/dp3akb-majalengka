<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminLoggedIn
{
    /**
     * Pastikan session admin_logged_in aktif sebelum mengakses halaman admin.
     * Kalau belum login, redirect ke home (untuk request biasa)
     * atau balikin JSON 401 (untuk request fetch/AJAX dari JS admin).
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->get('admin_logged_in')) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sesi login telah berakhir, silakan login kembali.',
                ], 401);
            }

            return redirect()
                ->route('home')
                ->with('admin_login_required', 'Silakan login terlebih dahulu untuk mengakses halaman admin.');
        }

        return $next($request);
    }
}