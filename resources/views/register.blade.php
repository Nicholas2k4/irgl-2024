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
    <div class="bg-[rgba(255,255,255,0.1)] shadow-[0_0_20px_rgba(255,255,255,0.1)] p-10 rounded-[20px] text-center">
      <form>
        <h2 class="text-2xl text-white font-bold mb-4">Register</h2>
        
        <div class="mb-2 flex flex-col items-left">
          <label for="username-id" class="text-white text-left ml-4">Nama Ketua Tim</label>
          <input type="text" id="username-id" name="username" placeholder="Contoh: Ferdinand Jonathan" required autocomplete="name" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
          <label for="no-rekening-ketua-tim" class="text-white text-left ml-4">No rekening ketua tim</label>
          <input type="text" id="no-rekening-ketua-tim" name="no-rekening-ketua-tim" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
          <label for="tanggal-lahir-id" class="text-white text-left ml-4">Tanggal lahir</label>
          <input type="date" id="tanggal-lahir-id" name="tanggal-lahir-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>

        <div class="mb-2 flex flex-col items-left">
          <label for="tempat-lahir-id" class="text-white text-left ml-4">Tempat kota lahir</label>
          <input type="text" id="tempat-lahir-id" name="tempat-lahir-name" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
          <label for="address-id" class="text-white text-left ml-4">Alamat</label>
          <textarea id="address-id" name="address" autocomplete="street-address" class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none"></textarea>
        </div>
        
        <div class="mb-2 flex flex-col items-left">
          <label for="phone" class="text-white text-left ml-4">No telp aktif</label>
          <input type="text" id="phone" name="phone" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
          <label for="idline" class="text-white text-left ml-4">ID Line</label>
          <input type="text" id="idline" name="idline" required class="flex-1 bg-[rgba(255,255,255,0.1)] text-white shadow-[0_0_10px_rgba(255,255,255,0.1)] p-2.5 rounded-[5px] border-none">
        </div>
        
        <div class="mb-2 flex flex-col items-left">
          <label for="file" class="text-white block text-left mb-2">Foto kartu siswa & surat pernyataan siswa aktif</label>
          <div class="relative overflow-hidden inline-block cursor-pointer bg-[#B026FF] text-white px-5 py-2.5 w-[70px] rounded-[5px]">
            <input type="file" id="file" name="file" accept="image/*" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" onchange="showFileName()">
            <span class="text-2xl material-icons">cloud_upload</span>
          </div>
          <div id="img-name" class="text-white mt-2"></div>
        </div>
        
        <button type="submit" class="bg-[#B026FF] text-black text-base cursor-pointer transition-colors duration-300 ease-in-out px-5 py-2.5 rounded-[5px] border-none hover:bg-[#0f0]">Next</button>
      </form>
    </div>
    
    <script>
      function showFileName() {
        var input = document.getElementById('file');
        var fileName = input.files[0] ? input.files[0].name : '';
        document.getElementById('img-name').textContent = fileName;
      }
    </script>
  </body>
</html>
