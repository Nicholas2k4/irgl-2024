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
        'is_validated',
        'id_jadwal',
        'alasan_resched',
        'link_bukti_resched',
        'can_spin_roulette',
        'game_id_allowed_play',
        'game_pass',
        'curr_streak',
        'curr_gp_streak',
        'curr_game_rotation'

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

    public function games()
    {
        return $this->belongsToMany(ElimGames::class,'elim_scores','id_team','id_game')->withPivot('score','time','created_at','updated_at');
    }
    public function history()
    {
        return $this->hasMany(ElimQuestionHistory::class);
    }
    public function historyGame()
    {
        return $this->hasMany(ElimGamesHistory::class);
    }
}
