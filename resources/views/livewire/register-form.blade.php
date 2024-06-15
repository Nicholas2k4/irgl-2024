<div class="bg-[rgba(255,255,255,0.1)] shadow-[0_0_20px_rgba(255,255,255,0.1)] p-10 rounded-[20px] text-center m-8 relative">
    @if($step === 1)
        @if($errors->any())
            <div class="bg-red-200 p-2 mb-4 text-red-800">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <h2 class="text-2xl text-white font-bold mb-4">Register</h2>
        <form wire:submit.prevent="nextStep">
            <div class="mb-2 flex flex-col items-left">
                <label for="nama-ketua-id" class="text-white text-left ml-4">Nama Ketua Tim</label>
                <input type="text" id="nama-ketua-id" wire:model="namaKetua" placeholder="Contoh: Christopher Joshua" required autocomplete="name" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="no-rekening-ketua-tim-id" class="text-white text-left ml-4">No rekening ketua tim</label>
                <div class="flex">
                  <select id="bank-select-id" wire:model="bankKetua" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
                    <option value="" selected class="bg-[rgba(0,0,0,0.8)]">Pilih Bank</option>
                    <option value="bca" class="bg-[rgba(0,0,0,0.8)]">BCA</option>
                    <option value="bni" class="bg-[rgba(0,0,0,0.8)]">BNI</option>
                    <option value="bri" class="bg-[rgba(0,0,0,0.8)]">BRI</option>
                    <option value="mandiri" class="bg-[rgba(0,0,0,0.8)]">Mandiri</option>
                    <option value="cimb" class="bg-[rgba(0,0,0,0.8)]">CIMB</option>
                  </select>
                  <input type="text" id="no-rekening-ketua-tim-id" wire:model="noRekeningKetuaTim" placeholder="Nomor Rekening" required class="flex-1 ml-2 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
                </div>
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="tanggal-lahir-ketua-id" class="text-white text-left ml-4">Tanggal lahir</label>
                <input type="date" id="tanggal-lahir-ketua-id" wire:model="tanggalLahirKetua" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
              </div>
      
              <div class="mb-2 flex flex-col items-left">
                <label for="tempat-lahir-ketua-id" class="text-white text-left ml-4">Tempat kota lahir</label>
                <input type="text" id="tempat-lahir-ketua-id" wire:model="tempatLahirKetua" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="alamat-ketua-id" class="text-white text-left ml-4">Alamat</label>
                <textarea id="alamat-ketua-id" wire:model="alamatKetua" autocomplete="street-address" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none"></textarea>
              </div>
      
              <div class="mb-2 flex flex-col items-left">
                <label for="kode-pos-ketua-id" class="text-white text-left ml-4">Kode Pos</label>
                <input type="text" id="kode-pos-ketua-id" wire:model="kodePosKetua" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="phone-ketua-id" class="text-white text-left ml-4">No telp aktif</label>
                <div class="flex items-center">
                  <span class="bg-[rgba(255,255,255,0.1)] text-white p-2.5 rounded-l-[5px]">+62</span>
                  <input type="text" id="phone-ketua-id" wire:model="phoneKetua" autocomplete="tel" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-r-[5px] border-none">
                </div>
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="ketua-idline-id" class="text-white text-left ml-4">ID Line</label>
                <input type="text" id="ketua-idline-id" wire:model="idlineKetua" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="file-ketua-id" class="text-white block text-left mb-2">Foto kartu siswa & surat pernyataan siswa aktif</label>
                <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
                  <input type="file" id="file-ketua-id" wire:model="fileKetua" accept="image/*" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('ketua')">
                  <span class="text-2xl material-icons">cloud_upload</span>
                </div>
                @if($fileKetua)
                    <div class="text-white mt-2 text-left">{{ $fileKetua->getClientOriginalName() }}</div>
                @endif
              </div>
              
              <button type="submit" class="bg-[#B026FF] text-black text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Next</button>
        </form>
    @elseif($step === 2)
        @if($errors->any())
            <div class="bg-red-200 p-2 mb-4 text-red-800">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="bg-yellow-200 p-2 mb-4 text-yellow-800">
                {{ session('message') }}
            </div>
        @endif
        <span class="text-2xl text-white absolute top-0 left-0 m-2 cursor-pointer material-icons" wire:click="backStep">arrow_back</span>
        <h2 class="text-2xl text-white font-bold mb-4">Register Anggota 1</h2>
        <form wire:submit.prevent="nextStep">
            <div class="mb-2 flex flex-col items-left">
                <label for="nama-anggota1-id" class="text-white text-left ml-4">Nama Anggota 1</label>
                <input type="text" id="nama-anggota1-id" wire:model="namaAnggota1" placeholder="Contoh: Christopher Joshua" required autocomplete="name" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="tanggal-lahir-anggota1-id" class="text-white text-left ml-4">Tanggal lahir</label>
                <input type="date" id="tanggal-lahir-anggota1-id" wire:model="tanggalLahirAnggota1" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
    
            <div class="mb-2 flex flex-col items-left">
                <label for="tempat-lahir-anggota1-id" class="text-white text-left ml-4">Tempat kota lahir</label>
                <input type="text" id="tempat-lahir-anggota1-id" wire:model="tempatLahirAnggota1" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="alamat-anggota1-id" class="text-white text-left ml-4">Alamat</label>
                <textarea id="alamat-anggota1-id" wire:model="alamatAnggota1" autocomplete="street-address" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none"></textarea>
            </div>
    
            <div class="mb-2 flex flex-col items-left">
                <label for="kode-pos-anggota1-id" class="text-white text-left ml-4">Kode Pos</label>
                <input type="text" id="kode-pos-anggota1-id" wire:model="kodePosAnggota1" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="phone-anggota1-id" class="text-white text-left ml-4">No telp aktif</label>
                <div class="flex items-center">
                <span class="bg-[rgba(255,255,255,0.1)] text-white p-2.5 rounded-l-[5px]">+62</span>
                <input type="text" id="phone-anggota1-id" wire:model="phoneAnggota1" autocomplete="tel" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-r-[5px] border-none">
                </div>
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="anggota1-idline-id" class="text-white text-left ml-4">ID Line</label>
                <input type="text" id="anggota1-idline-id" wire:model="idlineAnggota1" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="file-anggota1-id" class="text-white block text-left mb-2">Foto kartu siswa & surat pernyataan siswa aktif</label>
                <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
                <input type="file" id="file-anggota1-id" wire:model="fileAnggota1" accept="image/*" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('anggota1')">
                <span class="text-2xl material-icons">cloud_upload</span>
                </div>
                @if($fileAnggota1)
                    <div class="text-white mt-2 text-left">{{ $fileAnggota1->getClientOriginalName() }}</div>
                @endif
                </div>
            
            <button type="submit" class="bg-[#B026FF] text-black text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Next</button>
        </form>
    @elseif($step === 3)
        @if($errors->any())
            <div class="bg-red-200 p-2 mb-4 text-red-800">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="bg-yellow-200 p-2 mb-4 text-yellow-800">
                {{ session('message') }}
            </div>
        @endif
        <span class="text-2xl text-white absolute top-0 left-0 m-2 cursor-pointer material-icons" wire:click="backStep">arrow_back</span>
        <h2 class="text-2xl text-white font-bold mb-4">Register Anggota 2</h2>
        <form wire:submit.prevent="nextStep">
            <div class="mb-2 flex flex-col items-left">
                <label for="nama-anggota2-id" class="text-white text-left ml-4">Nama Anggota 2</label>
                <input type="text" id="nama-anggota2-id" wire:model="namaAnggota2" placeholder="Contoh: Christopher Joshua" required autocomplete="name" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="tanggal-lahir-anggota2-id" class="text-white text-left ml-4">Tanggal lahir</label>
                <input type="date" id="tanggal-lahir-anggota2-id" wire:model="tanggalLahirAnggota2" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>

            <div class="mb-2 flex flex-col items-left">
                <label for="tempat-lahir-anggota2-id" class="text-white text-left ml-4">Tempat kota lahir</label>
                <input type="text" id="tempat-lahir-anggota2-id" wire:model="tempatLahirAnggota2" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="alamat-anggota2-id" class="text-white text-left ml-4">Alamat</label>
                <textarea id="alamat-anggota2-id" wire:model="alamatAnggota2" autocomplete="street-address" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none"></textarea>
            </div>

            <div class="mb-2 flex flex-col items-left">
                <label for="kode-pos-anggota2-id" class="text-white text-left ml-4">Kode Pos</label>
                <input type="text" id="kode-pos-anggota2-id" wire:model="kodePosAnggota2" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="phone-anggota2-id" class="text-white text-left ml-4">No telp aktif</label>
                <div class="flex items-center">
                <span class="bg-[rgba(255,255,255,0.1)] text-white p-2.5 rounded-l-[5px]">+62</span>
                <input type="text" id="phone-anggota2-id" wire:model="phoneAnggota2" autocomplete="tel" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-r-[5px] border-none">
                </div>
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="anggota2-idline-id" class="text-white text-left ml-4">ID Line</label>
                <input type="text" id="anggota2-idline-id" wire:model="idlineAnggota2" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="file-anggota2-id" class="text-white block text-left mb-2">Foto kartu siswa & surat pernyataan siswa aktif</label>
                <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
                <input type="file" id="file-anggota2-id" wire:model="fileAnggota2" accept="image/*" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('anggota2')">
                <span class="text-2xl material-icons">cloud_upload</span>
                </div>
                @if($fileAnggota2)
                    <div class="text-white mt-2 text-left">{{ $fileAnggota2->getClientOriginalName() }}</div>
                @endif
            </div>
            
            <button type="submit" class="bg-[#B026FF] text-black text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Next</button>
        </form>
    @elseif($step === 4)
        @if($errors->any())
            <div class="bg-red-200 p-2 mb-4 text-red-800">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="bg-yellow-200 p-2 mb-4 text-yellow-800">
                {{ session('message') }}
            </div>
        @endif
        <span class="text-2xl text-white absolute top-0 left-0 m-2 cursor-pointer material-icons" wire:click="backStep">arrow_back</span>
        <h2 class="text-2xl text-white font-bold mb-4">Register team</h2>
        <form wire:submit.prevent="submit">
            <div class="mb-2 flex flex-col items-left">
                <label for="file-team-id" class="text-white block text-left mb-2">Bukti transfer</label>
                <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
                <input type="file" id="file-team-id" wire:model="fileTeam" accept="image/*" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('team')">
                <span class="text-2xl material-icons">cloud_upload</span>
                </div>
                @if($fileTeam)
                    <div class="text-white mt-2 text-left">{{ $fileTeam->getClientOriginalName() }}</div>
                @endif
            </div>

            <div class="mb-2 flex flex-col items-left">
                <label for="nama-team-id" class="text-white text-left ml-4">Nama Tim</label>
                <input type="text" id="nama-team-id" wire:model="namaTeam" placeholder="Contoh: NATUS VINCERE" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>

            <div class="mb-2 flex flex-col items-left">
                <label for="password-id" class="text-white text-left ml-4">Password</label>
                <input type="password" id="password-id" wire:model="password" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>

            <div class="mb-2 flex flex-col items-left">
                <label for="confirm-password-id" class="text-white text-left ml-4">Confirm Password</label>
                <input type="password" id="confirm-password-id" wire:model="password_confirmation" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>

            <button type="submit" class="bg-[#B026FF] text-black text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Register</button>
        </form>
    @endif
</div>