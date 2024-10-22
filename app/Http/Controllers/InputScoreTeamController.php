<?php

namespace App\Http\Controllers;

use App\Models\SemiStatistic;
use App\Models\Team;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class InputScoreTeamController extends Controller
{
    function showForm()
    {
        $teams = Team::select('nama')->get();
        return view('admin.inputscoreteam', [
            'teams' => $teams,
            'title' => 'Points',
        ]);
    }

    function addScore(Request $request)
    {
        // validate request
        $validated = $request->validate([
            'team-name' => 'required|string',
            // 'nama-game' => 'required|string',
            'score' => 'required|numeric'
        ]);


        // check if the team exists
        try {
            $team = Team::where('nama', $request['team-name'])->firstOrFail();
            // return redirect()->route('admin.market')->with('success', 'Team ' . $request['team-name'] . ' found! Score=' . $team->semiStatistic->score);
        } catch (Exception $e) {
            return redirect()->route('admin.inputscoreteam')->with('error', 'Team ' . $request['team-name'] . ' not found!');
        }


        // get semi stats
        $semiStatistic = $team->semiStatistic;


        // add score
        if ($semiStatistic) {
            $semiStatistic->score += $validated['score'];
            $semiStatistic->save();

            Log::channel('daily')->info(Session::get('name') . ' added ' . $validated['score'] . ' points for team ' . $validated['team-name'] . '.');

            return redirect()->route('admin.inputscoreteam')->with('success', 'Added ' . $validated['score'] . ' points for team ' . $validated['team-name'] . '!');
        } else {
            return redirect()->route('admin.inputscoreteam')->with('error', 'Semifinal statistics for team ' . $request['team-name'] . ' not found!');
        }
    }
}
