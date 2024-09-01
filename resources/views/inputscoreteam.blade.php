<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IRGL 2024 | Login</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
</head>

<body>
    @if ($errors->any())
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ $errors->first() }}",
                icon: "error"
            });
        </script>
    @endif

    @if (session()->has('message'))
        <script>
            Swal.fire({
                title: "Info",
                text: "{{ session('message') }}",
                icon: "info"
            });
        </script>
    @endif

    <div class="bg-black flex justify-center items-center h-screen bg-[url('https://images.hdqwalls.com/download/neon-city-5k-3u-1920x1080.jpg')] bg-cover bg-center bg-no-repeat">
        <div
            class="bg-[rgba(0,0,0,0.5)] backdrop-blur-lg shadow-[0_0_20px_rgba(255,255,255,0.1)] w-[400px] p-10 rounded-[20px] text-center m-8 relative">
            <form action="{{ route('inputscoreteam.addscore') }}" method="POST">
                @csrf
                <h2 class="text-2xl text-white font-bold mb-4">Input Score Team</h2>

                <div class="mb-2 flex flex-col items-left">
                    <label for="nama-team-id" class="text-white text-left">Pilih Team</label>
                    <select id="nama-team-id" name="nama-team" required
                        class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none select2">
                        @foreach ($teams as $team)
                            <option value="{{ $team->nama }}">{{ $team->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2 flex flex-col items-left">
                    <label for="nama-game-id" class="text-white text-left">Pilih Game</label>
                    <select type="text" id="nama-game-id" name="nama-game" placeholder="Contoh: NATUS VINCERE" required
                        class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
                        @foreach ($teams as $team)
                            <option value="{{ $team->nama }}" class="bg-[rgba(0,0,0,0.8)]">{{ $team->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2 flex flex-col items-left">
                    <label for="jumlah-score-id" class="text-white text-left">Jumlah Score</label>
                    <input type="number" id="jumlah-score-id" name="jumlah-score" required
                        class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
                </div>

                <br>
                <button type="submit"
                    class="bg-[#B026FF] text-white text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Insert</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#nama-team-id').select2({
                placeholder: "Select a Team",
                allowClear: true,
                ajax: {
                    url: "{{ route('inputscoreteam.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term // Search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(team) {
                                return {
                                    id: team.nama,
                                    text: team.nama
                                }
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            });
        });
    </script>
</body>

</html>
