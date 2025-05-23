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
