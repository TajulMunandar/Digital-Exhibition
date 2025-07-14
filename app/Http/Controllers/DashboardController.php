<?php

namespace App\Http\Controllers;

use App\Models\Mentee;
use App\Models\Mentor;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mente = Mentee::count();
        $mentor = Mentor::count();
        $akun = $mente + $mentor;
        $best = Project::where('is_best', 1)->count();
        $project = Project::count();
        $projectsPerBatch = DB::table('projects')
            ->join('kategori_projects', 'projects.kategoriId', '=', 'kategori_projects.id')
            ->select('kategori_projects.batch', DB::raw('COUNT(projects.id) as total_project'))
            ->groupBy('kategori_projects.batch')
            ->orderBy('kategori_projects.batch')
            ->get();

        $batchLabels = $projectsPerBatch->pluck('batch');
        $batchCounts = $projectsPerBatch->pluck('total_project');
        $pages = "Dashboard";
        return view('dashboard.pages.index')->with(compact('pages', 'best', 'project', 'akun', 'akun', 'batchLabels', 'batchCounts'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
