<?php

namespace App\Http\Controllers;

use App\Models\KategoriProject;
use App\Models\Member;
use App\Models\MemberMaster;
use App\Models\MentorProject;
use App\Models\Project;
use App\Models\Tech;
use App\Models\TechProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DashboardMenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = "Dashboard Mente";

        $user = Auth::user();
        $teches = Tech::all();

        // Ambil kategoriId mentee yang sedang login
        $kategoriId = $user->mentee->kategoriId ?? null;

        // Ambil semua member berdasarkan kategori tersebut
        $memberGroups = MemberMaster::where('kategoriId', $kategoriId)
            ->select('group', 'role', 'id')
            ->get()
            ->groupBy('group');

        $kategoris = KategoriProject::all();
        return view('dashboard.pages.input-project', compact('pages', 'kategoris', 'teches', 'memberGroups'));
    }

    public function getMentorsByKategori($kategoriId)
    {
        $mentors = MentorProject::with('Mentor')
            ->where('kategoriId', $kategoriId)
            ->get()
            ->pluck('mentor.username');

        return response()->json($mentors);
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

        try {
            $request->validate([
                'nama_group' => 'required|string|max:255',
                'sesi_kelas' => 'required|string',
                'kategoriId' => 'required|exists:kategori_projects,id',
                'nama_product' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'link_video' => 'required|url',
                'link_figma' => 'required|url',
                'link_website' => 'required|url',
                'tech_ids' => 'array',
                'tech_ids.*' => 'exists:teches,id',
                'thumbnail' => 'nullable|image|max:5120',
            ]);

            DB::beginTransaction();
            // Upload thumbnail
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            // Generate unique slug
            $slug = Str::slug($request->nama_product) . '-' . Str::random(5);

            // Simpan project
            $project = Project::create([
                'nama_group' => $request->nama_group,
                'sesi_kelas' => $request->sesi_kelas,
                'kategoriId' => $request->kategoriId,
                'nama_product' => $request->nama_product,
                'deskripsi' => $request->deskripsi,
                'thumbnail' => $thumbnailPath,
                'slug' => $slug,
                'link_video' => $request->link_video,
                'link_figma' => $request->link_figma,
                'link_website' => $request->link_website,
                'userId' => Auth::user()->id,
                'is_best' => false,
            ]);

            // Simpan tech stack ke pivot table
            if ($request->filled('tech_ids')) {

                // Tambah ulang tech yang dipilih
                foreach ($request->tech_ids as $techId) {
                    TechProject::create([
                        'projectId' => $project->id,
                        'techId' => $techId,
                    ]);
                }
            }
            // Simpan anggota dari semua grup
            foreach ($request->nama ?? [] as $group => $namaArray) {
                foreach ($namaArray as $index => $namaAnggota) {
                    if (empty($namaAnggota)) continue;

                    $linkedIn = $request->linkedIn[$group][$index] ?? '';
                    $roleId = $request->roleId[$group][$index] ?? null;

                    if (!$roleId) continue; // skip jika role tidak diisi

                    Member::create([
                        'nama' => $namaAnggota,
                        'linkedIn' => $linkedIn,
                        'roleId' => $roleId,
                        'projectId' => $project->id,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('dashboard.mente')->with('success', 'Project berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error ke laravel.log
            Log::error('Gagal menyimpan project:', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan project. Silakan coba lagi.' . $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
