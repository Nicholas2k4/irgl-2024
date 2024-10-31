@extends('semifinal.layout-semifinal')

@section('style')
    <style>
        .content {
            background-color: rgba(87, 8, 97, 0.5);
            box-shadow:
                inset 0 0 10px rgba(0, 0, 0, 0.7),
                0 0 10px rgba(255, 255, 255, 0.5),
                0 0 6px rgba(87, 8, 97, 0.5);
            border-radius: 12px;
        }
    </style>
@endsection

@section('content')
    <div class="flex flex-col items-center justify-center p-5">
        <div class="w-full flex justify-between items-center px-1">
            <div class="flex items-center text-white text-lg">
                <span class=" text-2xl font-dm font-bold">INVENTORY</span>
            </div>
            <div class="flex items-center space-x-2 text-white text-lg">
                <img src="{{ asset('assets/point.png') }}" class="w-5 h-5" alt="Coin Icon">
                <span class=" text-base font-dm">999999</span>
            </div>
        </div>
        <div class="content p-8 mx-7 rounded-xl text-white w-full max-w-md mt-4 overflow-y-auto max-h-[400px]">
            <div class="grid grid-cols-4 lg:grid-cols-6 gap-6 ">
                <div class="relative col-span-2">
                    <img src="{{ asset('assets/irgl1.png') }}" alt="Icon 1">
                    <div
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                    <h2 class="text-white text-center font-dm">Rp. 5000</h2>
                </div>
                <div class="relative col-span-2">
                    <img src="{{ asset('assets/irgl2.png') }}" alt="Icon 1">
                    <div
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                    <h2 class="text-white text-center font-dm">Rp. 5000</h2>
                </div>
                <div class="relative col-span-2">
                    <img src="{{ asset('assets/irgl3.png') }}" alt="Icon 1">
                    <div
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                    <h2 class="text-white text-center font-dm">Rp. 5000</h2>
                </div>
                <div class="relative col-span-2">
                    <img src="{{ asset('assets/irgl4.png') }}" alt="Icon 1">
                    <div
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                    <h2 class="text-white text-center font-dm">Rp. 5000</h2>
                </div>
                <div></div>
                <div class="relative col-span-2">
                    <img src="{{ asset('assets/irgl5.png') }}" alt="Icon 1">
                    <div
                        class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        2
                    </div>
                    <h2 class="text-white text-center font-dm">Rp. 5000</h2>
                </div>
            </div>
        </div>
        <div class="w-full flex justify-center items-center px-3 pt-1">
            <div class="flex items-center space-x-2 text-white text-sm">
                <h1> <b>NB: </b> The display price is the current prize</h1>
            </div>
        </div>

    </div>
@endsection
