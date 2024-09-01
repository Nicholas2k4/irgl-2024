<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class InputScoreTeamController extends Controller
{
    function showForm() {
        $teams = Team::select('nama')->get();
        return view('inputscoreteam', compact('teams'));
    }

    function searchTeam(Request $request) {
        $query = $request->get('query');

        $teams = Team::where('nama', 'LIKE', "%{$query}%")->select('nama')->get();

        return response()->json($teams);
    }
}
