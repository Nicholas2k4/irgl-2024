<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Google_Client;
use App\Models\Team;
use App\Models\User;
use App\Models\Admin;
use App\Models\Jadwal;
use Google_Service_Oauth2;
use App\Models\ElimStatistics;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreadminRequest;
use App\Http\Requests\UpdateadminRequest;

class AdminController extends Controller
{
    public function main()
    {
        $data['username'] = session('name');
        $data['email'] = session('email');
        $data['nrp'] = session('nrp');
        $data['division_name'] = session('division_name');
        $data['title'] = 'Homepage';
        return view('admin.main', $data);
    }

    public function rekapTeam()
    {
        $teams = Team::with('user')->get();
        $users = User::with('team')->get();
        $title = 'Teams';
        return view('admin.rekapTeam', compact('teams', 'users', 'title'));
    }
    public function validasiBuktiTransfer($id)
    {
        $team = Team::find($id);
        if ($team) {
            $team->is_validated = true;
            $team->save();
            Log::channel('daily')->info(session('name') . ' has validated payment of team "' . $team->nama . '"');
            return redirect()->back()->with(['success' => 'Bukti transfer kelompok berhasil divalidasi']);
        }

        return redirect()->back()->with(['error' => 'Kelompok tidak ditemukan']);
    }

    public function leaderboards()
    {
        $statWithJadwal = ElimStatistics::with(['team.jadwal'])
            ->whereNotNull('end_time')
            ->get()
            ->map(function ($elim_stat) {
                $end_time = Carbon::parse($elim_stat->end_time); //2024-03-21 17:00:12

                $tanggal = Carbon::parse($elim_stat->team->jadwal->tanggal);
                $start_time = Carbon::parse($elim_stat->team->jadwal->start_time)
                    ->setDate($tanggal->year, $tanggal->month, $tanggal->day);

                $interval = $start_time->diff($end_time);
                $elim_stat->time_taken = sprintf(
                    '%02d %02d:%02d:%02d.%02d',
                    $interval->d, //ini nanti dimatikan, INGET
                    $interval->h,
                    $interval->i,
                    $interval->s,
                    floor($interval->f * 100) // ms
                );
                $elim_stat->time_taken_microseconds = $start_time->diffInMilliseconds($end_time);
                return $elim_stat;
            })
            ->sort(function ($a, $b) {
                if ($a->time_taken_microseconds == $b->time_taken_microseconds) {
                    if ($a->highest_gp_streak == $b->highest_gp_streak) {
                        if ($a->highest_streak == $b->highest_streak) {
                            if ($a->total_score == $b->total_score) {
                                return $b->total_game_finished - $a->total_game_finished;
                            }
                            return $b->total_score - $a->total_score;
                        }
                        return $b->highest_streak - $a->highest_streak;
                    }
                    return $b->highest_gp_streak - $a->highest_gp_streak;
                }
                return $a->time_taken_microseconds - $b->time_taken_microseconds;
            });

        $statBawah = ElimStatistics::with(['team.jadwal'])
            ->whereNull('end_time')
            ->get()
            ->sort(function ($a, $b) {
                if ($a->highest_gp_streak == $b->highest_gp_streak) {
                    if ($a->highest_streak == $b->highest_streak) {
                        if ($a->total_score == $b->total_score) {
                            return $b->total_game_finished - $a->total_game_finished;
                        }
                        return $b->total_score - $a->total_score;
                    }
                    return $b->highest_streak - $a->highest_streak;
                }
                return $b->highest_gp_streak - $a->highest_gp_streak;
            });

        $leaderboards = $statWithJadwal->concat($statBawah);
        // dd($statBawah);
        return view('admin.scoringSystem', [
            'leaderboards' => $leaderboards,
            'title' => 'Leaderboards'
        ]);
    }
}
