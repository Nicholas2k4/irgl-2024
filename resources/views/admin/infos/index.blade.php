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

    <div
        class="container mx-auto p-8 pt-10 mt-16 bg-white dark:bg-black bg-opacity-70 dark:bg-opacity-30 shadow-lg rounded-lg min-w-[85%] sm:min-w-[75%]">
        <h1 class="text-3xl font-bold mb-4 dark:text-white text-center">Information</h1>
        <div class="container mx-auto">

            <a href="{{ route('admin.infos.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                Add New Information
            </a>
            <div class="overflow-auto max-h-[500px]">
                <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-lg">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-2 px-4 text-center w-1/12">No</th>
                            <th class="py-2 px-4 text-center w-2/12">Title</th>
                            <th class="py-2 px-4 text-center w-7/12">Content</th>
                            <th class="py-2 px-4 text-center min-w-[200px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-200">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($infos as $info)
                            <tr>
                                <td class="py-2 px-4 text-center">{{ $i }}</td>
                                <td class="py-2 px-4 text-center">{{ $info->title }}</td>
                                <td class="py-2 px-4 text-center">{{ $info->content }}</td>
                                <td class="py-2 px-4 text-center">
                                    <a href="{{ route('admin.infos.edit', $info->id) }}"
                                        class="inline-block rounded bg-yellow-300 px-4 py-2 text-xs font-medium uppercase leading-normal text-gray-800 shadow-md transition duration-150 ease-in-out hover:bg-yellow-400 focus:bg-yellow-400 active:bg-yellow-500">Edit</a>
                                    <form action="{{ route('admin.infos.destroy', $info->id) }}"
                                        id="deleteForm{{ $info->id }}" class="hidden" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    <button
                                        class="deleteBtn inline-block rounded bg-red-400 px-4 py-2 text-xs font-medium uppercase leading-normal text-gray-800 shadow-md transition duration-150 ease-in-out hover:bg-red-500 focus:bg-red-500 active:bg-red-600 ml-4"
                                        id="{{ $info->id }}">Delete</button>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let bold = document.getElementById('infos');
        bold.className = 'text-[#fff] p-1 px-5 font-bold text-lg w-full h-full';

        $(document).ready(function() {
            $('.deleteBtn').on('click', function() {
                Swal.fire({
                    title: "Delete this info?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#777",
                    confirmButtonText: "Delete"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteForm' + this.id).submit();
                    }
                });
                console.log(this.id);
            })
        });
    </script>
@endsection
