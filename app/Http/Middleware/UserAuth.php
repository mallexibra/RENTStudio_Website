<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->session()->get('token');
        $id = $request->session()->get('id_user');
        $role = $request->session()->get('role');
        $fullname = $request->session()->get('name');

        if ($token && $id && $fullname && $role == "admin") {
            return $next($request);
        } else if ($token && $id && $fullname && $role == "user") {
            return $next($request);
        }

        // $request->session()->flush();

        return redirect('/login');
    }
}
