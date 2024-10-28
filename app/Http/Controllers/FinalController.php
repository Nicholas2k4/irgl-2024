<?php

namespace App\Http\Controllers;

use App\Models\FinalQuestion;
use App\Models\Team;
use Google\Service\Dataproc\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Exception;

class FinalController extends Controller
{

    public function game1()
    {
        $data['title'] = "Final Quiz";
        $data['answers'] = Team::where('id', session('team_id'))->with('finalQuestions')->first();
        // $data['questions'] = FinalQuestion::select('id', 'question', 'image')->get();
        $data['questions'] = Team::where('id', session('team_id'))->first()->unansweredFinalQuestion();
        $data['team_name'] = Team::where('id', session('team_id'))->first()->nama;
        $data['score'] = Team::where('id', session('team_id'))->first()->finalStatistic->score;
        return view('final.game1', $data);
    }
    public function game2()
    {
        $data['title'] = "Final Decode";
        $data['words'] = env('SECRET_WORDS');
        return view('final.game2', $data);
    }
    public function game3()
    {
        $data['title'] = "Final Cryptography";
        $data['questions'] = FinalQuestion::where('category', 'like', '%crypto%')->where('status', 1)->get();
        return view('final.game3', $data);
    }
    public function storeLogicAnswer(Request $request, $id)
    {

        $request->merge(['answer' => strtolower($request->answer)]);
        $question = FinalQuestion::find($id);

        $prevAnswer = DB::table('final_answers')
            ->where('team_id', session('team_id'))
            ->where('question_id', $id)
            ->first();

        if ($prevAnswer) {
            if ($prevAnswer->is_correct) {
                return response()->json([
                    'success' => false,
                    'message' => 'This Question already answered correctly!'
                ]);
            } else {
                $cooldownEnd = Carbon::parse($prevAnswer->incorrect_at)->addMinutes(5);
                if (now()->lessThan($cooldownEnd)) {
                    $remainingTime = $cooldownEnd->diffInSeconds(now());
                    return response()->json([
                        'success' => false,
                        'message' => "Please wait for {$remainingTime} seconds before trying again."
                    ]);
                }
            }
        }


        if (strtolower($question->answer) == $request->answer) {
            DB::table('final_answers')->updateOrInsert(
                [
                    'team_id' => session('team_id'),
                    'question_id' => $id,
                ],
                [
                    'answer' => $request->answer,
                    'is_correct' => true,
                    'incorrect_at' => null,
                    'updated_at' => now()
                ]
            );

            $stats = Team::findOrFail(session('team_id'))->finalStatistic;
            if ($question->category == 'quiz') {
                $stats->score += 25;
                $stats->save();
            } else if ($question->category == 'crypto_a') {
                $question->update(['status' => 0]);
                FinalQuestion::where('category', 'crypto_b')->where('status', 0)->first()->update(['status' => 1]);
                $stats->update(['crypto_time_1' => now()]);
            } else if ($question->category == 'crypto_b') {
                $question->update(['status' => 0]);
                FinalQuestion::where('category', 'crypto_c')->where('status', 0)->first()->update(['status' => 1]);
                $stats->update(['crypto_time_2' => now()]);
            } else if ($question->category == 'crypto_c') {
                $question->update(['status' => 0]);
                $stats->update(['crypto_time_3' => now()]);
            }

            return response()->json(['success' => true, 'message' => 'Answer Correct!']);
        } else {
            DB::table('final_answers')->updateOrInsert(
                [
                    'team_id' => session('team_id'),
                    'question_id' => $id,
                ],
                [
                    'answer' => $request->answer,
                    'is_correct' => false,
                    'incorrect_at' => now(),
                    'updated_at' => now()
                ]
            );

            // 5 mins cooldown if answer is incorrect

            return response()->json(['success' => false, 'message' => 'Incorrect Answer!']);
        }
    }


    public function clue()
    {
        $teams = DB::table('teams')
            ->join('final_statistics', 'teams.id', '=', 'final_statistics.team_id')
            ->select('teams.nama as nama', 'final_statistics.*')
            ->get();

        return view('admin.clue', [
            'title' => 'Clue',
            'teams' => $teams,
        ]);
    }

    public function buyClue(Request $request)
    {
        // validate request
        $request->validate([
            'team-name' => 'required|string',
            'clue' => 'required',
        ]);

        // check if the team exists
        try {
            $team = Team::where('nama', $request['team-name'])->firstOrFail();
            // return redirect()->route('admin.clue')->with('success', 'Team ' . $request['team-name'] . ' found! Score=' . $team->finalStatistic->score);
        } catch (Exception $e) {
            return redirect()->route('admin.clue')->with('error', 'Team ' . $request['team-name'] . ' not found!');
        }

        // check if already bought
        if ($request['clue'] == 1 && $team->finalStatistic->has_clue1) {
            return redirect()->route('admin.clue')->with('error', 'Team ' . $request['team-name'] . ' already bought clue 1!');
        }
        if ($request['clue'] == 2 && $team->finalStatistic->has_clue2) {
            return redirect()->route('admin.clue')->with('error', 'Team ' . $request['team-name'] . ' already bought clue 2!');
        }
        if ($request['clue'] == 3 && $team->finalStatistic->has_clue3) {
            return redirect()->route('admin.clue')->with('error', 'Team ' . $request['team-name'] . ' already bought clue 3!');
        }
        if ($request['clue'] == 4 && $team->finalStatistic->has_clue4) {
            return redirect()->route('admin.clue')->with('error', 'Team ' . $request['team-name'] . ' already bought clue 4!');
        }
        if ($request['clue'] == 5 && $team->finalStatistic->has_clue5) {
            return redirect()->route('admin.clue')->with('error', 'Team ' . $request['team-name'] . ' already bought clue 5!');
        }
        if ($request['clue'] == 6 && $team->finalStatistic->has_clue6) {
            return redirect()->route('admin.clue')->with('error', 'Team ' . $request['team-name'] . ' already bought clue 6!');
        }
        if ($request['clue'] == 7 && $team->finalStatistic->has_clue7) {
            return redirect()->route('admin.clue')->with('error', 'Team ' . $request['team-name'] . ' already bought dictionary 1!');
        }
        if ($request['clue'] == 8 && $team->finalStatistic->has_clue8) {
            return redirect()->route('admin.clue')->with('error', 'Team ' . $request['team-name'] . ' already bought dictionary 2!');
        }

        // payment
        DB::beginTransaction();
        $price = $request['clue'] <= 6 ? 15 : 100;

        if ($team->finalStatistic->score < $price) {
            DB::rollBack();
            return redirect()->route('admin.clue')->with('error', 'Team ' . $request['team-name'] . " doesnt has enough points!");
        } else {
            $team->finalStatistic->score -= $price;
            if ($request['clue'] == 1) $team->finalStatistic->has_clue1 = true;
            if ($request['clue'] == 2) $team->finalStatistic->has_clue2 = true;
            if ($request['clue'] == 3) $team->finalStatistic->has_clue3 = true;
            if ($request['clue'] == 4) $team->finalStatistic->has_clue4 = true;
            if ($request['clue'] == 5) $team->finalStatistic->has_clue5 = true;
            if ($request['clue'] == 6) $team->finalStatistic->has_clue6 = true;
            if ($request['clue'] == 7) $team->finalStatistic->has_clue7 = true;
            if ($request['clue'] == 8) $team->finalStatistic->has_clue8 = true;
            $team->finalStatistic->save();
            DB::commit();
            return redirect()->route('admin.clue')->with('success', 'Team ' . $request['team-name'] . ' transaction success!');
        }
    }

    public function storeDecode(Request $request)
    {
        if ($request->answer != env('DECODE_ANSWER')) {
            return response()->json(['success' => false, 'message' => 'Incorrect Answer!']);
        }
        $team = Team::findOrFail(session('team_id'));

        if (!$team->finalStatistic->decode_time) {
            $team->finalStatistic->update(['decode_time', now()]);
        }

        return response()->json(['success' => true, 'message' => 'You have successfully decoded the secret!']);
    }
}
