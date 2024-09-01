<?php

namespace App\Http\Controllers;

use App\Models\SemiStatistic;
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

    function addScore(Request $request) {
        $validated = $request->validate([
            'nama-team' => 'required|string',
            'nama-game' => 'required|string',
            'jumlah-score' => 'required|numeric'
        ]);

        $team = Team::where('nama', 'LIKE', $validated['nama-team'])->select('id')->first();
        
        if ($team) {
            $semiStatistic = SemiStatistic::where('id_team', $team->id)->first();
    
            if ($semiStatistic) {
                $semiStatistic->score += $validated['jumlah-score'];
                $semiStatistic->save();
    
                return response()->json(['message' => 'Score updated successfully'], 200);
            } else {
                return response()->json(['message' => 'SemiStatistic entry not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Team not found'], 404);
        }
    }
}
