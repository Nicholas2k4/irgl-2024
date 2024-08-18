@extends('layout.admin')

@section('body')
<div class="justify-center items-center flex max-w-[100vw] min-h-screen">
    <div class="w-[93.6vw] justify-evenly items-center flex flex-col rounded-2xl bg-white">

        <div class="w-full h-[15%] flex items-center justify-center mt-6">
            <label for="inputCari">Search:</label>
            <input id="inputCari" oninput="search()" datasearch class="w-40 h-7 border-gray-400 border-[1px] ml-2 rounded-[3px]">
        </div>

        <div class="overflow-auto sm:overflow-x-scroll w-[98%] relative mb-2 px-4">
            <table class="justify-center items-center mt-10 mb-1 w-[150vw]" id="teamTable">
                <thead>
                    <tr class="min-w-full">
                        <th class="min-w-[28px] cursor-pointer" onclick="sortBy(0)">No</th>
                        <th class="min-w-[100px] cursor-pointer" onclick="sortBy(1)">Team</th>
                        <th class="min-w-[112px] max-w-[136px] cursor-pointer" onclick="sortBy(2)">Line</th>
                        <th class="min-w-[112px] max-w-[136px] cursor-pointer" onclick="sortBy(3)">No Telp</th>
                        <th class="min-w-[90px] cursor-pointer max-w-[80px]" onclick="sortBy(4)">Data Anggota</th>
                        <th class="min-w-[90px] max-w-[80px] cursor-pointer" onclick="sortBy(5)">Bukti Transfer</th>
                        <th class="cursor-pointer min-w-[90px] max-w-[80px]" onclick="sortBy(6)">Action Bukti Transfer</th>
                        <th class="min-w-[150px] cursor-pointer max-w-[180px]" onclick="sortBy(7)">Last Edited</th>
                        <th class="min-w-[150px] max-w-[180px] cursor-pointer" onclick="sortBy(8)">Team Created</th>
                    </tr>
                </thead>

                <tbody id="bodyTable" class="text-center">
                    @foreach ($teams as $team => $data)
                    @if ($team % 2 == 0)
                    <tr
                        class="bg-gray-200/90 text-center border-t-[0.8px] border-b-[0.4px] border-gray-400/40 min-w-full">
                        @else
                    <tr class="bg-white text-center">
                        @endif
                        <td>{{ ++$team }}</td>
                        <td>{{ $data->nama }}</td>

                        <td id="lineKetua">
                            @foreach ($users as $user => $userData)
                            @if ($userData->is_ketua && $userData->id_tim == $data->id)
                            {{ $userData->id_line }}
                            @endif
                            @endforeach
                        </td>
                        <td id="telpKetua">
                            @foreach ($users as $user => $userData)
                            @if ($userData->is_ketua && $userData->id_tim == $data->id)
                            {{ $userData->no_telp }}
                            @endif
                            @endforeach
                        </td>
                        <td id="anggotas">
                            <button id="anggotaView{{ $team }}" onclick="togglePopup('{{ $data->id }}')"
                                class="w-12 h-8 my-2 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 text-center">View</button>
                        </td>
                        <td>
                            <button
                                class="w-12 h-8 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 text-center">
                                <a href="{{ '/storage' . asset(str_replace('public/', '', $data->link_bukti_tf)) }}" target="_blank">View</a>
                            </button>
                        </td>

                        @if ($data->is_validated == false)
                        <td>
                            <form id="formValidasiBayar"
                                action="{{ route('admin.validasiBuktiTransfer', ['id' => $data->id]) }}"
                                method="POST" class="hidden">
                                @csrf
                            </form>

                            <button id="validasiBuktiTransfer"
                                class="w-16 h-8 my-2 rounded-[4px] bg-green-600 hover:bg-green-800 text-gray-200 text-center">Validasi</button>
                        </td>
                        @else
                        <td>Validated</td>
                        @endif

                        @if ($data->updated_at != null && $data->created_at != null)
                        <td>{{ $data->updated_at }}</td>
                        <td>{{ $data->created_at }}</td>
                        @else
                        <td>null</td>
                        <td>null</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Popup Section -->
<div id="popup"
    class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50 z-10 hidden">
    <div class="md:w-[66vw] h-[94%] w-[85vw]  bg-white px-4 py-[10px] rounded-lg">
        <div class="w-full border-b-[1px] border-gray-400/30 flex flex-row justify-between">
            <h1 class="text-lg text-black">Detail Anggota</h1>
            <button onclick="togglePopup()" class="text-gray-500 hover:text-gray-800 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <div class="w-full flex flex-row items-center border-b-[2px] border-black pt-4 pb-1 text-center">
            <h2 class="min-w-[25px]">No</h2>
            <h2 class="w-2/6">Nama</h2>
            <h2 class="w-2/6">Line</h2>
            <h2 class="min-w-[60px] sm:w-1/6">Foto</h2>
        </div>

        <div id="displayAnggota" class="w-full h-4/5 flex flex-col">
            <!-- border-t-[1px] border-b-[1px] border-gray-400/60 -->
        </div>

        <div class="w-full flex justify-end mt-2">
            <button onclick="togglePopup()"
                class="w-12 h-8 rounded-[4px] bg-gray-600 text-gray-200 text-center hover:bg-gray-800">Close</button>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    let bold = document.getElementById('rekapTeam');
    bold.className = 'text-[#fff] p-1 px-5 font-bold text-lg w-full h-full';

    var dataUsers = <?php echo json_encode($users); ?>;
    var dataTeams = <?php echo json_encode($teams); ?>;

    function asset(path) {
        const baseUrl = '{{ url(' / ') }}'; // Base URL of your Laravel application
        return baseUrl + '/' + path;
    }

    function togglePopup(teamId) {
        console.log(teamId)
        const popup = document.getElementById('popup');
        let anggotaDiv = document.getElementById('displayAnggota')

        if (popup.classList.contains('hidden')) {
            // Display popup
            popup.classList.remove('hidden');

            let counter = 1;
            for (let i = 0; i < dataUsers.length; i++) {
                if (dataUsers[i]['id_tim'] == teamId) {
                    const linkFoto = dataUsers[i]['link_foto'].replace('public/', '');
                    anggotaDiv.innerHTML += `
             <div class="w-full h-1/3 flex items-center text-center box-border border-b-[1px] border-gray-400/60">
    <h2 class="min-w-[25px] text-center text-sm sm:text-base">${counter}</h2>
    <h2 class="w-2/6 text-center text-sm sm:text-base">${dataUsers[i]['nama']}</h2>
    <h2 class="w-2/6 text-center text-sm sm:text-base">${dataUsers[i]['id_line']}</h2>
    <div class="min-w-[60px] sm:w-1/6 text-center text-sm sm:text-base flex items-center justify-center">
<a href="${asset('storage/' + linkFoto)}" target="_blank" class="w-12 h-8 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 flex text-center items-center justify-center">View</a>
    </div>
  </div>
  `;
                    counter++;
                }

            }

        } else {
            anggotaDiv.innerHTML = ``;
            popup.classList.add('hidden');

        }
    }
    $(document).on("click", "#validasiBuktiTransfer", function() {
        Swal.fire({
            title: 'Apakah anda yakin validasi bukti transfer?',
            text: "Anda tidak dapat mengembalikan tindakan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Validasi!'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = $(this).siblings('#formValidasiBayar');
                form.submit();
            }
        });
    });

    function search() {
        let records = document.getElementById('bodyTable')
        let input = document.getElementById('inputCari').value
        input = input.toLowerCase().trim().replace(/\s+/g, '')

        var temuTeam = [];
        var temuAnggotaTeam = [];
        var seenTeams = new Set();

        if (input === '' || input === null) {
            records.innerHTML = `                @foreach ($teams as $team => $data)
                @if ($team % 2 == 0)
                <tr class="bg-gray-200/90 text-center border-t-[0.8px] border-b-[0.4px] border-gray-400/40 min-w-full">
                    @else
                <tr class="bg-white text-center">
                    @endif
                    <td>{{ ++$team }}</td>
                    <td>{{ $data->nama }}</td>

                    <td id="lineKetua">
                        @foreach ($users as $user => $userData)
                        @if ($userData->is_ketua && $userData->id_tim == $data->id)
                        {{ $userData->id_line }}
                        @endif
                        @endforeach
                    </td>
                    <td id="telpKetua">
                        @foreach ($users as $user => $userData)
                        @if ($userData->is_ketua && $userData->id_tim == $data->id)
                        {{ $userData->no_telp }}
                        @endif
                        @endforeach
                    </td>
                    <td id="anggotas">
                        <button id="anggotaView{{ $team }}" onclick="togglePopup('{{ $data->id }}')" class="w-12 h-8 my-2 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 text-center">View</button>
                    </td>
                    <td>
                        <button class="w-12 h-8 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 text-center">
                            <a href="{{ asset('storage/uploads/' . basename($data->link_bukti_tf)) }}" target="_blank">View</a>
                        </button>
                    </td>

                    @if ($data->is_validated == false)
                    <td>
                        <form id="formValidasiBayar" action="{{ route('admin.validasiBuktiTransfer', ['id' => $data->id]) }}" method="POST" class="hidden">
                            @csrf
                        </form>

                        <button id="validasiBuktiTransfer" class="w-16 h-8 my-2 rounded-[4px] bg-green-600 hover:bg-green-800 text-gray-200 text-center">Validasi</button>
                    </td>
                    @else
                    <td>Validated</td>
                    @endif

                    @if ($data->updated_at != null && $data->created_at != null)
                    <td>{{ $data->updated_at }}</td>
                    <td>{{ $data->created_at }}</td>
                    @else
                    <td>null</td>
                    <td>null</td>
                    @endif
                </tr>
                @endforeach`;
        } else {

            // KARENA 3x looping for makanya ada yang bisa kedouble antara ketua dan anggota" nya

            for (let i = 0; i < dataTeams.length; i++) {
                if (!seenTeams.has(dataTeams[i]['id'])) {
                    if (dataTeams[i]['nama'].toLowerCase().trim().replace(/\s+/g, '').includes(input)) {
                        let temp = [dataTeams[i]['nama'], dataTeams[i]['id'], dataTeams[i]['link_bukti_tf'], dataTeams[i][
                            'is_validated'
                        ], dataTeams[i]['created_at'], dataTeams[i]['updated_at']];
                        temuTeam.push(temp);
                        seenTeams.add(dataTeams[i]['id']);
                    }
                    if (input === 'false' || input.includes('validasi') || input.includes('gavalid') || input.includes(
                            'belumvalid') || input.includes('belomvalid') || input.includes('notvalid')) {
                        if (!dataTeams[i]['is_validated']) {
                            let temp = [dataTeams[i]['nama'], dataTeams[i]['id'], dataTeams[i]['link_bukti_tf'], dataTeams[
                                i]['is_validated'], dataTeams[i]['created_at'], dataTeams[i]['updated_at']];
                            temuTeam.push(temp);
                            seenTeams.add(dataTeams[i]['id']);
                        }
                    }

                    for (let k = 0; k < dataUsers.length; k++) {
                        if (dataUsers[k]['id_tim'] === dataTeams[i]['id'] && !seenTeams.has(dataTeams[i]['id'])) {
                            if ((dataUsers[k]['id_line'].toLowerCase().trim().replace(/\s+/g, '').includes(input) ||
                                    dataUsers[k]['no_telp'].toLowerCase().trim().replace(/\s+/g, '').includes(input)) &&
                                dataUsers[k]['is_ketua']) {
                                let temp = [dataTeams[i]['nama'], dataTeams[i]['id'], dataTeams[i]['link_bukti_tf'],
                                    dataTeams[i]['is_validated'], dataTeams[i]['created_at'], dataTeams[i]['updated_at']
                                ];
                                temuTeam.push(temp);
                                seenTeams.add(dataTeams[i]['id']);
                            }
                        }
                    }
                }
            }
            for (let i = 0; i < dataUsers.length; i++) {
                for (let j = 0; j < temuTeam.length; j++) {
                    if (temuTeam[j][1] == dataUsers[i]['id_tim']) {
                        let tempAnggota = [dataUsers[i]['is_ketua'], dataUsers[i]['id_line'], dataUsers[i]['no_telp'],
                            dataUsers[i]['id_tim'], dataUsers[i]['nama']
                        ]
                        temuAnggotaTeam.push(tempAnggota);
                    }
                }
            }
            // Buat Tabelnya dari temuTeam dan temuAnggotaTeam

            records.innerHTML = "";
            console.log(temuTeam);

            for (let i = 0; i < temuTeam.length; i++) {
                let teamId = temuTeam[i][1];
                let tempAnggota = [];
                for (j = 0; j < temuAnggotaTeam.length; j++) {
                    if (temuAnggotaTeam[j][3] == teamId && temuAnggotaTeam[j][0]) {
                        tempAnggota.push(temuAnggotaTeam[j][1], temuAnggotaTeam[j][2], temuAnggotaTeam[j][4])
                    }
                }
                let ketua = tempAnggota[2];
                let ketuaLine = tempAnggota[0];
                let ketuaTelp = tempAnggota[1];

                let isValidated = temuTeam[i][3];

                let createdAt = 'null';
                let updatedAt = 'null';

                if (temuTeam[i][5] != null && temuTeam[i][4] != null) {
                    createdAt = temuTeam[i][4];
                    updatedAt = temuTeam[i][5];

                    const createdate = new Date(createdAt);
                    var formatcreate_at = createdate.toLocaleString('en-CA', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false,
                        timeZone: 'Asia/Jakarta'
                    }).replace(',', '');

                    const updatedate = new Date(updatedAt);

                    var formatupdated_at = updatedate.toLocaleString('en-CA', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false,
                        timeZone: 'Asia/Jakarta'
                    }).replace(',', '');
                }

                records.innerHTML += `
        <tr class="${i % 2 == 0 ? 'bg-gray-200/90 text-center border-t-[0.8px] border-b-[0.4px] border-gray-400/40 min-w-full' : 'bg-white text-center'}">
            <td>${i + 1}</td>
            <td>${temuTeam[i][0]}</td>
            <td>${ketuaLine}</td>
            <td>${ketuaTelp}</td>
            <td>
                <button id="anggotaView{{ $team }}" onclick="togglePopup('${teamId}')" class="w-12 h-8 my-2 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 text-center">View</button>
            </td>
            <td>
                <button class="w-12 h-8 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 text-center">
                    <a href="{{ '/storage' . asset(str_replace('public/', '', '${temuTeam[i][2]}')) }}" target="_blank">View</a>
                </button>
            </td>
            <td>
                ${isValidated ? 'Validated' : `
                                    <form id="formValidasiBayar" action="/admin/validasiBuktiTransfer/${teamId}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                    <button id="validasiBuktiTransfer" class="w-16 h-8 my-2 rounded-[4px] bg-green-600 hover:bg-green-800 text-gray-200 text-center">Validasi</button>
                                `}
            </td>
            <td>${formatupdated_at}</td>
            <td>${formatcreate_at}</td>
        </tr>
    `;
            }
        }
    }

    window.addEventListener("keydown", function(event) {
        if (event.key === "Escape") {
            event.preventDefault();
            document.getElementById(`displayAnggota`).innerHTML = ``;
            popup.classList.add('hidden');
        }
    });
    
    let sort = [null, null, null, null, null, null, null, null, null];

    function sortBy(columnIndex){
        const table = document.getElementById("teamTable");

        let dataRow = Array.from(table.rows).slice(1) //slice <th>
        let sortdir = sort[columnIndex] === 'asc' ? 'desc' : 'asc'

        if (sort[columnIndex] === 'desc') {
        sortdir = null;
    }

    dataRow.sort((a, b) => {
        const cellA = a.cells[columnIndex].innerText.toLowerCase();
        const cellB = b.cells[columnIndex].innerText.toLowerCase();

        if (sortdir === 'asc') {
            return cellA > cellB ? 1 : -1;
        } else if (sortdir === 'desc') {
            return cellA < cellB ? 1 : -1;
        } else {
            return 0; //default
        }
    });

    sort = [null, null, null, null, null, null, null, null, null];
    sort[columnIndex] = sortdir;

    if (sortdir) {
        for (let dataRowa of dataRow) {
            table.tBodies[0].appendChild(dataRowa);
        }
    } else {
        // Restore the original order
        dataRow.sort((a, b) => a.rowIndex - b.rowIndex);
        for (let dataRowa of dataRow) {
            table.tBodies[0].appendChild(dataRowa);
        }
    }

    }
</script>

@if (session('success'))
        <script>
            SweetAlert.fire({
                icon: 'success',
                title: '{{ session('success') }}',
            });
        </script>
        {{ session()->forget('success') }}
    @endif


    @if (session('error'))
        <script>
            SweetAlert.fire({
                icon: 'error',
                title: '{{ session('error') }}',
            });
        </script>
        {{ session()->forget('error') }}
    @endif
@endsection