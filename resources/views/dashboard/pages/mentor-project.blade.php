@extends('dashboard.partials.main')

@section('content')
    <div class="row p-2">
        <div class="col">
            <button class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#tambahAsesmenModal" style="background: #8A3DFF">
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
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/dashboard/mentor">Akun Mentor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/dashboard/mentor/asesment"
                                style="background-color: #0d6efd; color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">Kategori
                                Mentor</a>
                        </li>
                    </ul>
                </div>
                <table class="table table-striped w-100" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username Mentor</th>
                            <th>Email</th>
                            <th>Kategori</th>
                            <th>Batch</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mentorProjects as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->mentor->username }}</td>
                                <td>{{ $item->mentor->user->email }}</td>
                                <td>{{ $item->kategori->nama }}</td>
                                <td>{{ $item->kategori->batch }}</td>
                                <td>
                                    {{-- style="background: #4CAF50"
                                    style="background: #336D95"
                                    style="background: #E0594C" --}}
                                    <button class="btn btn-warning" data-bs-toggle="modal" style="background: #4CAF50"
                                        data-bs-target="#editAsesmenModal{{ $item->id }}">Edit</button>
                                    <form action="{{ route('asesment.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger" style="background: #E0594C"
                                            onclick="return confirm('Yakin ingin menghapus asesmen ini?')">Hapus</button>
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
                                <select name="mentorId" class="form-control" required>
                                    @foreach ($mentors as $mentor)
                                        <option value="{{ $mentor->id }}"
                                            {{ $item->mentorId == $mentor->id ? 'selected' : '' }}>
                                            {{ $mentor->username }} ({{ $mentor->user->email }})
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
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-warning" style="background: #8A3DFF">Update</button>
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
                            <select name="mentorId" class="form-control" required>
                                <option disabled selected>-- Pilih Mentor --</option>
                                @foreach ($mentors as $mentor)
                                    <option value="{{ $mentor->id }}">{{ $mentor->username }}
                                        ({{ $mentor->user->email }})
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
