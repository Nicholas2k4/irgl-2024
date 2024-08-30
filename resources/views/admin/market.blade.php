@extends('layout.admin')

@section('body')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "{{ session('success') }}"
            });
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "{{ session('error') }}"
            });
        </script>
    @endif

    <div class="h-fit p-10 text-center">
        <div class="bg-gradient-to-r from-[#133D7D] to-[#711191]  rounded-lg px-7 py-4 w-full md:w-1/2 mx-auto">
            <h1 class="font-bold text-white text-4xl mt-3 mb-5 tracking-wider">Marketplace</h1>
            <form action="#">
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white">Team Name</h2>
                    <h1 class="text-5xl font-black">100000</h1>
                    <input type="text" class="w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Email Filter <i class="text-sm font-bold">@21</i></h2>
                    <input type="number" class="w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500" value=0>
                </div>  
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Encryption Machine <i class="text-sm font-bold">@22</i></h2>
                    <input type="number" class="w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500" value=0>
                </div>  
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Traffic Controller <i class="text-sm font-bold">@23</i></h2>
                    <input type="number" class="w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500" value=0>
                </div>  
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Antivirus <i class="text-sm font-bold">@24</i></h2>
                    <input type="number" class="w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500" value=0>
                </div>  
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Input Validator <i class="text-sm font-bold">@25</i></h2>
                    <input type="number" class="w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500" value=0>
                </div>  
                
                
                <button type="submit" class="bg-green-600 hover:bg-green-900 px-4 py-2 rounded-lg cursor-pointer mt-4 text-white font-bold ease-in-out duration-150">Buy Items</button>
            </form>
            @csrf
        </div>
    </div>
@endsection
