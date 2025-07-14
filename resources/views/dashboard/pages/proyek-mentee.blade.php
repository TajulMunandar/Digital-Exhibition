@extends('dashboard.partials.main')

@section('content')
    <div class="row p-2">
        <div class="row">
            <div class="col-sm-6 col-md">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>

        {{-- lama --}}
        <div class="card">
            <div class="card-body">
                <h5 class="mb-4">Daftar Project</h5>
                <table class="table table-striped w-100 " id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Proyek</th>
                            <th>Nama Group</th>
                            <th>Kategori</th>
                            <th>Sesi Kelas</th>
                            <th>Batch</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $index => $project)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $project->nama_product }}</td>
                                <td>{{ $project->nama_group }}</td>
                                <td>{{ $project->kategori->nama ?? '-' }}</td>
                                <td>{{ $project->sesi_kelas }}</td>
                                <td>{{ $project->kategori->batch ?? '-' }}</td>
                                <td>
                                    <button class="btn btn-primary" style="background: #8A3DFF" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $project->id }}">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($projects as $project)
        <div class="modal fade" id="detailModal{{ $project->id }}" tabindex="-1"
            aria-labelledby="detailModalLabel{{ $project->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="detailModalLabel{{ $project->id }}">Detail Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Thumbnail -->
                        <div class="card-outer mb-4">
                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 p-3">
                                <img src="{{ asset('storage/' . $project->thumbnail) }}" class="img-fluid img-card"
                                    alt="Thumbnail Project" />
                            </div>

                            <!-- Video + Technologies + Links row -->
                            <div class="row gx-4 mb-4">
                                <div class="col-lg-8 mb-4">
                                    <div class="video-wrapper shadow rounded-3">
                                        <iframe src="{{ $project->link_video }}" title="Project Video" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="rounded-container shadow-sm p-3 mb-4">
                                        <h5 class="mb-3">Teknologi Yang Digunakan</h5>
                                        <ul class="tech-icons ps-0">
                                            @foreach ($project->Teches as $tech)
                                                <li>
                                                    <img src="{{ asset('storage/public/icons/' . $tech->icon) }}"
                                                        alt="{{ $tech->nama }}" class="me-2" width="10%">
                                                    {{ $tech->nama }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="rounded-container shadow-sm p-3">
                                        <h5 class="mb-3">Project Links</h5>
                                        <ul class="ps-3">
                                            <li><a href="{{ $project->link_website }}" class="link-blue" target="_blank"
                                                    rel="noopener">Website</a></li>
                                            <li><a href="{{ $project->link_figma }}" class="link-blue" target="_blank"
                                                    rel="noopener">Prototype</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Title and badges -->
                            <h1 class="fw-bold">{{ $project->nama_product }}</h1>
                            <div class="mt-4 mb-3 d-flex flex-wrap gap-3 badge-group">
                                <span class="badge badge-purple p-2">by {{ $project->nama_group }}</span>
                                <span class="badge badge-pink p-2">{{ $project->Kategori->nama }}</span>
                                <span class="badge badge-blue-outline p-2">Batch {{ $project->Kategori->batch }}</span>
                            </div>

                            <!-- Description -->
                            <section>
                                <h3 class="section-title">Deskripsi Project</h3>
                                <p>{!! $project->deskripsi !!}</p>
                            </section>

                            <section>
                                <h3 class="section-title">Mentor Group</h3>
                                <div class="d-flex flex-wrap gap-4 fs-5">
                                    @foreach ($project->MentorGroup as $mentorGroup)
                                        @php
                                            $mentorUsername = optional($mentorGroup->MentorProject->Mentor)->username;
                                        @endphp

                                        @if ($mentorUsername)
                                            <div class="d-flex align-items-center gap-2 flex-grow-1">
                                                <span class="person-icon">👤</span>{{ $mentorUsername }}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </section>

                            <!-- Members Section -->
                            @php
                                $groupedMembers = $project->Member->groupBy(fn($m) => $m->MemberMaster->group);
                            @endphp

                            @foreach ($groupedMembers as $group => $members)
                                <section class="mt-4">
                                    <h3 class="section-title">Tim {{ $group }}</h3>
                                    <div class="row g-4">
                                        @foreach ($members as $member)
                                            <div class="col-6 col-md-4 col-lg-3 team-member d-flex">
                                                <div class="icon-circle" aria-label="User Icon">
                                                    {{ strtoupper(substr($member->nama, 0, 1)) }}</div>
                                                <div>
                                                    <div class="name">{{ $member->nama }}</div>
                                                    <div class="role">{{ $member->MemberMaster->role }}</div>
                                                    <a href="{{ $member->linkedIn }}"
                                                        class="linkedin-link d-inline-flex align-items-center"
                                                        target="_blank" rel="noopener">
                                                        <svg viewBox="0 0 24 24">
                                                            <path
                                                                d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zm-11 20h-3v-12h3v12zm-1.5-13.4c-1 0-1.8-.8-1.8-1.8s.8-1.8 1.8-1.8c1 0 1.8.8 1.8 1.8s-.8 1.8-1.8 1.8zm13.5 13.4h-3v-5.6c0-1.3-.5-2.2-1.7-2.2s-2 1-2 2.1v5.7h-3v-12h3v1.6h.1c.5-.9 1.7-1.8 3.5-1.8 3.7 0 4.3 2.5 4.3 5.7v6.5z" />
                                                        </svg><img src="{{ asset('img/logo-linkind.png') }}" class="me-2"
                                                            style="width: 1rem; height: 1rem;">
                                                        LinkedIn
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            @endforeach
                            <div class="row w-100">
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-secondary me-2" close="close" data-bs-dismiss="modal"
                                        style="background: rgba(92, 92, 92, 0.2); color:rgb(92, 92, 92)">
                                        Batal
                                    </button>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSetujui"
                                        style="background: #8A3DFF">
                                        Jadikan Best Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="modalSetujui" tabindex="-1" aria-labelledby="modalSetujuiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('project.status.best', $project->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalSetujuiLabel">Jadikan Best Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menjadikan project ini best project?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary me-2" close="close" data-bs-dismiss="modal"
                            style="background: rgba(92, 92, 92, 0.2); color:rgb(92, 92, 92)">Batal</button>
                        {{-- <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button> --}}
                        <button class="btn btn-primary" type="submit" style="background: #8A3DFF">Jadikan Best
                            Project</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                autoWidth: false,
                scrollX: true,
                language: {
                    search: "",
                    searchPlaceholder: "Search...",
                    paginate: {
                        previous: "<i class='fa fa-chevron-left'></i>",
                        next: "<i class='fa fa-chevron-right'></i>"
                    }
                }
            });

            $('.dataTables_filter input[type="search"]').css({
                marginBottom: "10px"
            });
        });
    </script>
@endsection
@section('css')
    <style>
        body {
            background: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #222;
        }

        .rounded-container {
            border-radius: 1.5rem;
            background: #fff;
            padding: 1rem;
            border: 1px solid #ddd;
        }

        .img-card {
            border-radius: 1rem;
            border: 1px solid #ccc;
            background: #f7f9fa;
            padding: 1rem;
        }

        .logo-text {
            color: #237a68;
            font-weight: 700;
        }

        .logo-subtext {
            font-weight: 500;
            font-size: 0.9rem;
            color: #494949;
        }

        .badge-group .badge {
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-purple {
            background-color: #8A3DFF;
            color: #F4F3F9;
            font-size: 0.7;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-pink {
            background-color: transparent;
            color: #BE2CD2;
            border: #BE2CD2 1px solid;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-blue-outline {
            border: 1px solid #214CE0;
            color: #214CE0;
            background-color: transparent;
            font-weight: 600;
            font-size: 0.7rem;
        }

        .section-title {
            font-weight: 600;
            font-size: 1.25rem;
            margin-top: 3rem;
            margin-bottom: 1.5rem;
            color: #222;
        }

        .link-blue {
            color: #1565c0;
            text-decoration: underline;
        }

        .person-icon {
            font-size: 1.3rem;
            vertical-align: middle;
            margin-right: 0.3rem;
            color: #444;
        }

        .team-member .icon-circle {
            background-color: #7a4dff;
            color: white;
            border-radius: 50%;
            height: 40px;
            width: 40px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 1.1rem;
            margin-right: 0.8rem;
        }

        .team-member .name {
            font-weight: 600;
        }

        .team-member .role {
            font-size: 0.85rem;
            color: #555;
        }

        .team-member .linkedin {
            font-size: 0.75rem;
            color: #555;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-top: 0.1rem;
        }

        .team-member .linkedin svg {
            width: 14px;
            height: 14px;
            fill: #0a66c2;
        }

        a.linkedin-link:hover {
            text-decoration: none;
            color: #0a66c2;
        }

        blockquote {
            margin: 0;
            padding-left: 1rem;
            border-left: 4px solid #237a68;
            font-style: italic;
            color: #555;
        }

        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
            border-radius: 1rem;
        }

        .video-wrapper iframe,
        .video-wrapper video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 1rem;
        }

        .tech-icons li {
            list-style: none;
            margin-bottom: 0.6rem;
            font-size: 1rem;
            color: #444;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tech-icons li svg {
            fill: currentColor;
        }

        .card-outer {
            border: 1px solid #ddd;
            border-radius: 1.5rem;
            background: #f9fcfc;
            padding: 1rem;
            overflow-x: auto;
        }

        .mb-badge {
            margin-right: 0.6rem;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 767px) {

            .img-card,
            .card-outer {
                padding: 0.5rem;
            }
        }
    </style>
@endsection
