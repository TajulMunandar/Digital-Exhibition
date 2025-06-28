<?php

namespace App\Http\Controllers;

use App\Models\Tech;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TechController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = "Technology";
        $techs = Tech::all();
        return view('dashboard.pages.tech')->with(compact('pages', 'techs'));
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
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'icon' => 'required|file|mimes:jpg,jpeg,png,svg|max:2048'
            ]);

            $path = $request->file('icon')->store('public/icons');

            Tech::create([
                'nama' => $request->name,
                'icon' => basename($path)
            ]);

            return redirect()->back()->with('success', 'Tech berhasil ditambahkan.');
        } catch (Exception $e) {
            Log::error('Gagal menyimpan tech: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan tech.');
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
        try {
            $tech = Tech::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'icon' => 'nullable|file|mimes:jpg,jpeg,png,svg|max:2048'
            ]);

            $data = [
                'nama' => $request->name,
            ];

            if ($request->hasFile('icon')) {
                // Hapus icon lama jika ada
                if ($tech->icon && Storage::exists('public/icons/' . $tech->icon)) {
                    Storage::delete('public/icons/' . $tech->icon);
                }

                $path = $request->file('icon')->store('public/icons');
                $data['icon'] = basename($path);
            }

            $tech->update($data);

            return redirect()->back()->with('success', 'Tech berhasil diupdate.');
        } catch (Exception $e) {
            Log::error('Gagal mengupdate tech: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate tech.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $tech = Tech::findOrFail($id);

            // Hapus icon dari storage jika ada
            if ($tech->icon && Storage::exists('public/icons/' . $tech->icon)) {
                Storage::delete('public/icons/' . $tech->icon);
            }

            $tech->delete();

            return redirect()->back()->with('success', 'Tech berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Gagal menghapus tech: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus tech.');
        }
    }
}
