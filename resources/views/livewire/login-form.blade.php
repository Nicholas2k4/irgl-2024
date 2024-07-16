<div class="bg-[rgba(0,0,0,0.5)] backdrop-blur-lg shadow-[0_0_20px_rgba(255,255,255,0.1)] w-[400px] p-10 rounded-[20px] text-center m-8 relative">
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
    <form wire:submit.prevent="login">
        <h2 class="text-2xl text-white font-bold mb-4">Login Team</h2>
        <div class="mb-2 flex flex-col items-left">
            <label for="nama-team-id" class="text-white text-left ml-4">Nama Team</label>
            <input type="text" id="nama-team-id" wire:model="nama" placeholder="Contoh: NATUS VINCERE" required autocomplete="name" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>

        <div class="mb-2 flex flex-col items-left">
            <label for="password-id" class="text-white text-left ml-4">Password</label>
            <input type="password" id="password-id" wire:model="password" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>

        <button type="submit" class="bg-[#B026FF] text-black text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Login</button>
    </form>
</div>