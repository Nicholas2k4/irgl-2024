@extends('layout.user')


@section('head')
    <style>
        * {
            font-family: 'Fira Code', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), linear-gradient(135deg, #ff4dff, #9d00ff, #001eff, #00f0ff);
            min-height: 100vh;
            width: 100vw;
            background-size: 300% 300%;
            animation: gradient 15s infinite;
        }
    </style>
@endsection
@section('content')
    <section class="w-full h-screen flex justify-center items-center">
        <div class="w-[950px] h-[500px] bg-neutral-700 rounded-xl">
            <div class="w-full h-[50px] flex items-end pl-2">
                <div class="bg-black rounded-t-lg w-[277px] h-[40px] p-2 text-white flex items-center">
                    <img src="{{ asset('assets/logo/logo-02-02.png') }}" alt="irgl-logo" class="w-[25px] mr-2">
                    <p class=" text-sm font-bold opensans">IRGL Final Command Prompt</p>
                </div>
            </div>
            <div class="bg-black w-full h-full p-1 rounded-b-lg">
                <p class="text-green-500 leading-tight">IRGL Final Command Prompt</p>
                <p class="text-green-500 leading-tight">Copyright © IRGL Corporation. All rights reserved.</p><br>
                <p class="text-green-500 leading-tight">Complete this final game within 120 minutes! Goodluck Cyber Savants!
                </p><br>
                <x-commandLine>
                {{-- <div class="flex">
                    <p class="text-green-500 leading-tight">IRGL C:\Users\NamaTim></p>

                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-8 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-8 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                    <input type="text" maxlength="1"
                        class="ml-4 letter-input border-b border-green-500 bg-transparent w-[23px] h-[20px] text-center text-green-500 focus:outline-none">
                </div> --}}
            </div>
        </div>
    </section>


    <script>
        var letterInputs = document.querySelectorAll('.letter-input');

        letterInputs.forEach((input, index) => {
            input.addEventListener('keyup', function(event) {
                if (event.key.length === 1) {
                    if (index < letterInputs.length - 1) {
                        letterInputs[index + 1].focus();
                    }
                } else if (event.key === 'Backspace') {
                    if (index > 0) {
                        letterInputs[index - 1].focus();
                    }
                } else if (event.key === 'ArrowLeft') {
                    if (index > 0) {
                        letterInputs[index - 1].focus();
                    }
                } else if (event.key === 'ArrowRight') {
                    if (index < letterInputs.length - 1) {
                        letterInputs[index + 1].focus();
                    }
                }
            });
        });
    </script>
@endsection
