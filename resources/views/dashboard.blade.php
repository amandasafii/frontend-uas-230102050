<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex">

  <!-- Sidebar (pakai persis class & struktur kamu) -->
 <aside class="w-64 bg-blue-800 min-h-screen text-white p-5 flex flex-col">
  <div class="flex items-center gap-2 mb-6">
    <!-- Ikon topi beasiswa SVG -->
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
  <a href="/" class="flex items-center gap-3 px-3 py-2 rounded bg-white text-blue-800 font-semibold">
    <i data-feather="home"></i>
    <span>Dashboard</span>
  </a>
  <a href="{{ route('mahasiswa.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-600 text-blue-100">
    <i data-feather="user-check"></i>
    <span>Data Mahasiswa</span>
  </a>
  <a href="{{ route('kelas.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-600 text-blue-100">
    <i data-feather="users"></i>
    <span>Data Matkul</span>
  </a>
  <a href="{{ route('prodi.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-600 text-blue-100">
    <i data-feather="book"></i>
    <span>Data Prodi</span>
  </a>
  <a href="{{ route('matkul.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-600 text-blue-100">
    <i data-feather="book"></i>
    <span>Mata Kuliah</span>
  </a>
</nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8 min-h-screen overflow-auto">
    <!-- Dashboard -->
    <section id="dashboard" class="page-content block">
      <h2 class="text-3xl font-bold text-gray-700 flex items-center gap-2 mb-6">
        <i data-feather="home" class="text-blue-600"></i> Dashboard
      </h2>

        <!-- Kotak selamat datang -->
  <div class="bg-white rounded-xl shadow-md p-6 mb-8 text-center">
    <h3 class="text-3xl font-bold text-gray-800 mb-2">✨Selamat Datang di Sistem Informasi Nilai✨</h3>
    <p class="text-gray-600 text-lg">Kelola data mahasiswa, kelas, dan program studi dengan mudah.</p>
  </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
  <!-- Mahasiswa -->
  <div class="bg-blue-400 text-white p-6 rounded-xl shadow hover:shadow-md transition">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-3xl font-bold">2</p>
        <p class="mt-1">Mahasiswa</p>
      </div>
      <div class="text-4xl">🎓</div>
    </div>
  </div>

  <!-- Kelas -->
  <div class="bg-indigo-400 text-white p-6 rounded-xl shadow hover:shadow-md transition">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-3xl font-bold">1</p>
        <p class="mt-1">Matkul</p>
      </div>
      <div class="text-4xl">🏫</div>
    </div>
  </div>

  <!-- Program Studi -->
  <div class="bg-cyan-400 text-white p-6 rounded-xl shadow hover:shadow-md transition">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-3xl font-bold">3</p>
        <p class="mt-1">Program Studi</p>
      </div>
      <div class="text-4xl">📚</div>
    </div>
  </div>
</div>
<!-- Program Studi -->
  <div class="bg-cyan-400 text-white p-6 rounded-xl shadow hover:shadow-md transition">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-3xl font-bold">4</p>
        <p class="mt-1">Mata Kuliah</p>
      </div>
      <div class="text-4xl">📚</div>
    </div>
  </div>
</div>

    </section>

    <!-- Data Mahasiswa
    <section id="mahasiswa" class="page-content hidden">
      <h2 class="text-3xl font-bold text-gray-700 mb-6">Data Mahasiswa Terbaru</h2>
      <div class="bg-white p-6 rounded-xl shadow">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-semibold text-gray-700">Data Mahasiswa Terbaru</h3>
          <a href="tambah.html" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah</a>
        </div>
        <table class="w-full table-auto text-sm text-left border">
          <thead class="bg-blue-50">
            <tr>
              <th class="p-2">No</th>
              <th class="p-2">Nama</th>
              <th class="p-2">Username</th>
              <th class="p-2">Email</th>
              <th class="p-2">Jenis Kelamin</th>
              <th class="p-2">Telp</th>
              <th class="p-2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-t hover:bg-gray-50">
              <td class="p-2">1</td>
              <td class="p-2">ROHMAN</td>
              <td class="p-2">rohman</td>
              <td class="p-2">rohman@gmail.com</td>
              <td class="p-2">Pria</td>
              <td class="p-2">081212341234</td>
              <td class="p-2">
                <a href="edit.html" class="text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section> -->

    <!-- Data Dosen
    <section id="dosen" class="page-content hidden">
      <h2 class="text-3xl font-bold text-gray-700 mb-6">Data Dosen</h2>
      <p class="text-gray-600">Konten data dosen akan muncul di sini.</p>
    </section> -->
  </main>

  <!-- <script>
    feather.replace();

    const navLinks = document.querySelectorAll(".nav-link");
    const pages = document.querySelectorAll(".page-content");

    function setActivePage(pageId) {
      pages.forEach(page => {
        if (page.id === pageId) {
          page.classList.remove("hidden");
          page.classList.add("block");
        } else {
          page.classList.add("hidden");
          page.classList.remove("block");
        }
      });

      navLinks.forEach(link => {
        if (link.dataset.page === pageId) {
          // kasih efek background putih & teks biru gelap saat aktif
          link.classList.add("bg-white", "text-blue-800", "font-semibold");
          link.classList.remove("text-blue-100");
        } else {
          link.classList.remove("bg-white", "text-blue-800", "font-semibold");
          link.classList.add("text-blue-100");
        }
      });
    }

    // Default aktif Dashboard
    setActivePage("dashboard");

    navLinks.forEach(link => {
      link.addEventListener("click", e => {
        e.preventDefault();
        const page = link.dataset.page;
        setActivePage(page);
      });
    });
  </script> -->
    <script>
    feather.replace();
  </script>
</body>
</html>