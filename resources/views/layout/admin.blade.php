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

<body class="m-0 p-0 w-screen overflow-x-hidden h-screen bg-gradient-to-r from-[#6b2b52]  to-[#422a6a]">
    <nav class="w-screen h-[45px] flex-row shadow-xl shadow-[#0000002D]
    bg-gradient-to-r from-[#6b2b52] to-[#311b55] top-0 right-0 absolute">
        <div class="max-w-[98%] h-[100%] pl-10 flex flex-wrap justify-between mx-auto items-center">
            
        <a href="#" class=""><span class="text-[#fff] font-bold text-lg">ADMIN IRGL 2024</span></a>
           
        <button></button> <!--HP show Menu-->
        
        <div class="max-w-[50%]flex justify-between mr-1">
                <a class=" text-[#fff] p-1 font-bold text-lg" href="/admin/main">Home</a>
                <!-- <a class=" text-[#fff]/60 p-1  hover:text-[#fff]/80 text-lg" href="/admin/rekapPendaftar">Rekap Pendaftar</a> -->
                <a class=" text-[#fff]/60 ml-7 mr-7 p-1 hover:text-[#fff]/80 text-lg" href="/admin/rekapTeam">Rekap Team</a>
                <a class=" text-[#fff]/60 ml-7 mr-7 p-1 hover:text-[#fff]/80 text-lg" href="/admin/jadwal-crud/main">Edit Jadwal</a>
                <a class=" rounded-lg text-[#fff]/60 hover:text-[#fff]/80 p-1 text-lg hover:bg-red-800/80" href="/logout">Log Out</a>
            </div>
        </div>
    </nav>
@yield('body')

@yield('script')
</body>

</html>