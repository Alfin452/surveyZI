<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUnitKerjaAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && strtolower(Auth::user()->role?->role_name) === 'admin') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Anda tidak memiliki hak akses sebagai Admin Unit Kerja.');
    }
}
