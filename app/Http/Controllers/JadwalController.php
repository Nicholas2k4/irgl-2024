<?php

namespace App\Http\Controllers;

use App\Models\ElimGamesHistory;
use App\Models\ElimQuestionHistory;
use App\Models\ElimStatistics;
use App\Models\Team;
use App\Models\Jadwal;
use App\Models\Reschedule;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Utils\HttpResponseCode;
use App\Utils\HttpResponse;

class JadwalController extends Controller
{
    use WithFileUploads;
    use HttpResponse;

    // LOCAL PESERTA SIDE
    public function index()
    {
        if (auth()->check()) {
            $jadwal = Jadwal::select('jadwal.*')
                ->selectSub(function ($query) {
                    $query->selectRaw('COUNT(*)')
                        ->from('teams')
                        ->whereColumn('jadwal.id', 'teams.id_jadwal')
                        ->limit(5);
                }, 'teams_count')
                ->having('teams_count', '<', 5)
                ->get();
            return view('jadwal', compact('jadwal'));
        } else {
            return redirect()->route('login');
        }
    }

    // Untuk input jadwal awal
    public function store(Request $request)
    {
        $request->validate([
            'jadwal' => 'required|exists:jadwal,id',
        ]);

        $team = auth()->user();

        if ($team->jadwal) {
            return redirect()->back()->with('error', 'Team sudah memiliki jadwal.');
        }

        $jadwal = Jadwal::findOrFail($request->jadwal);

        if ($jadwal->teams()->count() >= 5) {
            return redirect()->back()->with('error', 'Jadwal sudah penuh.');
        }

        $team->id_jadwal = $jadwal->id;
        $team->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dipilih.');
    }

    // Khusus untuk resched
    public function reschedule(Request $request)
    {
        $request->validate([
            'jadwal' => 'required|exists:jadwal,id',
            'alasan' => 'required|string|max:255',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $team = auth()->user();
        if (!$team) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }
        $currentJadwal = $team->jadwal;

        if (!$currentJadwal) {
            return redirect()->back()->with('error', 'Team belum memiliki jadwal.');
        }

        $newJadwal = Jadwal::findOrFail($request->jadwal);

        if ($newJadwal->teams()->count() >= 5) {
            return redirect()->back()->with('error', 'Jadwal sudah penuh.');
        }

        $team->id_jadwal_resched = $newJadwal->id;
        $team->alasan_resched = $request->alasan;
        $team->link_bukti_resched = $request->file('bukti')->store('public/uploads');
        $team->resched_approval = 2;
        $team->save();

        return redirect()->intended('/jadwal')->with('successResched', 'Success. Reschedule is waiting for approval.');
    }

    // ADMIN SIDE
    public function main()
    {
        $jadwal = Jadwal::all();
        $teamResched = Team::with('jadwalResched')
            ->whereHas('jadwalResched')
            ->get();
        $title = 'Schedule';
        return view('admin.jadwal-crud.main', compact('jadwal', 'teamResched', 'title'));
    }
    public function delete(Request $r)
    {
        $jadwal = Jadwal::where('id', $r->id)->first();
        $temp_id = $jadwal->id;
        $jadwal->delete();

        return redirect()->route('admin.jadwal.main')
            ->with('success', "Jadwal with id: {$temp_id} deleted successfully.");
    }

    public function view(Request $r)
    {
        $jadwal = Jadwal::where('id', $r->id)->first();
        $title = 'Edit Schedule';
        return view('admin.jadwal-crud.view')
            ->with('jadwal', $jadwal)
            ->with('title', $title);
    }
    public function adminStore(Request $r)
    {

        if ($r->has('id')) {
            $jadwal = Jadwal::find($r->id);
        } else {
            $jadwal = new Jadwal;
        }

        $jadwal->tanggal = $r->tanggal;
        $jadwal->start_time = $r->start_time;
        $jadwal->end_time = $r->end_time;
        $jadwal->save();

        Log::channel('daily')->info(session('name') . ' has created new schedule on ' . $r->tanggal . ' from ' . $r->start_time . ' to ' . $r->end_time);

        return redirect()->route('admin.jadwal.main')->with('success', 'Jadwal saved successfully.');
    }

    public function input()
    {
        return view('admin.jadwal-crud.input', ['title' => 'Add Schedule']);
    }

    // Team Checker
    public function getTeams($jadwal_id)
    {
        $teams = Team::where('id_jadwal', $jadwal_id)->get();
        return response()->json($teams);
    }
    public function approve($id)
    {
        $team = Team::findOrFail($id);

        if ($team->jadwalResched) {
            $oldSchedId = $team->id_jadwal;

            $oldSched = Jadwal::findOrFail($oldSchedId);
            $newSched = Jadwal::findOrFail($team->id_jadwal_resched);

            $team->resched_approval = 1;
            $team->id_jadwal = $team->id_jadwal_resched;
            $team->save();

            \DB::table('reschedule')->insert([
                'id_kelompok' => $team->id,
                'id_jadwal_awal' => $oldSchedId,
                'id_jadwal_resched' => $team->id_jadwal_resched,
                'alasan' => $team->alasan_resched,
                'bukti' => $team->link_bukti_resched,
                'approval' => $team->resched_approval,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::channel('daily')->info(session('name') . ' has approved reschedule request for team "' . $team->nama . '" from ' . $oldSched->tanggal . ', ' . $oldSched->start_time . ' - ' . $oldSched->end_time . ' to ' . $newSched->tanggal . ', ' . $newSched->start_time . ' - ' . $newSched->end_time);

            return redirect()->back()->with('success', 'Reschedule request approved.');
        }

        return redirect()->back()->with('error', 'Reschedule request not found.');
    }

    public function reject($id)
    {
        $team = Team::findOrFail($id);

        if ($team->jadwalResched) {
            $team->resched_approval = 0;
            $team->save();

            $oldSched = Jadwal::findOrFail($team->id_jadwal);
            $newSched = Jadwal::findOrFail($team->id_jadwal_resched);

            \DB::table('reschedule')->insert([
                'id_kelompok' => $team->id,
                'id_jadwal_awal' => $team->id_jadwal,
                'id_jadwal_resched' => $team->id_jadwal_resched,
                'alasan' => $team->alasan_resched,
                'bukti' => $team->link_bukti_resched,
                'approval' => $team->resched_approval,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::channel('daily')->info(session('name') . ' has rejected reschedule request for team "' . $team->nama . '" from ' . $oldSched->tanggal . ', ' . $oldSched->start_time . ' - ' . $oldSched->end_time . ' to ' . $newSched->tanggal . ', ' . $newSched->start_time . ' - ' . $newSched->end_time);

            return redirect()->back()->with('success', 'Reschedule request rejected.');
        }

        return redirect()->back()->with('error', 'Reschedule request not found.');
    }
    public function rescheduleLog()
    {
        $reschedules = Reschedule::with(['jadwalAwal', 'jadwalResched'])->get();
        return response()->json($reschedules);
    }

    public function reset(){
        $teams = Team::get();
        $jadwal = Jadwal::select('jadwal.*')
        ->selectSub(function ($query) {
            $query->selectRaw('COUNT(*)')
                ->from('teams')
                ->whereColumn('jadwal.id', 'teams.id_jadwal')
                ->limit(5);
        }, 'teams_count')
        ->having('teams_count', '<', 5)
        ->get();
        $data = [
            'title' => 'Reset Password',
            'teams' => $teams,
            'jadwal' => $jadwal
        ];
        return view('admin.reset', $data);
    }
    public function resetPost(Request $request){
        // dd($request->all());
        $team = Team::find($request->team_id);
        if(!$team){
            return response()->json(['message' => 'Team not found'], 404);
        }
        $team->update([
            'can_spin_roulette' => 1,
            'game_id_allowed_play' => null,
            'game_pass' => null,
        ]);
        Log::channel('daily')->info(session('name') . ' has reset game for team "' . $team->nama . '"');
        return response()->json(['message' => 'Reset Game success', 'success' => true], 200);
    }

    public function resetSchedule(Request $request){
        $team = Team::find($request->team_id);
        $jadwal = Jadwal::find($request->jadwal_id);
        if(!$team || !$jadwal){
            return response()->json(['message' => 'Not found'], 404);
        }
        DB::beginTransaction();
        try {
            $team->games()->detach();
            ElimGamesHistory::where('team_id', $team->id)->delete();
            ElimQuestionHistory::where('id_team', $team->id)->delete();
            ElimStatistics::where('id_team', $team->id)->update([
                'end_time' => null,
                'won_grand_prize' => 0,
                'highest_gp_streak' => 0,
                'highest_streak' => 0,
                'total_score' => 0,
                'total_game_finished' => 0,
            ]);
            $team->update([
                'can_spin_roulette' => 1,
                'game_id_allowed_play' => null,
                'game_pass' => null,
                'curr_streak' => 0,
                'curr_gp_streak' => 0,
                'curr_game_rotation' => 0,
                'curr_question_id' => null,
                'id_jadwal'=>$jadwal->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to reset schedule'], 500);
        }
        Log::channel('daily')->info(session('name') . ' has reset schedule for team "' . $team->nama . '" from ' . $jadwal->tanggal . ', ' . $jadwal->start_time . ' - ' . $jadwal->end_time);
        return response()->json(['message' => 'Reset Game success', 'success' => true], 200);
    }
}
