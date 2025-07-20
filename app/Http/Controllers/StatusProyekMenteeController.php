<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusProyekMenteeController extends Controller
{
    public function index()
    {
        $pages = "Status Proyek";
        $user = Auth::user()->id;
        $projects = Project::where('userId', $user)
            ->with(['Status' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->get();
        return view('dashboard.pages.status-mente')->with(compact('pages', 'projects'));
    }
}