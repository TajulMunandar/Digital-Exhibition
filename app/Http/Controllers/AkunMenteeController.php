<?php

namespace App\Http\Controllers;

use App\Models\KategoriProject;
use App\Models\Mentee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AkunMenteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mentees = Mentee::with(['user', 'kategori'])->get();
        $kategoris = KategoriProject::all();
        $pages = "Akun Mentee";
        return view('dashboard.pages.mentee', compact('mentees', 'kategoris', 'pages'));
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
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:mentees,username',
            'password' => 'required|min:6',
            'kategoriId' => 'required|exists:kategori_projects,id',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'isAdmin' => 0,
            ]);

            Mentee::create([
                'userId' => $user->id,
                'username' => $request->username,
                'kategoriId' => $request->kategoriId,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Akun Mentee berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan mentee: ' . $e->getMessage());
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
            'username' => 'required|unique:mentees,username,' . $id,
            'kategoriId' => 'required|exists:kategori_projects,id',
        ]);

        try {
            $mentee = Mentee::findOrFail($id);
            $mentee->update([
                'username' => $request->username,
                'kategoriId' => $request->kategoriId,
            ]);

            return redirect()->back()->with('success', 'Data mentee berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui mentee: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mentee = Mentee::findOrFail($id);
            $user = User::find($mentee->userId);

            $mentee->delete();
            if ($user) {
                $user->delete();
            }

            return redirect()->back()->with('success', 'Mentee berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus mentee: ' . $e->getMessage());
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
            $mentee = Mentee::findOrFail($id);
            $user = User::findOrFail($mentee->userId);
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'Password berhasil direset!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal reset password: ' . $e->getMessage());
        }
    }
}
