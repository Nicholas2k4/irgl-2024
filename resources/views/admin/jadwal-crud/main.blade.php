@extends('layout.admin')

@section('body')
<div class="container mx-auto p-8 pt-10 mt-16 bg-white dark:bg-black bg-opacity-70 dark:bg-opacity-30 shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold mb-4 dark:text-white text-center">Jadwal Ronde Eliminasi</h1>
    <div class="container mx-auto">

        @if (session('success'))
            <div class="bg-green-200 p-2 mb-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.jadwal.input') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Add New Jadwal
        </a>

        <table id="jadwalTable" class="min-w-full bg-white rounded-lg overflow-hidden shadow-lg">
            <thead class="bg-gray-800 text-white">
                <tr>
                <th class="py-2 px-4 text-center cursor-pointer" onclick="sortTable(0)">ID</th>
                <th class="py-2 px-4 text-center cursor-pointer" onclick="sortTable(1)">Tanggal</th>
                <th class="py-2 px-4 text-center cursor-pointer" onclick="sortTable(2)">Start Time</th>
                <th class="py-2 px-4 text-center cursor-pointer" onclick="sortTable(3)">End Time</th>
                <th class="py-2 px-4 text-center">Actions</th>
            </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @foreach ($jadwal as $data)
                    <tr>
                        <td class="py-2 px-4 text-center">{{ $data->id }}</td>
                        <td class="py-2 px-4 text-center">{{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('ddd, DD MMMM YYYY') }}</td>
                        <td class="py-2 px-4 text-center">{{ $data->start_time }}</td>
                        <td class="py-2 px-4 text-center">{{ $data->end_time }}</td>
                        <td class="py-2 px-4 text-center">
                            <a href="{{ route('admin.jadwal.view', $data->id) }}" class="inline-block rounded bg-gray-300 px-4 py-2 text-xs font-medium uppercase leading-normal text-gray-800 shadow-md transition duration-150 ease-in-out hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500">Edit</a>
                            <form action="{{ route('admin.jadwal.delete', $data->id) }}" method="POST" class="inline-block">
                                @csrf
                                <a href="{{ route('admin.jadwal.delete', $data->id) }}" onclick="return confirm('Hapus data ini? Id: {{ $data->id }}')">
                        <button type="button" class="inline-block rounded bg-red-500 px-4 py-2 text-xs font-medium uppercase leading-normal text-white shadow-md transition hover:bg-red-600 focus:outline-none active:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
<script>
let bold = document.getElementById('jadwal');
bold.className = 'text-[#fff] p-1 px-5 font-bold text-lg w-full h-full';

    function sortTable(columnIndex) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("jadwalTable");
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[columnIndex];
                y = rows[i + 1].getElementsByTagName("TD")[columnIndex];
                if (dir == "asc") {
                    if (columnIndex === 0) {
                        // Sort ID
                        if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (columnIndex === 1) {
                        // Sort Date by ISO format
                        if (new Date(x.innerHTML) > new Date(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                } else if (dir == "desc") {
                    if (columnIndex === 0) {
                        // Sort ID
                        if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (columnIndex === 1) {
                        // Sort Date by ISO format
                        if (new Date(x.innerHTML) < new Date(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>


@endsection