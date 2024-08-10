<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showStepOne() {
        return view('registration.registration-step-one');
    }

    public function postStepOne(Request $request) {
        $validatedData = $request->validate([
            'namaKetua' => 'required',
            'bankKetua' => 'required',
            'noRekeningKetuaTim' => 'required',
            'tanggalLahirKetua' => 'required|date',
            'tempatLahirKetua' => 'required',
            'alamatKetua' => 'required',
            'kodePosKetua' => 'required|numeric',
            'phoneKetua' => 'required',
            'idlineKetua' => 'required',
            'fileKetua' => 'required|image|max:8192', // Max 8MB
        ]);
        $validatedData['namaKetua'] = ucwords(strtolower($validatedData['namaKetua'])); // Pascal Case

        // Store the uploaded file temporarily
        if ($request->hasFile('fileKetua')) {
            $path = $request->file('fileKetua')->store('tmp', 'local');
            $validatedData['fileKetua'] = $path; // Save the path instead of the file instance
        }

        $request->session()->put('step1', $validatedData);

        return redirect()->route('register.show.step.two');
    }

    public function showStepTwo() {
        return view('registration.registration-step-two');
    }

    public function postStepTwo(Request $request) {
        $validatedData = $request->validate([
            'namaAnggota1' => 'required',
            'tanggalLahirAnggota1' => 'required|date',
            'tempatLahirAnggota1' => 'required',
            'alamatAnggota1' => 'required',
            'kodePosAnggota1' => 'required|numeric',
            'phoneAnggota1' => 'required',
            'idlineAnggota1' => 'required',
            'fileAnggota1' => 'required|image|max:8192', // Max 8MB
        ]);
        $validatedData['namaAnggota1'] = ucwords(strtolower($validatedData['namaAnggota1'])); // Pascal Case

        $request->session()->put('step2', $validatedData);

        return redirect()->route('register.show.step.three');
    }

    public function showStepThree() {
        return view('registration.registration-step-three');
    }

    public function postStepThree(Request $request) {
        $validatedData = $request->validate([
            'namaAnggota2' => 'required',
            'tanggalLahirAnggota2' => 'required|date',
            'tempatLahirAnggota2' => 'required',
            'alamatAnggota2' => 'required',
            'kodePosAnggota2' => 'required|numeric',
            'phoneAnggota2' => 'required',
            'idlineAnggota2' => 'required',
            'fileAnggota2' => 'required|image|max:8192', // Max 8MB
        ]);
        $validatedData['namaAnggota2'] = ucwords(strtolower($validatedData['namaAnggota2'])); // Pascal Case

        $request->session()->put('step3', $validatedData);

        return redirect()->route('register.show.step.four');
    }

    public function showStepFour() {
        return view('registration.registration-step-four');
    }

    public function postStepFour(Request $request) {
        $validatedData = $request->validate([
            'fileTeam' => 'required|image|max:8192', // Max 8MB
            'namaTeam' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $validatedData['namaTeam'] = strtoupper(strtolower($validatedData['namaTeam'])); // UPPER CASE


        $request->session()->put('step4', $validatedData);

        return redirect()->route('register.complete');
    }

    public function completeRegistration(Request $request) {
        $step1 = $request->session()->get('step1');
        $step2 = $request->session()->get('step2');
        $step3 = $request->session()->get('step3');
        $step4 = $request->session()->get('step4');

        // Check if team name already exists
        if (Team::where('nama', $step4->namaTeam)->exists()) {
            session()->flash('message', 'Team name already exists. Please choose another name.');
            return;
        }

        // Store uploaded files
        $fileKetuaName = $step1->fileKetua->store('public/uploads');
        $fileAnggota1Name = $step2->fileAnggota1->store('public/uploads');
        $fileAnggota2Name = $step3->fileAnggota2->store('public/uploads');
        $fileTeamName = $step4->fileTeam->store('public/uploads');

        // Insert team into Teams database
        $newTeam = Team::create([
            'nama' => $step4->namaTeam,
            'password' => Hash::make($step4->password),
            'link_bukti_tf' => $fileTeamName,
            'is_validated' => false
        ]);

        // Retrieve the ID of the newly inserted team
        $team_id = $newTeam->id;

        // Insert ketua into Users database
        User::create([
            'nama' => $step1->namaKetua,
            'tanggal_lahir' => $step1->tanggalLahirKetua,
            'tempat_lahir' => $step1->tempatLahirKetua,
            'alamat' => $step1->alamatKetua,
            'kode_pos' => $step1->kodePosKetua,
            'no_telp' => $step1->phoneKetua,
            'id_line' => $step1->idlineKetua,
            'link_foto' => $fileKetuaName,
            'is_ketua' => true,
            'bank' => $step1->bankKetua,
            'no_rek' => $step1->noRekeningKetuaTim,
            'id_tim' => $team_id
        ]);

        // Insert anggota1 into Users database
        User::create([
            'nama' => $step2->namaAnggota1,
            'tanggal_lahir' => $step2->tanggalLahirAnggota1,
            'tempat_lahir' => $step2->tempatLahirAnggota1,
            'alamat' => $step2->alamatAnggota1,
            'kode_pos' => $step2->kodePosAnggota1,
            'no_telp' => $step2->phoneAnggota1,
            'id_line' => $step2->idlineAnggota1,
            'link_foto' => $fileAnggota1Name,
            'is_ketua' => false,
            'id_tim' => $team_id
        ]);

        // Insert anggota2 into Users database
        User::create([
            'nama' => $step3->namaAnggota2,
            'tanggal_lahir' => $step3->tanggalLahirAnggota2,
            'tempat_lahir' => $step3->tempatLahirAnggota2,
            'alamat' => $step3->alamatAnggota2,
            'kode_pos' => $step3->kodePosAnggota2,
            'no_telp' => $step3->phoneAnggota2,
            'id_line' => $step3->idlineAnggota2,
            'link_foto' => $fileAnggota2Name,
            'is_ketua' => false,
            'id_tim' => $team_id
        ]);

        session()->flash('message', 'Team registered successfully!');

        $request->session()->forget(['step1', 'step2', 'step3', 'step4']);

        return redirect()->route('home')->with('success', 'Registration completed successfully!');
    }

}
