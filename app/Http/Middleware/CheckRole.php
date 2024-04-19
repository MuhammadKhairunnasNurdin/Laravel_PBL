<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @param $role
     * @return Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        /**
         * if user hadn't logged in, back to login page
         */
        if (!Auth::check()) {
            return redirect('login');
        }

        if ($request->user()->level != $role) {

            /**
             * if user haven't roles to access, return to log in with access denied
             */
            return redirect('login')->with('error', 'Maaf anda tidak memiliki akses');
        }

        return $next($request);
    }
}
