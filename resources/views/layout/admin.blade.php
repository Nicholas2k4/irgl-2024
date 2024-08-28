<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin IRGL 2024 | {{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    {{-- Swal --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/img/logo.png') }}"> --> <!-- GANTI ICON IRGL, cari tempat-->
    <link rel="canonical" href="https://irgl.petra.ac.id/">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <!-- AJAX -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ["Open Sans", "sans-serif"],
                    body: ["Open Sans", "sans-serif"],
                    mono: ["ui-monospace", "monospace"],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>

</head>

<body class="m-0 p-0 w-screen overflow-x-hidden min-h-screen bg-gradient-to-r from-[#6b2b52]  to-[#422a6a]">
    <header class="sm:shadow-xl sm:shadow-[#0000002D] bg-gradient-to-r from-[#6b2b52] to-[#311b55]">
        <nav class="w-[96%] h-[9vh] flex mx-auto justify-between items-center">
            <a href="#" class=""><span class="text-[#fff] font-bold text-lg">ADMIN IRGL 2024</span></a>

            <div id="ull" class="hidden absolute bg-gradient-to-r from-[#6b2b52] to-[#311b55] sm:bg-none sm:shadow-none shadow-xl shadow-[#0000002D] sm:static sm:justify-end sm:max-w-[71.6vw] min-h-[35vh] left-0 top-[9%] w-full sm:flex justify-center items-center">
                <ul class="flex flex-col sm:flex-row sm:gap-[1.4vw] gap-[5vh] h-full w-[97vw] sm:max-w-[100%] sm:justify-end">
                    <li class="flex">
                        <a id="home" class="text-[#fff]/60 p-1 px-5 hover:text-[#fff]/80 text-lg w-full h-full" href="{{ route('admin.main') }}">Home</a>
                    </li>
                    <li class="flex">
                        <a id="rekapTeam" class="text-[#fff]/60 p-1 px-5 hover:text-[#fff]/80 text-lg w-full h-full" href="{{ route('admin.rekapTeam') }}">Rekap Team</a>
                    </li>
                    <li class="flex">
                        <a id="jadwal" class="text-[#fff]/60 p-1 px-5 hover:text-[#fff]/80 text-lg w-full h-full" href="{{ route('admin.jadwal.main') }}">Edit Jadwal</a>
                    </li>
                    <li class="flex">
                         <a class="rounded-lg text-[#fff]/60 hover:text-[#fff]/80 p-1 text-lg w-full h-full hover:bg-red-800/80" href="{{ route('logout') }}">Log Out</a>
                    </li>
                </ul>
            </div>

            <div class="flex items-center sm:hidden py-[0.25rem] px-[0.75rem] rounded-md border-[0.5px] border-[#bcabeb77]">
                <button onclick="displayMenu()" class="cursor-pointer">
                    <svg id="menuBurger" class="hover:stroke-slate-50" width="30px" height="30px" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 18L20 18" stroke="#7d70b8" stroke-width="2" stroke-linecap="round" />
                        <path d="M4 12L20 12" stroke="#7d70b8" stroke-width="2" stroke-linecap="round" />
                        <path d="M4 6L20 6" stroke="#7d70b8" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </nav>
    </header>
    <script>
        function displayMenu() {
            const ull = document.getElementById("ull");
            if(ull.classList.contains('hidden')){
                ull.classList.remove('hidden');
                ull.classList.add('flex');
                ull.classList.add('z-10');
            }else{
                ull.classList.add('hidden');
            }
        }
    </script>

    @yield('body')
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    @yield('script')
</body>

</html>
