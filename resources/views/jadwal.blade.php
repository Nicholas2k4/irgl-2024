<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>IRGL 2024 | Schedule</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body
    class="pt-14 p-5 bg-[url('https://cdna.artstation.com/p/assets/images/images/042/327/908/large/zippy-lee-botborgs-purple-3k.jpg?1634200457')]">

    {{-- Swal --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "{{ session('success') }}",
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "{{ session('error') }}",
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "{{ $errors->first() }}",
            });
        </script>
    @endif

    <div class="container mx-auto p-8 pt-10 bg-white bg-opacity-70 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Eliminary Round</h1>

        @if (auth()->check())
            @if (auth()->user()->jadwal != null)
                {{-- Form untuk Reschedule Jadwal --}}
                <form action="{{ route('jadwal.reschedule') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        @php
                            $reschedJadwal = \App\Models\Jadwal::find(auth()->user()->id_jadwal_resched);
                        @endphp
                        @if (auth()->user()->resched_approval != 2)
                            @if (auth()->user()->resched_approval == 1 && auth()->user()->id_jadwal_resched)
                                <div class="bg-green-200 p-2 px-4 mb-4 text-green-800 flex gap-2 rounded-lg">
                                    <p>Jadwal berhasil di-reschedule ke tanggal</p>
                                    <p class="font-bold">
                                        {{ \Carbon\Carbon::parse($reschedJadwal->tanggal)->isoFormat('ddd, DD MMMM YYYY') }}
                                    </p>
                                    <p class="font-bold">{{ $reschedJadwal->start_time }} s/d
                                        {{ $reschedJadwal->end_time }}</p>
                                </div>
                            @elseif (auth()->user()->resched_approval == 0)
                                <div class="bg-red-200 p-2 px-4 mb-4 text-red-800 rounded-lg">
                                    <p>Jadwal reschedule tidak diterima.</p>
                                </div>
                            @endif
                            <p class="text-2xl font-bold pb-5">{{ auth()->user()->nama }}</p>
                            <label for="jadwal" class="block text-sm font-medium text-gray-700">Jadwal Saat
                                Ini</label>
                            <p>{{ \Carbon\Carbon::parse(auth()->user()->jadwal->tanggal)->isoFormat('ddd, DD MMMM YYYY') }}
                                - {{ auth()->user()->jadwal->start_time }} s/d {{ auth()->user()->jadwal->end_time }}
                            </p>
                    </div>
                    <div class="mb-4">
                        <label for="jadwal" class="block text-sm font-medium text-gray-700">Pilih Jadwal Baru</label>
                        <select name="jadwal" id="jadwal"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($jadwal as $data)
                                @php
                                    $formattedDate = \Carbon\Carbon::parse($data->tanggal)->isoFormat(
                                        'ddd, DD MMMM YYYY',
                                    );
                                @endphp
                                <option value="{{ $data->id }}">{{ $formattedDate }} - {{ $data->start_time }}
                                    s/d
                                    {{ $data->end_time }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan Reschedule</label>
                        <textarea name="alasan" id="alasan" rows="3"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="bukti" class="block text-sm font-medium text-gray-700">Bukti Pendukung
                            (Foto)</label>
                        <input type="file" accept="image/*" name="bukti" id="bukti"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Reschedule Jadwal
                    </button>
                    <!-- ganti href ke route main -->
                    <a href="route main"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-block">
                        Back
                    </a>
                </form>
            @elseif (auth()->user()->resched_approval == 2 && auth()->user()->id_jadwal_resched)
                <p class="text-2xl font-bold pb-5">{{ auth()->user()->nama }}</p>
                <label for="jadwal" class="block text-sm font-medium text-gray-700">Jadwal Saat Ini</label>
                <p>{{ \Carbon\Carbon::parse(auth()->user()->jadwal->tanggal)->isoFormat('ddd, DD MMMM YYYY') }}
                    - {{ auth()->user()->jadwal->start_time }} s/d {{ auth()->user()->jadwal->end_time }}</p>
                @if ($reschedJadwal)
                    <div class="bg-yellow-200 p-2 px-4 mb-4 text-yellow-800 flex gap-2 mt-5 rounded-lg">
                        <p>Waiting approval for reschedule date of</p>
                        <p class="font-bold">
                            {{ \Carbon\Carbon::parse($reschedJadwal->tanggal)->isoFormat('ddd, DD MMMM YYYY') }}</p>
                        <p class="font-bold">{{ $reschedJadwal->start_time }} s/d {{ $reschedJadwal->end_time }}</p>
                    </div>
                @endif
            @endif
        @else
            {{-- Form untuk Memilih Jadwal --}}
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <p class="text-2xl font-bold">{{ auth()->user()->nama }}</p>
                    <label for="jadwal" class="block text-sm font-medium text-gray-700">Pilih Jadwal</label>
                    <select name="jadwal" id="jadwal"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach ($jadwal as $data)
                            @php
                                $formattedDate = \Carbon\Carbon::parse($data->tanggal)->isoFormat('ddd, DD MMMM YYYY');
                            @endphp
                            <option value="{{ $data->id }}">{{ $formattedDate }} - {{ $data->start_time }}
                                s/d {{ $data->end_time }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Submit
                </button>
                <!-- ganti href ke route main -->
                <a href="route main"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-block">
                    Back
                </a>
            </form>
        @endif
    @else
        <p>User is not authenticated</p>
        @endif
    </div>
</body>

</html>
