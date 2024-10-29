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


    <!-- <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/img/logo.png') }}"> -->
    <!-- GANTI ICON IRGL, cari tempat-->
    <link rel="canonical" href="https://irgl.petra.ac.id/">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ["Open Sans", "sans-serif"],
                    body: ["Open Sans", "sans-serif"],
                    mono: ["ui-monospace", "monospace"],
                    dm: ["Share Tech Mono", "monospace"],
                    sacramento: ["Sacramento", "cursive"],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');
        @import url("https://fonts.googleapis.com/css?family=Sacramento&display=swap");

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            transition: top 0.7s;
            z-index: 500;
        }

        .navbar-hidden {
            top: -200px;
        }

        .hoi {
            box-shadow: 0 0 5px rgb(219, 64, 247), 0 0 8px rgb(158, 124, 209);
            transition: all .4s ease;
            background-color: rgba(219, 64, 247, 0.1) !important;
            border-radius: 10px;
        }
    </style>
    @yield('style')
</head>

<body
    class="bg-black items-center justify-center flex h-screen bg-[url('/assets/bg-semi.jpg')] bg-cover bg-center bg-no-repeat overflow-hidden">
    <nav
        class="bg-gradient-to-r from-[#6b2b52]  to-[#422a6a] py-4 border-gray-200  dark:bg-gray-900 navbar shadow-custom-md font-dm px-5 ">
        <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto 2xl:max-w-[90vw]">
            <a href="#" class=""><span class="text-[#fff] font-bold text-md px-1">SEMIFINAL IRGL
                    2024</span></a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white bg-gradient-to-r from-[#6b2b52]  to-[#422a6a] rounded-lg  nav-custom:hidden focus:outline-none  hamburger"
                aria-controls="navbar-default" aria-expanded="true">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full nav-custom:block nav-custom:w-auto nav-custom:mb-0" id="navbar-default">
                <ul
                    class="hoi my-3 nav-custom:my-0 font-medium flex flex-col nav-custom:p-0 border nav-custom:text-sm  nav-custom:flex-row sm:space-x-8 lg:space-x-1 rtl:space-x-reverse nav-custom:mt-0 nav-custom:border-0 nav-custom:bg-white">
                    <li></li>
                    <li>
                        <a href="{{ route('semifinal.news') }}"
                            class="lg:text-lg lg:mx-5 mx-1 block py-2 px-3 text-white rounded hover:bg-gradient-to-r from-[#6b2b52]  to-[#422a6a] nav-custom:hover:bg-transparent nav-custom:border-0 nav-custom:p-0 ">News</a>
                    </li>
                    <li>
                        <a href="{{route('semifinal.inventory')}}"
                            class="lg:text-lg lg:mx-5 mx-1 block py-2 px-3 text-white rounded hover:bg-gradient-to-r from-[#6b2b52]  to-[#422a6a] nav-custom:hover:bg-transparent nav-custom:border-0 nav-custom:p-0 ">Inventory</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @yield('script')
</body>


<script>
    $(document).ready(function() {
        $('.hamburger').click(function() {
            $('#navbar-default').toggle();
        });

        $(window).resize(function() {
            if ($(window).width() > 1100) {
                $('#navbar-default').css('display', 'block');
            } else {
                $('#navbar-default').css('display', 'none');
            }
        });
        let prevScrollPos = $(window).scrollTop();

        $(window).on('scroll', function() {
            const currentScrollPos = $(window).scrollTop();

            if (prevScrollPos > currentScrollPos) {
                $('.navbar').removeClass('navbar-hidden');

            } else {
                $('.navbar').addClass('navbar-hidden');
                if ($(window).width() < 1100) {
                    $('#navbar-default').css('display', 'none');
                }
            }
            prevScrollPos = currentScrollPos;
        });
    });
</script>

</html>
