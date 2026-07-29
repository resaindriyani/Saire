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
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login atau belum
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Cek apakah role user sesuai dengan hak akses rute tersebut
        if (Auth::user()->role !== $role) {
            // Jika pelamar mencoba masuk ke area admin, atau sebaliknya, lempar ke dashboard masing-masing
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('error', 'Kamu tidak memiliki akses ke halaman tersebut.');
            }
            return redirect()->route('pelamar.dashboard')->with('error', 'Kamu tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}