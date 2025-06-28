<?php

namespace App\Http\Controllers;

use App\Models\KategoriProject;
use App\Models\Mentor;
use App\Models\MentorProject;
use Illuminate\Http\Request;

class MentorProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = "Mentor Project";
        $mentorProjects = MentorProject::with(['mentor.user', 'kategori'])->get();
        $mentors = Mentor::with('user')->get();
        $kategoris = KategoriProject::all();
        return view('dashboard.pages.mentor-project')->with(compact('pages', 'mentorProjects', 'mentors', 'kategoris'));
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
            'mentorId' => 'required|exists:mentors,id',
            'kategoriId' => 'required|exists:kategori_projects,id',
        ]);

        try {
            MentorProject::create([
                'mentorId' => $request->mentorId,
                'kategoriId' => $request->kategoriId,
            ]);

            return redirect()->back()->with('success', 'Asesmen berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan asesmen: ' . $e->getMessage());
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
            'mentorId' => 'required|exists:mentors,id',
            'kategoriId' => 'required|exists:kategori_projects,id',
        ]);

        try {
            $asesmen = MentorProject::findOrFail($id);
            $asesmen->update([
                'mentorId' => $request->mentorId,
                'kategoriId' => $request->kategoriId,
            ]);

            return redirect()->back()->with('success', 'Asesmen berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate asesmen: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            MentorProject::destroy($id);
            return redirect()->back()->with('success', 'Asesmen berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus asesmen: ' . $e->getMessage());
        }
    }
}
