<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{
    public function index()
    {
        $personals = Personal::all();
        return view('personal', compact('personals'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'login' => ['required', 'unique:personals,login'],
            'password' => ['required'],
            'fullname' => ['required'],
            'lastname' => ['required'],
            'role' => ['required'],
        ]);
        Personal::create($validated);
        return redirect()->route('personalIndex');
    }

    public function delete(Personal $personal)
    {
        // dd($personal);
        $personal->delete();

        return redirect()->route('personalIndex');
    }
}
