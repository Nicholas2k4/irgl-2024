<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IRGL</title>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Swal --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/img/logo.png') }}"> --> <!-- GANTI ICON IRGL, cari tempat-->
    <link rel="canonical" href="https://irgl.petra.ac.id/">

    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="m-0 p-0 h-screen bg-gradient-to-r from-[#6b2b52]  to-[#422a6a]">
<!-- GANTI Ke Background buat user -->
@if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
            });
        </script>
    @endif
<div class="h-screen w-screen flex justify-center items-center">
    <div class="w-[400px] h-[400px] justify-center items-center flex flex-col
    border-solid border-[2px] border-[#cacaca80] rounded-[20px] backdrop-blur-lg shadow-inner shadow-[#ffffff99] bg-[#ffffff1a]/20">
        <div class="text-center">
            <!-- image/icon (?) -->
             <h1 class="font-bold">IRGL</h1>
        </div>

        <div class="w-[100%] h-[40%] overflow-hidden translate-y-10">
        <a href="{{ $auth_url }}" class="flex justify-center text-center items-center flex-col">
                <button class="flex w-[320px] h-[45px] rounded-[50px] items-center cursor-pointer border-solid border-[2px] border-b-teal-200 justify-around text-center text-[#fff]/80">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                        <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
                    </svg>
                    Sign In with Google Account
                </button>
            </a>
        </div>

    </div>
</div>

<!-- /GANTI Ke Background buat user --> 
</body>

</html>