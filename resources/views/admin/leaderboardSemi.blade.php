@extends('layout.admin')

@section('body')
<div class="justify-center items-center flex max-w-[100vw] h-fit mt-12 mx-auto">
    <div class="w-[93.6vw] justify-evenly items-center flex flex-col rounded-2xl bg-white">

        <div class="overflow-auto sm:overflow-x-scroll w-[98%] relative mb-2 px-4">
            <table class="justify-center items-center mt-10 mb-1 w-[150vw]" id="teamTable">
                <thead class=" bg-gray-200">
                    <tr class="min-w-full">
                        <th class="min-w-[10px] cursor-pointer max-w-[10px]">Rank</th>
                        <th class="min-w-[40px] cursor-pointer max-w-[40px]">Team</th>
                        <th class="min-w-[30px] cursor-pointer max-w-[30px]">Score</th>
                        <th class="min-w-[30px] cursor-pointer max-w-[30px]">Email Filter</th>
                        <th class="min-w-[30px] cursor-pointer max-w-[30px]">Encryption Machine</th>
                        <th class="min-w-[30px] cursor-pointer max-w-[30px]">Traffic Controller</th>
                        <th class="min-w-[30px] cursor-pointer max-w-[30px]">Antivirus</th>
                        <th class="min-w-[30px] cursor-pointer max-w-[30px]">Input Controller</th>
                    </tr>
                </thead>

                <tbody id="bodyTable" class="text-center">
                    @php
                    $counter = 0
                    @endphp
                    @foreach ($teams as $team)
                    <tr id="team{{ $counter }}" class="border-b-2 border-solid hover:bg-gray-100 cursor-pointer">
                        <td>{{ $counter + 1 }}</td>
                        <td>{{ $team->nama }}</td>
                        <td>{{ $team->semiStatistic->score}}</td>
                        <td>{{ $team->semiStatistic->email_filter}}</td>
                        <td>{{ $team->semiStatistic->encryption_machine}}</td>
                        <td>{{ $team->semiStatistic->traffic_controller}}</td>
                        <td>{{ $team->semiStatistic->antivirus}}</td>
                        <td>{{ $team->semiStatistic->input_validator}}</td>
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
