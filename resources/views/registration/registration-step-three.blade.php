@extends('register')

@section('container')
<div class="bg-[rgba(0,0,0,0.5)] backdrop-blur-lg shadow-[0_0_20px_rgba(255,255,255,0.1)] md:w-fit md:min-w-[400px] w-5/6 p-10 rounded-[20px] text-center m-8 relative">
    <a href="{{ route('register.show.step.two') }}">
        <span class="text-2xl text-white absolute top-0 left-0 m-2 cursor-pointer material-icons">arrow_back</span>
    </a>    <h2 class="text-xl md:text-2xl text-white font-bold mb-4">Register Anggota 2</h2>
    <form action="{{ route('register.show.step.three') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-2 flex flex-col items-left">
            <label for="nama-anggota2-id" class="text-sm md:text-base text-white text-left">Nama Anggota 2</label>
            <input type="text" id="nama-anggota2-id" name="namaAnggota2" placeholder="Contoh: Christopher Joshua" value="{{ old('namaAnggota2', session('step3.namaAnggota2')) }}" required autocomplete="name" class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
            <label for="tanggal-lahir-anggota2-id" class="text-sm md:text-base text-white text-left">Tanggal lahir</label>
            <input type="date" id="tanggal-lahir-anggota2-id" name="tanggalLahirAnggota2" value="{{ old('tanggalLahirAnggota2', session('step3.tanggalLahirAnggota2')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>

        <div class="mb-2 flex flex-col items-left">
            <label for="tempat-lahir-anggota2-id" class="text-sm md:text-base text-white text-left">Tempat kota lahir</label>
            <input type="text" id="tempat-lahir-anggota2-id" name="tempatLahirAnggota2" value="{{ old('tempatLahirAnggota2', session('step3.tempatLahirAnggota2')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
            <label for="alamat-anggota2-id" class="text-sm md:text-base text-white text-left">Alamat</label>
            <textarea id="alamat-anggota2-id" name="alamatAnggota2" autocomplete="street-address" value="{{ old('alamatAnggota2', session('step3.alamatAnggota2')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none"></textarea>
        </div>

        <div class="mb-2 flex flex-col items-left">
            <label for="kode-pos-anggota2-id" class="text-sm md:text-base text-white text-left">Kode Pos</label>
            <input type="text" id="kode-pos-anggota2-id" name="kodePosAnggota2" value="{{ old('kodePosAnggota2', session('step3.kodePosAnggota2')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
            <label for="phone-anggota2-id" class="text-sm md:text-base text-white text-left">No telp aktif</label>
            <div class="flex items-center">
            <span class="bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white p-2.5 rounded-l-[5px]">+62</span>
            <input type="text" id="phone-anggota2-id" name="phoneAnggota2" autocomplete="tel" value="{{ old('phoneAnggota2', session('step3.phoneAnggota2')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-r-[5px] border-none">
            </div>
        </div>
        
        <div class="mb-2 flex flex-col items-left">
            <label for="anggota2-idline-id" class="text-sm md:text-base text-white text-left">ID Line</label>
            <input type="text" id="anggota2-idline-id" name="idlineAnggota2" value="{{ old('idlineAnggota2', session('step3.idlineAnggota2')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
            <label for="file-anggota2-id" class="text-sm md:text-base text-white block text-left">Foto kartu siswa & surat pernyataan siswa aktif</label>
            <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
            <input type="file" id="file-anggota2-id" name="fileAnggota2" accept="image/*" value="{{ old('fileAnggota2', session('step3.fileAnggota2')) }}" required class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('anggota2')">
            <span class="text-2xl material-icons">cloud_upload</span>
            </div>
            <div class="text-sm md:text-base text-white mt-2 text-left"></div>
        </div>
        
        <button type="submit" class="bg-[#B026FF] text-sm md:text-base text-white text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Next</button>
    </form>
</div>
@endsection