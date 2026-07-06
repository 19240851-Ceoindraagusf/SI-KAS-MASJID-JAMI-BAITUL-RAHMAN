<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserApprovalStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login dan belum disetujui, logout dan redirect
        if (Auth::check()) {
            $user = Auth::user();

            // Admin tidak perlu persetujuan
            if ($user->isAdmin()) {
                return $next($request);
            }

            // Jika bendahara dan belum disetujui, logout
            if ($user->isPending()) {
                Auth::logout();
                return redirect('/login')->with('error', 'Akun Anda masih menunggu persetujuan dari admin. Silakan hubungi admin untuk informasi lebih lanjut.');
            }
        }

        return $next($request);
    }
}
