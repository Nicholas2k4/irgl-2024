@extends('layout.admin')

@section('body')
<div class="justify-center items-center flex h-[90vh]">
    <div class="text-center">
    <h1 class="justify-center text-[#fff] font-[300] text-4xl">
            Haloo Adminn !
        </h1>
        <h1 class="justify-center text-white font-[700] text-3xl m-2">
            {{ strtoupper($username) }}
        </h1>
        <h1 class="justify-center text-white text-md">
            divisi {{ strtoupper($division_name) }} / {{ strtoupper($nrp) }}
        </h1>    </div>
</div>
@endsection

@section('script')
<script>
let bold = document.getElementById('home');
bold.className = 'text-[#fff] p-1 px-5 font-bold text-lg w-full h-full';
</script>
@endsection