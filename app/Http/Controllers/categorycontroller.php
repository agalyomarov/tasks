<?php

namespace App\Http\Controllers;

use App\Models\category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use stdClass;

class categorycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personal = DB::table('personals')->where(['login' => session()->get('login'), 'password' => session()->get('password')])->first();
        if (!$personal) {
            $personal = new stdClass();
            $personal->id = 'admin';
        }
        $categories = DB::table('goals')->where('author_id', $personal->id)->get();
        foreach ($categories as $category) {
            $category->created_at = Carbon::parse($category->created_at)->format('d.m.Y');
            if ($category->author_id != 'admin') {
                $personal = DB::table('personals')->where('id', $category->author_id)->first();
                $category->author = $personal;
            } else if ($category->author_id == 'admin') {
                $category->author = 'admin';
            }
        }
        // dd($categories);
        return view('x1', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $personal = DB::table('personals')->where('login', session()->get('login'))->first();
        $author_id = '';
        if ($personal) {
            $author_id = $personal->id;
        } else if (config('app.ADMIN_LOGIN') == session()->get('login')) {
            $author_id = 'admin';
        }
        $new_category = DB::table('goals')->insert(['title' => $request->title, 'status' => 'offered', 'author_id' => $author_id, 'created_at' => Date::now(), 'updated_at' => Date::now()]);
        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }
}
