@extends('layout.admin')

@section('body')
<div class="justify-center items-center mt-32 flex min-h-screen">
    <div class="w-[95vw] justify-center items-center flex flex-col rounded-2xl mr-4 bg-white">
        <div class="w-full h-[15%] flex items-center justify-center mt-6">
            <label for="inputCari">Search:</label>
            <input id="inputCari" oninput="search()" class="w-40 h-7 border-gray-400 border-[1px] ml-2 rounded-[3px]">
        </div>
        <table class="w-[90vw] justify-center items-center mt-10 mb-1">
            <thead>
                <tr class="min-w-full">
                    <th>No</th>
                    <th>Team</th>
                    <th>Line</th>
                    <th>No Telp</th>
                    <th>Data Anggota</th>
                    <th>Bukti Transfer</th>
                    <th>Action Bukti Transfer</th>
                    <th>Last Edited</th>
                    <th>Team Created</th>
                </tr>
            </thead>

            <tbody id="bodyTable">
                @foreach($teams as $team => $data)
                @if($team % 2 == 0)
                <tr class="bg-gray-200/90 text-center border-t-[0.8px] border-b-[0.4px] border-gray-400/40 min-w-full">
                    @else
                <tr class="bg-white text-center">
                    @endif
                    <td>{{ ++$team }}</td>
                    <td>{{ $data->nama }}</td>

                    <td id="lineKetua">
                        @foreach($users as $user => $userData)
                        @if($userData->is_ketua && $userData->id_tim == $data->id)
                        {{ $userData->id_line }}
                        @endif
                        @endforeach
                    </td>
                    <td id="telpKetua">
                        @foreach($users as $user => $userData)
                        @if($userData->is_ketua && $userData->id_tim == $data->id)
                        {{ $userData->no_telp }}
                        @endif
                        @endforeach
                    </td>
                    <td id="anggotas">
                        <button id="anggotaView{{$team}}" onclick="togglePopup({{$data->id}})" class="w-12 h-8 my-2 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 text-center">View</button>
                    </td>
                    <td>
                        <a href="{{ strpos($data->link_bukti_tf, 'http') === 0 ? $data->link_bukti_tf : 'https://' . $data->link_bukti_tf }}" target="_blank" class="w-12 h-8 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 flex text-center items-center justify-center">View</a>
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

                    @if($data->updated_at != null && $data->created_at != null)
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

<!-- Popup Section -->
<div id="popup" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50 z-10 hidden">
    <div class="w-[50vw] h-[94%] bg-white px-4 py-[10px] rounded-lg">
        <div class="w-full border-b-[1px] border-gray-400/30 flex flex-row justify-between">
            <h1 class="text-lg text-black">Detail Anggota</h1>
            <button onclick="togglePopup()" class="text-gray-500 hover:text-gray-800 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="w-full flex flex-row items-center border-b-[2px] border-black pt-4 pb-1 text-center">
            <h2 class="w-1/6">No</h2>
            <h2 class="w-2/6">Nama</h2>
            <h2 class="w-2/6">Line</h2>
            <h2 class="w-1/6">Foto</h2>
        </div>

        <div id="displayAnggota" class="w-full h-4/5 flex flex-col">
            <!-- border-t-[1px] border-b-[1px] border-gray-400/60 -->
        </div>

        <div class="w-full flex justify-end mt-2">
            <button onclick="togglePopup()" class="w-12 h-8 rounded-[4px] bg-gray-600 text-gray-200 text-center hover:bg-gray-800">Close</button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var dataUsers = <?php echo json_encode($users); ?>;
    var dataTeams = <?php echo json_encode($teams); ?>;

    function togglePopup(teamId) {
        const popup = document.getElementById('popup');
        let anggotaDiv = document.getElementById('displayAnggota')

        if (popup.classList.contains('hidden')) {
            // Display popup
            popup.classList.remove('hidden');

            let counter = 1;
            for (let i = 0; i < dataUsers.length; i++) {
                if (dataUsers[i]['id_tim'] == teamId) {
                    anggotaDiv.innerHTML += `
             <div class="w-full h-1/3 flex items-center text-center box-border border-b-[1px] border-gray-400/60">
    <h2 class="w-1/6 text-center">${counter}</h2>
    <h2 class="w-2/6 text-center">${dataUsers[i]['nama']}</h2>
    <h2 class="w-2/6 text-center">${dataUsers[i]['id_line']}</h2>
    <div class="w-1/6 text-center flex items-center justify-center">
<a href="${dataUsers[i]['link_foto'].startsWith('http://') || dataUsers[i]['link_foto'].startsWith('https://') ? dataUsers[i]['link_foto'] : 'https://' + dataUsers[i]['link_foto']}" target="_blank" class="w-12 h-8 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 flex text-center items-center justify-center">View</a>
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

        let temuTeam = [];
        let temuAnggotaTeam = [];

        if (input.value === '' || input.value === null) {
            records.innerHTML = `@foreach($teams as $team => $data)
            @if($team % 2 == 0)
            <tr class="bg-gray-200/90 text-center border-t-[0.8px] border-b-[0.4px] border-gray-400/40 min-w-full">
                @else
            <tr class="bg-white text-center">
                @endif
                <td>{{ ++$team }}</td>
                <td>{{ $data->nama }}</td>

                <td id="lineKetua">
                    @foreach($users as $user => $userData)
                    @if($userData->is_ketua && $userData->id_tim == $data->id)
                    {{ $userData->id_line }}
                    @endif
                    @endforeach
                </td>
                <td id="telpKetua">
                    @foreach($users as $user => $userData)
                    @if($userData->is_ketua && $userData->id_tim == $data->id)
                    {{ $userData->no_telp }}
                    @endif
                    @endforeach
                </td>
                <td id="anggotas">
                    <button id="anggotaView{{$team}}" onclick="togglePopup({{$data->id}})" class="w-12 h-8 my-2 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 text-center">View</button>
                </td>
                <td>
                <a href="{{ strpos($data->link_bukti_tf, 'http') === 0 ? $data->link_bukti_tf : 'https://' . $data->link_bukti_tf }}" target="_blank" class="w-12 h-8 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 flex text-center items-center justify-center">View</a>
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

                @if($data->updated_at != null && $data->created_at != null)
                <td>{{ $data->updated_at }}</td>
                <td>{{ $data->created_at }}</td>
                @else
                <td>null</td>
                <td>null</td>
                @endif
            </tr>
            @endforeach`;
        } else {
            for (let i = 0; i < dataTeams.length; i++) {
                if (dataTeams[i]['nama'].toLowerCase().trim().replace(/\s+/g, '').includes(input)) {
                    let temp = [dataTeams[i]['nama'], dataTeams[i]['id']];
                    temuTeam.push(temp);
                }
                if (input === 'false' || input.includes('validasi') || input.includes('gavalid') || input.includes('belumvalid')||input.includes('belomvalid') || input.includes('notvalid')) {
                    if (!dataTeams[i]['is_validated']) {
                        let temp = [dataTeams[i]['nama'], dataTeams[i]['id']];
                        temuTeam.push(temp);
                    }
                }

                for (let k = 0; k < dataUsers.length; k++) {
                    if (dataUsers[k]['id_tim'] === dataTeams[i]['id']) {
                        if ((dataUsers[k]['id_line'].toLowerCase().trim().replace(/\s+/g, '').includes(input) || dataUsers[k]['no_telp'].toLowerCase().trim().replace(/\s+/g, '').includes(input)) && dataUsers[k]['is_ketua']) {
                            let temp = [dataTeams[i]['nama'], dataTeams[i]['id']];
                            temuTeam.push(temp);
                        }
                    }
                }
            }
            for (let i = 0; i < dataUsers.length; i++) {
                for (let j = 0; j < temuTeam.length; j++) {
                    if (temuTeam[j][1] == dataUsers[i]['id_tim']) {
                        let tempAnggota = [dataUsers[i]['is_ketua'], dataUsers[i]['id_line'], dataUsers[i]['no_telp']]
                        temuAnggotaTeam.push(tempAnggota);
                    }
                }
            }
            // Buat Tabelnya dari temuTeam dan temuAnggotaTeam

            let recordsHtml = '';
            for (let i = 0; i < temuTeam.length; i++) {
                let team = temuTeam[i];
                let teamId = team[1];
                let ketua = temuAnggotaTeam.find(anggota => anggota[0] == teamId) || ['', ''];
                let ketuaLine = ketua[0];
                let ketuaTelp = ketua[1];
                let teamData = dataTeams.find(team => team['id'] == teamId);
                let isValidated = teamData.is_validated;
                let updatedAt = teamData.updated_at ? teamData.updated_at : 'null';
                let createdAt = teamData.created_at ? teamData.created_at : 'null';

                recordsHtml += `
        <tr class="${i % 2 == 0 ? 'bg-gray-200/90 text-center border-t-[0.8px] border-b-[0.4px] border-gray-400/40 min-w-full' : 'bg-white text-center'}">
            <td>${i + 1}</td>
            <td>${teamData.nama}</td>
            <td>${ketuaLine}</td>
            <td>${ketuaTelp}</td>
            <td>
                <button onclick="togglePopup(${teamId})" class="w-12 h-8 my-2 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 text-center">View</button>
            </td>
            <td>
                <a href="${teamData.link_bukti_tf.startsWith('http') ? teamData.link_bukti_tf : 'https://' + teamData.link_bukti_tf}" target="_blank" class="w-12 h-8 rounded-[4px] bg-blue-600 hover:bg-blue-800 text-gray-200 flex text-center items-center justify-center">View</a>
            </td>
            <td>
                ${isValidated ? 'Validated' : `
                    <form id="formValidasiBayar" action="/admin/validasiBuktiTransfer/${teamId}" method="POST" class="hidden">
                        @csrf
                    </form>
                    <button id="validasiBuktiTransfer" class="w-16 h-8 my-2 rounded-[4px] bg-green-600 hover:bg-green-800 text-gray-200 text-center">Validasi</button>
                `}
            </td>
            <td>${updatedAt}</td>
            <td>${createdAt}</td>
        </tr>
    `;
            }
            records.innerHTML = recordsHtml;
        }
    }

    window.addEventListener("keydown", function(event) {
        if (event.key === "Escape") {
            event.preventDefault();
            document.getElementById(`displayAnggota`).innerHTML = ``;
            popup.classList.add('hidden');
        }
    });
</script>

@if (session('success'))
<script>
    SweetAlert.fire({
        icon: 'success',
        title: '{{ session('
        success ') }}',
    });
</script>

{{ session()->forget('success') }}
@endif

@if (session('error'))
<script>
    SweetAlert.fire({
        icon: 'error',
        title: '{{ session('
        error ') }}',
    });


    {
        {
            session() - > forget('error')
        }
    }
</script>
@endif

@endsection