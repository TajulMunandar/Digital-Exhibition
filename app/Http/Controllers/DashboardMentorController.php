<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Status;
use Illuminate\Http\Request;

class DashboardMentorController extends Controller
{
    // public function index()
    // {
    //     $pages = "Dashboard Mentor";
    //     $projects = Project::with('kategori')->get(); // relasi ke tabel kategori_projects
    //     return view('dashboard.pages.index-mentor', compact('projects', 'pages'));
    // }

    public function index()
    {
        $pages = "Dashboard Mentor";
        // Modifikasi query untuk hanya menampilkan proyek yang belum ditinjau
        $projects = Project::with('kategori')
            ->whereDoesntHave('Status')
            ->get(); // hanya menampilkan proyek yang belum memiliki status
        return view('dashboard.pages.index-mentor', compact('projects', 'pages'));
    }

    // public function show($projectId)
    // {
    //     $project = Project::with('Member.MemberMaster')->findOrFail($projectId)->first();
    //     $pages = "Detail Project";
    //     return view('dashboard.pages.approvment', compact('project', 'pages'));
    // }

    public function show($projectId)
    {
        $project = Project::find($projectId);
        $pages = "Detail Project";
        return view('dashboard.pages.approvment', compact('project', 'pages'));
    }

    public function setujui(Project $project)
    {

        Status::create([
            'status' => 'Disetujui',
            'projectId' => $project->id,
            'comment' => 'Project disetujui oleh reviewer.',
        ]);

        return back()->with('success', 'Project disetujui.');
        return redirect()->route('status-proyek.index')->with('success', 'Project disetujui dan dipindahkan ke halaman status.');
    }

    public function revisi(Request $request, Project $project)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        Status::create([
            'status' => 'Revisi',
            'projectId' => $project->id,
            'comment' => $request->comment,
        ]);

        return back()->with('error', 'Project dikembalikan untuk revisi.');
    }

    public function best(Request $request, Project $project)
    {
        $project->update([
            'is_best' => 1,
        ]);

        return back()->with('success', 'Project Sudah Menjadi Best!');
    }
}
