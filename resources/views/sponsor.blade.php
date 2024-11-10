<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sponsor Page</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        @keyframes iterate {
            0% {
                opacity: 1;
            }

            15% {
                color: rgb(255, 237, 135);
                text-shadow: -3px -1px 3px #F946FA, 3px 1px 3px #4087CF, 0px 0px 20px white;
            }

            30% {
                opacity: 1;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body
    class="bg-[url('/assets/bg-semi.jpg')] bg-cover bg-center bg-no-repeat flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-5 bg-transparent shadow-lg rounded-md">
        <h1 id="ty" class="text-white text-4xl sm:text-5xl md:text-6xl font-bold text-center mb-12">Thank you for participating IRGL 2024!</h1>
        <p id="sponsor" class="text-white text-md sm:text-xl text-center mb-6"
            style="text-shadow: 2px 1px 3px #4087CF">Sponsored by:</p>
        <div class="grid grid-cols-12 justify-center">
            <img src="{{ asset('assets/dnet.png') }}" alt="Sponsor 1 Logo" class="w-full col-span-12 sm:col-span-5 h-auto object-contain p-6">
            <div class="col-span-0 sm:col-span-2"></div>
            <img src="{{ asset('assets/amigo.png') }}" alt="Sponsor 2 Logo" class="w-full col-span-12 sm:col-span-5 h-auto object-contain p-6">
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        let thankText = $('#ty').html();

        let ele = '';
        for (let i = 0; i < thankText.length; i++) {
            ele += '<span>' + thankText[i] + '</span>';
        }
        $('#ty').html(ele);

        $('#ty span').each(function(index) {
            const delay = index * 140;
            console.log(delay);
            setTimeout(() => {
                $(this).css('animation', 'iterate 5.5s ease-in-out infinite');
            }, delay);
        });
    });
</script>

</html>
