@extends('register')

@section('container')
<div class="bg-[rgba(0,0,0,0.5)] backdrop-blur-lg shadow-[0_0_20px_rgba(255,255,255,0.1)] md:w-[420px] w-5/6 p-10 rounded-[20px] text-center m-8 relative">
    <h2 class="text-xl md:text-2xl text-white font-bold mb-4">Register</h2>
    <form action="{{ route('register.show.step.one') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-2 flex flex-col items-left">
            <label for="nama-ketua-id" class="text-sm md:text-base text-white text-left">Nama Ketua Tim</label>
            <input type="text" id="nama-ketua-id" name="namaKetua" placeholder="Contoh: Christopher Joshua" value="{{ old('namaKetua', session('step1.namaKetua')) }}" required autocomplete="name" class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
          
        <div class="mb-2 flex flex-col items-left">
            <label for="no-rekening-ketua-tim-id" class="text-sm md:text-base text-white text-left">No rekening ketua tim</label>
            <div class="flex">
                <select id="bank-select-id" name="bankKetua" required class="bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none w-1/2 md:w-1/4 lg:w-min">
                    <option value="" selected class="bg-[rgba(0,0,0,0.8)]">Pilih Bank</option>
                    <option value="bca" {{ old('bankKetua', session('step1.bankKetua')) == 'bca' ? 'selected' : '' }}  class="bg-[rgba(0,0,0,0.8)]">BCA</option>
                    <option value="bni" {{ old('bankKetua', session('step1.bankKetua')) == 'bni' ? 'selected' : '' }}  class="bg-[rgba(0,0,0,0.8)]">BNI</option>
                    <option value="bri" {{ old('bankKetua', session('step1.bankKetua')) == 'bri' ? 'selected' : '' }}  class="bg-[rgba(0,0,0,0.8)]">BRI</option>
                    <option value="mandiri" {{ old('bankKetua', session('step1.bankKetua')) == 'mandiri' ? 'selected' : '' }}  class="bg-[rgba(0,0,0,0.8)]">Mandiri</option>
                    <option value="cimb" {{ old('bankKetua', session('step1.bankKetua')) == 'cimb' ? 'selected' : '' }}  class="bg-[rgba(0,0,0,0.8)]">CIMB</option>
                </select>
                <input type="text" id="no-rekening-ketua-tim-id" name="noRekeningKetuaTim" placeholder="Nomor Rekening" value="{{ old('noRekeningKetuaTim', session('step1.noRekeningKetuaTim')) }}" required class="ml-2 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none w-full md:w-3/4 lg:w-5/6">
            </div>
        </div>
          
        <div class="mb-2 flex flex-col items-left">
            <label for="tanggal-lahir-ketua-id" class="text-sm md:text-base text-white text-sm md:text-base text-left">Tanggal lahir</label>
            <input type="date" id="tanggal-lahir-ketua-id" name="tanggalLahirKetua" value="{{ old('tanggalLahirKetua', session('step1.tanggalLahirKetua')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
  
        <div class="mb-2 flex flex-col items-left">
            <label for="tempat-lahir-ketua-id" class="text-sm md:text-base text-white text-left">Tempat kota lahir</label>
            <input type="text" id="tempat-lahir-ketua-id" name="tempatLahirKetua" value="{{ old('tempatLahirKetua', session('step1.tempatLahirKetua')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
          
        <div class="mb-2 flex flex-col items-left">
            <label for="alamat-ketua-id" class="text-sm md:text-base text-white text-left">Alamat</label>
            <textarea id="alamat-ketua-id" name="alamatKetua" autocomplete="street-address" class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">{{old('alamatKetua', session('step1.alamatKetua'))}}</textarea>
        </div>
  
        <div class="mb-2 flex flex-col items-left">
            <label for="kode-pos-ketua-id" class="text-sm md:text-base text-white text-left">Kode Pos</label>
            <input type="text" id="kode-pos-ketua-id" name="kodePosKetua" value="{{ old('kodePosKetua', session('step1.kodePosKetua')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
          
        <div class="mb-2 flex flex-col items-left">
            <label for="phone-ketua-id" class="text-sm md:text-base text-white text-left">No telp aktif</label>
            <div class="flex items-center">
                <span class="bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white p-2.5 rounded-l-[5px]">+62</span>
                <input type="text" id="phone-ketua-id" name="phoneKetua" autocomplete="tel" value="{{ old('phoneKetua', session('step1.phoneKetua')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-r-[5px] border-none">
            </div>
        </div>
          
        <div class="mb-2 flex flex-col items-left">
            <label for="ketua-idline-id" class="text-sm md:text-base text-white text-left">ID Line</label>
            <input type="text" id="ketua-idline-id" name="idlineKetua" value="{{ old('idlineKetua', session('step1.idlineKetua')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
          
        <div class="mb-2 flex flex-col items-left">
            <label for="file-ketua-id" class="text-sm md:text-base text-white block text-left mb-2">Foto kartu siswa atau surat pernyataan siswa aktif</label>
            <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
                <input type="file" id="file-ketua-id" name="fileKetua" accept="image/*" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('ketua')">
                <span class="text-2xl material-icons">cloud_upload</span>
            </div>
            <div id="img-name-ketua" class="text-sm md:text-base text-white mt-2 text-left break-words">
                @if (session('step1.fileKetua'))
                    {{ basename(session('step1.fileKetua')) }}
                @endif
            </div>
        </div>
          
        <button type="submit" class="bg-[#B026FF] text-sm md:text-base text-white text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Next</button>
    </form>
</div>
@endsection