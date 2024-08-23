<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Homepage</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        html{
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-[url('/assets/bg-mobile.png')] bg-cover bg-fixed">
    <div class="absoulte inset-0 bg-black bg-opacity-40 h-full">
        @include('components.navbar')
        @include('components.about')
        @include('components.timeline')
        @include('components.faq')
    </div>

    
    <script>
        if(window.innerWidth >= 768){
            window.location.href = "{{ route('homepage') }}"
        }
        
        window.addEventListener('resize', function(){
            if(window.innerWidth >= 768){
                window.location.href = "{{ route('homepage') }}"
            }
        });
    </script>
</body>
</html>
