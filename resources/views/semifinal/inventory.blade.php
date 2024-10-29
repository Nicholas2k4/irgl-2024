@extends('semifinal.layout-semifinal')

@section('style')
    <style>
        .content {
            background-color: rgba(87, 8, 97, 0.5);
            box-shadow: 0 0 6px rgba(255, 255, 255, 0.5),
                0 0 3px rgba(87, 8, 97, 0.5),
                0 0 2px rgba(255, 255, 255, 0.5);
        }
    </style>
@endsection

@section('content')
    <div class="fixed top-20 w-full flex items-center justify-center px-7 py-3">
        <div class="flex items-center space-x-2 text-white text-lg">
            <div class="text-center text-[#fff] text-3xl font-bold tracking-widest mb-4 font-dm">
                INVENTORY
            </div>
        </div>
    </div>
    <div class="min-h-screen flex flex-col items-center justify-center p-5">
        <div class="w-full flex justify-end items-end px-3">
            <div class="flex items-center space-x-2 text-white text-lg">
                <img src="{{ asset('assets/point.png') }}" class="w-5 h-5" alt="Coin Icon">
                <span class=" text-base font-dm">999999</span>
            </div>
        </div>
        <div class="content p-10 mx-7 rounded-xl text-white w-full max-w-md mt-4">
            <div class="grid grid-cols-4 lg:grid-cols-6 gap-8 place-items-center">
                <div class="relative col-span-2">
                    <img src="{{ asset('assets/irgl1.png') }}" alt="Icon 1" class="w-full h-full">
                    <div
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                </div>
                <div class="relative col-span-2">
                    <img src="{{ asset('assets/irgl2.png') }}" alt="Icon 1" class="w-full h-full">
                    <div
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                </div>
                <div class="relative col-span-2">
                    <img src="{{ asset('assets/irgl3.png') }}" alt="Icon 1" class="w-full h-full">
                    <div
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                </div>
                <div class="relative col-span-2">
                    <img src="{{ asset('assets/irgl4.png') }}" alt="Icon 1" class="w-full h-full">
                    <div
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                </div>
                <div></div>
                <div class="relative col-span-2">
                    <img src="{{ asset('assets/irgl5.png') }}" alt="Icon 1" class="w-full h-full">
                    <div
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
