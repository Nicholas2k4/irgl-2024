<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
  </head>
  <body class="bg-black flex justify-center items-center h-full bg-[url('https://images.hdqwalls.com/download/neon-city-5k-3u-1920x1080.jpg')] bg-cover bg-center bg-no-repeat">
    @if ($errors->any())
    <script>
        Swal.fire({
            title: "Error",
            text: "{{ $errors->first() }}",
            icon: "error"
        });
    </script>
    @endif

    @if (session()->has('message'))
    <script>
        Swal.fire({
            title: "Info",
            text: "{{ session('message') }}",
            icon: "info"
        });
    </script>
    @endif
    @yield('container')
    <script>
      function showFileName(id) {
        var input = document.getElementById('file-' + id + '-id');
        var fileName = input.files[0] ? input.files[0].name : '';
        document.getElementById('img-name-' + id).textContent = fileName;
      }
    </script>
  </body>
</html>
