@extends('main.partials.main')

@section('content')
    <div class="hero d-flex align-items-center">
        <div class="row">
            <div class="col">
                <h1 class="text-dark">Digital Exhibition: Showcase Proyek Mentee Infinite Learning</h1>
                <p>Sebuah platform yang dirancang untuk menampilkan proyek-proyek yang dibuat oleh peserta program pelatihan
                    pengembangan aplikasi dan website.</p>
                <a href="/showcase" class="btn btn-custom rounded">Lihat Proyek Kami <img src="{{ asset('img/arrow-right.svg') }}" alt="panah kanan" class="ms-2" style="width: 1rem; height: 1rem;"></a>
            </div>
            <div class="col">
                <img src="{{ asset('img/div.png') }}" alt="Image of the exhibition" class="image-side img-fluid">
            </div>
        </div>
    </div>

    <section class="hero2 d-flex align-items-center">
        <div class="row">
            <div class="col">
                <h1>Digital Exhibition</h1>
                <p>Digital Exhibition adalah sebuah platform yang dirancang untuk memungkinkan para peserta program
                    pelatihan mempresentasikan karya mereka dalam bentuk website. Platform ini menjadi wadah untuk
                    menampilkan kreativitas serta kompetensi teknis yang telah mereka kembangkan selama mengikuti pelatihan.
                </p>
                <div class="row">
                    <div class="col">
                        <div class="card" style="background: #FAFAFA; border: none;">
                            <div class="card-body">
                                <h5>Pembelejaran</h5>
                                <p>Program pelatihan intensif yang dibimbing oleh mentor berpengalaman.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="background: #FAFAFA; border: none;">
                            <div class="card-body">
                                <h5>Exhibition</h5>
                                <p>Pameran digital yang dirancang untuk menampilkan dan menyoroti proyek-proyek kreatif para
                                    peserta.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <img src="{{ asset('img/div2.png') }}" alt="Image of the exhibition" class="image-side img-fluid">
            </div>
        </div>
    </section>

    <section class=" align-items-center p-5" style="background: #FAFAFA">
        <div class="row w-100">
            <div class="col">
                <h1>Proyek Showcase</h1>
            </div>
            <div class="col text-end">
                <a href="/showcase" class="btn btn-custom rounded">Lihat Proyek <img src="{{ asset('img/arrow-right.svg') }}" alt="panah kanan" class="ms-2" style="width: 1rem; height: 1rem;"></a>
            </div>
        </div>
        <div class="row mt-4">
            @foreach ($projects as $project)
                <div class="col-md-4">
                    <a href="{{ route('project.show', $project->id) }}" class="text-decoration-none text-black">
                        <div class="project-card shadow-sm p-4" style="border: none;">
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" class="card-img-top mb-2" alt="Kosmiku">
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-2">{{ $project->nama_product }}</h5>
                                <p class="card-text small line-clamp-3">
                                    {{-- baru 1 --}}
                                    {{-- <p class="line-clamp-3">
                                        {{ Str::limit(strip_tags($project->deskripsi), 150, '...') }}
                                    </p> --}}

                                    {{-- baru 2 --}}
                                    <div class="line-clamp-3 prose prose-sm">
                                        {!! strip_tags($project->deskripsi, '<b><strong><i><em>') !!}
                                    </div>

                                    {{-- baru 3 --}}
                                    {{-- <p class="line-clamp-3 text-sm text-gray-700">
                                        {{ Str::limit(strip_tags($project->deskripsi), 120, '...') }}
                                    </p> --}}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mb-5 pb-5">
        <div class="container mb-5">
            <div class="logo-container">
                <h2 class="mb-5 pb-5">Mitra Terbaik Kami</h2>
                <img class="mx-5" src="https://www.pngkey.com/png/detail/201-2015918_red-hat-linux-logo-png-svg-red-hat.png"
                    alt="Red Hat Logo PNG" height="60">
                <img class="mx-5" src="https://upload.wikimedia.org/wikipedia/commons/5/51/IBM_logo.svg" alt="IBM" height="60">
                <img class="mx-5" src="https://upload.wikimedia.org/wikipedia/commons/5/51/RMIT_University_Logo.svg" alt="Red Hat"
                    height="60" style="background-color: white; padding: 4px; border-radius: 4px;">

                <img class="mx-5" src="https://kompaspedia.kompas.id/wp-content/uploads/2022/04/Logo-BI-format-PNG-1400x443.png"
                    alt="Bank Indonesia" height="60" style="background-color:white; padding:4px; border-radius:4px;">

                <!-- KOMINFO -->
                <img class="mx-5" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg/2060px-Logo_of_Ministry_of_Communication_and_Information_Technology_of_the_Republic_of_Indonesia.svg.png"
                    alt="KOMINFO" height="60" style="background-color:white; padding:4px; border-radius:4px;">
            </div>
        </div>
    </section>

    <section class="here2 d-flex align-items-center mb-5 pb-5" style="background: #FAFAFA">
        <div class="container text-center">
            <h1 class="my-5">Testimoni Alumni</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="card-img-top-testi"
                            alt="Michael Chen">


                        <div class="card-body">
                            <p class="card-text">"Program ini membuka banyak peluang karir baru untuk saya."</p>
                            <h5 class="card-title">Sarah Johnson</h5>
                            <p class="card-text"><small class="text-muted">Web Developer</small></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="card-img-top-testi"
                            alt="Emily Park">

                        <div class="card-body">
                            <p class="card-text">"Mentor yang sangat supportif dan materi pembelajaran yang terstruktur
                                dengan baik."</p>
                            <h5 class="card-title">Michael Chen</h5>
                            <p class="card-text"><small class="text-muted">Mobile Developer</small></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://randomuser.me/api/portraits/men/76.jpg" class="card-img-top-testi"
                            alt="Daniel Rivera">
                        <div class="card-body">
                            <p class="card-text">"Digital Exhibition membantu saya mendapatkan exposure yang
                                dibutuhkan."</p>
                            <h5 class="card-title">Amanda Williams</h5>
                            <p class="card-text"><small class="text-muted">UI/UX Designer</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>
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

        .hero {
            min-height: 80vh;
            background-color: #f8f9fa;
            padding: 4rem 2rem;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #4b2aad;
        }

        .hero p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #444;
        }

        .hero-text {
            max-width: 600px;
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

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .image-side {
            max-width: 100%;
            height: 100%;
        }

        .hero2 {
            min-height: 80vh;
            background-color: white;
            padding: 4rem 2rem;
        }

        .hero2 h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero2 p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            color: #444;
        }

        .hero-text {
            max-width: 600px;
        }

        .project-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.2s;
            cursor: pointer;
        }

        .project-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 32px rgb(0 0 0 / 0.2);
        }

        .logo-container {
            text-align: center;
            margin: 50px 0;
        }

        .logo-container img {
            max-width: 150px;
            /* Mengatur lebar maksimum logo */
            margin: 0 15px;
            /* Jarak antar logo */
        }


        .card-img-top-testi {
            border-radius: 100%;
            width: 100px;
            margin: 20px auto;
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
