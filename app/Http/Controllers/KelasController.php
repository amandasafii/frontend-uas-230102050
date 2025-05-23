<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KelasController extends Controller
    {
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $response = Http::get('http://localhost:8080/matakuliah');
        if ($response->successful()) {
            $kelas = $response->json();
            return view('kelas', ['kelas' => $kelas]);
        }
        return view('kelas', ['kelas' => [], 'error' => 'Gagal mengambil data kelas']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tambah_kelas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'kode_matkul' => 'required|string|max:255',
        'nama_matkul' => 'required|string|max:20',
        'semester' => 'required|string|max:20',
        'sks' => 'required|string|max:20',
    ]);

    $response = Http::post('http://localhost:8080/matakuliah', $validated);

    if ($response->successful()) {
        return redirect()->route('kelas.index')->with('success', 'Data matkul berhasil ditambahkan!');
    } else {
        return back()->withErrors('Gagal menyimpan data kelas. Silakan coba lagi.');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($kode_matkul)
{
     $response = Http::get("http://localhost:8080/matakuliah/{$kode_matkul}");
    if ($response->successful()) {
        $kelas = (object) $response->json(); // <- ubah di sini
        // dd($kelas);
        return view('edit_kelas', ['kelas' => $kelas]);
    }
    return redirect()->route('kelas.index')->with('error', 'Data matkul tidak ditemukan.');
}


public function update(Request $request, $kode_matkul)
{
    $validatedData = $request->validate([
        'kode_matkul' => 'required|string|max:255',
        'nama_matkul' => 'required|string|max:20',
        'semester' => 'required|string|max:20',
        'sks' => 'required|string|max:20',
    ]);

    $response = Http::put("http://localhost:8080/matakuliah/{$kode_matkul}", $validatedData);

    if ($response->successful()) {
        return redirect()->route('kelas.index')->with('success', 'Data matkul berhasil diperbarui.');
    }

    return redirect()->back()->withErrors('Gagal memperbarui data matkul.')->withInput();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode_matkul)
    {
    $response = Http::delete("http://localhost:8080/matkul/{$kode_matkul}");

    if ($response->successful()) {
        return redirect()->route('kelas.index')->with('success', 'Data matkul berhasil dihapus.');
    }

    return redirect()->route('kelas.index')->with('error', 'Gagal menghapus data matkul.');
    }
}
