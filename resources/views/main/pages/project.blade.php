@extends('main.partials.main')

@section('content')
    <!-- Top large image with phones + tablets + laptop + logo -->
    @if (session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <div id="toastSuccess" class="toast align-items-center text-bg-success border-0 show" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif
    <div class="container">

        <div class=" mb-4">
            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 p-3">
                <img src="{{ asset('storage/' . $project->thumbnail) }}" class="img-fluid img-card"
                    alt="Laptop screen depicting HidroTani online community forum page for hydroponic users" />
            </div>

            <!-- Video + Technologies + Links row -->
            <div class="row gx-4 mb-4">
                <div class="col-lg-8 mb-4">
                    <div class="video-wrapper shadow rounded-3">
                        <iframe src="{{ $project->link_video }}" title="HidroTani Project Overview" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="rounded-container shadow-sm p-3 mb-4">
                        <h5 class="mb-3">Technologies Used</h5>
                        <ul class="tech-icons ps-0">
                            @foreach ($project->Teches as $tech)
                                <li><img src="{{ asset('storage/public/icons/' . $tech->icon) }}" alt=""
                                        class="me-2" width="10%">
                                    {{ $tech->nama }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="rounded-container shadow-sm p-3 mb-4">
                        <h5 class="mb-3">Project Links</h5>
                        <ul class="ps-3">
                            <li><a href="{{ $project->link_website }}" class="link-blue" target="_blank" rel="noopener">Link
                                    Github</a></li>
                            <li><a href="{{ $project->link_figma }}" class="link-blue" target="_blank" rel="noopener">Link
                                    Prototype</a></li>
                        </ul>
                    </div>
                    <div class="rounded-container shadow-sm p-3">
                        <h5 class="mb-3">Tertarik</h5>
                        <div class="row px-3 flex-column mb-3">
                            <a href="{{ $project->link_website }}" class="link-blue" target="_blank"
                                style="text-decoration:none" rel="noopener">Info@infinitelearning.id</a>
                            <a href="{{ $project->link_figma }}" style="text-decoration:none" class="link-blue"
                                target="_blank" rel="noopener">Infinite
                                Learning Indonesia</a>
                        </div>
                        <button class="btn btn-contact-admin d-block w-100 p-2" style="background: #7a4dff"
                            data-bs-toggle="modal" data-bs-target="#modalSetujui">Hubungi
                            Admin</button>
                    </div>
                </div>
            </div>

            <!-- Title and badges -->
            <h1 class="fw-bold">{{ $project->nama_product }}</h1>
            <div class="mb-3 d-flex flex-wrap gap-2 badge-group">
                <span class="badge rounded-pill bg-primary">by {{ $project->nama_group }}</span>
                <span class="badge rounded-pill bg-purple text-white"
                    style="background-color:#d990d1;">{{ $project->Kategori->nama }}</span>
                <span class="badge rounded-pill bg-info text-dark">Batch {{ $project->Kategori->batch }}</span>
            </div>

            <!-- Project description -->
            <section>
                <h3 class="section-title">Deskripsi Project</h3>
                <p>{{ $project->deskripsi }}</p>
            </section>

            <!-- Mentor Group -->
            <section>
                <h3 class="section-title">Mentor Group</h3>
                <div class="d-flex flex-wrap gap-4 fs-5">
                    @foreach ($project->Kategori->MentorProject as $mentorProject)
                        <div class="d-flex align-items-center gap-2 flex-grow-1">
                            <span class="person-icon">👤</span>{{ $mentorProject->Mentor->username }}
                        </div>
                    @endforeach
                </div>
            </section>

            @php
                $groupedMembers = $project->Member->groupBy(fn($member) => $member->MemberMaster->group);

            @endphp

            <!-- Team Web -->
            @foreach ($groupedMembers as $group => $members)
                <section>
                    <h3 class="section-title">Tim {{ $group }}</h3>
                    <div class="row g-4">
                        @foreach ($members as $member)
                            <div class="col-6 col-md-4 col-lg-3 team-member d-flex">
                                <div class="icon-circle" aria-label="User Icon">
                                    {{ strtoupper(substr($member->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="name">{{ $member->nama }}</div>
                                    <div class="role">{{ $member->MemberMaster->role }}</div>
                                    <a href="{{ $member->linkedIn }}"
                                        class="linkedin-link d-inline-flex align-items-center" target="_blank"
                                        rel="noopener">
                                        <svg viewBox="0 0 24 24">
                                            <path
                                                d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zm-11 20h-3v-12h3v12zm-1.5-13.4c-1 0-1.8-.8-1.8-1.8s.8-1.8 1.8-1.8c1 0 1.8.8 1.8 1.8s-.8 1.8-1.8 1.8zm13.5 13.4h-3v-5.6c0-1.3-.5-2.2-1.7-2.2s-2 1-2 2.1v5.7h-3v-12h3v1.6h.1c.5-.9 1.7-1.8 3.5-1.8 3.7 0 4.3 2.5 4.3 5.7v6.5z" />
                                        </svg>
                                        LinkedIn
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        <div class="modal fade" id="modalSetujui" tabindex="-1" aria-labelledby="modalSetujuiLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="diskusiModalLabel">Hubungi Admin untuk Diskusi Lebih Lanjut</h5>

                    </div>
                    <form action="{{ route('pesan.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <p>Anda dapat mengisi bagian ini jika tertarik untuk mengetahui lebih lanjut atau ingin
                                mendiskusikan
                                produk
                                ini
                                lebih jauh.</p>
                            <div class="form-group mb-2">
                                <label for="type_pesan">Apa Topik Yang Ingin Anda Diskusikan?</label>
                                <select class="form-control" name="type_pesan" id="type_pesan" required>
                                    <option value="">Pilih opsi diskusi</option>
                                    <option value="Saya tertarik untuk merekrut anggota tim">Saya tertarik untuk merekrut
                                        anggota tim</option>
                                    <option value="Saya ingin berinvestasi">Saya ingin berinvestasi</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label for="nama_investor">Nama</label>
                                <input type="text" class="form-control" name="nama_investor" id="nama_investor"
                                    required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="instansi">Nama Industri</label>
                                <input type="text" class="form-control" name="instansi" id="instansi" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="email">Email/No.Telepon</label>
                                <input type="text" class="form-control" name="email" id="email" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="alamat_instansi">Alamat Perusahaan</label>
                                <input type="text" class="form-control" name="alamat_instansi" id="alamat_instansi"
                                    required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="pesan">Pesan</label>
                                <textarea class="form-control" name="pesan" id="pesan" rows="3" required></textarea>
                            </div>

                            <div class="form-group mb-2 form-check">
                                <input type="checkbox" class="form-check-input" id="confirm" required>
                                <label class="form-check-label" for="confirm">Ya, data sudah benar</label>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        body {
            background: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #222;
        }

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

        .btn-contact-admin {
            display: block;
            width: 100%;
            padding: 12px 20px;
            background: linear-gradient(135deg, #7a4dff, #a78bfa);
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 14px rgba(122, 77, 255, 0.4);
            transition: all 0.3s ease-in-out;
        }

        .btn-contact-admin:hover {
            background: linear-gradient(135deg, #5a34e0, #8c6dff);
            box-shadow: 0 6px 18px rgba(90, 52, 224, 0.5);
            transform: translateY(-2px);
        }

        .btn-contact-admin:active {
            transform: scale(0.98);
            box-shadow: 0 2px 8px rgba(90, 52, 224, 0.3);
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

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function(toastEl) {
                return new bootstrap.Toast(toastEl, {
                    delay: 4000
                });
            });
            toastList.forEach(toast => toast.show());
        });
    </script>
@endsection
