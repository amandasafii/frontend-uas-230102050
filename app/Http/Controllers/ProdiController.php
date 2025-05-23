<?php

namespace App\Http\Controllers;

use App\Models\prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $response = Http::get('http://localhost:8080/prodi');
        if ($response->successful()) {
            $prodi = $response->json();
            return view('prodi', ['prodi' => $prodi]);
        }
        return view('prodi', ['prodi' => [], 'error' => 'Gagal mengambil data prodi']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tambah_prodi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'id_prodi' => 'required|string|max:255',
        'nama_prodi' => 'required|string|max:20',
    ]);

    $response = Http::post('http://localhost:8080/prodi', $validated);

    if ($response->successful()) {
        return redirect()->route('prodi.index')->with('success', 'Data prodi berhasil ditambahkan!');
    } else {
        return back()->withErrors('Gagal menyimpan data prodi. Silakan coba lagi.');
    }
    }
    /**
     * Display the specified resource.
     */
    public function show(prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_prodi)
    {
          $response = Http::get("http://localhost:8080/prodi/{$id_prodi}");
    if ($response->successful()) {
        $prodi = (object) $response->json(); // <- ubah di sini
        // dd($prodi);
        return view('edit_prodi', ['prodi' => $prodi]);
    }
    return redirect()->route('prodi.index')->with('error', 'Data prodi tidak ditemukan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_prodi)
    {
         $validatedData = $request->validate([
        'id_prodi' => 'required|string|max:255',
        'nama_prodi' => 'required|string|max:20',
    ]);

    $response = Http::put("http://localhost:8080/prodi/{$id_prodi}", $validatedData);

    if ($response->successful()) {
        return redirect()->route('prodi.index')->with('success', 'Data prodi berhasil diperbarui.');
    }

    return redirect()->back()->withErrors('Gagal memperbarui data prodi.')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_prodi)
    {
         $response = Http::delete("http://localhost:8080/prodi/{$id_prodi}");

    if ($response->successful()) {
        return redirect()->route('prodi.index')->with('success', 'Data prodi berhasil dihapus.');
    }

    return redirect()->route('prodi.index')->with('error', 'Gagal menghapus data prodi.');
    }
}
