@extends('register')

@section('container')
<div class="bg-[rgba(0,0,0,0.5)] backdrop-blur-lg shadow-[0_0_20px_rgba(255,255,255,0.1)] md:w-fit md:max-w-[420px] w-5/6 p-10 rounded-[20px] text-center m-8 relative">
    <a href="{{ route('register.show.step.one') }}">
        <span class="text-2xl text-white absolute top-0 left-0 m-2 cursor-pointer material-icons">arrow_back</span>
    </a>
    <h2 class="text-xl md:text-2xl text-white font-bold mb-4">Register Anggota 1</h2>
    <form action="{{ route('register.show.step.two') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-2 flex flex-col items-left">
            <label for="nama-anggota1-id" class="text-sm md:text-base text-white text-left">Nama Anggota 1</label>
            <input type="text" id="nama-anggota1-id" name="namaAnggota1" placeholder="Contoh: Christopher Joshua" value="{{ old('namaAnggota1', session('step2.namaAnggota1')) }}" required autocomplete="name" class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
            <label for="tanggal-lahir-anggota1-id" class="text-sm md:text-base text-white text-left">Tanggal lahir</label>
            <input type="date" id="tanggal-lahir-anggota1-id" name="tanggalLahirAnggota1" value="{{ old('tanggalLahirAnggota1', session('step2.tanggalLahirAnggota1')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>

        <div class="mb-2 flex flex-col items-left">
            <label for="tempat-lahir-anggota1-id" class="text-sm md:text-base text-white text-left">Tempat kota lahir</label>
            <input type="text" id="tempat-lahir-anggota1-id" name="tempatLahirAnggota1" value="{{ old('tempatLahirAnggota1', session('step2.tempatLahirAnggota1')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
            <label for="alamat-anggota1-id" class="text-sm md:text-base text-white text-left">Alamat</label>
            <textarea id="alamat-anggota1-id" name="alamatAnggota1" autocomplete="street-address" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">{{ old('alamatAnggota1', session('step2.alamatAnggota1')) }}</textarea>
        </div>

        <div class="mb-2 flex flex-col items-left">
            <label for="kode-pos-anggota1-id" class="text-sm md:text-base text-white text-left">Kode Pos</label>
            <input type="text" id="kode-pos-anggota1-id" name="kodePosAnggota1" value="{{ old('kodePosAnggota1', session('step2.kodePosAnggota1')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
            <label for="phone-anggota1-id" class="text-sm md:text-base text-white text-left">No telp aktif</label>
            <div class="flex items-center">
            <span class="bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white p-2.5 rounded-l-[5px]">+62</span>
            <input type="text" id="phone-anggota1-id" name="phoneAnggota1" autocomplete="tel" value="{{ old('phoneAnggota1', session('step2.phoneAnggota1')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-r-[5px] border-none">
            </div>
        </div>
        
        <div class="mb-2 flex flex-col items-left">
            <label for="anggota1-idline-id" class="text-sm md:text-base text-white text-left">ID Line</label>
            <input type="text" id="anggota1-idline-id" name="idlineAnggota1" value="{{ old('idlineAnggota1', session('step2.idlineAnggota1')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
            <label for="file-anggota1-id" class="text-sm md:text-base text-white block text-left mb-2">Foto kartu siswa & surat pernyataan siswa aktif</label>
            <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
                <input type="file" id="file-anggota1-id" name="fileAnggota1" accept="image/*" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('anggota1')">
                <span class="text-2xl material-icons">cloud_upload</span>
            </div>
            <div id="img-name-anggota1" class="text-sm md:text-base text-white mt-2 text-left">
                @if (session('step2.fileAnggota1'))
                    {{ basename(session('step2.fileAnggota1')) }}
                @endif
            </div>
        </div>
        
        <button type="submit" class="bg-[#B026FF] text-sm md:text-base text-white text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Next</button>
    </form>
</div>
@endsection