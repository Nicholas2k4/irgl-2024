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
            <h1 class="font-bold text-white text-2xl mt-3 mb-5 tracking-wider md:text-3xl">Clue Shop</h1>
            <form action="{{ route('admin.buyClue') }}" method="POST" id="form-buy">
                @csrf
                <div class="relative mb-5">
                    <h2 class="text-white text-start">Team Name</h2>
                    <h1 class="text-2xl mb-3 text-amber-300 font-bold text-start" id='score-field'>score: -</h1>
                    <input type="text" id="team-name" placeholder="Search teams..."
                        class="w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        autocomplete="off" name="team-name">
                    <div id="dropdown" class="absolute z-10 w-full mt-1 bg-gray-800 rounded-lg shadow-lg hidden">
                        <ul id="dropdown-list" class="max-h-60 overflow-y-auto">
                            <!-- Options will be dynamically added here -->
                        </ul>
                    </div>
                </div>
                <div class="relative mb-5">
                    <h2 class="text-white text-start">Clue</h2>
                    <h1 class="text-2xl mb-3 text-amber-300 font-bold text-start" id='price-field'>price: -</h1>
                    <input type="text" placeholder="Search clue..."
                        class="w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        autocomplete="off" name="clue" id="clue-placeholder">
                    <div class="absolute z-10 w-full mt-1 bg-gray-800 rounded-lg shadow-lg hidden" id="dropdown-clue">
                        <ul class="max-h-60 overflow-y-auto">
                            <li class="p-2 text-white cursor-pointer hover:bg-indigo-500">Clue 1</li>
                            <li class="p-2 text-white cursor-pointer hover:bg-indigo-500">Clue 1</li>
                            <li class="p-2 text-white cursor-pointer hover:bg-indigo-500">Clue 1</li>
                            <li class="p-2 text-white cursor-pointer hover:bg-indigo-500">Clue 1</li>
                            <li class="p-2 text-white cursor-pointer hover:bg-indigo-500">Clue 1</li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Email Filter <i class="text-sm font-bold">{{ '@' . $email_price }}</i></h2>
                    <input type="number" id="email-qty"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="email-qty">
                </div> --}}

            </form>
            <button id='submit-buy'
                class="bg-gradient-to-r from-green-300 to-green-700
                 hover:from-[#235aad] hover:via-[#845893] hover:to-[#497cc9] px-4 py-2 rounded-lg cursor-pointer mt-4 text-white font-bold ease-in-out duration-500">Buy
                Clue</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let bold = document.getElementById('market');
        bold.className = 'text-[#fff] p-1 px-5 font-bold text-lg w-full h-full';

        $(document).ready(function() {
            // Dynamic team dropdown
            const input = $('#team-name');
            const dropdown = $('#dropdown');
            const dropdownList = $('#dropdown-list');
            const dropdownClue = $('#dropdown-clue');
            const teams = @json($teams);

            const cluePlaceholder = $('#clue-placeholder');

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
                if (!dropdownClue.is(event.target) && !dropdownClue.has(event.target).length &&
                    !cluePlaceholder.is(event.target) && !cluePlaceholder.has(event.target).length) {
                    dropdownClue.addClass('hidden'); 
                }
            });

            cluePlaceholder.on('click', function(event) {
                event.stopPropagation();
                dropdownClue.removeClass('hidden');
            });

            // Confirmation before submit
            $('#submit-buy').on('click', function(event) {
                Swal.fire({
                    title: "Buy clue for team " + $('#team-name').val() + "?",
                    showCancelButton: true,
                    confirmButtonText: "BUY!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-buy').submit();
                    }
                });
            });
        })
    </script>
@endsection
