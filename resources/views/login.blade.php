<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
</head>

<body>
    @if ($errors->any())
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ $errors->first() }}",
                icon: "error"
            });
        </script>
    @endif

    @if (session()->has('message'))
        <script>
            Swal.fire({
                title: "Info",
                text: "{{ session('message') }}",
                icon: "info"
            });
        </script>
    @endif

    <div
        class="bg-black flex justify-center items-center h-screen bg-[url('https://images.hdqwalls.com/download/neon-city-5k-3u-1920x1080.jpg')] bg-cover bg-center bg-no-repeat">
        <div
            class="bg-[rgba(0,0,0,0.5)] backdrop-blur-lg shadow-[0_0_20px_rgba(255,255,255,0.1)] w-[400px] p-10 rounded-[20px] text-center m-8 relative">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h2 class="text-2xl text-white font-bold mb-4">Login Team</h2>
                <div class="mb-2 flex flex-col items-left">
                    <label for="nama-team-id" class="text-white text-left">Nama Team</label>
                    <input type="text" id="nama-team-id" name="nama" placeholder="Contoh: NATUS VINCERE" required
                        autocomplete="name"
                        class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
                </div>

                <div class="mb-2 flex flex-col items-left">
                    <label for="password-id" class="text-white text-left">Password</label>
                    <input type="password" id="password-id" name="password" required
                        class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
                </div>
                <br>
                <button type="submit"
                    class="bg-[#B026FF] text-black text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Login</button>
            </form>
        </div>
    </div>

</body>

</html>
