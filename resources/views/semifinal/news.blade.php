@extends('semifinal.layout-semifinal')

@section('style')
    <style>
        .content {
            background-color: rgba(255, 255, 255, 0.15);
            -webkit-animation: wrapperIn 2s, neon 1.5s ease infinite paused;
        }

        .contex {
            background-color: rgba(87, 8, 97, 0.5);
            box-shadow: 0 0 6px rgba(255, 255, 255, 0.5),
                0 0 3px rgba(87, 8, 97, 0.5),
                0 0 2px rgba(255, 255, 255, 0.5);
        }

        @keyframes wrapperIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
@endsection
@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center p-5">
        <div class="text-center text-[#fff] text-3xl font-bold tracking-widest mb-4 font-dm">
            IRGL NEWS
        </div>
        <div class="content p-4 rounded-xl contex text-white w-full max-w-md font-dm">
            <p class="text-sm text-justify">
                Sebuah website perusahaan multinasional yang bertempat di Kota Bytefall telah diretas 2 hari yang lalu.
                Peretasan ini diduga menggunakan metode SQL Injection. Peretas/hacker, menggunakan celah yang terdapat
                pada website tersebut untuk mengambil data-data perusahaan mulai dari data transaksi dan juga data
                pribadi karyawan perusahaan. Pihak Hacker menginginkan uang tebusan sebesar 10 Triliun Rupiah untuk
                pengembalian data milik perusahaan.
            </p>
        </div>
    </div>
@endsection
