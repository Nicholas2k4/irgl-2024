<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Reschedule;
use App\Models\Team;
use Livewire\WithFileUploads;

class JadwalController extends Controller
{
    use WithFileUploads;

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

        if ($team->jadwalResched) {
            $team->resched_approval = 1;
            $team->id_jadwal = $team->id_jadwal_resched;
            $team->id_jadwal_resched = null;
            $team->save();
            return redirect()->back()->with('success', 'Reschedule request approved.');
        }

        return redirect()->back()->with('error', 'Reschedule request not found.');
    }

    public function reject($id)
    {
        $team = Team::findOrFail($id);

        if ($team->jadwalResched) {
            $team->resched_approval = 0;
            $team->id_jadwal_resched = null;
            $team->save();
            return redirect()->back()->with('success', 'Reschedule request rejected.');
        }

        return redirect()->back()->with('error', 'Reschedule request not found.');
    }
    public function rescheduleLog()
    {
        $reschedules = Reschedule::with(['jadwalAwal', 'jadwalResched'])->get();
        return response()->json($reschedules);
    }
}
