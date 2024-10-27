@extends('layout.user')

@section('head')
    <style>
        * {
            font-family: 'Fira Code', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @keyframes flicker {

            0%,
            5%,
            10%,
            42%,
            55%,
            70%,
            85%,
            92% {
                box-shadow: 0 0 3px rgb(88, 219, 255), 0 0 8px rgb(88, 219, 255), 0 0 13px #023583;
            }

            2%,
            7%,
            20%,
            47%,
            60%,
            77%,
            89%,
            97% {
                box-shadow: 0 0 8px rgb(88, 219, 255), 0 0 20px rgb(88, 219, 255), 0 0 35px #023583;
            }

            3%,
            15%,
            50%,
            63%,
            75%,
            88%,
            95% {
                box-shadow: 0 0 3px rgb(88, 219, 255), 0 0 10px rgb(88, 219, 255), 0 0 20px #023583;
            }

            100% {
                box-shadow: 0 0 5px rgb(88, 219, 255), 0 0 15px rgb(88, 219, 255), 0 0 25px #023583;
            }
        }


        canvas {
            display: block;
        }

        .main-layer {
            backdrop-filter: blur(7.5px) brightness(0.9);
            -webkit-backdrop-filter: blur(7.5px) brightness(0.9);
        }

        .question-container {
            /* box-shadow: 0 0 20px white, 0 0 60px white, 0 0 100px #023583; */
            animation: flicker 15s 1s infinite;
            transition: all .5s ease;
            background-color: rgba(51, 123, 238, 0.401);
            backdrop-filter: blur(10px) brightness(0.65);
        }

        .input-answer {
            box-shadow: 0 0 5px rgb(219, 64, 247), 0 0 8px rgb(137, 64, 247);
            transition: all .4s ease;
            background-color: rgba(219, 64, 247, 0.3) !important;
        }

        .input-answer:focus {
            /* box-shadow: 0 0 5px white, 0 0 8px white; */
            box-shadow: 0 0 5px white, 0 0 12px rgb(132, 228, 255);
            outline: none;
        }

        .input-answer::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .animate-button {
            transition: all .2s ease;
            box-shadow: 0 0 5px white, 0 0 8px rgb(132, 228, 255);
        }

        .animate-button:hover {
            box-shadow: 0 0 8px white, 0 0 13px rgb(132, 228, 255);
        }

        .animate-button:active {
            box-shadow: 0 0 2px white, 0 0 3px rgb(132, 228, 255);
        }

        body {
            overflow-x: hidden;
        }

        .info {
            box-shadow: 0 0 5px white, 0 0 15px white, 0 0 25px #023583;
            background-color: rgba(213, 44, 191, 0.351);
        }
    </style>
@endsection

@section('content')
    <div class="main-bg w-screen h-screen flex justify-center items-center fixed top-0 left-0">
        <video src="{{ asset('assets/bg-video.mp4') }}" autoplay loop muted playsinline
            class="w-screen object-cover relative">
        </video>
        <img src="{{ asset('assets/logo/logo-02-02.png') }}" class="w-[47%] absolute">
    </div>
    <a href="{{ route('final.game2') }}" class="contents">
        <button
            class="fixed top-0 right-0 mt-8 mr-8 z-[100] animate-button bg-[#853987] bg-opacity-70 text-zinc-100 text-sm rounded-xl w-fit px-4 py-2 h-fit">
            Go to Decode</button>
    </a>
    <div class="main-layer fixed w-screen min-h-screen z-50 top-0 left-0">
    </div>
    <div class="absolute w-screen min-h-screen z-50 top-0 left-0">
        <div class="w-full h-full flex items-center flex-col">
            <h1 class="w-full text-center text-4xl text-white font-semibold my-8">Final Cryptography</h1>
            <div class="question-container w-[800px] h-fit p-8 rounded-xl bg-opacity-30 my-8">
                <p class="text-zinc-100">{!! env('SET_A') !!}</p>
                {{-- Tambahi image --}}
                <div class="flex justify-center items-center mt-8 gap-x-8">
                    <input type="text" placeholder="Answer here"
                        class="input-answer bg-transparent rounded-lg w-full h-[40px] px-4 text-zinc-100">
                    <button id="submit-set-a"
                        class="submit-button animate-button bg-[#853987] bg-opacity-70 text-zinc-100 text-sm rounded-lg w-[300px] h-[40px]"
                        name="{{ $question->id }}" data-te-ripple-init data-te-ripple-color="light">
                        Submit This Answer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitAnswer(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    let answer = document.getElementById('answer-' + id).value;
                    $.ajax({
                        url: "{{ route('final.game1.store', '') }}/" + id,
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "answer": answer
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Oops...',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                })
                            }
                        },
                        error: function(response) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    });
                }
            })

        }

        let submitButtons = document.querySelectorAll('.submit-button');
        for (let i = 0; i < submitButtons.length; i++) {
            let questionId = parseInt(submitButtons[i].name, 10)
            submitButtons[i].addEventListener('click', function() {
                submitAnswer(questionId);
            })
        }
    </script>
@endsection
