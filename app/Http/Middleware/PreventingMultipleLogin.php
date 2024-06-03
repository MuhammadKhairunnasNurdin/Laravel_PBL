<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventingMultipleLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() and Auth::user()->session_id !== session()->getId()) {
            Auth::logout();
            return redirect('login')
                ->withInput()
                ->withErrors(['error' => 'Anda sudah login di device yang lain, Coba logout terlebih dahulu!']);
        }

        return $next($request);
    }
}
