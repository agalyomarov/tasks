<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMiddleware
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
        // dd(session('login'));
        $personal = DB::table('personals')->where(['login' => session('login'), 'password' => session('password')])->first();
        if ($personal) {
            if ($personal->role == 'admin') {
                return $next($request);
            }
        } else if (config('app.ADMIN_LOGIN') == session('login') && config('app.ADMIN_PASSWORD') == session('password')) {
            return $next($request);
        }
        return redirect()->route('auth');
        // dd($sessions);
    }
}
