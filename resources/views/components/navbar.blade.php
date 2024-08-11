<header class="flex justify-center mb-[7vh]">
    <nav class="l w-[100%] h-[7vh] fixed flex z-10 mx-auto justify-between shadow-lg bg-transparent">
        <div class="w-full h-full flex justify-evenly items-end gap-[2.3vw]">
            <a class="text-2xl text-white cursor-pointer">Home</a>
            <a class="text-2xl text-white cursor-pointer">About</a>
            <a class="text-2xl text-white cursor-pointer">Timeline</a>
            <a class="text-2xl text-white cursor-pointer">FAQ</a>
            <a class="text-2xl text-white cursor-pointer" href="{{ route('login') }}">Login</a>
        </div>
    </nav>
</header>
<style>
    /* .l{
        border-bottom: 3px solid;
        border-color: #edabe9;
        border-image-slice: 1;

        box-shadow: 0 3px 5px 2px #edabe9;
    }*/
    .l > div > a{
        box-shadow: 0 6px 4px -4px #9df2f2,
        0 8px 4px -3px #d6ed6f, 
                0 14px 6px -5px #d6ed6f, 
                0 17px 10px -9px #ffffff; 
                font-weight: bold;
    } 
</style>