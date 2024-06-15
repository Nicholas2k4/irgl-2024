<?php

namespace App\Livewire;

use App\Models\Team;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;


class RegisterForm extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $formData = [];

    // Declare properties for all form fields
    public $namaKetua, $bankKetua, $noRekeningKetuaTim, $tanggalLahirKetua, $tempatLahirKetua, $alamatKetua, $kodePosKetua, $phoneKetua, $idlineKetua, $fileKetua;
    public $namaAnggota1, $tanggalLahirAnggota1, $tempatLahirAnggota1, $alamatAnggota1, $kodePosAnggota1, $phoneAnggota1, $idlineAnggota1, $fileAnggota1;
    public $namaAnggota2, $tanggalLahirAnggota2, $tempatLahirAnggota2, $alamatAnggota2, $kodePosAnggota2, $phoneAnggota2, $idlineAnggota2, $fileAnggota2;
    public $fileTeam, $namaTeam, $password, $password_confirmation;

    public function render()
    {
        return view('livewire.register-form');
    }

    public function nextStep()
    {
        $this->step++;
    }

    public function backStep() 
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function submit()
    {
        $this->namaKetua = ucwords(strtolower($this->namaKetua)); // Pascal Case
        $this->namaAnggota1 = ucwords(strtolower($this->namaAnggota1)); // Pascal Case
        $this->namaAnggota2 = ucwords(strtolower($this->namaAnggota2)); // Pascal Case
        $this->namaTeam = strtoupper($this->namaTeam); // UPPER CASE

        $validatedData = $this->validate([
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

            'namaAnggota1' => 'required',
            'tanggalLahirAnggota1' => 'required|date',
            'tempatLahirAnggota1' => 'required',
            'alamatAnggota1' => 'required',
            'kodePosAnggota1' => 'required|numeric',
            'phoneAnggota1' => 'required',
            'idlineAnggota1' => 'required',
            'fileAnggota1' => 'required|image|max:8192', // Max 8MB

            'namaAnggota2' => 'required',
            'tanggalLahirAnggota2' => 'required|date',
            'tempatLahirAnggota2' => 'required',
            'alamatAnggota2' => 'required',
            'kodePosAnggota2' => 'required|numeric',
            'phoneAnggota2' => 'required',
            'idlineAnggota2' => 'required',
            'fileAnggota2' => 'required|image|max:8192', // Max 8MB

            'fileTeam' => 'required|image|max:8192', // Max 8MB
            'namaTeam' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check if team name already exists
        if (Team::where('nama', $this->namaTeam)->exists()) {
            session()->flash('message', 'Team name already exists. Please choose another name.');
            return;
        }

        // Store uploaded files
        $fileKetuaName = $this->fileKetua->store('public/uploads');
        $fileAnggota1Name = $this->fileAnggota1->store('public/uploads');
        $fileAnggota2Name = $this->fileAnggota2->store('public/uploads');
        $fileTeamName = $this->fileTeam->store('public/uploads');

        // Insert team into Teams database
        $newTeam = Team::create([
            'nama' => $this->namaTeam,
            'password' => $this->password,
            'link_bukti_tf' => $fileTeamName,
            'is_validated' => false
        ]);

        // Retrieve the ID of the newly inserted team
        $team_id = $newTeam->id;

        // Insert ketua into Users database
        User::create([
            'nama' => $this->namaKetua,
            'tanggal_lahir' => $this->tanggalLahirKetua,
            'tempat_lahir' => $this->tempatLahirKetua,
            'alamat' => $this->alamatKetua,
            'kode_pos' => $this->kodePosKetua,
            'no_telp' => $this->phoneKetua,
            'id_line' => $this->idlineKetua,
            'link_foto' => $fileKetuaName,
            'is_ketua' => true,
            'bank' => $this->bankKetua,
            'no_rek' => $this->noRekeningKetuaTim,
            'id_tim' => $team_id
        ]);
        
        // Insert anggota1 into Users database
        User::create([
            'nama' => $this->namaAnggota1,
            'tanggal_lahir' => $this->tanggalLahirAnggota1,
            'tempat_lahir' => $this->tempatLahirAnggota1,
            'alamat' => $this->alamatAnggota1,
            'kode_pos' => $this->kodePosAnggota1,
            'no_telp' => $this->phoneAnggota1,
            'id_line' => $this->idlineAnggota1,
            'link_foto' => $fileAnggota1Name,
            'is_ketua' => false,
            'id_tim' => $team_id
        ]);

        // Insert anggota2 into Users database
        User::create([
            'nama' => $this->namaAnggota2,
            'tanggal_lahir' => $this->tanggalLahirAnggota2,
            'tempat_lahir' => $this->tempatLahirAnggota2,
            'alamat' => $this->alamatAnggota2,
            'kode_pos' => $this->kodePosAnggota2,
            'no_telp' => $this->phoneAnggota2,
            'id_line' => $this->idlineAnggota2,
            'link_foto' => $fileAnggota2Name,
            'is_ketua' => false,
            'id_tim' => $team_id
        ]);

        session()->flash('message', 'Team registered successfully!');
        return redirect()->to('/');
    }
}
