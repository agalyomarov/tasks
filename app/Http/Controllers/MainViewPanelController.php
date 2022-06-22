<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainViewPanelController extends Controller
{
    public function index()
    {
        $goals = DB::table('goals')->get()->toArray();
        $projects = DB::table('projects')->get()->toArray();
        $members = DB::table('members')->get()->toArray();
        $tactics = DB::table('tasks')->get()->toArray();
        $results = DB::table('results')->get()->toArray();
        $records = [];
        if (session()->get('role') == 'admin' || session()->get('role') == 'director') {
            $records = array_merge($goals, $projects, $members, $tactics, $results);
        }
        if (session()->get('role') == 'manager_goals') {
            $records = $tactics;
        }
        if (session()->get('role') == 'manager_tactic') {
            $records = $projects;
        }
        if (session()->get('role') == 'manager_projects') {
            $records = $members;
        }
        foreach ($records as $record) {
            $record->created_at = Carbon::parse($record->created_at)->format('d-m-Y');
            if ($record->author_id != 'admin') {
                $record->author_id = Personal::find($record->author_id);
            }
        }
        return view('viewpanel', compact('records'));
    }

    public function offer(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $record = DB::table($data['name'])->where('id', $data['id'])->update(['status' => 'dismissed', 'description' => $data['description']]);
        return redirect()->route('viewpanelIndex');
        // dd($data);
    }
    public function take(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $record = DB::table($data['name'])->where('id', $data['id'])->update(['status' => 'taken']);
        return redirect()->route('viewpanelIndex');
        // dd($data);
    }
}
