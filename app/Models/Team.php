<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Team extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    use HasUuids;
    use HasApiTokens;
    protected $fillable = [
        'nama',
        'password',
        'link_bukti_tf',
        'asal_sekolah',
        'is_validated',
        'id_jadwal',
        'alasan_resched',
        'link_bukti_resched',
        'id_jadwal_resched',
        'resched_approval',
        'can_spin_roulette',
        'game_id_allowed_play',
        'game_pass',
        'curr_streak',
        'curr_gp_streak',
        'curr_game_rotation',
        'curr_question_id',
        'status',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_tim');
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
    public function jadwalResched()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal_resched');
    }

    public function games()
    {
        return $this->belongsToMany(ElimGames::class, 'elim_scores', 'id_team', 'id_game')->withPivot('score', 'time', 'created_at', 'updated_at');
    }
    public function history()
    {
        return $this->hasMany(ElimQuestionHistory::class);
    }
    public function historyGame()
    {
        return $this->hasMany(ElimGamesHistory::class);
    }
    public function reschedules()
    {
        return $this->hasMany(Reschedule::class, 'id_kelompok');
    }
    public function semiStatistic()
    {
        return $this->hasOne(SemiStatistic::class, 'id_team');
    }
    public function elimquestions()
    {
        return $this->belongsTo(ElimQuestions::class, 'curr_question_id');
    }

    public function finalStatistic()
    {
        return $this->hasOne(FinalStatistic::class, 'team_id');
    }
    public function finalQuestions()
    {
        return $this->belongsToMany(FinalQuestion::class, 'final_answers', 'team_id', 'question_id');
    }
    public function unansweredFinalQuestion()
    {
        $team_id = $this->id;
        $questions = FinalQuestion::leftJoin('final_answers', function ($join) use ($team_id) {
            $join->on('final_questions.id', '=', 'final_answers.question_id')
                ->where('final_answers.team_id', '=', $team_id);
        })
            ->where(function ($query) {
                $query->where('final_answers.is_correct', '!=', 1)
                    ->orWhereNull('final_answers.id');
            })
            ->select('final_questions.*')
            ->get();

        return $questions;
    }
}
