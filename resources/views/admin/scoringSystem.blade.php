@extends('layout.admin')

@section('body')
<div class="justify-center items-center flex max-w-[100vw] h-fit mt-12 mx-auto">
    <div class="w-[93.6vw] justify-evenly items-center flex flex-col rounded-2xl bg-white">

        <div class="overflow-auto sm:overflow-x-scroll w-[98%] relative mb-2 px-4">
            <table class="justify-center items-center mt-10 mb-1 w-[150vw]" id="teamTable">
                <thead class=" bg-gray-200">
                    <tr class="min-w-full">
                        <th class="min-w-[28px] cursor-pointer">Rank</th>
                        <th class="min-w-[100px] cursor-pointer">Already Played</th>
                        <th class="min-w-[100px] cursor-pointer">Team</th>
                        <th class="min-w-[112px] max-w-[136px] cursor-pointer">Time Taken</th>
                        <th class="min-w-[112px] max-w-[136px] cursor-pointer">Grandprize</th>
                        <th class="min-w-[112px] max-w-[136px] cursor-pointer">Highest GP Streak</th>
                        <th class="min-w-[112px] max-w-[136px] cursor-pointer">Highest Streak</th>
                        <th class="min-w-[90px] cursor-pointer max-w-[80px]">Score</th>
                        <th class="min-w-[90px] max-w-[80px] cursor-pointer">Total Game Diselesaikan</th>
                    </tr>
                </thead>

                <tbody id="bodyTable" class="text-center">
                    @php
                    $counter = 0
                    @endphp
                    @foreach ($leaderboards as $index => $statTeam)
                    <tr id="team{{ $counter }}" class="border-b-2 border-solid hover:bg-gray-100 cursor-pointer">
                        <td>{{ $counter + 1 }}</td>
                        <td class="flex justify-center items-center">{!! $statTeam->sudah_main !!}</td>
                        <td>{{ $statTeam->team->nama }}</td>
                        @if ($statTeam->end_time)
                        <td>{{ $statTeam->time_taken}}</td>
                        @else
                        <td>Not Finished</td> <!-- belum ada end_time -->
                        @endif
                        <td>{{ $statTeam->won_grand_prize }}</td>
                        <td>{{ $statTeam->highest_gp_streak}}</td>
                        <td>{{ $statTeam->highest_streak}}</td>
                        <td>{{ $statTeam->total_score}}</td>
                        <td>{{ $statTeam->total_game_finished}}</td>
                    </tr>                    
                    @php
                    $counter += 1
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    let bold = document.getElementById('rekapTeam');
    bold.className = 'text-[#fff] p-1 px-5 font-bold text-lg w-full h-full';
</script>

@if (session('success'))
<script>
    SweetAlert.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
    });
</script>
{{ session()->forget('success') }}
@endif


@if (session('error'))
<script>
    SweetAlert.fire({
        icon: 'error',
        title: 'Error',
        text: "{{ session('error') }}",
    });
</script>
{{ session()->forget('error') }}
@endif
@endsection