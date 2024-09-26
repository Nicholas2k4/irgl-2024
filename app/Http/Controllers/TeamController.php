<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Admin;
use Firebase\JWT\JWT;
use Carbon\Carbon;
use App\Models\ElimGames;
use App\Utils\HttpResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ElimQuestions;
use App\Models\ElimStatistics;
use App\Utils\HttpResponseCode;
use App\Models\ElimGamesHistory;
use App\Models\ElimQuestionHistory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Exceptions\MissingAbilityException;

class TeamController extends BaseController
{
    //
    use HttpResponse;
    public function __construct(Team $model)
    {
        parent::__construct($model);
    }


    public function cekJadwal(Team $team)
    {
        if ($team->jadwal == null) {
            return $this->error('Jadwal belum diatur', HttpResponseCode::HTTP_NOT_ACCEPTABLE);
        }
        $sekarang = Carbon::now();
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $team->jadwal->tanggal . ' ' . $team->jadwal->start_time);
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $team->jadwal->tanggal . ' ' . $team->jadwal->end_time);
        if (!$sekarang->between($startDateTime, $endDateTime)) {
            return $this->error('Jadwal tidak sesuai', HttpResponseCode::HTTP_NOT_ACCEPTABLE);
        }
        return true;
    }

    public function getUserData(Request $request)
    {
        $creds = $request->only('team_name', 'password');
        $validate = Validator::make(
            $creds,
            [
                'team_name' => 'required|exists:teams,nama',
                'password' => 'required',
            ],
            [
                'team_name.required' => 'nama is required',
                'team_name.exists' => 'Team not found',
                'password.required' => 'Password is required',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        $team = Team::where('nama', $creds['team_name'])->first();
        $cekJadwal = $this->cekJadwal($team);
        if ($cekJadwal instanceof \Illuminate\Http\JsonResponse) {
            return $cekJadwal;
        }
        if (!$team) {
            return $this->error('You are not a participant of IRGL 2024!', HttpResponseCode::HTTP_UNAUTHORIZED);
        }
        if (!Hash::check($creds['password'], $team->password)) {
            return $this->error('Invalid credentials', HttpResponseCode::HTTP_UNAUTHORIZED);
        }
        return $this->success([
            'id' => $team->id,
            'team_name' => $team->nama,
        ]);
    }
    public function getTeamById($id_kelompok)
    {
        $team = Team::where('id', $id_kelompok)->first();

        if ($team) {
            return response()->json($team);
        } else {
            return response()->json(['error' => 'Team not found'], 404);
        }
    }
    public function getUserDataByGamePass(Request $request)
    {
        $creds = $request->only('username', 'game_id');
        $validate = Validator::make(
            $creds,
            [
                'username' => 'required',
                'game_id' => 'required|exists:elim_games,id',
            ],
            [
                'username.required' => 'username is required',
                'game_id.required' => 'game_id is required',
                'game_id.exists' => 'game_id not found',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        $team = Team::where('game_pass', $creds['username'])->first();
        // dd($team);
        if (!$team) {
            return $this->error('No data found for the provided username and game_id', HttpResponseCode::HTTP_FORBIDDEN);
        }
        if ($team->jadwal == null) {
            return $this->error('Jadwal belum diatur', HttpResponseCode::HTTP_NOT_ACCEPTABLE);
        }
        $sekarang = Carbon::now();
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $team->jadwal->tanggal . ' ' . $team->jadwal->start_time);
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $team->jadwal->tanggal . ' ' . $team->jadwal->end_time);
        if (!$sekarang->between($startDateTime, $endDateTime)) {
            return $this->error('Jadwal tidak sesuai', HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        $result = Team::where('game_pass', $creds['username'])
            ->where('game_id_allowed_play', $creds['game_id'])
            ->first();
        // dd($result);
        if (!$result) {
            return $this->error('No data found for the provided username and game_id', HttpResponseCode::HTTP_FORBIDDEN);
        } else {
            return $this->success([
                'id' => $result->id,
                'username' => $result->nama,
            ]);
        }
    }

    public function uploadScoreWin(Request $request)
    {
        $creds = $request->only('team_id', 'game_id', 'score');
        $validate = Validator::make(
            $creds,
            [
                'team_id' => 'required|exists:teams,id',
                'game_id' => 'required|exists:elim_games,id',
                'score' => 'required|int',
            ],
            [
                'team_id.required' => 'team_id is required',
                'game_id.required' => 'game_id is required',
                'team_id.exists' => 'team_id not found',
                'game_id.exists' => 'game_id not found',
                'score.required' => 'score is required',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        $team = Team::find($creds['team_id']);
        $statistic = ElimStatistics::where('id_team', $creds['team_id'])->first();
        // dd($team);
        try {
            $team->games()->attach($creds['game_id'], ['score' => $creds['score']]);
            $team->update([
                'curr_streak' => $team->curr_streak + 1,
                'can_spin_roulette' => 1,
                'game_id_allowed_play' => null,
                'game_pass' => null,
            ]);
            if ($team->curr_streak > $statistic->highest_streak) {
                if ($statistic) {
                    $statistic->update([
                        'highest_streak' => max($statistic->highest_streak, $team->curr_streak),
                        'total_score' => $statistic->total_score + $creds['score'],
                        'total_game_finished' => $statistic->total_game_finished + 1,
                    ]);
                } else {
                    return $this->error('Team tidak ada di statistic', HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
                }
            } else {
                if ($statistic) {
                    $statistic->update([
                        'total_score' => $statistic->total_score + $creds['score'],
                        'total_game_finished' => $statistic->total_game_finished + 1,
                    ]);
                } else {
                    return $this->error('Team tidak ada di statistic', HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
                }
            }
        } catch (\Exception $e) {
            return $this->error('SQL errror', HttpResponseCode::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->success([
            'team_id' => $creds['team_id'],
            'game_id' => $creds['game_id'],
            'score' => $creds['score'],
        ]);
    }
    public function uploadScoreLose(Request $request)
    {
        $creds = $request->only('team_id', 'game_id', 'score');
        $validate = Validator::make(
            $creds,
            [
                'team_id' => 'required|exists:teams,id',
                'game_id' => 'required|exists:elim_games,id',
                'score' => 'required|int',
            ],
            [
                'team_id.required' => 'team_id is required',
                'game_id.required' => 'game_id is required',
                'team_id.exists' => 'team_id not found',
                'game_id.exists' => 'game_id not found',
                'score.required' => 'score is required',
                'time.required' => 'time is required',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        $team = Team::find($creds['team_id']);
        $statistic = ElimStatistics::where('id_team', $creds['team_id'])->first();
        try {
            $team->games()->attach($creds['game_id'], ['score' => $creds['score']]);

            $team->update([
                'curr_streak' => 0,
                'can_spin_roulette' => 1,
                'game_id_allowed_play' => null,
                'game_pass' => null,
            ]);
            if ($statistic) {
                $statistic->update([
                    'total_score' => $statistic->total_score + $creds['score'],
                    'total_game_finished' => $statistic->total_game_finished + 1,
                ]);
            } else {
                return $this->error('Team tidak ada di statistic', HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
            }
        } catch (\Exception $e) {
            return $this->error('SQL errror', HttpResponseCode::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->success([
            'team_id' => $creds['team_id'],
            'game_id' => $creds['game_id'],
            'score' => $creds['score'],
        ]);
    }

    public function getUserStreak(Request $request)
    {
        $creds = $request->only('team_id');
        $validate = Validator::make(
            $creds,
            [
                'team_id' => 'required|exists:teams,id',
            ],
            [
                'team_id.required' => 'team_id is required',
                'team_id.exists' => 'team_id not found',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        $team = Team::find($creds['team_id']);
        $cekJadwal = $this->cekJadwal($team);
        if ($cekJadwal instanceof \Illuminate\Http\JsonResponse) {
            return $cekJadwal;
        }
        return $this->success([
            'curr_streak' => $team->curr_streak,
            'can_spin_roulette' => $team->can_spin_roulette,
            'game_id_allowed_play' => $team->game_id_allowed_play,
            'game_pass' => $team->game_pass,
        ]);
    }

    public function getUserGrandPrizeStreak(Request $request)
    {
        $creds = $request->only('team_id');
        $validate = Validator::make(
            $creds,
            [
                'team_id' => 'required|exists:teams,id',
            ],
            [
                'team_id.required' => 'team_id is required',
                'team_id.exists' => 'team_id not found',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        $team = Team::find($creds['team_id']);
        return $this->success(['curr_gp_streak' => $team->curr_gp_streak]);
    }

    public function updateResultOfRoulette(Request $request)
    {
        $creds = $request->only('team_name', 'password', 'game_id_allowed_play');
        $validate = Validator::make(
            $creds,
            [
                'team_name' => 'required|exists:teams,nama',
                'password' => 'required',
                'game_id_allowed_play' => 'required|exists:elim_games,id',
            ],
            [
                'team_name.required' => 'team_name is required',
                'password.required' => 'Password is required',
                'game_id_allowed_play.required' => 'game_id_allowed_play is required',
                'game_id_allowed_play.exists' => 'game_id_allowed_play not found',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        $team = Team::where('nama', $creds['team_name'])->first();
        $totalgames = ElimGames::count();
        $alreadyPlayed = ElimGamesHistory::where('team_id', $team->id)
            ->where('rotation', $team->curr_game_rotation)
            ->count();
        if (!Hash::check($creds['password'], $team->password)) {
            return $this->error('Invalid credentials', HttpResponseCode::HTTP_UNAUTHORIZED);
        }
        $gamepass = Str::random(50);
        try {
            ElimGamesHistory::create([
                'game_id' => $creds['game_id_allowed_play'],
                'team_id' => $team->id,
                'rotation' => $team->curr_game_rotation,
            ]);
            if ($alreadyPlayed == $totalgames) {
                $team->update([
                    'can_spin_roulette' => 0,
                    'game_id_allowed_play' => $creds['game_id_allowed_play'],
                    'game_pass' => $gamepass,
                    'curr_game_rotation' => $team->curr_game_rotation + 1,
                ]);
            } else {
                $team->update([
                    'can_spin_roulette' => 0,
                    'game_id_allowed_play' => $creds['game_id_allowed_play'],
                    'game_pass' => $gamepass,
                ]);
            }
        } catch (\Exception $e) {
            return $this->error('SQL errror', HttpResponseCode::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->success([
            'game_id_allowed_play' => $creds['game_id_allowed_play'],
            'gamepass' => $gamepass,
        ]);
    }

    public function getGameLinkById(Request $request)
    {
        $creds = $request->only('game_id');
        $validate = Validator::make(
            $creds,
            [
                'game_id' => 'required|exists:elim_games,id',
            ],
            [
                'game_id.required' => 'game_id is required',
                'game_id.exists' => 'game_id not found',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        $game = ElimGames::find($creds['game_id']);
        return $this->success(['game_name' => $game->game_name, 'game_link' => $game->game_link]);
    }

    public function getGameByRoulette(Request $request)
    {
        $creds = $request->only('team_id');
        $validate = Validator::make(
            $creds,
            [
                'team_id' => 'required|exists:teams,id',
            ],
            [
                'team_id.required' => 'team_id is required',
                'team_id.exists' => 'team_id not found',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        $team = Team::find($creds['team_id']);
        $playedGameIds = ElimGamesHistory::where('team_id', $creds['team_id'])
            ->where('rotation', $team->curr_game_rotation)
            ->pluck('game_id')
            ->toArray();

        $availableGames = ElimGames::whereNotIn('id', $playedGameIds)->get();
        if ($availableGames->isEmpty()) {
            return $this->error('No available games left for the current rotation', HttpResponseCode::HTTP_NOT_FOUND);
        }
        return $this->success($availableGames);
    }

    function getQuestion(Request $request)
    {
        $creds = $request->only('team_id');
        $validate = Validator::make(
            $creds,
            [
                'team_id' => 'required|exists:teams,id',
            ],
            [
                'team_id.required' => 'team_id is required',
                'team_id.exists' => 'team_id not found',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        $team = Team::find($creds['team_id']);
        if (!is_null($team->curr_question_id)) {
            $question = ElimQuestions::where('id', $team->curr_question_id)->first();
            if ($question) {
                return $this->success([
                    'question_id' => $question->id,
                    'question' => $question->question,
                    'choice_1' => $question->choice_1,
                    'choice_2' => $question->choice_2,
                    'choice_3' => $question->choice_3,
                    'choice_4' => $question->choice_4
                ]);
            }
        }
        $cekJadwal = $this->cekJadwal($team);
        if ($cekJadwal instanceof \Illuminate\Http\JsonResponse) {
            return $cekJadwal;
        }


        $teamQuestionHistory = ElimQuestionHistory::where('id_team', $creds['team_id'])
            ->pluck('id_question')
            ->toArray();
        $questionsAvailforTeam = ElimQuestions::whereNotIn('id', $teamQuestionHistory)->pluck('id')->toArray();

        if (empty($questionsAvailforTeam)) {
            ElimQuestionHistory::where('id_team', $creds['team_id'])->delete();
            $teamQuestionHistory = ElimQuestionHistory::where('id_team', $creds['team_id'])
            ->pluck('id_question')
            ->toArray();
            $questionsAvailforTeam = ElimQuestions::whereNotIn('id', $teamQuestionHistory)->pluck('id')->toArray();
            if (empty($questionsAvailforTeam)) {
                return $this->error('No available Question left for the current session', HttpResponseCode::HTTP_NOT_FOUND);
            }
        }
        $randomIndex = array_rand($questionsAvailforTeam);
        $randomQuestionId = $questionsAvailforTeam[$randomIndex];
        $question = ElimQuestions::where('id', $randomQuestionId)->first();
        $team->update([
            'curr_question_id' => $question->id,
        ]);
        return $this->success(['question_id' => $question->id, 'question' => $question->question, 'choice_1' => $question->choice_1, 'choice_2' => $question->choice_2, 'choice_3' => $question->choice_3, 'choice_4' => $question->choice_4]);
    }

    function uploadQuestion(Request $request)
    {
        $creds = $request->only('team_id', 'question_id', 'answer');
        $validate = Validator::make(
            $creds,
            [
                'team_id' => 'required|exists:teams,id',
                'question_id' => 'required|exists:elim_questions,id',
                'answer' => 'required',
            ],
            [
                'team_id.required' => 'team_id is required',
                'question_id.required' => 'question_id is required',
                'answer.required' => 'Answer is required',
                'question_id.exists' => 'question_id not found',
            ],
        );
        foreach ($validate->errors()->all() as $error) {
            return $this->error($error, HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $team = Team::find($creds['team_id']);
        $cekJadwal = $this->cekJadwal($team);
        if ($cekJadwal instanceof \Illuminate\Http\JsonResponse) {
            return $cekJadwal;
        }
        $team->update([
            'curr_question_id' => null,
        ]);
        $statistic = ElimStatistics::where('id_team', $creds['team_id'])->first();

        $answerBenardariQuestion = ElimQuestions::where('id', $creds['question_id'])
            ->pluck('answer')
            ->first();
        if ($creds['answer'] == $answerBenardariQuestion) {
            $team->increment('curr_gp_streak');
            if ($team->curr_gp_streak > $statistic->highest_gp_streak) {
                $statistic->update(['highest_gp_streak' => $team->curr_gp_streak]);
            }
            $addToElimQuestionhistory = ElimQuestionHistory::create([
                'id_team' => $creds['team_id'],
                'id_question' => $creds['question_id'],
            ]);
            $addToElimQuestionhistory->save();
            if ($team['curr_gp_streak'] === 3) {
                $statistic->update(['won_grand_prize' => true]);
                $statistic->update(['end_time' => now()]);
            }

            return $this->success([
                'message' => 'Answer is Correct',
                'nama' => $team->nama,
            ]);
        } else {
            $team->update([
                'curr_gp_streak' => 0,
                'curr_streak' => 0,
            ]);
            $addToElimQuestionhistory = ElimQuestionHistory::create([
                'id_team' => $creds['team_id'],
                'id_question' => $creds['question_id'],
            ]);
            $addToElimQuestionhistory->save();
            return $this->success([
                'message' => 'Answer is Incorrect',
                'nama' => $team->nama,
            ]);
        }
    }

    function getTeamsByName(Request $request)
    {
        $team_name = $request->team_name;
        $teams = Team::where('nama', 'like', '%' . $team_name . '%')->get();
        return $this->success([
            'teams' => $teams,
        ]);
    }
}
