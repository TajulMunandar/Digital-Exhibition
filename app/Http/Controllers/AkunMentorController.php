<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AkunMentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mentors = Mentor::with(['user'])->get();
        $pages = "Akun Mentor";
        return view('dashboard.pages.mentor', compact('mentors', 'pages'));
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
            'username' => 'required|unique:mentors,username',
            'password' => 'required|min:6',
        ]);

        try {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'isAdmin' => 0,
            ]);

            $mentor = Mentor::create([
                'userId' => $user->id,
                'username' => $request->username,
            ]);

            return redirect()->back()->with('success', 'Mentor berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan mentor: ' . $e->getMessage());
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
            'username' => 'required|unique:mentors,username,' . $id,
        ]);

        try {
            $mentor = Mentor::findOrFail($id);
            $mentor->update([
                'username' => $request->username,
            ]);

            return redirect()->back()->with('success', 'Mentor berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui mentor: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mentor = Mentor::findOrFail($id);
            $user = User::find($mentor->userId);

            $mentor->delete();
            if ($user) {
                $user->delete();
            }

            return redirect()->back()->with('success', 'Mentor berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus mentor: ' . $e->getMessage());
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
            $mentor = Mentor::findOrFail($id);
            $user = User::findOrFail($mentor->userId);
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'Password berhasil direset!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal reset password: ' . $e->getMessage());
        }
    }
}
