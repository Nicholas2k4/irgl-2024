<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\ElimStatistics;
use App\Models\SemiStatistic;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function showStepOne()
    {
        return view('registration.registration-step-one');
    }

    public function postStepOne(Request $request)
    {
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
            'fileKetua' => 'nullable|image|max:8192', // Max 8MB
        ]);
        $validatedData['namaKetua'] = ucwords(strtolower($validatedData['namaKetua'])); // Pascal Case

        // Store the uploaded file temporarily
        if ($request->hasFile('fileKetua')) {
            $file = $request->file('fileKetua');
            // Generate a custom file name
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $customFileName = 'fileKetua_' . $originalName . '.' . $extension;

            // Store the file with the custom name in the 'tmp' directory
            $path = $file->storeAs('tmp', $customFileName, 'local');

            // Save the path instead of the file instance
            $validatedData['fileKetua'] = $path;
        } elseif ($request->session()->has('step1.fileKetua')) {
            // Keep existing file if not re-uploaded
            $validatedData['fileKetua'] = $request->session()->get('step1.fileKetua');
        } else {
            session()->put('step1', $request->except('fileKetua'));

            session()->flash('message', 'Please upload the required file.');
            return redirect()->route('register.show.step.one');
        }

        $request->session()->put('step1', $validatedData);

        return redirect()->route('register.show.step.two');
    }

    public function showStepTwo()
    {
        if (!session()->has('step1')) {
            return redirect()->route('register.show.step.one')->withErrors('Cannot access this yet.');
        }
        return view('registration.registration-step-two');
    }

    public function postStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'namaAnggota1' => 'required',
            'tanggalLahirAnggota1' => 'required|date',
            'tempatLahirAnggota1' => 'required',
            'alamatAnggota1' => 'required',
            'kodePosAnggota1' => 'required|numeric',
            'phoneAnggota1' => 'required',
            'idlineAnggota1' => 'required',
            'fileAnggota1' => 'nullable|image|max:8192', // Max 8MB
        ]);
        $validatedData['namaAnggota1'] = ucwords(strtolower($validatedData['namaAnggota1'])); // Pascal Case

        // Store the uploaded file temporarily
        if ($request->hasFile('fileAnggota1')) {
            $file = $request->file('fileAnggota1');
            // Generate a custom file name
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $customFileName = 'fileAnggota1_' . $originalName . '.' . $extension;

            // Store the file with the custom name in the 'tmp' directory
            $path = $file->storeAs('tmp', $customFileName, 'local');

            // Save the path instead of the file instance
            $validatedData['fileAnggota1'] = $path;
        } elseif ($request->session()->has('step2.fileAnggota1')) {
            // Keep existing file if not re-uploaded
            $validatedData['fileAnggota1'] = $request->session()->get('step2.fileAnggota1');
        } else {
            // Store the current input data in session
            session()->put('step2', $request->except('fileAnggota1'));

            session()->flash('message', 'Please upload the required file.');
            return redirect()->route('register.show.step.two');
        }

        $request->session()->put('step2', $validatedData);

        return redirect()->route('register.show.step.three');
    }

    public function showStepThree()
    {
        if (!session()->has('step2')) {
            return redirect()->route('register.show.step.two')->withErrors('Cannot access this yet.');
        }
        return view('registration.registration-step-three');
    }

    public function postStepThree(Request $request)
    {
        $validatedData = $request->validate([
            'namaAnggota2' => 'required',
            'tanggalLahirAnggota2' => 'required|date',
            'tempatLahirAnggota2' => 'required',
            'alamatAnggota2' => 'required',
            'kodePosAnggota2' => 'required|numeric',
            'phoneAnggota2' => 'required',
            'idlineAnggota2' => 'required',
            'fileAnggota2' => 'nullable|image|max:8192', // Max 8MB
        ]);
        $validatedData['namaAnggota2'] = ucwords(strtolower($validatedData['namaAnggota2'])); // Pascal Case

        // Store the uploaded file temporarily
        if ($request->hasFile('fileAnggota2')) {
            $file = $request->file('fileAnggota2');
            // Generate a custom file name
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $customFileName = 'fileAnggota2_' . $originalName . '.' . $extension;

            // Store the file with the custom name in the 'tmp' directory
            $path = $file->storeAs('tmp', $customFileName, 'local');

            // Save the path instead of the file instance
            $validatedData['fileAnggota2'] = $path;
        } elseif ($request->session()->has('step3.fileAnggota2')) {
            // Keep existing file if not re-uploaded
            $validatedData['fileAnggota2'] = $request->session()->get('step3.fileAnggota2');
        } else {
            session()->put('step3', $request->except('fileAnggota2'));

            session()->flash('message', 'Please upload the required file.');
            return redirect()->route('register.show.step.three');
        }

        $request->session()->put('step3', $validatedData);

        return redirect()->route('register.show.step.four');
    }

    public function showStepFour()
    {
        if (!session()->has('step3')) {
            return redirect()->route('register.show.step.three')->withErrors('Cannot access this yet.');
        }
        return view('registration.registration-step-four');
    }

    public function postStepFour(Request $request)
    {
        $validatedData = $request->validate([
            'fileTeam' => 'nullable|image|max:8192', // Max 8MB
            'namaTeam' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'password' => 'required|string|min:8|confirmed',
        ]);
        $validatedData['namaTeam'] = strtoupper($validatedData['namaTeam']); // UPPER CASE

        // Store the uploaded file temporarily
        if ($request->hasFile('fileTeam')) {
            $file = $request->file('fileTeam');
            // Generate a custom file name
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $customFileName = 'buktiTf_' . $originalName . '.' . $extension;

            // Store the file with the custom name in the 'tmp' directory
            $path = $file->storeAs('tmp', $customFileName, 'local');

            // Save the path instead of the file instance
            $validatedData['fileTeam'] = $path;
        } elseif ($request->session()->has('step4.fileTeam')) {
            // Keep existing file if not re-uploaded
            $validatedData['fileTeam'] = $request->session()->get('step4.fileTeam');
        } else {
            session()->put('step4', $request->except('fileTeam'));

            session()->flash('message', 'Please upload the required file.');
            return redirect()->route('register.show.step.four');
        }

        $request->session()->put('step4', $validatedData);

        return redirect()->route('register.complete');
    }

    public function completeRegistration(Request $request)
    {
        // Check if team name already exists
        if (Team::where('nama', session('step4.namaTeam'))->exists()) {
            session()->flash('message', 'Team name already exists. Please choose another name.');
            return redirect()->route('register.show.step.four');
        }

        // Store uploaded files
        $fileKetuaPath = $this->moveFileToPermanentStorage(session('step1.fileKetua'), 'public/uploads/' . session('step4.namaTeam'));
        $fileAnggota1Path = $this->moveFileToPermanentStorage(session('step2.fileAnggota1'), 'public/uploads/' . session('step4.namaTeam'));
        $fileAnggota2Path = $this->moveFileToPermanentStorage(session('step3.fileAnggota2'), 'public/uploads/' . session('step4.namaTeam'));
        $fileTeamPath = $this->moveFileToPermanentStorage(session('step4.fileTeam'), 'public/uploads/' . session('step4.namaTeam'));

        // Update session data with new file path
        session()->put('step1.fileKetua', $fileKetuaPath);
        session()->put('step2.fileAnggota1', $fileAnggota1Path);
        session()->put('step3.fileAnggota2', $fileAnggota2Path);
        session()->put('step4.fileTeam', $fileTeamPath);

        // Insert team into Teams database
        $newTeam = Team::create([
            'nama' => session('step4.namaTeam'),
            'password' => Hash::make(session('step4.password')),
            'link_bukti_tf' => session('step4.fileTeam'), // Use the file path from session
            'is_validated' => false
        ]);

        // Retrieve the ID of the newly inserted team
        $team_id = $newTeam->id;

        // Insert ketua into Users database
        User::create([
            'nama' => session('step1.namaKetua'),
            'tanggal_lahir' => session('step1.tanggalLahirKetua'),
            'tempat_lahir' => session('step1.tempatLahirKetua'),
            'alamat' => session('step1.alamatKetua'),
            'kode_pos' => session('step1.kodePosKetua'),
            'no_telp' => session('step1.phoneKetua'),
            'id_line' => session('step1.idlineKetua'),
            'link_foto' => session('step1.fileKetua'), // Use the file path from session
            'is_ketua' => true,
            'bank' => session('step1.bankKetua'),
            'no_rek' => session('step1.noRekeningKetuaTim'),
            'id_tim' => $team_id
        ]);

        // Insert anggota1 into Users database
        User::create([
            'nama' => session('step2.namaAnggota1'),
            'tanggal_lahir' => session('step2.tanggalLahirAnggota1'),
            'tempat_lahir' => session('step2.tempatLahirAnggota1'),
            'alamat' => session('step2.alamatAnggota1'),
            'kode_pos' => session('step2.kodePosAnggota1'),
            'no_telp' => session('step2.phoneAnggota1'),
            'id_line' => session('step2.idlineAnggota1'),
            'link_foto' => session('step2.fileAnggota1'), // Use the file path from session
            'is_ketua' => false,
            'id_tim' => $team_id
        ]);

        // Insert anggota2 into Users database
        User::create([
            'nama' => session('step3.namaAnggota2'),
            'tanggal_lahir' => session('step3.tanggalLahirAnggota2'),
            'tempat_lahir' => session('step3.tempatLahirAnggota2'),
            'alamat' => session('step3.alamatAnggota2'),
            'kode_pos' => session('step3.kodePosAnggota2'),
            'no_telp' => session('step3.phoneAnggota2'),
            'id_line' => session('step3.idlineAnggota2'),
            'link_foto' => session('step3.fileAnggota2'), // Use the file path from session
            'is_ketua' => false,
            'id_tim' => $team_id
        ]);

        // Add new team stats
        ElimStatistics::create([
            'id_team' => $team_id
        ]);

        // Add new team stats
        SemiStatistic::create([
            'id_team' => $team_id
        ]);

        session()->flash('message', 'Team registered successfully!');

        $request->session()->flush();

        return redirect('/')->with('success', 'Registration completed successfully!');
    }

    private function moveFileToPermanentStorage($file, $directory)
    {
        $this->createDirectory($directory);
        
        // Move file to permanent storage with a custom file name
        $filename = basename($file);
        $newPath = "$directory/$filename";
        Storage::move($file, $newPath);

        return $newPath;
    }

    public function createDirectory($path)
    {
        $fullPath = storage_path('app/' . $path);

        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true); // Create directory with 755 permissions
        }
    }
}
