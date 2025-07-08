@extends('main.partials.main')

@section('content')
    <div class="container py-5">
        <header class="mb-4 d-flex flex-column flex-md-row align-items-center gap-3">
    {{-- Kolom kiri: Judul --}}
    <h1 class="header-title mb-0 me-md-4">Studi Independen</h1>

    {{-- Kolom kanan: Form fleksibel --}}
    <form method="GET" class="d-flex flex-grow-1 flex-column flex-md-row gap-3">
        <input type="search" name="search" value="{{ request('search') }}" class="form-control"
            placeholder="Cari nama proyek" />

        <select name="kategori" class="form-select" onchange="this.form.submit()">
            <option value="">Pilih Kategori Produk</option>
            @foreach ($kategoriList as $item)
                <option value="{{ $item }}" {{ request('kategori') == $item ? 'selected' : '' }}>
                    {{ $item }}</option>
            @endforeach
        </select>

        <select name="batch" class="form-select" onchange="this.form.submit()">
            <option value="">Pilih Batch Mentee</option>
            @foreach ($batchList as $item)
                <option value="{{ $item }}" {{ request('batch') == $item ? 'selected' : '' }}>Batch
                    {{ $item }}</option>
            @endforeach
        </select>

        <button class="btn btn-primary d-none" type="submit">Filter</button>
    </form>
</header>

        <div class="row g-4">
            @foreach ($projects as $project)
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ route('project.show', $project->id) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm position-relative">
                            @if ($project->is_best == 1)
                                <img src="{{ asset('img/label-card.png') }}" 
                                    alt="Best Project Label" 
                                    class="position-absolute top-0 end-0" 
                                    style="width: 146px; z-index: 10;">
                            @endif
                            <img src="{{ asset('storage/' . $project->thumbnail) }}"
                                alt="Digital peternakan website UI showing dashboard and analytics with sheep images on brown background"
                                class="card-img-top"
                                onerror="this.onerror=null;this.src='https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/b16d330d-2919-418a-a0bf-0ae83fe4cdaa.png';" />
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $project->nama_product }}</h5>
                                <div class="mb-2">
                                    <span class="badge badge-purple">by {{ $project->nama_group }}</span>
                                    <span class="badge badge-pink">{{ $project->Kategori->nama }}</span>
                                    <span class="badge badge-blue-outline">Batch {{ $project->Kategori->batch }}</span>
                                </div>
                                {{-- <p class="card-text small line-clamp-3">
                                    {{ $project->deskripsi }}
                                </p> --}}
                                <div class="line-clamp-3 small">
                                        {!! strip_tags($project->deskripsi, '<b><strong><i><em>') !!}
                                    </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        


        {{-- <div class="row g-4">
            <!-- Card 1 -->
            @foreach ($projects as $project)
                <div class="col-12 col-md-6 col-lg-4 position-relative">
                    @if ($project->is_best == 1)
                        <div class="ribbon" aria-label="Best Project">Best Project</div>
                    @endif
                    <a href="{{ route('project.show', $project->id) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $project->thumbnail) }}"
                                alt="Digital peternakan website UI showing dashboard and analytics with sheep images on brown background"
                                class="card-img-top"
                                onerror="this.onerror=null;this.src='https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/b16d330d-2919-418a-a0bf-0ae83fe4cdaa.png';" />
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $project->nama_product }}</h5>
                                <div class="mb-2">
                                    <span class="badge badge-purple">by {{ $project->nama_group }}</span>
                                    <span class="badge badge-blue">{{ $project->Kategori->nama }}</span>
                                    <span class="badge badge-purple-outline">Batch {{ $project->Kategori->batch }}</span>
                                </div>
                                <p class="card-text small line-clamp-3">
                                    {{ $project->deskripsi }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div> --}}


        @if ($projects->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                <nav>
                    <ul class="pagination custom-pagination">
                        {{-- Previous --}}
                        @if ($projects->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link"
                                    href="{{ $projects->previousPageUrl() }}">&laquo;</a></li>
                        @endif

                        {{-- Pages --}}
                        @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                            @if ($page == $projects->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if ($projects->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $projects->nextPageUrl() }}">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif


    </div>
@endsection

@section('script')
    <script>
        // Untuk auto-submit saat user mengetik di input search
        const searchInput = document.querySelector('input[name="search"]');
        let timeout = null;

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    this.form.submit();
                }, 500); // submit otomatis 0.5 detik setelah user berhenti mengetik
            });
        }
    </script>
@endsection

@section('css')
    <style>
        .navbar-custom {
            background-color: white;
        }

        .nav-link {
            color: black !important;
            font-weight: normal;
            margin: 1rem;
        }

        .nav-link.active {
            color: #fff !important;
            background-color: #8a3dff !important;
            padding: 0.4rem 2rem;
            border-radius: 12px;
            /* membuat tampilan badge/pill */
            font-weight: 500;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn-purple {
            background-color: #8a3dff;
            color: white;
        }

        .btn-purple:hover {
            background-color: darkviolet;
            color: white;
        }

        .btn-light {
            background-color: lightpurple;
            color: #8a3dff;
        }

        /* .container {
            max-width: 1200px;
        } */

        a {
            text-decoration: none;
        }

        .btn-custom {
            background-color: #8a3dff;
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 999px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #6c2edc;
            color: white;
        }

        .header-title {
            font-weight: 900;
            font-size: 1.35rem;
            font-family: Arial, Helvetica, sans-serif;
            color: #000000;
            letter-spacing: -0.5px;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .card {
            background-color: #fff;
            color: #000;
            border-radius: 0.5rem;
            box-shadow: 0 8px 24px rgb(0 0 0 / 0.12);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .custom-pagination .page-item .page-link {
            color: #8a3dff;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            margin: 0 2px;
            padding: 6px 12px;
            transition: all 0.2s ease-in-out;
        }

        .custom-pagination .page-item.active .page-link {
            background-color: #8a3dff;
            color: white;
            border-color: #8a3dff;
            font-weight: 600;
        }

        .custom-pagination .page-item.disabled .page-link {
            color: #ccc;
            background-color: #f8f9fa;
            border-color: #ddd;
            cursor: not-allowed;
        }

        .custom-pagination .page-item .page-link:hover {
            background-color: #f1e9ff;
            border-color: #8a3dff;
            color: #8a3dff;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 32px rgb(0 0 0 / 0.2);
        }

        .card-img-top {
            object-fit: cover;
            height: 180px;
            width: 100%;
        }

        .badge-purple {
            background-color: #8A3DFF;
            color: #F4F3F9;
            font-size: 0.675rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-pink {
            background-color: transparent;
            color: #BE2CD2;
            border: #BE2CD2 1px solid;
            font-size: 0.675rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-blue-outline {
            border: 1px solid #214CE0;
            color: #214CE0;
            background-color: transparent;
            font-weight: 600;
            font-size: 0.675rem;
            text-transform: capitalize;
        }

        /* Ribbon styling */
        .ribbon {
            width: 120px;
            height: 28px;
            background: #6a4bd8;
            position: absolute;
            right: 0;
            top: 0;
            color: #fff;
            font-weight: 700;
            font-size: 0.75rem;
            text-align: center;
            line-height: 28px;
            clip-path: polygon(0 0, 100% 0, 100% 75%, 50% 100%, 0 75%);
            user-select: none;
            z-index: 10;
        }

        .ribbon svg {
            position: absolute;
            right: -10px;
            top: 0;
            height: 28px;
            fill: #532dab;
        }

        /* Pagination styles */
        .pagination {
            justify-content: center;
            margin-top: 2rem;
            margin-bottom: 3rem;
        }

        .form-select {
            max-width: 250px;
        }

        .form-control::placeholder {
            font-style: italic;
            color: #bbb;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .footer {
            background-color: #1a1a1a;
            padding: 20px 0;
            color: #fff;
        }

        .footer .social-icons a {
            margin: 0 10px;
            color: #fff;
        }
    </style>
@endsection
