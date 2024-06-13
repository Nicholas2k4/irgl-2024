
<div class="bg-[rgba(255,255,255,0.1)] shadow-[0_0_20px_rgba(255,255,255,0.1)] p-10 rounded-[20px] text-center m-8">
    @if($step === 1)
        <h2 class="text-2xl text-white font-bold mb-4">Register</h2>
        <form wire:submit.prevent="nextStep">
            <div class="mb-2 flex flex-col items-left">
                <label for="nama-ketua-id" class="text-white text-left ml-4">Nama Ketua Tim</label>
                <input type="text" id="nama-ketua-id" name="nama-ketua-name" placeholder="Contoh: Christopher Joshua" required autocomplete="name" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="no-rekening-ketua-tim-id" class="text-white text-left ml-4">No rekening ketua tim</label>
                <div class="flex">
                  <select id="bank-select" name="bank-select" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
                    <option value="" disabled selected class="bg-[rgba(0,0,0,0.8)]">Pilih Bank</option>
                    <option value="bca" class="bg-[rgba(0,0,0,0.8)]">BCA</option>
                    <option value="bni" class="bg-[rgba(0,0,0,0.8)]">BNI</option>
                    <option value="bri" class="bg-[rgba(0,0,0,0.8)]">BRI</option>
                    <option value="mandiri" class="bg-[rgba(0,0,0,0.8)]">Mandiri</option>
                    <option value="cimb" class="bg-[rgba(0,0,0,0.8)]">CIMB</option>
                  </select>
                  <input type="text" id="no-rekening-ketua-tim-id" name="no-rekening-ketua-tim-name" placeholder="Nomor Rekening" required class="flex-1 ml-2 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
                </div>
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="tanggal-lahir-ketua-id" class="text-white text-left ml-4">Tanggal lahir</label>
                <input type="date" id="tanggal-lahir-ketua-id" name="tanggal-lahir-ketua-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
              </div>
      
              <div class="mb-2 flex flex-col items-left">
                <label for="tempat-lahir-ketua-id" class="text-white text-left ml-4">Tempat kota lahir</label>
                <input type="text" id="tempat-lahir-ketua-id" name="tempat-lahir-ketua-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="alamat-ketua-id" class="text-white text-left ml-4">Alamat</label>
                <textarea id="alamat-ketua-id" name="alamat-ketua-name" autocomplete="street-address" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none"></textarea>
              </div>
      
              <div class="mb-2 flex flex-col items-left">
                <label for="kode-pos-ketua-id" class="text-white text-left ml-4">Kode Pos</label>
                <input type="text" id="kode-pos-ketua-id" name="kode-pos-ketua-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="phone-ketua-id" class="text-white text-left ml-4">No telp aktif</label>
                <div class="flex items-center">
                  <span class="bg-[rgba(255,255,255,0.1)] text-white p-2.5 rounded-l-[5px]">+62</span>
                  <input type="text" id="phone-ketua-id" name="phone-ketua-name" autocomplete="tel" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-r-[5px] border-none">
                </div>
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="ketua-idline-id" class="text-white text-left ml-4">ID Line</label>
                <input type="text" id="ketua-idline-id" name="ketua-idline-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
              </div>
              
              <div class="mb-2 flex flex-col items-left">
                <label for="file-ketua-id" class="text-white block text-left mb-2">Foto kartu siswa & surat pernyataan siswa aktif</label>
                <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
                  <input type="file" id="file-ketua-id" name="file-ketua-name" accept="image/*" required class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('ketua')">
                  <span class="text-2xl material-icons">cloud_upload</span>
                </div>
                <div id="img-name-ketua" class="text-white mt-2 text-left"></div>
              </div>
              
              <button type="submit" class="bg-[#B026FF] text-black text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Next</button>
        </form>
    @elseif($step === 2)
        <h2 class="text-2xl text-white font-bold mb-4">Register Anggota 1</h2>
        <form wire:submit.prevent="nextStep">
            <div class="mb-2 flex flex-col items-left">
                <label for="nama-anggota1-id" class="text-white text-left ml-4">Nama Anggota 1</label>
                <input type="text" id="nama-anggota1-id" name="nama-anggota1-name" placeholder="Contoh: Christopher Joshua" required autocomplete="name" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="tanggal-lahir-anggota1-id" class="text-white text-left ml-4">Tanggal lahir</label>
                <input type="date" id="tanggal-lahir-anggota1-id" name="tanggal-lahir-anggota1-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
    
            <div class="mb-2 flex flex-col items-left">
                <label for="tempat-lahir-anggota1-id" class="text-white text-left ml-4">Tempat kota lahir</label>
                <input type="text" id="tempat-lahir-anggota1-id" name="tempat-lahir-anggota1-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="alamat-anggota1-id" class="text-white text-left ml-4">Alamat</label>
                <textarea id="alamat-anggota1-id" name="alamat-anggota1-name" autocomplete="street-address" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none"></textarea>
            </div>
    
            <div class="mb-2 flex flex-col items-left">
                <label for="kode-pos-anggota1-id" class="text-white text-left ml-4">Kode Pos</label>
                <input type="text" id="kode-pos-anggota1-id" name="kode-pos-anggota1-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="phone-anggota1-id" class="text-white text-left ml-4">No telp aktif</label>
                <div class="flex items-center">
                <span class="bg-[rgba(255,255,255,0.1)] text-white p-2.5 rounded-l-[5px]">+62</span>
                <input type="text" id="phone-anggota1-id" name="phone-anggota1-name" autocomplete="tel" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-r-[5px] border-none">
                </div>
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="anggota1-idline-id" class="text-white text-left ml-4">ID Line</label>
                <input type="text" id="anggota1-idline-id" name="anggota1-idline-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="file-anggota1-id" class="text-white block text-left mb-2">Foto kartu siswa & surat pernyataan siswa aktif</label>
                <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
                <input type="file" id="file-anggota1-id" name="file-anggota1-name" accept="image/*" required class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('anggota1')">
                <span class="text-2xl material-icons">cloud_upload</span>
                </div>
                <div id="img-name-anggota1" class="text-white mt-2 text-left"></div>
            </div>
            
            <button type="submit" class="bg-[#B026FF] text-black text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Next</button>
        </form>
    @elseif($step === 3)
        <h2 class="text-2xl text-white font-bold mb-4">Register Anggota 2</h2>
        <form wire:submit.prevent="nextStep">
            <div class="mb-2 flex flex-col items-left">
                <label for="nama-anggota2-id" class="text-white text-left ml-4">Nama Anggota 2</label>
                <input type="text" id="nama-anggota2-id" name="nama-anggota2-name" placeholder="Contoh: Christopher Joshua" required autocomplete="name" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="tanggal-lahir-anggota2-id" class="text-white text-left ml-4">Tanggal lahir</label>
                <input type="date" id="tanggal-lahir-anggota2-id" name="tanggal-lahir-anggota2-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>

            <div class="mb-2 flex flex-col items-left">
                <label for="tempat-lahir-anggota2-id" class="text-white text-left ml-4">Tempat kota lahir</label>
                <input type="text" id="tempat-lahir-anggota2-id" name="tempat-lahir-anggota2-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="alamat-anggota2-id" class="text-white text-left ml-4">Alamat</label>
                <textarea id="alamat-anggota2-id" name="alamat-anggota2-name" autocomplete="street-address" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none"></textarea>
            </div>

            <div class="mb-2 flex flex-col items-left">
                <label for="kode-pos-anggota2-id" class="text-white text-left ml-4">Kode Pos</label>
                <input type="text" id="kode-pos-anggota2-id" name="kode-pos-anggota2-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="phone-anggota2-id" class="text-white text-left ml-4">No telp aktif</label>
                <div class="flex items-center">
                <span class="bg-[rgba(255,255,255,0.1)] text-white p-2.5 rounded-l-[5px]">+62</span>
                <input type="text" id="phone-anggota2-id" name="phone-anggota2-name" autocomplete="tel" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-r-[5px] border-none">
                </div>
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="anggota2-idline-id" class="text-white text-left ml-4">ID Line</label>
                <input type="text" id="anggota2-idline-id" name="anggota2-idline-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <div class="mb-2 flex flex-col items-left">
                <label for="file-anggota2-id" class="text-white block text-left mb-2">Foto kartu siswa & surat pernyataan siswa aktif</label>
                <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
                <input type="file" id="file-anggota2-id" name="file-anggota2-name" accept="image/*" required class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('anggota2')">
                <span class="text-2xl material-icons">cloud_upload</span>
                </div>
                <div id="img-name-anggota2" class="text-white mt-2 text-left"></div>
            </div>
            
            <button type="submit" class="bg-[#B026FF] text-black text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Next</button>
        </form>
    @elseif($step === 4)
        <h2 class="text-2xl text-white font-bold mb-4">Register team</h2>
        <form wire:submit.prevent="submit" onsubmit="return validatePasswords()">
            <div class="mb-2 flex flex-col items-left">
                <label for="file-team-id" class="text-white block text-left mb-2">Bukti transfer</label>
                <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
                <input type="file" id="file-team-id" name="file-team-name" accept="image/*" required class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('team')">
                <span class="text-2xl material-icons">cloud_upload</span>
                </div>
                <div id="img-name-team" class="text-white mt-2 text-left"></div>
            </div>

            <div class="mb-2 flex flex-col items-left">
                <label for="nama-team-id" class="text-white text-left ml-4">Nama Tim</label>
                <input type="text" id="nama-team-id" name="nama-team-name" placeholder="Contoh: NATUS VINCERE" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>

            <div class="mb-2 flex flex-col items-left">
                <label for="password-id" class="text-white text-left ml-4">Password</label>
                <input type="password" id="password-id" name="password-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>

            <div class="mb-2 flex flex-col items-left">
                <label for="confirm-password-id" class="text-white text-left ml-4">Confirm Password</label>
                <input type="password" id="confirm-password-id" name="password-name_confirmation" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
            </div>
            
            <button type="submit" class="bg-[#B026FF] text-black text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Register</button>
        </form>
    @endif
</div>