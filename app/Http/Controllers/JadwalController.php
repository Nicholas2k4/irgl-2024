<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
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
        $currentJadwal = $team->jadwal;

        if (!$currentJadwal) {
            return redirect()->back()->with('error', 'Team belum memiliki jadwal.');
        }

        $newJadwal = Jadwal::findOrFail($request->jadwal);

        if ($newJadwal->teams()->count() >= 5) {
            return redirect()->back()->with('error', 'Jadwal sudah penuh.');
        }

        $team->id_jadwal = $newJadwal->id;
        $team->alasan_resched = $request->alasan;
        $team->link_bukti_resched = $request->file('bukti')->store('public/uploads');
        $team->save();

        return redirect()->intended('/jadwal')->with('success', 'Jadwal berhasil di-reschedule.');
    }
}
