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
            <h1 class="font-bold text-white text-2xl mt-3 mb-5 tracking-wider md:text-3xl">Input Points</h1>
            <form action="{{ route('admin.inputscoreteam.addscore') }}" method="POST" id="form-score">
                @csrf
                <div class="relative mb-5">
                    <h2 class="text-white text-left mb-1">Team Name</h2>
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
                    <h2 class="text-white mb-1">Score</h2>
                    <input type="number" id="score"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="score">
                </div>
            </form>
            <button id='submit-score'
                class="bg-gradient-to-r from-green-300 to-green-700
                 hover:from-[#235aad] hover:via-[#845893] hover:to-[#497cc9] px-4 py-2 rounded-lg cursor-pointer mt-4 text-white font-bold ease-in-out duration-500">Add Points</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let bold = document.getElementById('points');
        bold.className = 'text-[#fff] p-1 px-5 font-bold text-lg w-full h-full';
        
        $(document).ready(function() {
            // Dynamic team dropdown
            const input = $('#team-name');
            const dropdown = $('#dropdown');
            const dropdownList = $('#dropdown-list');
            const teams = @json($teams);
            console.log(teams);

            input.on('input', function() {
                const query = input.val().toUpperCase();
                dropdownList.empty(); // Clear previous options

                teams.forEach(team => {
                    if (team.nama.toUpperCase().includes(query)) {
                        const listItem = $('<li>').text(team.nama.toUpperCase())
                            .addClass('p-2 text-white cursor-pointer hover:bg-indigo-500')
                            .on('click', function() {
                                input.val(team.nama.toUpperCase());
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



            // Confirmation before submit
            $('#submit-score').on('click', function(event) {
                Swal.fire({
                    title: "Add " + $('#score').val() + " points for team " + $('#team-name').val() + "?",
                    showCancelButton: true,
                    confirmButtonText: "ADD!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-score').submit();
                    }
                });
            });
        })
    </script>
@endsection
