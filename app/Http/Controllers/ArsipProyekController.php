<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArsipProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = "Arsip Project Mentee";
        
        // Ambil proyek yang memiliki status "Disetujui" sebagai status terakhir
        // Menggunakan subquery untuk mendapatkan ID proyek dengan status terakhir = "Disetujui"
        $projectIds = Status::select('projectId')
            ->whereIn('id', function($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('statuses')
                    ->groupBy('projectId');
            })
            ->where('status', 'Disetujui')
            ->pluck('projectId');
        
        // Ambil proyek berdasarkan ID yang sudah difilter
        $projects = Project::with(['kategori', 'MentorGroup.MentorProject.Mentor', 'Member.MemberMaster', 'Teches', 'Status'])
            ->whereIn('id', $projectIds)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('dashboard.pages.arsip', compact('projects', 'pages'));
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

// Kode Lainnya
// <?php

// namespace App\Http\Controllers;

// use App\Models\Project;
// use App\Models\Status;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// class ArsipProyekController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         $pages = "Arsip Project Mentee";
        
//         // Dapatkan ID proyek yang memiliki status "Disetujui"
//         $approvedProjects = DB::table('statuses as s1')
//             ->select('s1.projectId')
//             ->where('s1.status', 'Disetujui')
//             ->whereRaw('s1.created_at = (SELECT MAX(s2.created_at) FROM statuses as s2 WHERE s2.projectId = s1.projectId)')
//             ->pluck('projectId')
//             ->toArray();
        
//         // Ambil proyek berdasarkan ID yang sudah difilter
//         $projects = Project::with(['kategori', 'MentorGroup.MentorProject.Mentor', 'Member.MemberMaster', 'Teches', 'Status'])
//             ->whereIn('id', $approvedProjects)
//             ->orderBy('created_at', 'desc')
//             ->get();
            
//         return view('dashboard.pages.arsip', compact('projects', 'pages'));
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         //
//     }
// }