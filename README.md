# UAS FE SI Nilai

# 🛠️ Setup Database

a. Buat database di MySQL
Masuk ke phpMyAdmin atau terminal MySQL, lalu jalankan:
```blade
CREATE DATABASE db-uas-230102050;
USE db-uas-230102050;
```

b. Buat tabel-tabel berikut:
```blade
CREATE TABLE dosen (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  nip VARCHAR(20)
);

CREATE TABLE mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  nim VARCHAR(20),
  kelas_id INT
);

CREATE TABLE kelas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(50)
);

CREATE TABLE matakuliah (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  dosen_id INT
);

CREATE TABLE nilai (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_id INT,
  matakuliah_id INT,
  nilai INT
);

CREATE TABLE prodi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100)
);
```

# Backend SI Nilai

Ini adalah repository untuk backend aplikasi **SI Nilai** yang dibangun menggunakan **CodeIgniter 4**.

## 📥 Cara Clone Project

1. Buka terminal.
2. Clone repository ini:

```bash
git clone https://github.com/Arfilal/backend_sinilai.git
```
3. Masuk ke folder project:
```bash
   cd db-uas-230102050
```

4.  Install Dependency dengan Composer
```blade
composer install
```

5. Setup File Environment
```blade
cp env .env
```
Buka file .env, ubah isi konfigurasi berikut:
```blade
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = db-uas-230102050
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```
6. Nyalakan server dari BackEnd
```bash
php spark serve
```

7. Buka di browser:
```blade
http://localhost:8080
```

# 📮 Cara Mengetes API Backend di Postman

Gunakan Postman atau API testing tools lainnya untuk mengetes endpoint dari backend. Berikut ini adalah endpoint untuk **Mahasiswa** dan **Mata Kuliah**:
---

## 🧑‍🎓 Endpoint Mahasiswa

### 🔹 GET - Ambil semua data mahasiswa
```http
GET http://localhost:8080/mahasiswa
```
Tidak butuh body.

Response: Daftar mahasiswa dalam format JSON.

### 🔹 POST - Tambah data mahasiswa
```blade
POST http://localhost:8080/mahasiswa/create
```
Body Type: raw → JSON (ambil dari reply pada saat get)

### 🔹 PUT - Edit data mahasiswa
```blade
PUT http://localhost:8080/mahasiswa/{npm}
```

### 🔹 Delete - Hapus data mahasiswa
```blade
DEL http://localhost:8080/mahasiswa/{npm}
```

## 📘 Endpoint Mata Kuliah

### 🔹 GET - Ambil semua data matkul
```http
GET http://localhost:8080/matkul
```
Tidak butuh body.

Response: Daftar matkul dalam format JSON.

### 🔹 POST - Tambah data matkul
```blade
POST http://localhost:8080/matakuliah/create
```
Body Type: raw → JSON (ambil dari reply pada saat get)

### 🔹 PUT - Edit data matkul
```blade
PUT http://localhost:8080/matakuliah/{kode_matkul}
```

### 🔹 Delete - Hapus data matkul
```blade
DEL http://localhost:8080/matakuliah/{kode_matkul}
```

# Frontend SI Nilai - Laravel

Ini adalah frontend project Laravel bernama **frontend-uas-230102050** yang digunakan untuk menampilkan dan melakukan CRUD data Mahasiswa & Mata Kuliah dari backend CodeIgniter (API).

---

## 🛠️ 1. Membuat Project Laravel

```bash
composer create-project laravel/laravel frontend-uas-230102050
cd frontend-uas-230102050
php spark serve
```

## 🌐 2. Konfigurasi file env
Edit file envrename menjadi .env, lalu ubah session driver menjadi file :
```blade
SESSION_DRIVER=File
```

## 🧑‍🎓 3. Tutorial CRUD Mahasiswa
a. Tampilkan Data Mahasiswa
Route (web.php)
```blade
use App\Http\Controllers\MahasiswaController;

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);

```

b. Buat file MahasiswaController dengan masukkan perintah ini di terminal :
```blade
php artisan make:controller MahasiswaController --resource

```

c. Isikan setiap fungsi di MahasiswaController dengan endpoint yang telah disedikan :
🔹MahasiswaController.php :
```blade
<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $response = Http::get('http://localhost:8080/mahasiswa');
        if ($response->successful()) {
            $mahasiswa = $response->json();
            return view('mahasiswa', ['mahasiswa' => $mahasiswa]);
        }
        return view('mahasiswa', ['mahasiswa' => [], 'error' => 'Gagal mengambil data mahasiswa']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('tambah_mahasiswa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'npm' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'prodi' => 'required|string|max:100',
    ]);

    $response = Http::post('http://localhost:8080/mahasiswa', $validated);

    if ($response->successful()) {
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan!');
    } else {
        return back()->withErrors('Gagal menyimpan data mahasiswa. Silakan coba lagi.');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($npm)
    {
         $response = Http::get("http://localhost:8080/mahasiswa/{npm}");
        // dd($response);
    if ($response->successful()) {
        $mahasiswa = (object) $response->json(); // <- ubah di sini
        return view('edit_mahasiswa', ['mahasiswa' => $mahasiswa]);
    }
    return redirect()->route('mahasiswa.index')->with('error', 'Data mahasiswa tidak ditemukan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $npm)
    {
         $validatedData = $request->validate([
        'npm' => 'required|string|max:255',
        'nama_mhs' => 'required|string|max:20',
        'kode_kelas' => 'required|email|max:255',
        'id_prodi' => 'required|string|max:100',
    ]);

    $response = Http::put("http://localhost:8080/mahasiswa/{$npm}", $validatedData);

    if ($response->successful()) {
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    return redirect()->back()->withErrors('Gagal memperbarui data mahasiswa.')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($npm)
    {
          $response = Http::delete("http://localhost:8080/mahasiswa/{$npm}");

    if ($response->successful()) {
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    return redirect()->route('mahasiswa.index')->with('error', 'Gagal menghapus data mahasiswa.');
    }
}
```

4. Buat file view yaitu mahasiswa.blade.php, form untuk edit dan create mahasiswa
🔹mahasiswa.blade.php :
```blade
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Mahasiswa - Sistem Akademik</title>
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
  <a href="{{ route('mahasiswa.index') }}" class="flex items-center gap-3 px-3 py-2 rounded bg-white text-blue-800 font-semibold">
    <i data-feather="user-check"></i>
    <span>Data Mahasiswa</span>
  </a>
  <a href="{{ route('kelas.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-600 text-blue-100">
    <i data-feather="users"></i>
    <span>Data Matkul</span>
  </a>
  <a href="{{ route('prodi.index') ?? '#' }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-600 text-blue-100">
    <i data-feather="book"></i>
    <span>Data Prodi</span>
  </a>
</nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8 min-h-screen overflow-auto">
    <section>
      <h2 class="text-3xl font-bold text-gray-700 mb-6 flex items-center gap-2">
        <i data-feather="user-check" class="text-blue-600"></i> Data Mahasiswa
      </h2>

      <!-- Tombol Tambah & Search -->
      <div class="flex justify-between items-center mb-4">
        <a href="{{ route('mahasiswa.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          + Tambah Data
        </a>
       <form method="GET" action="{{ route('mahasiswa.index') }}" class="relative w-64">
  <input 
    id="searchInput" 
    type="text" 
    name="search"
    placeholder="Cari mahasiswa..." 
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
              <th class="py-3 px-4 border border-gray-300">NPM</th>
              <th class="py-3 px-4 border border-gray-300">Nama</th>
              <th class="py-3 px-4 border border-gray-300">Kode Kelas</th>
              <th class="py-3 px-4 border border-gray-300">ID Prodi</th>
              <th class="py-3 px-4 border border-gray-300 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody id="mahasiswaTableBody">
            @foreach ($mahasiswa as $index => $mhs)
              <tr class="hover:bg-gray-50">
                <td class="py-2 px-4 border border-gray-300 text-center">{{ $index + 1 }}</td>
                 <td class="py-2 px-4 border border-gray-300">{{ $mhs['npm'] }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $mhs['nama_mhs'] }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $mhs['kode_kelas'] }}</td>
                <td class="py-2 px-4 border border-gray-300">{{ $mhs['id_prodi'] }}</td>
                <td class="py-2 px-4 border border-gray-300 text-center">
                  <a href="{{ route('mahasiswa.edit', $mhs['npm']) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                  <form action="{{ route('mahasiswa.destroy', $mhs['npm']) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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

    // Live search di tabel mahasiswa
    const searchInput = document.getElementById("searchInput");
    const tableBody = document.getElementById("mahasiswaTableBody");

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

```

🔹create_mahasiswa.blade.php :
```blade
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


```

🔹edit_mahasiswa.blade.php :
```blade
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex items-center justify-center">

  <div class="bg-white w-full max-w-2xl p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-700 mb-6 flex items-center gap-2">
      <i data-feather="edit-2" class="text-yellow-500"></i> Edit Mahasiswa
    </h2>
@foreach($mahasiswa as $mhs)
    <form action="{{ route('mahasiswa.update', $mhs['npm']) }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label class="block text-sm font-semibold text-gray-600 mb-1">NPM</label>
        <input type="text" name="npm" value="{{ $mhs['npm'] }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-yellow-400" required readonly>
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-600 mb-1">Nama</label>
        <input type="text" name="nama_mhs" value="{{ $mhs['nama_mhs'] }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-yellow-400" required>
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-600 mb-1">Kode Kelas</label>
        <input type="text" name="kode_kelas" value="{{ $mhs['kode_kelas'] }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-yellow-400" required>
      </div>

      <div>
        <label class="block text-sm font-semibold text-gray-600 mb-1">ID prodi</label>
        <input type="text" name="id_prodi" value="{{ $mhs['id_prodi'] }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-yellow-400" required>
      </div>

      <div class="flex justify-end gap-3 mt-6">
        <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Update</button>
      </div>
    </form>
    @endforeach
  </div>

  <script>
    feather.replace();
  </script>
</body>
</html>

```

🔥 **Gunakan tutorial yang sama dengan CRUD Mahasiswa untuk membuat CRUD Mata Kuliah**

## 🚀 5. Jalankan Project
```blade
php artisan serve
```
akses di :
```blade
http://localhost:8000/mahasiswa
http://localhost:8000/matakuliah
```
