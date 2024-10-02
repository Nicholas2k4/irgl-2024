@extends('layout.admin')

@section('body')
    @if (session('success'))
        <script>
            Swal.fire({
                'icon': 'success',
                'title': 'Success',
                'text': "{{ session('success') }}"
            })
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                'icon': 'error',
                'title': 'Error',
                'text': "{{ session('error') }}"
            })
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ $errors->first() }}",
                icon: "error"
            });
        </script>
    @endif


    <div class="bg-white bg-opacity-70 w-[90%] sm:w-[70%] md:w-[50%] mx-auto mt-10 rounded-lg relative p-4">
        <form action="{{ route('admin.infos.update', $info->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="px-5 py-1">
                <h2 class="font-xl font-bold mb-1">Title</h2>
                <input type="text" class="border-none rounded min-w-full" name="title" required value="{{ $info->title }}">
            </div>
            <div class="px-5 py-1 mb-4">
                <h2 class="font-xl font-bold mb-1">Content</h2>
                <input type="text" class="border-none rounded min-w-full" name="content" required value="{{ $info->content }}">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded ml-5">
                Update
            </button>
            <a href="{{ route('admin.infos.index') }}"><button type="button" type="submit"
                    class="bg-gray-300 hover:bg-gray-500 text-gray-800 font-bold py-2 px-5 rounded">
                    Back</button></a>
        </form>
    </div>
@endsection

@section('script')
    <script>
        let bold = document.getElementById('infos');
        bold.className = 'text-[#fff] p-1 px-5 font-bold text-lg w-full h-full';
    </script>
@endsection