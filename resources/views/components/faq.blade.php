<style>
    .chats {
        font-family: "Share Tech Mono", monospace;
        font-weight: 700;
        grid-template-rows: auto 422px auto;
    }

    .chat {
        letter-spacing: 0;
        transition: width 0.26s linear, height 0.4s linear;
        overflow: hidden !important;
    }

    .chat-header {
        background-image: linear-gradient(to bottom right, rgba(144, 0, 166, 0.8), rgba(8, 71, 207, 0.67));
    }

    .chat-footer {
        background-image: linear-gradient(to top left, rgba(144, 0, 166, 0.8), rgba(8, 71, 207, 0.67));
    }

    .user-chat {
        background-color: #0847cf;
    }

    .chat-area,
    .chats {
        background: rgba(0, 0, 0, 0.1);
    }

    .chat-area::-webkit-scrollbar-track {
        background-color: #1d1a4d !important;
    }

    .question-container::-webkit-scrollbar-track {
        background-color: #1d1a4d !important;
    }

    .question-container {
        transition: none !important;
        animation: none !important;
    }

    .question {
        background-color: rgba(144, 0, 166, 0.8);
        border-color: #0847cf;
        transition: all .3s ease;
    }

    .reply-text {
        background-color: rgba(144, 0, 166, 0.8);
    }

    .question:hover {
        background-color: rgba(144, 0, 166, 0.68);
        color: white;
    }

    .question:active {
        background-color: rgba(144, 0, 166, 0.68);
    }

    .chat-istyping-container {
        opacity: 1;
        width: 60px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        transition: width 0.26s linear, height 0.4s linear;
    }

    .chat-istyping-circle-1,
    .chat-istyping-circle-2,
    .chat-istyping-circle-3 {
        position: relative;
        width: 11px;
        height: 11px;
        background-color: white;
        float: left;
        margin-right: 4px;
        border-radius: 100%;
        animation: typing-bounce-ball 1.5s linear 0s infinite forwards;
    }

    .chat-istyping-circle-2 {
        animation-delay: 0.2s;
    }

    .chat-istyping-circle-3 {
        animation-delay: 0.4s;
        margin-right: 0;
    }

    @keyframes typing-bounce-ball {
        0% {
            transform: scaleX(1) scaleY(1) translateY(0);
        }

        20% {
            transform: scaleX(1) scaleY(1) translateY(0);
        }

        30% {
            transform: scaleX(1.35) scaleY(0.35) translateY(100%);
        }

        49% {
            transform: scaleX(0.7) scaleY(1.2) translateY(-50%);
        }

        51% {
            transform: scaleX(0.7) scaleY(1.2) translateY(-50%);
        }

        70% {
            transform: scaleX(1.35) scaleY(0.35) translateY(100%);
        }

        80% {
            transform: scaleX(1) scaleY(1) translateY(0);
        }

        100% {
            transform: scaleX(1) scaleY(1) translateY(0);
        }
    }
</style>
<div class="faq fixed bottom-0 right-0 m-5 z-[9]">
    <button type="button"
        class="text-3xl rounded-full w-[50px] h-[50px] flex justify-center items-center bg-primary bg-opacity-70 px-6 pb-2 pt-2.5 font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:shadow-primary-2"
        data-twe-toggle="modal" data-twe-target="#exampleModalCenter" data-twe-ripple-init data-twe-ripple-color="light">
        ?
    </button>
</div>
<div data-twe-modal-init
    class="fixed left-0 top-0 z-[9999] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
    <div data-twe-modal-dialog-ref
        class="pointer-events-none relative bg-transparent flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] md:max-w-[700px] max-md:max-w-[380px] max-sm:max-w-[310px]">
        <div
            class="pointer-events-auto relative flex w-full flex-col rounded-3xl border-none bg-white bg-clip-padding text-current shadow-4 outline-none">

            <!-- Modal body -->
            <div class="relative">
                <div
                    class="chats grid md:w-[700px] max-md:w-[380px] max-sm:w-[310px] h-[550px] rounded-3xl overflow-hidden !z-50">
                    <div class="chat-header w-full h-[70px] rounded-t-2xl flex justify-between items-center">
                        <div class="flex justify-start items-center">
                            <img src="{{ asset('assets/sammy/sam-profile.png') }}" alt="faq-maskot"
                                class="rounded-full h-11 bg-yellow-400 mx-4">
                            <p class="text-lg font-bold max-sm:text-base text-white" data-aos="fade-down"
                                data-aos-once="true">
                                SAM-24</p>
                        </div>
                        <!-- Close button -->
                        <button type="button"
                            class="box-content rounded-none border-none mr-6 text-white focus:opacity-100 focus:shadow-none focus:outline-none"
                            data-twe-modal-dismiss aria-label="Close">
                            <span class="[&>svg]:h-6 [&>svg]:w-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <div class="chat-area pt-4 chat-section overflow-y-scroll overflow-x-hidden">
                        <div class="chatAnswer flex">
                            <img src="{{ asset('assets/sammy/sam-profile.png') }}" alt="faq-maskot"
                                class="rounded-full h-8 bg-yellow-400 ml-4 mr-3">
                            <p
                                class="chat overflow-visible text-white sm:text-base max-sm:text-sm w-fit px-3 py-2
                            reply-text rounded-tr-2xl rounded-br-2xl rounded-bl-2xl my-5 md:max-w-[450px] max-sm:max-w-[200px]">
                                Halooo 😁, perkenalkan namaku SAM-24. Aku akan menjawab pertanyaan kalian seputar
                                acara IRGL 2024.
                            </p>
                        </div>
                    </div>

                    <div
                        class="chat-footer w-full h-[58px] rounded-b-2xl flex justify-between place-self-end items-center">
                        <p class="ml-5 font-bold max-sm:text-xs text-white">Choose your question here</p>
                        <div class="flex items-center h-full" data-twe-dropdown-position="dropup">
                            <i class="!transition-none fa-regular fa-comment-dots mx-5 text-2xl hover:cursor-pointer text-white"
                                type="button" id="question-menu" data-twe-dropdown-toggle-ref aria-expanded="false"
                                data-twe-ripple-init data-twe-ripple-color="light">
                            </i>
                            <ul class="!transition-none question-container absolute z-[1000] float-left m-0 hidden min-w-max h-[180px] overflow-y-scroll list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-base shadow-lg data-[twe-dropdown-show]:block"
                                aria-labelledby="question-menu" data-twe-dropdown-menu-ref>
                                <li class="!block">
                                    <p class="question text-white w-[300px] block border-b-2 px-4 py-2 text-sm max-sm:text-xs font-bold hover:cursor-pointer"
                                        href="#" data-twe-dropdown-item-ref question-code="0">Penjelasan IRGL
                                    </p>
                                </li>
                                <li class="!block">
                                    <p class="question text-white w-[300px] block border-b-2 px-4 py-2 text-sm max-sm:text-xs font-bold hover:cursor-pointer"
                                        href="#" data-twe-dropdown-item-ref question-code="1">Komposisi tim
                                    </p>
                                </li>
                                <li class="!block">
                                    <p class="question text-white w-[300px] block border-b-2 px-4 py-2 text-sm max-sm:text-xs font-bold hover:cursor-pointer"
                                        href="#" data-twe-dropdown-item-ref question-code="2">Akomodasi luar
                                        kota</p>
                                </li>
                                <li class="!block">
                                    <p class="question text-white w-[300px] block border-b-2 px-4 py-2 text-sm max-sm:text-xs font-bold hover:cursor-pointer"
                                        href="#" data-twe-dropdown-item-ref question-code="3">Timeline</p>
                                </li>
                                <li class="!block">
                                    <p class="question text-white w-[300px] block border-b-2 px-4 py-2 text-sm max-sm:text-xs font-bold hover:cursor-pointer"
                                        href="#" data-twe-dropdown-item-ref question-code="4">Biaya
                                        pendaftaran</p>
                                </li>
                                <li class="!block">
                                    <p class="question text-white w-[300px] block border-b-2 px-4 py-2 text-sm max-sm:text-xs font-bold hover:cursor-pointer"
                                        href="#" data-twe-dropdown-item-ref question-code="5">Kegiatan lomba
                                    </p>
                                </li>
                                <li class="!block">
                                    <p class="question text-white w-[300px] block border-b-2 px-4 py-2 text-sm max-sm:text-xs font-bold hover:cursor-pointer"
                                        href="#" data-twe-dropdown-item-ref question-code="6">Hadiah</p>
                                </li>
                                <li class="!block">
                                    <p class="question text-white w-[300px] block border-b-2 px-4 py-2 text-sm max-sm:text-xs font-bold hover:cursor-pointer"
                                        href="#" data-twe-dropdown-item-ref question-code="7">Lokasi
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const chatSection = document.querySelector('.chat-section');

    const answerArray = [
        'IRGL adalah acara tahunan yang diselenggarakan oleh prodi Informatika Universitas Kristen Petra Surabaya 🧑‍💻, lomba ini mempertemukan Siswa/i SMA/SMK/MA/Sederajat se-Indonesia untuk mendapatkan hadiah 🤩',
        'Satu tim terdiri dari 3 orang siswa/i yang berasal dari 1 sekolah yang sama, untuk tingkat kelas dapat dicampur dalam satu tim',
        'Sayang sekali 😔, saat ini masih belum tersedia akomodasi dari luar kota',
        'Technical meeting diadakan pada tanggal 19 Oktober 2024, babak eliminasi dari tanggal 21-23 Oktober 2024 dan babak semifinal dan final dilaksanakan pada 2 November 2024 📅',
        'Untuk periode early bid dengan harga Rp 150.000,- dan periode normal dengan harga Rp 225.000,-. IRGL menggunakan sistem deposito, dimana jika peserta tidak lolos sampai babak semifinal maka uang peserta akan dikembalikan.',
        'Peserta akan bermain rally game dan mengerjakan soal soal yang berhubungan dengan logika 🧠 dan matematika dasar ➕. Jangan khawatir, tidak ada soal yang berhubungan dengan coding atau pemrograman 😁',
        'Pemenang dari lomba ini akan berkesempatan mendapatkan hadiah uang tunai dan juga beasiswa dengan total Rp 62.500.000,-',
        'Babak eliminasi akan dilakukan secara online, dimana seluruh anggota dalam satu tim wajib berada di lokasi yang sama. Sedangkan untuk babak semifinal dan final akan dilaksanakan secara offline di Universitas Kristen Petra Surabaya',
    ];

    var replyUser = function(answer) {
        const questionButton = document.getElementById('question-menu');
        const chatResponse = document.createElement('div');
        chatResponse.classList.add('chatAnswer', 'pt-4', 'flex');

        const chatProfile = document.createElement('img');
        chatProfile.src = 'assets/sammy/sam-profile.png';
        chatProfile.alt = 'faq-maskot';
        chatProfile.classList.add('rounded-full', 'h-8', 'bg-yellow-400', 'ml-4', 'mr-3');

        const replyText = document.createElement('div');
        replyText.classList.add('chat', 'overflow-visible', 'text-white', 'sm:text-base', 'max-sm:text-sm',
            'w-fit', 'sm:max-w-[250px]', 'md:max-w-[450px]', 'max-sm:max-w-[200px]',
            'px-3', 'py-2',
            'reply-text', 'rounded-tr-2xl', 'rounded-br-2xl', 'rounded-bl-2xl', 'my-5');
        replyText.innerHTML = `
<div class="chat-istyping-container">
<div class="chat-istyping-circle-1"></div>
<div class="chat-istyping-circle-2"></div>
<div class="chat-istyping-circle-3"></div>
</div>
`;

        questionButton.disabled = true;
        setTimeout(function() {
            // const chatElements = document.querySelectorAll('.chat');
            // const lastChatElement = chatElements[chatElements.length - 1];

            replyText.style.width = '0px';
            replyText.style.height = '0px';
        }, 1700);

        setTimeout(function() {
            replyText.style.width = '900px';
            replyText.style.height = 'auto';
            replyText.innerHTML = answer;
            chatSection.scrollTop = chatSection.scrollHeight;
            questionButton.disabled = false;
        }, 2000);
        chatResponse.appendChild(chatProfile);
        chatResponse.appendChild(replyText);

        chatSection.appendChild(chatResponse);
    }

    function makeChat(e) {
        var questionText = e.currentTarget.innerHTML;
        var questionCode = e.currentTarget.getAttribute('question-code');

        const userChat = document.createElement('div');
        userChat.classList.add('userAnswer', 'pt-5', 'flex', 'justify-end');
        const textChat = document.createElement('p');
        textChat.classList.add('chat', 'user-chat', 'overflow-visible', 'text-white', 'sm:text-base', 'max-sm:text-sm',
            'px-3', 'py-2', 'backdrop-opacity-80', 'rounded-tr-2xl', 'rounded-bl-2xl', 'rounded-tl-2xl', 'mr-4',
            'w-fit', 'sm:max-w-[250px]', 'md:max-w-[450px]', 'max-sm:w-[200px]');

        textChat.textContent = questionText;

        userChat.appendChild(textChat);
        chatSection.appendChild(userChat);
        chatSection.scrollTop = chatSection.scrollHeight;
        setTimeout(function() {
            replyUser(answerArray[questionCode]);
            chatSection.scrollTop = chatSection.scrollHeight;
        }, 400);
    }

    document.querySelectorAll('.question').forEach(item => {
        item.addEventListener('click', makeChat);
    });
</script>
