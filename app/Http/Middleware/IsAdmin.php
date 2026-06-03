<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan Auth facade di-import
use Symfony\Component\HttpFoundation\Response; // Untuk tipe return yang lebih spesifik

class IsAdmin
{
    /**
     * Handle an incoming request.
     * Menangani permintaan yang masuk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            // Jika belum login, arahkan ke halaman login dengan pesan error
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
        }

        // 2. Cek apakah pengguna yang sudah login memiliki peran 'admin'
        // Menggunakan method isAdmin() dari model User
        if (Auth::user()->isAdmin()) {
            // Jika pengguna adalah admin, lanjutkan ke request berikutnya
            return $next($request);
        }

        // 3. Jika pengguna sudah login tetapi bukan admin
        // Arahkan ke halaman utama (atau halaman lain yang sesuai) dengan pesan error.
        return redirect('/')->with('error', 'Anda tidak memiliki hak akses untuk halaman ini.');
        // Catatan: '/' mengarahkan ke halaman utama. Anda bisa menggantinya dengan route('home') jika ada.
    }
}
