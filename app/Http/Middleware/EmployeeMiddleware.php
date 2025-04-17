<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flash;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            if(Auth::user()->role == '1' || Auth::user()->role == '3') {
                return $next($request);
            } else {
                Flash::error('Access Denied. As you are not Employee or Admin');
                return redirect('/home');
            }
        } else {
            Flash::error('Login to access the website info');
            return redirect('/login');
        }
        return $next($request);
    }
}
