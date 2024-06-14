<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
  </head>
  <body class="bg-black flex justify-center items-center h-full">
    @livewire('register-form')
    @livewireScripts
    <script>
      function validatePasswords() {
        var password = document.getElementById('password-id').value;
        var confirmPassword = document.getElementById('confirm-password-id').value;
        if (password !== confirmPassword) {
            alert("Passwords do not match. Please try again.");
            return false;
        }
        return true;
    }
    </script>
  </body>
</html>
