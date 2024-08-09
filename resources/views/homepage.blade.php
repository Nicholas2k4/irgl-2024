<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Homepage</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body class="bg-[url('/assets/bg-mobile.png')] bg-cover bg-fixed">
    @include('components.navbar')
    @include('components.about')
    @include('components.timeline')
    @include('components.faq')

    <script>
        
        if(window.innerWidth >= 768){
            window.location.href = "{{ route('homepage.pc') }}"
        }
        
        window.addEventListener('resize', function(){
            if(window.innerWidth >= 768){
                window.location.href = "{{ route('homepage.pc') }}"
            }
        });
    </script>
</body>
</html>
