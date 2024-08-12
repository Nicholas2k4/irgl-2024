<!-- <h1>Berisi logo irgl, prizepool, penjelasan lomba(about) </h1> -->
<div class="fade-slide-in rounded-lg flex flex-col items-center justify-center mb-[2.5vh] mt-[8.5vh] mx-auto">
<img src="\assets\logo\logo-02-02.png" id="glitchlogo" class="glitchimg w-[63vw] h-[63vw] mb-6">
<div class="w-screen flex justify-evenly items-center">
<h2 class="k text-base">TOTAL PRIZE : <br><br> RP 62.500.000 </h2>
<img src="\assets\sammy\sam24_hooray.png" class="w-[25vw] scale-x-[-1] pt-[13vh]">
</div>
<div id="about" class="m bg-white/70 justify-center items-center flex flex-col pb-2 rounded-lg mt-[8.5vh]">
<div class="glitch items-center justify-center drop-shadow-2xl">
<h2 class=" text-4xl font-bold text-gray-100 pt-4 pb-2 text-center fade-slide-in">ABOUT US</h2>
</div>

<div class="n w-[96%] pb-4 rounded-lg">
<h3 class="text-[16px] font-bold text-center">Informatics Rally Games and Logic adalah sebuah lomba yang diselenggarakan oleh Prodi Informatika Universitas Kristen Surabaya. Lomba ini diikuti oleh Siswa/i  SMA/SMK/MA/Sederajat se-Indonesia. Pada tahun ini IRGL 2024 mengusung tema “Cybernetic Dystopia”, tema ini menggambarkan sebuah negara yang kacau karena bebasnya arus informasi dan data pribadi yang menyebabkan eksploitasi dan penyalahgunaan informasi. Dengan tema ini kami berharap para peserta lomba IRGL 2024 menjadi sadar akan pentingnya menjaga data data pribadi dan lebih mengenal cara untuk menjaga data pribadi mereka 
</h3>
<br>
<h3 class="text-[16px] font-bold text-center">
Lomba ini akan diadakan secara hybrid dimana babak eliminasi akan dilaksanakan secara online, sedangkan babak semifinal dan final akan dilaksanakan secara offline di Universitas Kristen Petra. Setiap tim terdiri dari 3 orang Siswa/i SMA/SMK/MA/Sederajat yang berasal dari 1 sekolah yang sama.  Pemenang dari lomba ini akan berkesempatan mendapatkan hadiah uang tunai dan juga beasiswa dengan total Rp 62.500.000,-. 
</h3>
</div>
</div>

</div>
<style>
    .k{
        animation: glitch 725ms infinite;
        font-size: 3.5rem;
    }
    .m > div > h2 {
    letter-spacing: 12px;
    }

    .m{
        /* background-color:rgba(0, 0, 0, 0.15); */
        
    /* background: #6c6e65 border-box;
    box-shadow: 0px 0px 15px rgba(0, 255, 255, 0.5), 
                0px 0px 25px rgba(255, 0, 255, 0.5), 
                inset 0px 0px 10px rgba(0, 255, 255, 0.5), 
                inset 0px 0px 20px rgba(255, 0, 255, 0.5); */
    text-align: center;
    }

    .n > h3{
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
    </script>