@extends('dashboard.partials.main')

@section('content')
    <!-- Tombol Tambah -->
    <div class="row p-2">
        <div class="col">
            <button class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#tambahMemberModal" style="background: #8A3DFF">
                <i class="fas fa-plus me-2"></i>Tambah Member
            </button>
        </div>

        <!-- Alert -->
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

        <!-- Tabel -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped w-100" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Group</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $index => $member)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $member->role }}</td>
                                <td>{{ $member->group }}</td>
                                <td>{{ $member->kategori->nama }} (Batch {{ $member->kategori->batch }})</td>
                                <td>
                                    <button class="btn btn-warning  p-2 me-2" data-bs-toggle="modal" style="background: rgba(76, 175, 80, 0.2)" data-bs-target="#editMemberModal{{ $member->id }}"><img src="{{ asset('img/icons/edit-icon.svg') }}" alt="Edit" width="32" height="32"></button>
                                    <form action="{{ route('member-master.destroy', $member->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger p-2" onclick="return confirm('Yakin hapus member ini?')" style="background: rgba(224, 89, 76, 0.1)"><img src="{{ asset('img/icons/delete.svg') }}" alt="Delete" width="32" height="32"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Edit -->
        @foreach ($members as $member)
            <div class="modal fade" id="editMemberModal{{ $member->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form action="{{ route('member-master.update', $member->id) }}" method="POST" class="modal-content">
                        @csrf @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Member</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Role</label>
                                <input type="text" name="role" value="{{ $member->role }}" class="form-control"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label>Group</label>
                                <input type="text" name="group" value="{{ $member->group }}" class="form-control"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label>Kategori</label>
                                <select name="kategoriId" class="form-control" required>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}"
                                            {{ $member->kategoriId == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }} (Batch {{ $kategori->batch }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal" style="background: rgba(92, 92, 92, 0.2); color:rgb(92, 92, 92)">Batal</button>
                            <button type="submit" class="btn btn-primary" style="background: #8A3DFF">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahMemberModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('member-master.store') }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Role</label>
                            <input type="text" name="role" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Group</label>
                            <input type="text" name="group" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="kategoriId" class="form-control" required>
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
