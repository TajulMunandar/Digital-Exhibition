<?php

namespace App\Http\Controllers;

use App\Models\KategoriProject;
use App\Models\Mentor;
use App\Models\MentorProject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MentorProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = "Mentor Project";
        $mentorProjects = MentorProject::with(['mentor', 'kategori', 'user'])->get();
        $groupedProjects = $mentorProjects
            ->groupBy(fn($item) => $item->userId . '-' . $item->kategoriId)
            ->map(function ($group) {
                return [
                    'id' => $group->first()->id,
                    'user' => $group->first()->User,
                    'kategori' => $group->first()->Kategori,
                    'mentors' => $group->pluck('Mentor')->unique('id')->values(),
                ];
            })->values();
        $mentors = Mentor::get();
        $kategoris = KategoriProject::all();
        return view('dashboard.pages.mentor-project')->with(compact('pages', 'mentorProjects', 'mentors', 'kategoris', 'groupedProjects'));
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
            'mentorId'   => 'required|array',
            'mentorId.*' => 'exists:mentors,id',
            'kategoriId' => 'required|exists:kategori_projects,id',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6',
        ]);
        try {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'isAdmin' => 0, // ganti sesuai kebutuhan
            ]);
            foreach ($request->mentorId as $mentorId) {
                MentorProject::create([
                    'userId'     => $user->id,
                    'mentorId'   => $mentorId,
                    'kategoriId' => $request->kategoriId,
                ]);
            }
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'mentorId'   => 'required|array',
            'mentorId.*' => 'exists:mentors,id',
            'kategoriId' => 'required|exists:kategori_projects,id',
        ]);

        try {
            // Ambil MentorProject yang dipilih
            $mentorProject = MentorProject::findOrFail($id);
            $userId = $mentorProject->userId;
            $kategoriId = $request->kategoriId;

            // Hapus semua mentor lama untuk user & kategori tersebut
            MentorProject::where('userId', $userId)
                ->where('kategoriId', $mentorProject->kategoriId)
                ->delete();

            // Simpan mentor baru
            foreach ($request->mentorId as $mentorId) {
                MentorProject::create([
                    'userId'     => $userId,
                    'mentorId'   => $mentorId,
                    'kategoriId' => $kategoriId,
                ]);
            }

            return redirect()->back()->with('success', 'Asesmen berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update asesmen: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Ambil MentorProject berdasarkan ID
            $mentorProject = MentorProject::findOrFail($id);

            // Ambil userId yang bersangkutan
            $userId = $mentorProject->userId;

            // Hapus semua MentorProject dengan userId tersebut
            MentorProject::where('userId', $userId)->delete();

            // Hapus user-nya juga
            User::find($userId)?->delete();

            return redirect()->back()->with('success', 'Semua asesmen dan user berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus asesmen: ' . $e->getMessage());
        }
    }

    public function resetPassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $mentorProject = MentorProject::findOrFail($id);
            $user = User::findOrFail($mentorProject->userId);
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'Password berhasil direset!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal reset password: ' . $e->getMessage());
        }
    }
}
