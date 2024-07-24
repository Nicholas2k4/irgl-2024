@extends('layout.admin')

@section('body')
<div
    class="container mx-auto p-8 pt-10 mt-16 bg-white dark:bg-black bg-opacity-70 dark:bg-opacity-30 shadow-lg rounded-lg">
    <div class="flex justify-end mb-4">
        <button onclick="scrollToSection('reschedTable')"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Go to Reschedule Table
        </button>
    </div>
    <h1 class="text-3xl font-bold mb-4 dark:text-white text-center">Jadwal Ronde Eliminasi</h1>
    <div class="container mx-auto">

        @if (session('success'))
            <div class="bg-green-200 p-2 mb-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.jadwal.input') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Add New Jadwal
        </a>
        <div class="overflow-auto max-h-[500px]">
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
                            <td class="py-2 px-4 text-center">
                                {{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('ddd, DD MMMM YYYY') }}
                            </td>
                            <td class="py-2 px-4 text-center">{{ Carbon\Carbon::parse($data->start_time)->isoFormat('HH:mm') }}</td>
                            <td class="py-2 px-4 text-center">{{ Carbon\Carbon::parse($data->end_time)->isoFormat('HH:mm') }}</td>
                            <td class="py-2 px-4 text-center">
                                <button onclick="viewGroup({{ $data->id }})"
                                    class="inline-block rounded bg-green-300 px-4 py-2 text-xs font-medium uppercase leading-normal text-gray-800 shadow-md transition duration-150 ease-in-out hover:bg-green-400 focus:bg-green-400 active:bg-green-500">View Teams</button>
                                <a href="{{ route('admin.jadwal.view', $data->id) }}"
                                    class="inline-block rounded bg-yellow-300 px-4 py-2 text-xs font-medium uppercase leading-normal text-gray-800 shadow-md transition duration-150 ease-in-out hover:bg-yellow-400 focus:bg-yellow-400 active:bg-yellow-500">Edit</a>
                                <form action="{{ route('admin.jadwal.delete', $data->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    <a href="{{ route('admin.jadwal.delete', $data->id) }}"
                                        onclick="return confirm('Hapus data ini? Id: {{ $data->id }}')">
                                        <button type="button"
                                            class="inline-block rounded bg-red-500 px-4 py-2 text-xs font-bold uppercase leading-normal text-white shadow-md transition hover:bg-red-600 focus:outline-none active:bg-red-700">&times;</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div id="teamModal" class="fixed inset-0 items-center flex justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 w-full max-w-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold dark:text-white">List Teams:</h2>
                <button onclick="closeModal()"
                    class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 dark:text-white text-lg">
                    &times;
                </button>
            </div>
            <div id="teamContent" class="text-gray-700 dark:text-gray-200">
                <!-- Isi Modal Team -->
            </div>
        </div>
    </div>


    <div
        class="container mx-auto p-8 pt-10 mt-16 bg-white dark:bg-black bg-opacity-70 dark:bg-opacity-30 shadow-lg rounded-lg">
        <div class="flex justify-end mb-4 space-x-4">
            <button onclick="rescheduleLog()"
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center">
                <i class="fas fa-history mr-2"></i>
                Reschedule Log
            </button>
            <button onclick="scrollToSection('jadwalTable')"
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Go to Jadwal Table
            </button>
        </div>

        <h1 class="text-3xl font-bold mb-4 dark:text-white text-center">Reschedule Requests</h1>
        <div class="container mx-auto">
            <div class="overflow-auto max-h-[500px]">
                <table id="reschedTable" class="min-w-full bg-white rounded-lg overflow-hidden shadow-lg">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-2 px-4 text-center cursor-pointer" onclick="sortTable(3)">Nama Kelompok</th>
                            <th class="py-2 px-4 text-center cursor-pointer">Jadwal Awal</th>
                            <th class="py-2 px-4 text-center cursor-pointer">Jadwal Reschedule</th>
                            <th class="py-2 px-4 text-center">Alasan</th>
                            <th class="py-2 px-4 text-center">Bukti</th>
                            <th class="py-2 px-4 text-center">Approval</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-200">
                        @foreach ($teamResched as $data)
                            <tr>
                                <td class="py-2 px-4 text-center">{{ $data->nama }}</td>
                                <td class="py-2 px-4 text-center">
                                    {{ \Carbon\Carbon::parse($data->jadwal->tanggal)->isoFormat('ddd, DD MMMM YYYY') }}
                                    <br>
                                    {{ \Carbon\Carbon::parse($data->jadwal->start_time)->isoFormat('HH:mm') }}
                                    s/d
                                    {{ \Carbon\Carbon::parse($data->jadwal->end_time)->isoFormat('HH:mm')}}

                                </td>
                                <td class="py-2 px-4 text-center">
                                    {{ \Carbon\Carbon::parse($data->jadwalResched->tanggal)->isoFormat('ddd, DD MMMM YYYY') }}
                                    <br>
                                    {{ \Carbon\Carbon::parse($data->jadwalResched->start_time)->isoFormat('HH:mm') }}
                                    s/d
                                    {{ \Carbon\Carbon::parse($data->jadwalResched->end_time)->isoFormat('HH:mm')}}
                                </td>
                                <td class="py-2 px-4 text-center">{{ $data->alasan_resched }}</td>
                                <td class="py-2 px-4 text-center">
                                    <a href="{{ asset('storage/' . $data->link_bukti_resched) }}"
                                        class="text-blue-500 hover:underline" target="_blank">View Document</a>
                                </td>
                                <td class="py-2 px-4 text-center">
                                    @if ($data->resched_approval == 0)
                                        <p class="bg-white text-red-700 font-bold py-2 px-4 rounded border-red-700">Rejected</p>
                                    @elseif ($data->resched_approval == 1)
                                        <p class="bg-white text-green-700 font-bold py-2 px-4 rounded border border-green-700">
                                            Approved</p>
                                    @else
                                        <form action="{{ route('admin.jadwal.approve', $data->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.jadwal.reject', $data->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reject</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="logModal" class="fixed inset-0 items-center flex justify-center z-50 hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 w-full max-w-4xl">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold dark:text-white">History Log:</h2>
                    <button onclick="closeModal()"
                        class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 dark:text-white text-lg">
                        &times;
                    </button>
                </div>
                <div id="logContent" class="bg-white dark:bg-gray-800 rounded-lg overflow-auto max-h-[80vh]">
                    <!-- Isi Modal History -->
                </div>
            </div>
        </div>

    </div>
</div>
</div>
@endsection

@section('script')
<script>
    let bold = document.getElementById('jadwal');
    bold.className = 'text-[#fff] p-1 px-5 font-bold text-lg w-full h-full';

    function viewGroup(jadwal_id) {
        fetch(`/admin/jadwal/${jadwal_id}/teams`)
            .then(response => response.json())
            .then(data => {
                let teamContent = document.getElementById('teamContent');
                teamContent.innerHTML = `
                    <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-2 px-4 text-center">Name</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 dark:text-gray-200 divide-y divide-gray-800 dark:divide-gray-600">
                            ${data.map(member => `
                                <tr>
                                    <td class="py-2 px-4 text-center">${member.nama}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                `;
                document.getElementById('teamModal').classList.remove('hidden');
            })
            .catch(error => console.error('Error fetching team details:', error));
    }

    function closeModal() {
        document.getElementById('teamModal').classList.add('hidden');
        document.getElementById('logModal').classList.add('hidden');
    }
    function scrollToSection(sectionId) {
        document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
    }

    function rescheduleLog() {
        fetch(`/admin/jadwal/reschedule-log`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data);
                let logContent = document.getElementById('logContent');

                const teamNames = {};

                const fetchTeamNames = data.map(item => {
                    if (!teamNames[item.id_kelompok]) {
                        return fetch(`/admin/team/${item.id_kelompok}`)
                            .then(response => response.json())
                            .then(team => {
                                teamNames[item.id_kelompok] = team.nama;
                            })
                            .catch(error => console.error('Error fetching team name:', error));
                    }
                    return Promise.resolve();
                });

                Promise.all(fetchTeamNames).then(() => {
                    logContent.innerHTML = `
                        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-2 px-4 text-center cursor-pointer">Kelompok</th>
                                    <th class="py-2 px-4 text-center cursor-pointer w-1/4">Jadwal Awal</th>
                                    <th class="py-2 px-4 text-center cursor-pointer w-1/4">Jadwal Reschedule</th>
                                    <th class="py-2 px-4 text-center">Alasan</th>
                                    <th class="py-2 px-4 text-center">Bukti</th>
                                    <th class="py-2 px-4 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-200 divide-y divide-gray-800 dark:divide-gray-600">
                                ${data.map(item => `
                                    <tr>
                                        <td class="py-2 px-4 text-center">${teamNames[item.id_kelompok]}</td>
                                        <td class="py-2 px-4 text-center w-1/4">${moment(item.jadwal_awal.tanggal).format('ddd, DD MMMM YYYY')}<br>
                                        ${moment(item.jadwal_awal.start_time, 'HH:mm:ss').format('HH:mm')} s/d 
                                        ${moment(item.jadwal_awal.end_time, 'HH:mm:ss').format('HH:mm')} </td>
                                        <td class="py-2 px-4 text-center w-1/4">${moment(item.jadwal_resched.tanggal).format('ddd, DD MMMM YYYY')}<br>
                                        ${moment(item.jadwal_resched.start_time, 'HH:mm:ss').format('HH:mm')} s/d 
                                        ${moment(item.jadwal_resched.end_time, 'HH:mm:ss').format('HH:mm')} </td>
                                        <td class="py-2 px-4 text-center">${item.alasan}</td>
                                        <td class="py-2 px-4 text-center">
                                            <a href="${item.bukti ? `/storage/${item.bukti}` : '#'}" class="text-blue-500 hover:underline" target="_blank">View Document</a>
                                        </td>
                                        <td class="py-2 px-4 text-center">
                                            ${item.approval === 0 ?
                            `<p class="bg-white text-red-700 font-bold py-2 px-4 rounded">Rejected</p>` :
                            `<p class="bg-white text-green-700 font-bold py-2 px-4 rounded border">Approved</p>`
                        }
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    `;
                    document.getElementById('logModal').classList.remove('hidden');
                });
            })
            .catch(error => console.error('Error fetching reschedule log:', error));
    }

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