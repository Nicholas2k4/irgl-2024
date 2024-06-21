@extends('layout.admin')

@section('body')
<div class="justify-center items-center flex h-[90vh]">
<table class="w-[95vw] bg-white">
    <thead>
        <tr class="min-w-full">
            <th>No</th>
            <th>Team</th>
            <th>Line</th>
            <th>No Telp</th>
            <th>Data Anggota</th>
            <th>Bukti Transfer</th>
            <th>Action Bukti Transfer</th>
            <!-- <th>Validated Bukti Pembayaran by</th> -->
            <th>Last Edited</th>
            <th>Team Created</th>
        </tr>
    </thead>

    <tbody>
        @foreach($teams as $team =>$data)
        @if($team % 2 == 0)
        <tr class="bg-gray-200/90 border-t-[0.8px] border-b-[0.4px] border-gray-400/40 min-w-full">
        @else
        <tr class="bg-white">
        @endif
            <td>{{ ++$team}}</td>
            <td>{{ $data->nama}}</td>
            
            <td id="lineKetua">
                @foreach($users as $user =>$userData)
                @if($userData->is_ketua)
                    @if($userData->id_tim == $data->id)
                    {{ $userData->id_line }}
                    @endif
                @endif
                @endforeach
            </td>
            <td id="telpKetua">
            @foreach($users as $user =>$userData)
                @if($userData->is_ketua)
                    @if($userData->id_tim == $data->id)
                    {{ $userData->no_telp }}
                    @endif
                @endif
                @endforeach
            </td>
            <td id="anggotas"><button id="anggotaView" onclick="listAnggota()" class="h-4 w-5">View</button></td>
            <td>{{$data->link_bukti_tf}}</td>
            @if ($data->is_validated == false)
                                <td class="text-red-400">
                                    Belum Validasi Pembayaran
                                </td>
                            @else
                                <td>Validated</td>
                            @endif
            

            @if<td> {{ $data->updated_at }} </td>  
            <td> {{ $data->created_at }} </td> 

        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection

@section('script')
@endsection