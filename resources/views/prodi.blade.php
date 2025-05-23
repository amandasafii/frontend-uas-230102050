<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data prodi - Sistem Akademik</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-blue-800 min-h-screen text-white p-5 flex flex-col">
    <div class="flex items-center gap-2 mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.84 4.906c0 3.042-1.129 5.824-3.16 7.416a6.987 6.987 0 01-6.16 0c-2.031-1.592-3.16-4.374-3.16-7.416a12.083 12.083 0 01.84-4.906L12 14z" />
      </svg>
      <h1 class="text-2xl font-bold text-blue-100">Sistem Informasi Nilai</h1>
    </div>

    <div class="mb-6">
      <p class="font-semibold text-white">ADMINISTRATOR</p>
      <p class="text-green-300 text-sm">● Online</p>
    </div>

       <nav class="space-y-3">
  <a href="/" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-600 text-blue-100">
    <i data-feather="home"></i>
    <span>Dashboard</span>
  </a>
  <a href="{{ route('mahasiswa.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-600 text-blue-100">
    <i data-feather="user-check"></i>
    <span>Data Mahasiswa</span>
  </a>
  <a href="{{ route('kelas.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-600 text-blue-100"">
    <i data-feather="users"></i>
    <span>Data kelas</span>
  </a>
  <a href="{{ route('prodi.index') }}" class="flex items-center gap-3 px-3 py-2 rounded bg-white text-blue-800 font-semibold">
    <i data-feather="book"></i>
    <span>Data Prodi</span>
  </a>
</nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8 min-h-screen overflow-auto">
    <section>
      <h2 class="text-3xl font-bold text-gray-700 mb-6 flex items-center gap-2">
        <i data-feather="book" class="text-blue-600"></i> Data prodi
      </h2>

      <!-- Tombol Tambah & Search -->
      <div class="flex justify-between items-center mb-4">
        <a href="{{ route('prodi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          + Tambah Data
        </a>
       <form method="GET" action="{{ route('prodi.index') }}" class="relative w-64">
  <input 
    id="searchInput" 
    type="text" 
    name="search"
    placeholder="Cari prodi..." 
    value="{{ request('search') }}"
    class="pl-10 pr-4 py-2 w-full border rounded-md focus:outline-none focus:ring focus:ring-indigo-300 text-sm"
  />
  <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
  </svg>
</form>

      </div>
  
      <!-- Tabel -->
      <div class="bg-white rounded-xl shadow p-4 overflow-auto">
        <table class="min-w-full table-auto border border-gray-300">
          <thead>
            <tr class="bg-blue-100 text-left text-gray-700 text-sm uppercase">
              <th class="py-3 px-4 border border-gray-300">No</th>
              <th class="py-3 px-4 border border-gray-300">id prodi</th>
              <th class="py-3 px-4 border border-gray-300">Nama Program Studi</th>
              <th class="py-3 px-4 border border-gray-300 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody id="prodiTableBody">
            @foreach ($prodi as $index => $prd)
              <tr class="hover:bg-gray-50">
                <td class="py-2 px-4 border border-gray-300 text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $prd['id_prodi'] }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $prd['nama_prodi'] }}</td>
                <td class="py-2 px-4 border border-gray-300 text-center">
                  <a href="{{ route('prodi.edit', $prd['id_prodi']) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                  <form action="{{ route('prodi.destroy', $prd['id_prodi']) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Hapus</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </main>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Ganti ikon Feather
    feather.replace();

    // Live search di tabel prodi
    const searchInput = document.getElementById("searchInput");
    const tableBody = document.getElementById("prodiTableBody");

    searchInput.addEventListener("input", function () {
      const keyword = this.value.toLowerCase();
      const rows = tableBody.getElementsByTagName("tr");

      Array.from(rows).forEach((row) => {
        const rowText = row.textContent.toLowerCase();
        row.style.display = rowText.includes(keyword) ? "" : "none";
      });
    });
  });
  </script>
</body>
</html>
