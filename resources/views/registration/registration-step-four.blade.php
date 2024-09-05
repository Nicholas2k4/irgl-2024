@extends('register')

@section('container')
<div class="bg-[rgba(0,0,0,0.5)] backdrop-blur-lg shadow-[0_0_20px_rgba(255,255,255,0.1)] md:w-[420px] w-5/6 p-10 rounded-[20px] text-center m-8 relative">
    <a href="{{ route('register.show.step.three') }}">
        <span class="text-2xl text-white absolute top-0 left-0 m-2 cursor-pointer material-icons">arrow_back</span>
    </a>    <h2 class="text-xl md:text-2xl text-white font-bold mb-4">Register team</h2>
    <form action="{{ route('register.show.step.four') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-2 flex flex-col items-left">
            <h2 class="text-white text-left text-xl mt-3">Ketentuan Transfer:</h2>
            <h2 class="text-white text-left text-md">Early Bird Price: Rp 150,000</h2>
            <h2 class="text-white text-left text-md mb-3">Normal Price: Rp 225,000</h2>
            <h2 class="text-white text-left text-xl">Transfer uang pendaftaran sesuai ketentuan berikut:</h2>
            <h2 class="text-white text-left text-md">No. Rek (BCA): 8221 4544 13 (a.n. Laura Wijaya)</h2>
            <h2 class="text-white text-left text-md mb-5">Berita: IRGL 2024, Nama Kelompok</h2>
            <label for="file-team-id" class="text-sm md:text-base text-white block text-left mb-2">Bukti transfer (Max 5 MB)</label>
            <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
                <input type="file" id="file-team-id" name="fileTeam" accept="image/*" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('team')">
                <span class="text-2xl material-icons">cloud_upload</span>
            </div>
            <div id="img-name-team" class="text-sm md:text-base text-white mt-2 text-left">
                @if (session('step4.fileTeam'))
                    {{ basename(session('step4.fileTeam')) }}
                @endif
            </div>
        </div>

        <div class="mb-2 flex flex-col items-left">
            <label for="nama-team-id" class="text-sm md:text-base text-white text-left">Nama Tim</label>
            <input type="text" id="nama-team-id" name="namaTeam" placeholder="Contoh: NATUS VINCERE" value="{{ old('namaTeam', session('step4.namaTeam')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        <div class="mb-2 flex flex-col items-left">
            <label for="asal_sekolah" class="text-sm md:text-base text-white text-left">Asal Sekolah</label>
            <input type="text" id="asal_sekolah" name="asalsekolah" placeholder="" value="{{ old('asalsekolah') ?? ''}}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>

        <div class="mb-2 flex flex-col items-left">
            <label for="password-id" class="text-sm md:text-base text-white text-left">Password</label>
            <input type="password" id="password-id" name="password" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>

        <div class="mb-2 flex flex-col items-left">
            <label for="confirm-password-id" class="text-sm md:text-base text-white text-left">Confirm Password</label>
            <input type="password" id="confirm-password-id" name="password_confirmation" class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>

        <button type="submit" class="bg-[#B026FF] text-sm md:text-base text-white text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Register</button>
    </form>
</div>
@endsection