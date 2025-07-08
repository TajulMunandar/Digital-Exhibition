@extends('dashboard.partials.main')
@section('content')
    <div class="card">
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
        <div class="card-body">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Informasi -->
                <h5 class="mb-3 fw-bold">Informasi Proyek</h5>
                <p class="mb-3">Bagian ini berisi informasi seputar detail grup, mulai dari nama group, sesi kelas,
                    hingga
                    mentor group dari <strong>Project Massive Challenge</strong>.</p>
                <div class="row gy-3 align-items-center mb-3">
                    <div class="col-lg-5">
                        <label for="namaGroup" class="form-label fw-semibold">Nama Group</label>
                        <div class="mb-1" style="font-size: 12px">Gunakan format Title Case ya, contohnya seperti ini:
                            Infinite Learning.
                        </div>
                        <input type="text" id="namaGroup" class="form-control" placeholder="Masukkan nama group"
                            name="nama_group" />
                    </div>
                    <div class="col-lg-2">
                        <label for="sesiKelas" class="form-label fw-semibold">Sesi Kelas</label>
                        <br class="small mb-2">
                        </br>
                        <select id="sesiKelas" class="form-select" aria-label="Pilih Sesi/Kelas" name="sesi_kelas">
                            <option selected disabled>Pilih Sesi/Kelas</option>
                            <option value="Pagi">Pagi</option>
                            <option value="Siang">Siang</option>
                            <option value="Malam">Malam</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <label>Kategori</label>
                        <br class="small mb-2">
                        </br>
                        <select name="kategoriId" id="kategoriId" class="form-control" name="kategoriId">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }} - Batch {{ $kategori->batch }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="mentorGroup" class="form-label fw-semibold">Mentor Group</label>
                        <br class="small mb-2">
                        </br>
                        <textarea id="mentorGroupText" type="text" id="mentorGroup" class="form-control"
                            placeholder="Nama depan mentor Group" readonly></textarea>
                    </div>
                </div>

                <!-- Anggota Group -->
                <div class="mb-4">
                    <h5 class="fw-bold">Anggota Group</h5>
                    <p class="mb-3">Bagian ini berisi informasi seputar keanggotaan group, siapa saja yang terlibat dalam
                        mengerjakan <strong>Project Massive Challenge.</strong></p>

                    <!-- Tim Web -->
                    @foreach ($memberGroups as $groupName => $members)
                        <fieldset class="mb-4">
                            <h6 class="fw-bold">Tim {{ $groupName }}</h6>
                            <small class="text-muted d-block mb-1">Form untuk anggota group {{ $groupName }}</small>

                            <div class="repeater" data-group="{{ $groupName }}">
                                <div class="row align-items-center gy-3 repeater-item mb-2">
                                    <div class="col-md-4">
                                        <label class="fw-semibold">Nama Anggota</label>
                                        <input type="text" name="nama[{{ $groupName }}][]" class="form-control mt-1"
                                            placeholder="Nama anggota group {{ $groupName }}" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="fw-semibold">LinkedIn</label>
                                        <input type="url" name="linkedIn[{{ $groupName }}][]" class="form-control"
                                            placeholder="Masukkan link LinkedIn" />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="fw-semibold d-flex justify-content-between align-items-center">
                                            Role
                                        </label>
                                        <select name="roleId[{{ $groupName }}][]" class="form-select">
                                            <option selected disabled>Pilih Role</option>
                                            @foreach ($members as $member)
                                                <option value="{{ $member->id }}">
                                                    {{ ucwords(str_replace('_', ' ', $member->role)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 pt-5">
                                        <span class="btn-group">
                                            <button type="button" class="btn btn-sm btn-success add-row">+</button>
                                            <button type="button" class="btn btn-sm btn-danger remove-row">−</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    @endforeach
                </div>

                <!-- Product Information -->
                <div class="mb-4">
                    <h5 class="fw-bold">Product Information</h5>
                    <p class="mb-3">Bagian ini berisi informasi seputar detail produk/proyek yang sudah dikembangkan pada
                        <strong>Massive Challenge</strong> di Infinite Learning Indonesia.
                    </p>

                    <div class="mb-3">
                        <h6 for="productName">Product Name</h6>
                        <small class="text-muted d-block mb-1">Gunakan format <strong>Title Case</strong> ya, contohnya
                            seperti
                            ini: Ayo Bercocok Tanam.</small>
                        <input type="text" id="productName" class="form-control" placeholder="Input your product name"
                            name="nama_product" />
                    </div>

                    <div class="mb-3">
                        <h6 for="descriptionProduct">Description Product</h6>
                        <small class="text-muted d-block mb-1">Kolom ini mendukung Rich Text Formatting. Usahakan
                            deskripsinya yang
                            padat dan berisi, ceritakan dampaknya kepada pengguna dan kamu bisa meng-highlight hal-hal yang
                            kamu
                            ingin tekankan kepada pembaca.</small>
                        {{-- <textarea id="descriptionProduct" rows="4" class="form-control" placeholder="Describe product your team"
                            name="deskripsi"></textarea> --}}
                            {{-- kurni --}}
                        <textarea id="descriptionProduct" class="form-control" placeholder="Deskripsikan produk tim kammu" name="deskripsi"></textarea>
                    </div>

                    <div class="mb-3">
                        <h6 for="techSelect">Teknologi Yang Digunakan</h6>
                        <small class="text-muted d-block mb-1">Pilih lebih dari satu teknologi yang digunakan dalam produk
                            ini.</small>
                        <select name="tech_ids[]" id="techSelect" class="form-select" multiple>
                            @foreach ($teches as $tech)
                                <option value="{{ $tech->id }}">{{ $tech->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <h6>Thumbnail Product</h6>
                        <small class="text-muted d-block mb-1">
                            Thumbnail Product wajib menggunakan gambar berformat <b>*.JPEG</b> dan ukuran file &lt; 5 MB
                            dan
                            untuk ukurannya yaitu ukuran untuk desktop 16:9 atau 1280 × 720.</small>
                        <label for="thumbnailProduct" class="file-drop-zone" tabindex="0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-upload-cloud" viewBox="0 0 24 24">
                                <polyline points="16 16 12 12 8 16"></polyline>
                                <line x1="12" y1="12" x2="12" y2="21"></line>
                                <path d="M20.39 18.39a5 5 0 00-9.79-1.6A4.5 4.5 0 015.5 17.5a4.5 4.5 0 00-.5 8.5h11"></path>
                            </svg>
                            <span>upload file thumbnail</span><br />
                            <button type="button" class="btn btn-dark btn-sm mt-2">Pilih File</button>
                            <input type="file" id="thumbnailProduct" class="d-none" accept="image/*"
                                aria-label="Upload Thumbnail Product" name="thumbnail" />
                        </label>
                    </div>

                    <div class="mb-3">
                        <h6 for="videoShowcase">Link Video Showcase</h6>
                        <small class="text-muted d-block mb-1">Silahkan upload terlebih dahulu videonya ke platform
                            <strong>Youtube</strong> dengan <strong>visibilitas Not Public</strong> atau <strong>Tidak
                                Publik</strong>.</small>
                        <input type="url" id="videoShowcase" class="form-control" placeholder="Masukkan link video"
                            name="link_video" />
                    </div>

                    <div class="mb-3">
                        <h6 for="linkFigma">Link Figma</h6>
                        <small class="text-muted d-block mb-1">Masukkan Link figma Project .</small>
                        <input type="url" id="linkFigma" class="form-control" placeholder="Input your product name"
                            name="link_figma" />
                    </div>

                    <div class="mb-3">
                        <h6 for="linkGithub">Link Website/Github</h6>
                        <small class="text-muted d-block mb-1">Jika website kamu belum menggunakan hosting yang berbayar
                            atau
                            mempunyai nama domain resmi, kamu bisa menggunakan platform seperti <strong>Vercel</strong> atau
                            <strong>Netlify</strong> atau platform lain sejenisnya. kamu juga bisa menggunakan link
                            github</small>
                        <input type="url" id="linkGithub" class="form-control" placeholder="Input your product name"
                            name="link_website" />
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <fieldset class="border rounded p-3 mb-4">
                    <h5 class="fw-bold mb-2 text-danger">Terms and Conditions<span class="text-danger">*</span>
                    </h5>
                    <p class="small mb-3">
                        Produk yang teman-teman kembangkan sepenuhnya hak milik teman-teman dan tim. Infinite Learning
                        Indonesia
                        diberikan izin untuk mempromosikan produk dan menunjukkan produk sebagai hasil karya ketika
                        teman-teman
                        belajar di Infinite Learning Indonesia.
                        Infinite Learning Indonesia juga diberikan izin untuk menghubungi teman-teman kembali, jika ada
                        informasi
                        lebih lanjut mengenai produk yang sudah teman-teman kembangkan selama belajar disini.
                    </p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agreeCheck" required />
                        <label class="form-check-label" for="agreeCheck">Ya, data sudah benar</label>
                    </div>
                </fieldset>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary" style="background: #8A3DFF">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
        {{-- kurni --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        // Script to handle file input click on custom drop zone
        const dropZone = document.querySelector('.file-drop-zone');
        const fileInput = document.getElementById('thumbnailProduct');

        dropZone.addEventListener('click', () => {
            fileInput.click();
        });

        dropZone.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                fileInput.click();
            }
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                dropZone.querySelector('span').textContent = fileInput.files[0].name;
            }
        });
        $('#kategoriId').on('change', function() {
            const kategoriId = $(this).val();
            if (kategoriId) {
                $.get('/dashboard/get-mentors/' + kategoriId, function(data) {
                    $('#mentorGroupText').val(data.join(', ')); // gabungkan jadi string
                });
            } else {
                $('#mentorGroupText').val('');
            }
        });
        $(document).ready(function() {
            $('.repeater').each(function() {
                let repeater = $(this);
                let groupName = repeater.data('group');

                repeater.on('click', '.add-row', function() {
                    let firstRow = repeater.find('.repeater-item').first();
                    let clone = firstRow.clone();

                    clone.find('input').val('');
                    clone.find('select').val('');
                    repeater.append(clone);
                });

                repeater.on('click', '.remove-row', function() {
                    let rows = repeater.find('.repeater-item');
                    if (rows.length > 1) {
                        $(this).closest('.repeater-item').remove();
                    } else {
                        alert('Minimal satu anggota harus ada.');
                    }
                });
            });
        });

        // kurni
        $(document).ready(function() {
            $('#descriptionProduct').summernote({
            height: 400,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol',]],
                ['insert', ['link']]
            ]
            });
        });
    </script>
@endsection
@section('css')
    <style>
        /* Custom style for dashed upload area */
        .file-drop-zone {
            border: 2px dashed #6c757d;
            border-radius: 6px;
            background: #f8f9fa;
            min-height: 110px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 0.2rem;
            color: #6c757d;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .file-drop-zone:hover {
            background-color: #e9ecef;
        }

        .file-drop-zone svg {
            width: 30px;
            height: 30px;
            color: #6c757d;
        }

        .btn-disabled {
            pointer-events: none;
            opacity: 0.65;
        }

        small.text-muted {
            user-select: none;
        }
    </style>
@endsection
