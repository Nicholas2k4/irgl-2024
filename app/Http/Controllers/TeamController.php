<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Admin;
use Firebase\JWT\JWT;
use App\Models\ElimGames;
use App\Utils\HttpResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ElimStatistics;
use App\Utils\HttpResponseCode;
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
        // dd($team);
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
        $result = Team::where('game_pass', $creds['username'])->where('game_id_allowed_play', $creds['game_id'])->first();
        // dd($result);
        if (!$result) {
            return $this->error('No data found for the provided username and game_id', HttpResponseCode::HTTP_FORBIDDEN);
        }
        else{
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
        return $this->success(['curr_streak' => $team->curr_streak, 'can_spin_roulette' => $team->can_spin_roulette]);
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
        if (!$team) {
            return $this->error('You are not a participant of IRGL 2024!', HttpResponseCode::HTTP_UNAUTHORIZED);
        }
        if (!Hash::check($creds['password'], $team->password)) {
            return $this->error('Invalid credentials', HttpResponseCode::HTTP_UNAUTHORIZED);
        }
        $gamepass = Str::random(50);
        try {
            $team->update([
                'can_spin_roulette' => 0,
                'game_id_allowed_play' => $creds['game_id_allowed_play'],
                'game_pass' => $gamepass,
            ]);
        } catch (\Exception $e) {
            return $this->error('SQL errror', HttpResponseCode::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->success([
            'game_id_allowed_play' => $creds['game_id_allowed_play'],
            'gamepass' => $gamepass
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
}
