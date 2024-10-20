@extends('layout.admin')

@section('body')
    <div class="h-fit p-10 text-center">
        <div class="bg-gradient-to-r from-[#133D7D] to-[#711191] rounded-lg px-7 py-4 w-full md:w-1/2 mx-auto">
            <h1 class="font-bold text-white text-2xl mt-3 mb-5 tracking-wider md:text-3xl">Reset Game IRGL</h1>
            <div class="relative mb-5">
                <h2 class="text-4xl mb-3 text-amber-300 font-bold" id="score-field">-</h2>
                <input type="text" id="team-name" placeholder="Search teams..."
                    class="w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                    autocomplete="off" name="team-name">
                <div id="dropdown" class="absolute z-10 w-full mt-1 bg-gray-800 rounded-lg shadow-lg hidden">
                    <ul id="dropdown-list" class="max-h-60 overflow-y-auto">
                    </ul>
                </div>
                <input type="hidden" id="selected-team-id">
            </div>
            <div class="flex flex-col w-full rounded-lg shadow-xl items-center justify-center mb-10">
                <div class="relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="grid sm:grid-cols-2 sm:gap-1 content-center justify-center">
                        <div class="flex justify-center items-center">
                            <button
                                class="resetgame  relative m-8 max-md:w-40 w-72 h-36 border border-gray-300 hover:border-gray-600 hover:text-white shadow-md text-center flex justify-center items-center bg-gradient-to-r from-green-300 to-green-700
                                hover:from-[#235aad] hover:via-[#845893] hover:to-[#497cc9] px-4 py-2 rounded-lg cursor-pointer mt-4 text-white font-bold ease-in-out duration-500">
                                RESET GAME
                            </button>
                        </div>
                        <div class="flex justify-center items-center">

                            <div id="resets"
                                class="resetjadwal relative m-8 max-md:w-40 w-72 h-36 border border-gray-300 hover:border-gray-600 hover:text-white shadow-md text-center flex justify-center items-center bg-gradient-to-r from-green-300 to-green-700
                                    hover:from-[#235aad] hover:via-[#845893] hover:to-[#497cc9] px-4 py-2 rounded-lg cursor-pointer mt-4 text-white font-bold ease-in-out duration-500"
                                data-te-toggle="modal" data-te-target="#Modal">
                                RESET JADWAL
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div data-te-modal-init
        class=" fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
        id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div data-te-modal-dialog-ref
            class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
            <div
                class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                <div
                    class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                    <!--Modal title-->
                    <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
                        id="exampleModalLabel">
                        Reset Jadwal
                    </h5>
                    <!--Close button-->
                    <button type="button"
                        class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                        data-te-modal-dismiss aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!--Modal body-->
                <div class="relative flex-auto p-4" data-te-modal-body-ref>
                    <div class="relative mb-3" data-te-input-wrapper-init>
                        <input type="text"
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            id="modal-team-name" name="name" placeholder="Team Name" disabled />
                        <label for="name"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Team
                            Name
                        </label>
                    </div>
                    <div class="relative mb-3" data-te-input-wrapper-init hidden>
                        <input type="text"
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                            id="modal-team-id" name="id" placeholder="" />
                    </div>
                    <div class="w-full mb-3">
                        <select id="tanggal" name="tanggal" data-te-select-init>
                            @foreach ($jadwal as $data)
                                @php
                                    $formattedDate = \Carbon\Carbon::parse($data->tanggal)->isoFormat(
                                        'ddd, DD MMMM YYYY',
                                    );
                                @endphp
                                <option value="{{ $data->id }}">{{ $formattedDate }} - {{ $data->start_time }}
                                    s/d
                                    {{ $data->end_time }}
                                </option>
                            @endforeach
                        </select>
                        <label data-te-select-label-ref>Tanggal yang tersedia</label>
                    </div>
                </div>
                <!--Modal footer-->
                <div
                    class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                    <button type="button"
                        class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                        data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                        Close
                    </button>
                    <button type="submit" id="submit"
                        class="save ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                        data-te-ripple-init data-te-ripple-color="light">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const input = $('#team-name');
        const dropdown = $('#dropdown');
        const dropdownList = $('#dropdown-list');
        const teams = @json($teams); // Data tim dari backend

        // Saat pengguna mengetik di input
        input.on('input', function() {
            const query = input.val().toUpperCase();
            dropdownList.empty();

            teams.forEach(team => {
                if (team.nama.toUpperCase().includes(query)) {
                    const listItem = $('<li>')
                        .text(team.nama.toUpperCase())
                        .attr('data-id', team.id)
                        .addClass('p-2 text-white cursor-pointer hover:bg-indigo-500')
                        .on('click', function() {
                            input.val(team.nama.toUpperCase());
                            $('#score-field').html(team.nama);
                            $('#selected-team-id').val(team.id);
                            dropdown.addClass('hidden');
                        });
                    dropdownList.append(listItem);
                }
            });
            dropdown.removeClass('hidden');
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('#dropdown, #team-name').length) {
                dropdown.addClass('hidden');
            }
        });

        $(document).ready(function() {
            $('.resetgame').click(function() {
                const teamName = $('#score-field').html();
                const teamId = $('#selected-team-id').val();
                if (teamName == '' || teamId == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please select a team and date before resetting the schedule!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return;
                }
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will reset the game for the team " + teamName,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reset it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('admin.resetgame-team') }}',
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                team_id: teamId
                            },
                            success: async function(response) {
                                if (response.success) {
                                    await Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                    window.location.reload();
                                } else {
                                    await Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                }
                            }
                        });
                    }
                });
            });

            $('.resetjadwal').click(function() {
                const teamName = $('#score-field').html();
                const teamId = $('#selected-team-id').val();

                if (!teamName || teamName === 'Team Name') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please select a team before resetting the schedule!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return;
                }

                $('#modal-team-name').val(teamName);
                $('#modal-team-id').val(teamId);

                $('#Modal').removeClass('hidden');
            });
            $('.save').click(async function() {
                var team_id = $('#modal-team-id').val();
                var teamName = $('#modal-team-name').val();
                var tanggal = $('#tanggal').val();
                if (team_id == '' || tanggal == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please select a team and date before resetting the schedule!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return;
                }
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will reset the schedule for the team " + teamName,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reset it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('admin.resetgame-schedule') }}',
                            type: 'PUT',
                            data: {
                                _token: "{{ csrf_token() }}",
                                team_id: team_id,   
                                jadwal_id: tanggal
                            },
                            success: async function(response) {
                                if (response.success) {
                                    await Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                    window.location.reload();
                                } else {
                                    await Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                }
                            }
                        });
                    }
                });

            })

        });
    </script>
@endsection
