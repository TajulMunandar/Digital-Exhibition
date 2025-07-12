@extends('dashboard.partials.main')

@section('content')
    <!-- Tambah Button -->
    <div class="row p-2">
        <div class="col">
            <button class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal" style="background: #8A3DFF">
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
                            <th>Nama</th>
                            <th>Batch</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoris as $index => $kategori)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kategori->nama }}</td>
                                <td>{{ $kategori->batch }}</td>
                                <td>
                                    <button class="btn btn-warning p-2 me-2" data-bs-toggle="modal" data-bs-target="#editKategoriModal{{ $kategori->id }}" style="background: rgba(76, 175, 80, 0.2)" ><img src="{{ asset('img/icons/edit-icon.svg') }}" alt="Edit" width="32" height="32"></button>
                                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger p-2" onclick="return confirm('Yakin hapus kategori ini?')" style="background: rgba(224, 89, 76, 0.1)"><img src="{{ asset('img/icons/delete.svg') }}" alt="Delete" width="32" height="32"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Edit --}}
        @foreach ($kategoris as $kategori)
            <div class="modal fade" id="editKategoriModal{{ $kategori->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="modal-content">
                        @csrf @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Kategori</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="nama" value="{{ $kategori->nama }}" class="form-control"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label>Batch</label>
                                <input type="number" name="batch" value="{{ $kategori->batch }}" class="form-control"
                                    required>
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

        {{-- Modal Tambah --}}
        <div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('kategori.store') }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Batch</label>
                            <input type="number" name="batch" class="form-control" required>
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
