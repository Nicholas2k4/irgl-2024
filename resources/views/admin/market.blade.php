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
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "{{ $errors->first() }}"
            });
        </script>
    @endif

    <div class="h-fit p-10 text-center">
        <div class="bg-gradient-to-r from-[#133D7D] to-[#711191]  rounded-lg px-7 py-4 w-full md:w-1/2 mx-auto">
            <h1 class="font-bold text-white text-4xl mt-3 mb-5 tracking-wider">Marketplace</h1>
            <form action="{{ route('admin.market.store') }}" method="POST">
                @csrf
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white">Team Name</h2>
                    <h1 class="text-4xl mb-3 text-amber-300 font-bold">pts: -</h1>
                    <input type="text"
                        class="w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="team-name" required>
                </div>
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Email Filter <i class="text-sm font-bold">@21</i></h2>
                    <input type="number" id="email-qty"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="email-qty">
                </div>
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Encryption Machine <i class="text-sm font-bold">@22</i></h2>
                    <input type="number" id="encrypt-qty"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="encrypt-qty">
                </div>
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Traffic Controller <i class="text-sm font-bold">@23</i></h2>
                    <input type="number" id="traffic-qty"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="traffic-qty">
                </div>
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Antivirus <i class="text-sm font-bold">@24</i></h2>
                    <input type="number" id="antivirus-qty"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="antivirus-qty">
                </div>
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Input Validator <i class="text-sm font-bold">@25</i></h2>
                    <input type="number" id="input-qty"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="input-qty">
                </div>

                <h1 class="text-left text-amber-300 text-3xl font-bold mt-3 mb-5" id="total-price">Total: -</h1>

                <button type="submit"
                    class="bg-gradient-to-r from-green-300 to-green-700
                 hover:from-[#235aad] hover:via-[#845893] hover:to-[#497cc9] px-4 py-2 rounded-lg cursor-pointer mt-4 text-white font-bold ease-in-out duration-500">Buy
                    Items</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.item-qty').on('change keyup', function() {
                let emailQty = $('#email-qty').val();
                let encryptQty = $('#encrypt-qty').val();
                let trafficQty = $('#traffic-qty').val();
                let antivirusQty = $('#antivirus-qty').val();
                let inputQty = $('#input-qty').val();

                let totalPrice = emailQty * 21 + encryptQty * 22 + trafficQty * 23 + antivirusQty * 24 +
                    inputQty * 25;
                $('#total-price').html('Total: ' + totalPrice);
            })
        })
    </script>
@endsection
