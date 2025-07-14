<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        // Validate login input
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->isAdmin == 1) {
                return redirect('/dashboard/index');
            } elseif ($user->MentorProject) {
                return redirect('/dashboard/index-mentor');
            } elseif ($user->Mentee) {
                return redirect('/dashboard/index-mente');
            } else {
                Auth::logout();
                return redirect('/login')->with('error', 'Akun tidak dikenali.');
            }
        }

        // Authentication failed, redirect back with error
        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
