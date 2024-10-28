<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IRGL 2024 | {{ $title }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="{{ asset('asset/logo-02-02.png') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fira+Code:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Ubuntu+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');

        .opensans {
            font-family: 'Open Sans', sans-serif !important;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .swal2-confirm {
            background: rgb(46, 143, 255) !important;
        }

        .swal2-deny,
        .swal2-cancel {
            background: rgb(255, 79, 79) !important;
        }

        .incorrected {
            animation: flickerIncorrect 15s 1s infinite !important;
            transition: all .5s ease;
            background-color: rgba(51, 123, 238, 0.401);
            backdrop-filter: blur(10px) brightness(0.65);
        }

        @keyframes flickerIncorrect {

            0%,
            5%,
            10%,
            42%,
            55%,
            70%,
            85%,
            92% {
                box-shadow: 0 0 3px red, 0 0 8px red, 0 0 13px red;
            }

            2%,
            7%,
            20%,
            47%,
            60%,
            77%,
            89%,
            97% {
                box-shadow: 0 0 8px red, 0 0 20px red, 0 0 35px red;
            }

            3%,
            15%,
            50%,
            63%,
            75%,
            88%,
            95% {
                box-shadow: 0 0 3px red, 0 0 10px red, 0 0 20px red;
            }

            100% {
                box-shadow: 0 0 5px red, 0 0 15px red, 0 0 25px red;
            }
        }
    </style>

    <script type="importmap">
        {
            "imports": {
                "three": "https://cdn.jsdelivr.net/npm/three@0.164.1/build/three.module.js",
                "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.164.1/examples/jsm/"
            }
        }
    </script>
    @yield('head')
</head>

<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
</body>

</html>
