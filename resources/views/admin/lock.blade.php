@extends('layout.admin')

@section('body')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "{{ session('success') }}"
            });
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "{{ session('error') }}"
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "{{ $errors->first() }}"
            });
        </script>
    @endif

    <div class="h-fit p-10 text-center">
        <div class="bg-gradient-to-r from-[#133D7D] to-[#711191]  rounded-lg px-7 py-4 w-full md:w-1/2 mx-auto">
            <h1 class="font-bold text-white text-2xl mt-3 mb-5 tracking-wider md:text-3xl">Lock</h1>
            <form action="{{ route('admin.lock.store') }}" method="POST" id="form-lock">
                @csrf
                <div class="flex flex-col items-start mb-5">
                    <h2 class="text-white mb-1">Price<i class="text-sm font-bold"></i>
                    </h2>
                    <input type="number" id="price"
                        class="item-qty w-full rounded-lg bg-transparent text-white border-white focus:border-indigo-500 focus:ring-indigo-500"
                        name="price">
                </div>
            </form>
            <button id='submit-lock'
                class="bg-gradient-to-r from-green-300 to-green-700
                 hover:from-[#235aad] hover:via-[#845893] hover:to-[#497cc9] px-4 py-2 rounded-lg cursor-pointer mt-4 text-white font-bold ease-in-out duration-500">Try Lock</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Confirmation before submit
            $('#submit-lock').on('click', function(event) {
                Swal.fire({
                    title: "Test lock?",
                    showCancelButton: true,
                    confirmButtonText: "Yeah!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-lock').submit();
                    }
                });
            });
        })
    </script>
@endsection
