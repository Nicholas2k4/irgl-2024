@extends('register')

@section('container')
<div class="bg-[rgba(0,0,0,0.5)] backdrop-blur-lg shadow-[0_0_20px_rgba(255,255,255,0.1)] md:w-fit md:min-w-[400px] w-5/6 p-10 rounded-[20px] text-center m-8 relative">
    <a href="{{ route('register.show.step.three') }}">
        <span class="text-2xl text-white absolute top-0 left-0 m-2 cursor-pointer material-icons">arrow_back</span>
    </a>    <h2 class="text-xl md:text-2xl text-white font-bold mb-4">Register team</h2>
    <form action="{{ route('register.show.step.four') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-2 flex flex-col items-left">
            <label for="file-team-id" class="text-sm md:text-base text-white block text-left mb-2">Bukti transfer</label>
            <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
            <input type="file" id="file-team-id" name="fileTeam" accept="image/*" value="{{ old('fileTeam', session('step4.fileTeam')) }}" required class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName('team')">
            <span class="text-2xl material-icons">cloud_upload</span>
            </div>
            <div class="text-sm md:text-base text-white mt-2 text-left"></div>
        </div>

        <div class="mb-2 flex flex-col items-left">
            <label for="nama-team-id" class="text-sm md:text-base text-white text-left">Nama Tim</label>
            <input type="text" id="nama-team-id" name="namaTeam" placeholder="Contoh: NATUS VINCERE" value="{{ old('namaTeam', session('step4.namaTeam')) }}" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-sm md:text-base text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
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