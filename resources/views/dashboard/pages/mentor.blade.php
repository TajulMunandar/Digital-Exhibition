@extends('dashboard.partials.main')

@section('content')
    <div class="row p-2">
        <div class="col">
            <button class="btn btn-primary float-end mb-3" style="background: #8A3DFF" data-bs-toggle="modal"
                data-bs-target="#tambahMentorModal">
                <i class="fas fa-plus me-2"></i>Tambah
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
                        <a href="/dashboard/mentor" class="text-decoration-none font-weight-bold" style="color: #8A3DFF; border-bottom: 2px solid #8A3DFF;">List Mentor</a>
                        <a href="/dashboard/mentor/asesment" class="text-decoration-none text-secondary">Akun Mentor</a>
                    </div>
                </div>
                <table class="table table-striped w-100" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mentor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mentors as $index => $mentor)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mentor->username }}</td>
                                <td>
                                    <button class="btn btn-warning p-2 me-2" data-bs-toggle="modal" style="background: rgba(76, 175, 80, 0.2)" data-bs-target="#editMentorModal{{ $mentor->id }}"><img src="{{ asset('img/icons/edit-icon.svg') }}" alt="Edit" width="32" height="32"></button>

                                    <form action="{{ route('mentor.destroy', $mentor->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger p-2" onclick="return confirm('Yakin hapus mentor {{ $mentor->username }} ?')" style="background: rgba(224, 89, 76, 0.1)"><img src="{{ asset('img/icons/delete.svg') }}" alt="Delete" width="32" height="32"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Edit --}}
        @foreach ($mentors as $mentor)
            <div class="modal fade" id="editMentorModal{{ $mentor->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('mentor.update', $mentor->id) }}" method="POST" class="modal-content">
                        @csrf @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Mentor</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Username</label>
                                <input type="text" name="username" value="{{ $mentor->username }}" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        {{-- Modal Tambah --}}
        <div class="modal fade" id="tambahMentorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('mentor.store') }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Mentor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" style="background: #8A3DFF">Buat akun mentor</button>
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
