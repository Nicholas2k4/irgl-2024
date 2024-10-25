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
                    <h1 class="text-2xl mb-3 text-amber-300 font-bold text-start" id="price-field">price: -</h1>
                    <select
                        class="w-full rounded-lg bg-transparent text-white border border-white focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none font-bold"
                        name="clue" id="clue-dropdown">
                        <option value="" disabled selected class="bg-gray-800 text-white">Select a clue...</option>
                        <option value="1" class="bg-gray-800 text-white hover:bg-indigo-500 clue-options"
                            id='clue-1-option'>Clue 1</option>
                        <option value="2" class="bg-gray-800 text-white hover:bg-indigo-500 clue-options"
                            id='clue-2-option'>Clue 2</option>
                        <option value="3" class="bg-gray-800 text-white hover:bg-indigo-500 clue-options"
                            id='clue-3-option'>Clue 3</option>
                        <option value="4" class="bg-gray-800 text-white hover:bg-indigo-500 clue-options"
                            id='clue-4-option'>Clue 4</option>
                        <option value="5" class="bg-gray-800 text-white hover:bg-indigo-500 clue-options"
                            id='clue-5-option'>Clue 5</option>
                        <option value="6" class="bg-gray-800 text-white hover:bg-indigo-500 clue-options"
                            id='clue-6-option'>Clue 6</option>
                        <option value="7" class="bg-gray-800 text-white hover:bg-indigo-500 clue-options"
                            id='clue-7-option'>Dictionary 1</option>
                        <option value="8" class="bg-gray-800 text-white hover:bg-indigo-500 clue-options"
                            id='clue-8-option'>Dictonary 2</option>
                    </select>
                </div>
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
            const teams = @json($teams);

            // clue selections
            const clue1 = $('#clue-1-option');
            const clue2 = $('#clue-2-option');
            const clue3 = $('#clue-3-option');
            const clue4 = $('#clue-4-option');
            const clue5 = $('#clue-5-option');
            const clue6 = $('#clue-6-option');
            const clue7 = $('#clue-7-option');
            const clue8 = $('#clue-8-option');

            // live team search
            input.on('input', function() {
                const query = input.val().toUpperCase();
                dropdownList.empty();

                teams.forEach(team => {
                    if (team.nama.toUpperCase().includes(query)) {
                        const listItem = $('<li>').text(team.nama.toUpperCase())
                            .addClass('p-2 text-white cursor-pointer hover:bg-indigo-500')
                            .on('click', function() {
                                input.val(team.nama.toUpperCase());
                                $('#score-field').html(team.nama + ' score: ' + team.score);
                                dropdown.addClass('hidden');
                                updateClueDropdown(team);
                            });
                        dropdownList.append(listItem);
                    }
                })
                dropdown.removeClass('hidden');
            });

            // make clue selections according to selected team statistics
            function updateClueDropdown(team) {
                if (team.has_clue1 == 0) clue1.removeClass('hidden');
                else clue1.addClass('hidden');
                if (team.has_clue2 == 0) clue2.removeClass('hidden');
                else clue2.addClass('hidden');
                if (team.has_clue3 == 0) clue3.removeClass('hidden');
                else clue3.addClass('hidden');
                if (team.has_clue4 == 0) clue4.removeClass('hidden');
                else clue4.addClass('hidden');
                if (team.has_clue5 == 0) clue5.removeClass('hidden');
                else clue5.addClass('hidden');
                if (team.has_clue6 == 0) clue6.removeClass('hidden');
                else clue6.addClass('hidden');
                if (team.has_clue7 == 0) clue7.removeClass('hidden');
                else clue7.addClass('hidden');
                if (team.has_clue8 == 0) clue8.removeClass('hidden');
                else clue8.addClass('hidden');
            }

            // clue prices
            $('#clue-dropdown').on('change', function() {
                let selectedValue = parseInt($(this).val());
                let priceContent = 'price: ' + (selectedValue < 7 ? '15' : '100');
                $('#price-field').html(priceContent);
            });

            // hide team dropdown
            $(document).on('click', function(event) {
                dropdown.addClass('hidden');
            });

            // Confirmation before submit
            $('#submit-buy').on('click', function(event) {
                Swal.fire({
                    title: "Buy " + $('#clue-dropdown').find('option:selected').text() + " for team " + $('#team-name').val() + "?",
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
