@extends('layout.admin')

@section('body')
    <div class="flex flex-col w-full py-8 rounded-lg shadow-xl items-center justify-center mb-10">
        <h1 class="text-center text-4xl uppercase font-bold mb-2">Elimination Leaderboard</h1>
    </div>
    {{-- <div class="flex flex-col w-full py-8 rounded-lg shadow-xl items-center justify-center mb-10"> --}}
        <div id="datatable" class="w-full px-5 py-5" data-te-max-height="460" data-te-fixed-header="true"></div>
    {{-- </div> --}}
    {{-- {{$coba}} --}}
@endsection()

@section('script')
    <script>
        const customDatatable = document.getElementById("datatable");
        const data = JSON.parse(@json($scores));
        const instance = new te.Datatable(
            customDatatable, {
                columns: [
                    {
                        label: "Nama Team",
                        field: "team_name",
                        sort: true,
                        // fixed: true

                    },
                    {
                        label: "Score",
                        field: "score",
                        sort: true,
                        // fixed: true
                    }
                ],
                rows: data.map((item,i) => {
                    return {
                        ...item,
                        team_name: item.team_name,
                        score: item.score,
                    };
                }),
            }, {
                hover: true,
            },
        );
    </script>
@endSection()
