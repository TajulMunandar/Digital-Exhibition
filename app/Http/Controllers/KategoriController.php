<?php

namespace App\Http\Controllers;

use App\Models\KategoriProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = "Kategori";
        $kategoris = KategoriProject::all();
        return view('dashboard.pages.kategori')->with(compact('pages', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'batch' => 'required|integer',
        ]);

        try {
            KategoriProject::create([
                'nama' => $request->nama,
                'batch' => $request->batch,
            ]);

            return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Store Kategori Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan kategori.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'batch' => 'required|integer',
        ]);

        try {
            $kategori = KategoriProject::findOrFail($id);
            $kategori->update([
                'nama' => $request->nama,
                'batch' => $request->batch,
            ]);

            return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Update Kategori Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui kategori.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kategori = KategoriProject::findOrFail($id);
            $kategori->delete();

            return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Delete Kategori Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus kategori.');
        }
    }
}
