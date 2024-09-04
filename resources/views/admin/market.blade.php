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
            <h1 class="font-bold text-white text-2xl mt-3 mb-5 tracking-wider md:text-3xl">Marketplace</h1>
            <form action="{{ route('admin.market.store') }}" method="POST">
                @csrf
                <div class="relative mb-5">
                    <h2 class="text-white">Team Name</h2>
                    <h1 class="text-4xl mb-3 text-amber-300 font-bold" id='score-field'>score: -</h1>
                    <input type="text" id="team-name" placeholder="Search teams..."
                        class="w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        autocomplete="off" name="team-name">
                    <div id="dropdown" class="absolute z-10 w-full mt-1 bg-gray-800 rounded-lg shadow-lg hidden">
                        <ul id="dropdown-list" class="max-h-60 overflow-y-auto">
                            <!-- Options will be dynamically added here -->
                        </ul>
                    </div>
                </div>
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Email Filter <i class="text-sm font-bold">{{ '@' . $email_price }}</i></h2>
                    <input type="number" id="email-qty"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="email-qty">
                </div>
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Encryption Machine <i class="text-sm font-bold">{{ '@' . $encrypt_price }}</i></h2>
                    <input type="number" id="encrypt-qty"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="encrypt-qty">
                </div>
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Traffic Controller <i class="text-sm font-bold">{{ '@' . $traffic_price }}</i></h2>
                    <input type="number" id="traffic-qty"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="traffic-qty">
                </div>
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Antivirus <i class="text-sm font-bold">{{ '@' . $antivirus_price }}</i></h2>
                    <input type="number" id="antivirus-qty"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="antivirus-qty">
                </div>
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Input Validator <i class="text-sm font-bold">{{ '@' . $input_price }}</i></h2>
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
            // Dynamic item price
            $('.item-qty').on('change keyup', function() {
                let emailQty = $('#email-qty').val();
                let encryptQty = $('#encrypt-qty').val();
                let trafficQty = $('#traffic-qty').val();
                let antivirusQty = $('#antivirus-qty').val();
                let inputQty = $('#input-qty').val();

                let emailPrice = @json($email_price);
                let encryptPrice = @json($encrypt_price);
                let trafficPrice = @json($traffic_price);
                let antivirusPrice = @json($antivirus_price);
                let inputPrice = @json($input_price);

                let totalPrice = emailQty * emailPrice + encryptQty * encryptPrice + trafficQty * trafficPrice + antivirusQty * antivirusPrice +
                    inputQty * inputPrice;
                $('#total-price').html('Total: ' + totalPrice);
            });



            // Dynamic team dropdown
            const input = $('#team-name');
            const dropdown = $('#dropdown');
            const dropdownList = $('#dropdown-list');
            const teams = @json($teams);

            input.on('input', function() {
                const query = input.val().toUpperCase();
                dropdownList.empty(); // Clear previous options

                teams.forEach(team => {
                    if (team.nama.toUpperCase().includes(query)) {
                        const listItem = $('<li>').text(team.nama.toUpperCase())
                            .addClass('p-2 text-white cursor-pointer hover:bg-indigo-500')
                            .on('click', function() {
                                input.val(team.nama.toUpperCase());
                                $('#score-field').html(team.nama + ' score: ' + team.score);
                                dropdown.addClass('hidden'); // Hide dropdown on selection
                            });
                        dropdownList.append(listItem);
                    }
                })
                dropdown.removeClass('hidden');
            });

            $(document).on('click', function(event) {
                dropdown.addClass('hidden');
            });
        })
    </script>
@endsection
