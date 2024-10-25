<?php

namespace App\Http\Controllers;

use App\Models\FinalQuestion;
use App\Models\Team;
use Google\Service\Dataproc\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FinalController extends Controller
{

    public function game1()
    {
        $data['title'] = "Final Game 1";
        $data['answers'] = Team::where('id', session('team_id'))->with('finalQuestions')->first();
        $data['questions'] = FinalQuestion::select('id', 'question', 'image')->get();
        return view('final.game1', $data);
    }
    public function game2()
    {
        $data['title'] = "Final Game 2";
        $data['words'] = env('SECRET_WORDS');
        return view('final.game2', $data);
    }
    public function storeLogicAnswer(Request $request, $id)
    {
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

        if ($question->answer == $request->answer) {
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
            $stats->score += 25;
            $stats->save();

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
}
