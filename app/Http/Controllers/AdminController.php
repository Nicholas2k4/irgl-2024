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
use App\Utils\HttpResponseCode;

class AdminController extends Controller
{
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

        $statWithJadwal = ElimStatistics::with(['team.jadwal','team'])
        ->whereNotNull('end_time')
        ->get()
        ->map(function ($elim_stat) {

            $done = '<?xml version="1.0" encoding="utf-8"?><svg class="w-6 p-[2px]" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 122.88" style="enable-background:new 0 0 122.88 122.88" xml:space="preserve"><style type="text/css"><![CDATA[
                .st0{fill-rule:evenodd;clip-rule:evenodd;fill:#3AAF3C;}
            ]]></style><g><path class="st0" d="M61.44,0c33.93,0,61.44,27.51,61.44,61.44c0,33.93-27.51,61.44-61.44,61.44C27.51,122.88,0,95.37,0,61.44 C0,27.51,27.51,0,61.44,0L61.44,0L61.44,0z M39.48,56.79c4.6,2.65,7.59,4.85,11.16,8.78c9.24-14.88,19.28-23.12,32.32-34.83 l1.28-0.49h14.28C79.38,51.51,64.53,69.04,51.24,94.68c-6.92-14.79-13.09-25-26.88-34.47L39.48,56.79L39.48,56.79z"/></g></svg>';
            $notYet = `<?xml version="1.0" encoding="utf-8"?><svg class="p-[2px]" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.879 122.879" enable-background="new 0 0 122.879 122.879" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" fill="#FF4141" d="M61.44,0c33.933,0,61.439,27.507,61.439,61.439 s-27.506,61.439-61.439,61.439C27.507,122.879,0,95.372,0,61.439S27.507,0,61.44,0L61.44,0z M73.451,39.151 c2.75-2.793,7.221-2.805,9.986-0.027c2.764,2.776,2.775,7.292,0.027,10.083L71.4,61.445l12.076,12.249 c2.729,2.77,2.689,7.257-0.08,10.022c-2.773,2.765-7.23,2.758-9.955-0.013L61.446,71.54L49.428,83.728 c-2.75,2.793-7.22,2.805-9.986,0.027c-2.763-2.776-2.776-7.293-0.027-10.084L51.48,61.434L39.403,49.185 c-2.728-2.769-2.689-7.256,0.082-10.022c2.772-2.765,7.229-2.758,9.953,0.013l11.997,12.165L73.451,39.151L73.451,39.151z"/></g></svg>`;

            $sekarang = Carbon::now();
                $end_time = Carbon::parse($elim_stat->end_time); //2024-03-21 17:00:12

                $tanggal = Carbon::parse($elim_stat->team->jadwal->tanggal);
                $start_time = Carbon::parse($elim_stat->team->jadwal->start_time)
                    ->setDate($tanggal->year, $tanggal->month, $tanggal->day);
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $elim_stat->team->jadwal->tanggal . ' ' . $elim_stat->team->jadwal->end_time);
                $interval = $start_time->diff($end_time);
                $elim_stat->time_taken = sprintf(
                    '%02d:%02d:%02d.%02d',
                    $interval->h,
                    $interval->i,
                    $interval->s,
                    floor($interval->f * 100) // ms
                );
                if ($endDateTime < $sekarang) {
                    // jika Jadwal->end_time lebih kecil dari sekarang maka jadwal telah berlalu, kembalikan SVG
                    $elim_stat->sudah_main = $done;
                } else {
                    $elim_stat->sudah_main = $notYet;
                }

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
            ->map(function ($elim_stat) {
                $done = '<?xml version="1.0" encoding="utf-8"?><svg class="w-6 p-[2px]" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 122.88" style="enable-background:new 0 0 122.88 122.88" xml:space="preserve"><style type="text/css"><![CDATA[
                    .st0{fill-rule:evenodd;clip-rule:evenodd;fill:#3AAF3C;}
                ]]></style><g><path class="st0" d="M61.44,0c33.93,0,61.44,27.51,61.44,61.44c0,33.93-27.51,61.44-61.44,61.44C27.51,122.88,0,95.37,0,61.44 C0,27.51,27.51,0,61.44,0L61.44,0L61.44,0z M39.48,56.79c4.6,2.65,7.59,4.85,11.16,8.78c9.24-14.88,19.28-23.12,32.32-34.83 l1.28-0.49h14.28C79.38,51.51,64.53,69.04,51.24,94.68c-6.92-14.79-13.09-25-26.88-34.47L39.48,56.79L39.48,56.79z"/></g></svg>';
                $notYet = '<?xml version="1.0" encoding="utf-8"?><svg class="w-6 p-[2px]" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.879 122.879" enable-background="new 0 0 122.879 122.879" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" fill="#FF4141" d="M61.44,0c33.933,0,61.439,27.507,61.439,61.439 s-27.506,61.439-61.439,61.439C27.507,122.879,0,95.372,0,61.439S27.507,0,61.44,0L61.44,0z M73.451,39.151 c2.75-2.793,7.221-2.805,9.986-0.027c2.764,2.776,2.775,7.292,0.027,10.083L71.4,61.445l12.076,12.249 c2.729,2.77,2.689,7.257-0.08,10.022c-2.773,2.765-7.23,2.758-9.955-0.013L61.446,71.54L49.428,83.728 c-2.75,2.793-7.22,2.805-9.986,0.027c-2.763-2.776-2.776-7.293-0.027-10.084L51.48,61.434L39.403,49.185 c-2.728-2.769-2.689-7.256,0.082-10.022c2.772-2.765,7.229-2.758,9.953,0.013l11.997,12.165L73.451,39.151L73.451,39.151z"/></g></svg>';

                if ($elim_stat->team->id_jadwal == null) {
                    $elim_stat->sudah_main = 'Belum isi Jadwal';
                    return $elim_stat;
                }
                $sekarang = Carbon::now();
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $elim_stat->team->jadwal->tanggal . ' ' . $elim_stat->team->jadwal->end_time);

                if ($endDateTime < $sekarang) {
                    // Jika Jadwal->end_time lebih kecil dari sekarang, artinya sudah main
                    $elim_stat->sudah_main = $done;
                } else {
                    // dd($elim_stat);
                    $elim_stat->sudah_main = $notYet;
                }

                return $elim_stat;
            })
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

        return view('admin.scoringSystem', [
            'leaderboards' => $leaderboards,
            'title' => 'Leaderboards'
        ]);
    }

    public function playerSemi(){
        $teams = Team::where('status', '>=', 1)->get();
        return view('admin.semiPlayer', [
            'teams' => $teams,
            'title' => 'Semi Player',
        ]);
    }
}
