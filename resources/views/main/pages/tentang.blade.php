@extends('main.partials.main')

@section('content')
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

    <section class="hero2 d-flex align-items-center" style="background: #fafafa">
        <div class="row">

            <div class="col col-8">
                <img src="{{ asset('img/tentang.png') }}" alt="Image of the exhibition" class="image-side img-fluid">
            </div>
            <div class="col">
                <h1>Proyek Mentee Group Yang Ditampilkan</h1>
                <p>Project yang ditampilkan terbagi dari beberapa kelompok/tim di beberapa program, ada juga kelompok yang
                    collab
                </p>
            </div>
        </div>
    </section>
    <section class="hero2 d-flex align-items-center">
        <div class="row d-flex align-items-center">
            <div class="col">
                <h1>Merge Collab (Web & Mob & AI)</h1>
                <p>Program merupakan program yang membangun aplikasi lengkap yang mencakup pengembangan web, mobile, dan
                    integrasi teknologi AI. Peserta diajak membuat solusi end-to-end dari sisi antarmuka pengguna hingga
                    kecerdasan buatan seperti chatbot atau sistem rekomendasi.
                </p>
            </div>
            <div class="col ">
                <img src="{{ asset('img/div2.png') }}" alt="Image of the exhibition" class="image-side img-fluid">
            </div>
        </div>
    </section>
    <section class="hero2 d-flex align-items-center" style="background: #fafafa">
        <div class="row d-flex align-items-center">
            <div class="col ">
                <img src="{{ asset('img/div2.png') }}" alt="Image of the exhibition" class="image-side img-fluid">
            </div>
            <div class="col">
                <h1>Merge (Web & Mob)</h1>
                <p>Program ini berfokus pada pengembangan aplikasi lintas platform, yaitu website dan aplikasi mobile, tanpa
                    komponen AI. Program ini cocok bagi peserta yang ingin membangun sistem terpadu yang dapat diakses di
                    berbagai perangkat.
                </p>
            </div>

        </div>
    </section>

    <section class="hero2 d-flex align-items-center">
        <div class="row d-flex align-items-center">
            <div class="col">
                <h1>Collab (Web & AI)</h1>
                <p>Program ini merupakan penggabungan antara teknologi web dan AI, seperti penggunaan Natural Language
                    Processing (NLP) atau computer vision dalam aplikasi web, namun tanpa pengembangan sisi mobile.
                </p>
            </div>
            <div class="col ">
                <img src="{{ asset('img/div2.png') }}" alt="Image of the exhibition" class="image-side img-fluid">
            </div>
        </div>
    </section>

    <section class="hero2 d-flex align-items-center" style="background: #fafafa">
        <div class="row d-flex align-items-center">
            <div class="col ">
                <img src="{{ asset('img/div2.png') }}" alt="Image of the exhibition" class="image-side img-fluid">
            </div>
            <div class="col">
                <h1>Website</h1>
                <p>Program website merupakan pembuatan aplikasi berbasis website dengan
                </p>
            </div>

        </div>
    </section>

    <section class="hero2 d-flex align-items-center">
        <div class="row d-flex align-items-center">
            <div class="col">
                <h1>Game</h1>
                <p>yang fokus pada pembuatan game berbasis web maupun mobile dengan memanfaatkan game engine seperti Unity
                    atau Godot.
                </p>
            </div>
            <div class="col ">
                <img src="{{ asset('img/div2.png') }}" alt="Image of the exhibition" class="image-side img-fluid">
            </div>
        </div>
    </section>

    <section class="hero2 d-flex align-items-center" style="background: #fafafa">
        <div class="row d-flex align-items-center">
            <div class="col ">
                <img src="{{ asset('img/div2.png') }}" alt="Image of the exhibition" class="image-side img-fluid">
            </div>
            <div class="col">
                <h1>Artificial Intelligence</h1>
                <p>dirancang untuk memberikan pemahaman menyeluruh tentang kecerdasan buatan serta penerapannya dalam
                    pengembangan aplikasi digital. Dalam program ini, peserta akan mempelajari dasar-dasar Artificial
                    Intelligence, termasuk pengenalan machine learning, algoritma pembelajaran seperti klasifikasi dan
                    regresi, serta cara kerja model AI dalam mengolah data.
                </p>
            </div>

        </div>
    </section>

    <section class="hero2 d-flex align-items-center">
        <div class="row d-flex align-items-center">
            <div class="col">
                <h1>HCRH</h1>
                <p>Hybrid Cloud & Red Hat, yaitu pelatihan profesional yang mengajarkan peserta untuk mengelola dan
                    menjalankan aplikasi di lingkungan Hybrid Cloud menggunakan teknologi Red Hat seperti OpenShift dan
                    Ansible.
                </p>
            </div>
            <div class="col ">
                <img src="{{ asset('img/div2.png') }}" alt="Image of the exhibition" class="image-side img-fluid">
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
        }

        .project-card:hover {
            transform: scale(1.05);
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
