<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex items-center justify-center">

  <div class="bg-white w-full max-w-2xl p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-700 mb-6 flex items-center gap-2">
      <i data-feather="plus-circle" class="text-blue-600"></i> Tambah Mahasiswa
    </h2>

    <form action="{{ route('mahasiswa.store') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-semibold text-gray-600 mb-1">NPM</label>
        <input type="text" name="npm" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400" required>
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Mahasiswa</label>
        <input type="text" name="nama_mahs" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400" required>
      </div>

       <div>
        <label class="block text-sm font-semibold text-gray-600 mb-1">Kode Kelas</label>
        <input type="text" name="kode_kelas" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400" required>
      </div>

       <div>
        <label class="block text-sm font-semibold text-gray-600 mb-1">ID Prodi</label>
        <input type="text" name="id_prodi" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400" required>
      </div>

      <div class="flex justify-end gap-3 mt-6">
        <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
      </div>
    </form>
  </div>

  <script>
    feather.replace();
  </script>
</body>
</html>

