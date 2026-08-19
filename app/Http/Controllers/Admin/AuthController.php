<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{

    public function login(Request $request): JsonResponse
    {
        $throttleKey = 'admin-login:' . $request->ip();

        // Sudah terkunci karena 3x gagal berturut-turut
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return response()->json([
                'success' => false,
                'locked' => true,
                'retry_after' => $seconds,
                'message' => "Terlalu banyak percobaan gagal. Coba lagi dalam {$seconds} detik.",
            ], 429);
        }


        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); 
            RateLimiter::clear($throttleKey);

            // Dipertahankan supaya middleware admin.auth yang sudah ada tetap jalan
            session(['admin_logged_in' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil!',
                'redirect' => route('admin.dashboard'),
            ]);
        }

        RateLimiter::hit($throttleKey, 60);

        return response()->json([
            'success' => false,
            'message' => 'Username atau password salah!',
        ], 401);
    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->forget('admin_logged_in');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }


    // Halaman index Pengaturan — daftar opsi (sekarang baru "Ubah Password")
    public function pengaturanIndex()
    {
        return view('admin.pengaturan.index', [
            'title' => 'Pengaturan',
        ]);
    }


    public function showChangePasswordForm()
    {
        return view('admin.pengaturan.ubah-password', [
            'title' => 'Ubah Password',
        ]);
    }


    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini yang kamu masukkan salah.',
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()
            ->route('admin.pengaturan.ubah-password')
            ->with('success', 'Password berhasil diubah. Gunakan password baru untuk login berikutnya.');
    }
}