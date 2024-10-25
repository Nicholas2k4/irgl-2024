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
            <div class="bg-black w-full h-full p-1 rounded-b-lg overflow-y-scroll" id="terminal">
                <p class="text-green-500 leading-tight">IRGL Final Command Prompt</p>
                <p class="text-green-500 leading-tight">Copyright © IRGL Corporation. All rights reserved.</p><br>
                <p class="text-green-500 leading-tight">Complete this final game within 120 minutes! Goodluck Cyber Savants!
                </p><br>
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
        let index = 0;
        let terminal = document.getElementById('terminal');

        // Array of correct answers for each command prompt
        var correctAnswer = "DECODETHECYPHER"; // Replace with your actual answers

        function terminalInit() {
            appendComponent(index);
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                checkAnswer(index); // Check if the answer is correct
                disableInputs(index); // Disable the current input row
                index++;

                appendComponent(index); // Add the next row for input
            }
        });

        function appendComponent(index) {
            let newCmd = document.createElement('div');
            newCmd.innerHTML = `<x-cmd index=${index}></x-cmd>`;
            terminal.appendChild(newCmd);

            let letterInputs = document.querySelectorAll(`.letter-input${index}`);
            letterInputs.forEach((input, i) => {
                input.addEventListener('keyup', function(event) {
                    handleInputKey(event, letterInputs, i);
                });
            });
            letterInputs[0].focus();
        }

        function handleInputKey(event, letterInputs, i) {
            if (event.key.length === 1) {
                if (i < letterInputs.length - 1) {
                    letterInputs[i + 1].focus();
                }
            } else if (event.key === 'Backspace') {
                if (i > 0) {
                    letterInputs[i - 1].focus();
                }
            } else if (event.key === 'ArrowLeft') {
                if (i > 0) {
                    letterInputs[i - 1].focus();
                }
            } else if (event.key === 'ArrowRight') {
                if (i < letterInputs.length - 1) {
                    letterInputs[i + 1].focus();
                }
            }
        }

        function disableInputs(index) {
            let letterInputs = document.querySelectorAll(`.letter-input${index}`);
            letterInputs.forEach((input) => {
                input.disabled = true;
            });
        }

        function checkAnswer(index) {
            let letterInputs = document.querySelectorAll(`.letter-input${index}`);
            let userAnswer = "";

            // Concatenate the input values into a string
            letterInputs.forEach((input) => {
                userAnswer += input.value.toUpperCase(); // Convert to uppercase for case-insensitive comparison
            });


            // Compare the user input with the correct answer
            if (userAnswer === correctAnswer) {
                $.ajax({
                    method: "POST",
                    url: "{{ route('final.game2.store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        answer: userAnswer
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Congratulations',
                            text: response.message,
                            icon: 'success',
                        }).then(() => {
                            window.location.href = "{{ route('final.game3') }}";
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Error!',
                            text: response.responseJSON.message,
                            icon: 'error',
                        })
                        console.log(response);
                    }
                })
            } else {
                displayFeedback("Incorrect answer!");
            }
        }

        function displayFeedback(message) {
            let feedback = document.createElement('p');
            feedback.classList.add('text-red-500', 'leading-tight');
            feedback.textContent = message;
            terminal.appendChild(feedback);
        }

        terminalInit();
    </script>
@endsection
