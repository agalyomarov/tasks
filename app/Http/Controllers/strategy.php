<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class strategy extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $strategies = DB::table('results')->get();
        foreach ($strategies as $strategy) {
            $strategy->created_at = Carbon::parse($strategy->created_at)->format('d.m.Y');
            if ($strategy->author_id != 'admin') {
                $personal = DB::table('personals')->where('id', $strategy->author_id)->first();
                $strategy->author = $personal;
            } else if ($strategy->author_id == 'admin') {
                $strategy->author = 'admin';
            }
        }
        return view('x5', compact('strategies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('strategy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $personal = DB::table('personals')->where(['login' => session()->get('login')])->first();
        $author = '';
        if ($personal) {
            $author_id = $personal->id;
        } else if (config('app.ADMIN_LOGIN') == session()->get('login')) {
            $author_id = 'admin';
        }
        $new_category = DB::table('results')->insert(['title' => $request->title, 'status' => 'offered', 'author_id' => $author_id, 'created_at' => Date::now(), 'updated_at' => Date::now()]);
        return redirect('/strategy');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
