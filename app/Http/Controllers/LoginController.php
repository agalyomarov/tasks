<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth');
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $personal = DB::table('personals')->where(['login' => $data['login'], 'password' => $data['password']])->first();
        if ($personal) {
            session(['login' => $personal->login]);
            session(['password' => $personal->password]);
            session(['role' => $personal->role]);
            // if ($personal->role == 'director') {
            return  redirect()->route('main');
            // }
        } else if (config('app.ADMIN_LOGIN') == $data['login'] && config('app.ADMIN_PASSWORD') == $data['password']) {
            session(['login' => config('app.ADMIN_LOGIN')]);
            session(['password' => config('app.ADMIN_PASSWORD')]);
            session(['role' => 'admin']);
            return  redirect()->route('main');
        }
        return redirect()->route('auth');
    }

    public function logout()
    {
        session()->forget('role');
        session()->forget('login');
        session()->forget('password');
        return redirect()->route('auth');
    }
}
