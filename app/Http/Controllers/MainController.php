<?php

namespace App\Http\Controllers;

use App\Models\KategoriProject;
use App\Models\Pesan;
use App\Models\Project;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $projects = Project::whereHas('Status', function ($query) {
            $query->where('status', 'Disetujui');
        })
            ->with(['Status' => function ($query) {
                $query->latest();
            }])
            ->latest()
            ->take(3)
            ->get();
        return view('main.pages.index')->with('projects', $projects);
    }

    public function show($id)
    {
        $project = Project::find($id);
        return view('main.pages.project')->with('project', $project);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_pesan' => 'required|string',
            'email' => 'required|string',
            'nama_investor' => 'required|string',
            'instansi' => 'required|string',
            'alamat_instansi' => 'required|string',
            'pesan' => 'required|string',
        ]);

        Pesan::create([
            'type_pesan' => $request->type_pesan,
            'email' => $request->email,
            'nama_investor' => $request->nama_investor,
            'instansi' => $request->instansi,
            'alamat_instansi' => $request->alamat_instansi,
            'pesan' => $request->pesan,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim!');
    }

    public function showCase(Request $request)
    {
        $kategoriList = KategoriProject::select('nama')->distinct()->pluck('nama');
        $batchList = KategoriProject::select('batch')->distinct()->pluck('batch');
        // Ambil request filter
        $search = $request->input('search');
        $kategori = $request->input('kategori');
        $batch = $request->input('batch');

        $projects = Project::with('Kategori')
            ->when($search, function ($query, $search) {
                $query->where('nama_product', 'like', '%' . $search . '%');
            })
            ->when($kategori, function ($query, $kategori) {
                $query->whereHas('Kategori', function ($q) use ($kategori) {
                    $q->where('nama', $kategori);
                });
            })
            ->when($batch, function ($query, $batch) {
                $query->whereHas('Kategori', function ($q) use ($batch) {
                    $q->where('batch', $batch);
                });
            })->whereHas('Status', function ($query) {
                $query->where('status', 'Disetujui');
            })
            ->with(['Status' => function ($query) {
                $query->latest();
            }])
            ->latest()
            ->paginate(9) // <--- paginate di sini
            ->withQueryString(); // <--- penting supaya filter tetap saat ganti halaman
        return view('main.pages.showcase',  compact('projects', 'kategoriList', 'batchList', 'search', 'kategori', 'batch'));
    }

    public function tentang()
    {
        $projects = Project::latest()->get()->take(3);
        return view('main.pages.tentang');
    }
}
