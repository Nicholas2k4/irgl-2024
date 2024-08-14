<style>
    /* .l{
        border-bottom: 3px solid;
        border-color: #edabe9;
        border-image-slice: 1;

        box-shadow: 0 3px 5px 2px #edabe9;
    }*/
    /* .l>div>a {
        box-shadow: 0 6px 4px -4px #9df2f2,
            0 8px 4px -3px #d6ed6f,
            0 14px 6px -5px #d6ed6f,
            0 17px 10px -9px #ffffff;
        font-weight: bold;
    } */

     .pirgl{
        text-shadow: 0 0 12px rgba(175, 0, 255, 0.95);
        
     }

     .neon-purple-button svg {
    stroke: rgba(175, 0, 255, 0.75);
    filter: drop-shadow(0 0 10px rgba(175, 0, 255, 0.75))
            drop-shadow(0 0 20px rgba(175, 0, 255, 0.75))
            drop-shadow(0 0 30px rgba(175, 0, 255, 0.75));
}

#menuhtop {
    transition: transform 0.2s ease-in-out;
}
body{
    scroll-behavior: smooth;
}
</style>

<header class="flex justify-center mb-[7vh]">
    <nav class="l w-[100%] h-[8vh] fixed flex flex-row z-20 mx-auto justify-between">
        <div class="w-full h-screen p-2" id="menuhtop">

        <div class="w-full flex justify-center items-center px-4">
            <button onclick="displayMenuh()" class="neon-purple-button">
                <svg id="menuBurger" class="hover:stroke-slate-50" width="30px" height="30px" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 18L20 18" stroke="#7d70b8" stroke-width="2" stroke-linecap="round" />
                    <path d="M4 12L20 12" stroke="#7d70b8" stroke-width="2" stroke-linecap="round" />
                    <path d="M4 6L20 6" stroke="#7d70b8" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
            
            <div class="flex w-full h-full justify-end items-center">
                <img src="../assets/logo/logo-02-02.png" class="w-[30px] h-[30px]">
                <p class="text-white font-bold pirgl">IRGL 2024</p>
            </div>

        </div>


        
    </div>
</nav>
</header>

<div class="w-screen h-screen hidden z-30 fixed" id="menune">
    <div class="flex flex-col justify-center items-center w-full h-[60%]">
        <ul class="items-center w-full h-full ">
            <li class="flex h-[15%] items-center">
                <a class="text-2xl w-full text-white cursor-pointer text-center pirgl" onclick="displayMenuh()" href="#">Home</a>
            </li>
            <li class="flex h-[15%] items-center">
                <a class="text-2xl w-full text-white cursor-pointer text-center pirgl" onclick="displayMenuh()" href="#about">About</a>
            </li>
            <li class="flex h-[15%] items-center">
                <a class="text-2xl w-full text-white cursor-pointer text-center pirgl" onclick="displayMenuh()" href="#timeline">Timeline</a>
            </li>
            <li class="flex h-[15%] items-center">
                <a class="text-2xl w-full text-white cursor-pointer text-center pirgl" onclick="displayMenuh()" href="#faq">FAQ</a>
            </li>
            <li class="flex h-[15%] items-center">
                <a class="text-2xl w-full text-white cursor-pointer text-center pirgl" href="{{ route('login') }}">Login</a>
            </li>
            <li class="flex h-[15%] items-center">
                <a class="text-2xl w-full text-white cursor-pointer text-center pirgl" href="{{ route('register') }}">Register</a>
            </li>
        </ul>
    </div>
</div>


<script>
    let berger = document.getElementById('menune');
    let menutop = document.getElementById('menuhtop');
    
    function displayMenuh(){
        if(berger.classList.contains('hidden')){
            berger.classList.remove('hidden');
                    
            menutop.classList.add('backdrop-blur-[6px]');
        }else{
            berger.classList.add('hidden')
            menutop.classList.remove('backdrop-blur-[6px]');
        }
    }

    let lastScrollTop = 0;

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop && berger.classList.contains('hidden')) {
        menutop.style.transform = 'translateY(-100%)';
    } else {
        menutop.style.transform = 'translateY(0)';
    }
    lastScrollTop = scrollTop;
});



// function goto(path){
//     path = path.toLowerCase();
    
//     if(path.includes('home')){

//     }
//     else if(path.includes('about')){
//         const about = document.getElementById('about');
//         const navbarHeight = document.getElementById('menuhtop').offsetHeight;

//         const scrollPosition = about.offsetTop;
//         window.scrollTo({
//         top: scrollPosition,
//         behavior: 'smooth'
//     });

//     }
//     else if(path.includes('timeline')){

//     }
//     else if(path.includes('faq')){

//     }
// }

</script>