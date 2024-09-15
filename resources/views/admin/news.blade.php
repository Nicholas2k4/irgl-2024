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
            <h1 class="text-left text-white text-xl">Slug: {{ $current_news->slug }}</h1>
            <h1 class="text-left text-white text-xl">Content: {{ $current_news->content }}</h1>
            <h1 class="text-left text-white text-xl">Email filter price: {{ $current_news->email_filter_price }}</h1>
            <h1 class="text-left text-white text-xl">Encryption machine price: {{ $current_news->encryption_machine_price }}
            </h1>
            <h1 class="text-left text-white text-xl">Traffic controller price: {{ $current_news->traffic_controller_price }}
            </h1>
            <h1 class="text-left text-white text-xl">Antivirus price: {{ $current_news->antivirus_price }}</h1>
            <h1 class="text-left text-white text-xl">Input validator price: {{ $current_news->input_validator_price }}</h1>
            <h1 class="text-left text-white text-xl">Slot left: {{ $current_news->slot }}</h1>
            <h1 class="text-left text-white text-xl">Next news slug: {{ $current_news->next_slug }}</h1>
            <h1 class="text-left text-white text-xl">Attack type: {{ $current_news->attack_type }}</h1>

            <form action="{{ route('admin.news.skipNews') }}" method="POST" id="form-next">
                @csrf
            </form>
            <button id='submit-next'
                class="bg-gradient-to-r from-green-300 to-green-700
             hover:from-[#235aad] hover:via-[#845893] hover:to-[#497cc9] px-4 py-2 rounded-lg cursor-pointer mt-4 text-white font-bold ease-in-out duration-500">Skip News</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let bold = document.getElementById('news');
        bold.className = 'text-[#fff] p-1 px-5 font-bold text-lg w-full h-full';

        $(document).ready(function() {
            // Confirmation before submit
            $('#submit-next').on('click', function(event) {
                Swal.fire({
                    title: "Skip to next news?",
                    showCancelButton: true,
                    confirmButtonText: "SKIP!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-next').submit();
                    }
                });
            });
        })
    </script>
@endsection
