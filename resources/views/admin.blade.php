<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PAGE | IRGL 2024</title>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Swal --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/img/logo.png') }}"> --> <!-- GANTI ICON IRGL, cari tempat-->
    <link rel="canonical" href="https://irgl.petra.ac.id/">

    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="m-0 p-0 h-screen bg-gradient-to-r from-[#6b2b52]  to-[#422a6a]">
    <nav class="w-screen h-[5vh] flex-row shadow-xl shadow-[#0000002D]
    bg-gradient-to-r from-[#6b2b52] to-[#311b55]">
        <div class="max-w-[98%] h-[100%] flex flex-wrap items-center justify-between mx-auto p-4"> <!--isi -->
            <a href="#" class=""><span class="text-[#fff] font-bold text-lg">ADMIN IRGL 2024</span></a>
            <button></button> <!--HP show Menu-->
            <div class="max-w-[50%] flex h-[100%] justify-between">
                <a class=" text-[#fff] font-bold text-lg">Home</a>
                <a class=" text-[#fff]/60 ml-10 mr-10 hover:text-[#fff]/80 text-lg">Rekap Pendaftar</a>
                <a class=" text-[#fff]/60 hover:text-[#fff]/80 text-lg">Rekap Team</a>
            </div>
        </div>
    </nav>
@yield('body')
@yield('script')
</body>

</html>