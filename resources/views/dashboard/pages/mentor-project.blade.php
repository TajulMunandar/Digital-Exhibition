@extends('dashboard.partials.main')

@section('content')
    <div class="row p-2">
        <div class="col">
            <button class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#tambahAsesmenModal"
                style="background: #8A3DFF">
                <i class="fas fa-plus me-2"></i>Tambah Kategori Mentor
            </button>
        </div>

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

        <div class="card">
            <div class="card-body">
                <div class="row p-2 mb-2">
                    <div class="d-flex gap-3 mb-3">
                        <a href="/dashboard/mentor" class="text-decoration-none text-secondary">List Mentor</a>
                        <a href="/dashboard/mentor/asesment" class="text-decoration-none font-weight-bold" style="color: #8A3DFF; border-bottom: 2px solid #8A3DFF;">Akun Mentor</a>
                    </div>
                </div>
                <table class="table table-striped w-100" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Mentor</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($groupedProjects as $index => $group)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $group['user']->email ?? '-' }}</td>
                                <td>
                                    @foreach ($group['mentors'] as $mentor)
                                        {{ $mentor->username }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                
                                <td>{{ $group['kategori']->nama ?? '-' }}</td>
                                <td>
                                    <button class="btn btn-warning p-2 me-2" data-bs-toggle="modal" style="background: rgba(76, 175, 80, 0.2)" data-bs-target="#editAsesmenModal{{ $group['id'] }}"><img src="{{ asset('img/icons/edit-icon.svg') }}" alt="Edit" width="32" height="32"></button>

                                    <button class="btn btn-secondary p-2 me-2" data-bs-toggle="modal" style="background: rgba(51, 109, 149, 0.2)" data-bs-target="#resetPasswordModal{{ $group['id'] }}"><img src="{{ asset('img/icons/edit-pass-icon.svg') }}" alt="Edit" width="32" height="32"></button>


                                    <form action="{{ route('asesment.destroy', $group['id']) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger p-2" style="background: rgba(224, 89, 76, 0.1)" onclick="return confirm(`Yakin ingin menghapus akun mentor {{ $group['user']->email }} ?`)"><img src="{{ asset('img/icons/delete.svg') }}" alt="Edit" width="32" height="32"></button>
                                        
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @foreach ($mentorProjects as $index => $item)
            <!-- Modal Edit -->
            <div class="modal fade" id="editAsesmenModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('asesment.update', $item->id) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Kategori Mentor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Mentor</label>
                                <select name="mentorId[]" class="mentor-select" multiple required>
                                    @foreach ($mentors as $mentor)
                                        <option value="{{ $mentor->id }}"
                                            {{ $item->Mentor && $item->Mentor->id == $mentor->id ? 'selected' : '' }}>
                                            {{ $mentor->username }} {{ $mentor->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Kategori</label>
                                <select name="kategoriId" class="form-control" required>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ $item->kategoriId == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }} (Batch {{ $kategori->batch }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" style="background: rgba(92, 92, 92, 0.2); color:rgb(92, 92, 92)">Batal</button>
                            <button class="btn btn-warning" style="background: #8A3DFF">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Reset Password --}}
            <div class="modal fade" id="resetPasswordModal{{ $item->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('mentor.resetPassword', $item->id) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Ganti Kata Sandi</h5>
                            
                        </div>
                        <div class="modal-body">
                            <p>Email : {{ $item->user->email }}</p>
                            <div class="mb-3">
                                <label>Kata Sandi Baru</label>
                                <input type="password" name="password" class="form-control" required minlength="6">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" style="background: rgba(92, 92, 92, 0.2); color:rgb(92, 92, 92)">Batal</button>                           
                            <button type="submit" class="btn btn-primary" style="background: #8A3DFF">Ganti</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        {{-- Modal Tambah --}}
        <div class="modal fade" id="tambahAsesmenModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('asesment.store') }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori Mentor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Mentor</label>
                            <select name="mentorId[]" id="mentorSelect" multiple>
                                @foreach ($mentors as $mentor)
                                    <option value="{{ $mentor->id }}">
                                        {{ $mentor->username }} {{ $mentor->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="kategoriId" class="form-control" required>
                                <option disabled selected>-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }} (Batch
                                        {{ $kategori->batch }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" style="background: #8A3DFF">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mentorSelect = document.getElementById('mentorSelect');
            new Choices(mentorSelect, {
                removeItemButton: true,
                shouldSort: false,
                placeholder: true,
                placeholderValue: 'Pilih mentor...',
            });
        });
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('shown.bs.modal', function() {
                modal.querySelectorAll('.mentor-select').forEach(function(selectElement) {
                    if (!selectElement.classList.contains('choices-initialized')) {
                        new Choices(selectElement, {
                            removeItemButton: true,
                            shouldSort: false,
                            placeholder: true,
                            placeholderValue: 'Pilih mentor...',
                        });
                        selectElement.classList.add(
                            'choices-initialized'); // agar tidak double inisialisasi
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                autoWidth: false,
                scrollX: true,
                language: {
                    search: "",
                    searchPlaceholder: "Cari...",
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
