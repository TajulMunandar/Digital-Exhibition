<?php

namespace App\Http\Controllers;

use App\Models\KategoriProject;
use App\Models\MemberMaster;
use Illuminate\Http\Request;

class MemberMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = MemberMaster::with('kategori')->get();
        $kategoris = KategoriProject::all();
        $pages = "Member Master";
        return view('dashboard.pages.member-master', compact('members', 'kategoris', 'pages'));
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
            'role' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'kategoriId' => 'required',
        ]);

        try {
            MemberMaster::create([
                'role' => $request->role,
                'group' => $request->group,
                'kategoriId' => $request->kategoriId,
            ]);

            return redirect()->back()->with('success', 'Member berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan member: ' . $e->getMessage());
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
            'role' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'kategoriId' => 'required',
        ]);

        try {
            $member = MemberMaster::findOrFail($id);
            $member->update([
                'role' => $request->role,
                'group' => $request->group,
                'kategoriId' => $request->kategoriId,
            ]);

            return redirect()->back()->with('success', 'Member berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui member: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $member = MemberMaster::findOrFail($id);
            $member->delete();

            return redirect()->back()->with('success', 'Member berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus member: ' . $e->getMessage());
        }
    }
}
