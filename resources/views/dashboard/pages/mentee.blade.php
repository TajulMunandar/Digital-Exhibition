@extends('dashboard.partials.main')

@section('content')
    <div class="row p-2">
        <div class="col">
            <button class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#tambahMenteeModal">
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
                <table class="table table-striped w-100" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mentees as $index => $mentee)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mentee->user->email }}</td>
                                <td>{{ $mentee->username }}</td>
                                <td>{{ $mentee->kategori->nama }}</td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editMenteeModal{{ $mentee->id }}">Edit</button>
                                    <button class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#resetPasswordModal{{ $mentee->id }}">Reset Password</button>
                                    <form action="{{ route('mentee.destroy', $mentee->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Yakin hapus mentee ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Edit --}}
        @foreach ($mentees as $mentee)
            <div class="modal fade" id="editMenteeModal{{ $mentee->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('mentee.update', $mentee->id) }}" method="POST" class="modal-content">
                        @csrf @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Mentee</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Username</label>
                                <input type="text" name="username" value="{{ $mentee->username }}" class="form-control"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label>Kategori</label>
                                <select name="kategoriId" class="form-control" required>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ $kategori->id == $mentee->kategoriId ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="resetPasswordModal{{ $mentee->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('mentee.resetPassword', $mentee->id) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Password Baru</label>
                                <input type="password" name="password" class="form-control" required minlength="6">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        {{-- Modal Tambah --}}
        <div class="modal fade" id="tambahMenteeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('mentee.store') }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Mentee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="kategoriId" class="form-control" required>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Tambah</button>
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
