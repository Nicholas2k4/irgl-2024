<style>
    .k {
        animation: glitch 725ms infinite;
        font-size: 9vw;
        line-height: 15px;
    }

    .m>div>h2 {
        letter-spacing: 12px;
    }

    .m {
        /* background-color:rgba(0, 0, 0, 0.15); */

        /* background: #6c6e65 border-box;
    box-shadow: 0px 0px 15px rgba(0, 255, 255, 0.5),
                0px 0px 25px rgba(255, 0, 255, 0.5),
                inset 0px 0px 10px rgba(0, 255, 255, 0.5),
                inset 0px 0px 20px rgba(255, 0, 255, 0.5); */
        text-align: center;
    }

    .n>h3 {
        text-shadow: 0px 0px 10px #fff, 0px 0px 20px #00ffff, 0px 0px 30px #ff00ff;
    }

    @keyframes glitchimage {
        0% {
            background: url('../assets/logo/logo-02-02.png');
            width: 63vh;
            height: 63vw;
            margin-bottom: 24px;
        }

        13% {
            background: url('../assets/logo/glitchlogo1.png');
            width: 63vh;
            height: 63vw;
            margin-bottom: 24px;
        }

        25% {
            background: url('../assets/logo/glitchlogo2.png');
            width: 63vh;
            height: 63vw;
            margin-bottom: 24px;
        }

        37% {
            background: url('../assets/logo/glitchlogo3.png');
            width: 63vh;
            height: 63vw;
            margin-bottom: 24px;
        }

        50% {
            background: url('../assets/logo/glitchlogo4.png');
            width: 63vh;
            height: 63vw;
            margin-bottom: 24px;
        }

        63% {
            background: url('../assets/logo/glitchlogo5.png');
            width: 63vh;
            height: 63vw;
            margin-bottom: 24px;
        }

        75% {
            background: url('../assets/logo/glitchlogo6.png');
            width: 63vh;
            height: 63vw;
            margin-bottom: 24px;
        }

        87% {
            background: url('../assets/logo/glitchlogo7.png');
            width: 63vh;
            height: 63vw;
            margin-bottom: 24px;
        }

        100% {
            background: url('../assets/logo/glitchlogo3.png');
            width: 63vh;
            height: 63vw;
            margin-bottom: 24px;
        }

    }
</style>
<div class="fade-slide-in rounded-lg flex flex-col items-center justify-center mb-[2.5vh] mx-auto">


    <img src="\assets\logo\logo-02-02.png" id="glitchlogo" class="glitchimg w-[63vw] h-[63vw] mb-6">



    <div class="w-full flex flex-col items-center justify-center mb-10">
        <h1 class="px-3 text-white text-center pt-[6vh] text-5xl font-black"
            style="text-shadow: 2px 2px 4px rgb(151, 22, 165), -2px -2px 3px rgba(122, 34, 19);">TOTAL PRIZE</h1>
        <h1 class="px-3 text-white text-center text-5xl font-black"
            style="text-shadow: 2px 2px 4px rgb(151, 22, 165), -2px -2px 3px rgb(122, 34, 19);">Rp 62.500.000</h1>
        <img src="\assets\sammy\sam24_hooray.png" class="w-[35vw] pt-[1vh]">
    </div>

    <div class="w-screen py-[-14px] my-[-14px] flex justify-evenly items-center">

    </div>

    <!-- Modal background (semi-transparent overlay) -->
    <div id="modalOverlay" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">

        <!-- Modal content -->
        <div id="modalContent" class="bg-white rounded-lg shadow-lg w-1/3 p-6">
            <h2 class="text-lg font-semibold mb-4">Modal Title</h2>
            <p>This is the modal content. You can put anything here.</p>
            <button class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700"
                onclick="closeModal()">Close</button>
        </div>
    </div>

    <div id="about" class="m bg-black/30 justify-center items-center flex flex-col pb-2 rounded-lg mt-8 p-8">
        <div class="glitch items-center justify-center drop-shadow-2xl">
            <h2 class=" text-5xl font-bold text-gray-100 mb-4 text-center fade-slide-in p-4">ABOUT US</h2>
        </div>

        <div class="n w-[96%] pb-4 rounded-lg">
            <h3 class="text-[16px] font-bold text-center text-white">Informatics Rally Games and Logic adalah sebuah lomba yang
                diselenggarakan oleh Prodi Informatika Universitas Kristen Surabaya. Lomba ini diikuti oleh Siswa/i
                SMA/SMK/MA/Sederajat se-Indonesia. Pada tahun ini IRGL 2024 mengusung tema “Cybernetic Dystopia”, tema
                ini menggambarkan sebuah negara yang kacau karena bebasnya arus informasi dan data pribadi yang
                menyebabkan eksploitasi dan penyalahgunaan informasi. Dengan tema ini kami berharap para peserta lomba
                IRGL 2024 menjadi sadar akan pentingnya menjaga data data pribadi dan lebih mengenal cara untuk menjaga
                data pribadi mereka
            </h3>
            <br>
            <h3 class="text-[16px] font-bold text-center text-white">
                Lomba ini akan diadakan secara hybrid dimana babak eliminasi akan dilaksanakan secara online, sedangkan
                babak semifinal dan final akan dilaksanakan secara offline di Universitas Kristen Petra. Setiap tim
                terdiri dari 3 orang Siswa/i SMA/SMK/MA/Sederajat yang berasal dari 1 sekolah yang sama. Pemenang dari
                lomba ini akan berkesempatan mendapatkan hadiah uang tunai dan juga beasiswa dengan total Rp
                62.500.000,-.
            </h3>
        </div>
    </div>

</div>

<script>
    let glitchicon = document.getElementById('glitchlogo')

    async function glitchlogo() {
        const delay = ms => new Promise(resolve => setTimeout(resolve, ms));

        const setGlitchIcon = async (src, duration) => {
            glitchicon.src = src;
            await delay(duration);
        };

        while (true) {
            await setGlitchIcon('../assets/logo/logo-02-02.png', 175);
            await setGlitchIcon('../assets/logo/glitchlogo1.png', 175);
            await setGlitchIcon('../assets/logo/glitchlogo2.png', 175);
            await setGlitchIcon('../assets/logo/glitchlogo3.png', 175);
            await setGlitchIcon('../assets/logo/glitchlogo4.png', 175);
            await setGlitchIcon('../assets/logo/glitchlogo5.png', 175);
            await setGlitchIcon('../assets/logo/glitchlogo6.png', 175);
            await setGlitchIcon('../assets/logo/glitchlogo7.png', 175);
            glitchicon.src = '../assets/logo/logo-02-02.png';
            await delay(1750);
        }
    }
    glitchlogo();

    let glitchContainer = document.getElementById('glitchContainer');
    glitchContainer.addEventListener('click', () => {
        document.getElementById('modalOverlay').classList.remove('hidden');
        document.getElementById('modalOverlay').classList.add('z-50');
    });

    function closeModal() {
        document.getElementById('modalOverlay').classList.add('hidden');
        document.getElementById('modalOverlay').classList.remove('z-50');
    }
</script>
