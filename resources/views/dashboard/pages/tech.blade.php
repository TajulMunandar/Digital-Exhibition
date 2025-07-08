@extends('dashboard.partials.main')

@section('content')
    <!-- Tambah Button -->
    <div class="row p-2">
        <div class="col">
            <button class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#tambahtechModal" style="background: #8A3DFF">
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
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($techs as $index => $tech)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $tech->nama }}</td>
                                <td> <img src="{{ asset('storage/public/icons/' . $tech->icon) }}" alt=""
                                        width="10%"></td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#edittechModal{{ $tech->id }}">Edit</button>
                                    <form action="{{ route('tech.destroy', $tech->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Yakin hapus tech ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @foreach ($techs as $tech)
            <div class="modal fade" id="edittechModal{{ $tech->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form action="{{ route('tech.update', $tech->id) }}" method="POST" class="modal-content"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit tech</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" value="{{ $tech->nama }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Icon</label>
                                <input type="file" name="icon" value="{{ $tech->icon }}" class="form-control">
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

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahtechModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('tech.store') }}" method="POST" enctype="multipart/form-data"
                    class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah tech</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required tabindex="1">
                        </div>
                        <div class="mb-3">
                            <label>Icon</label>
                            <input type="file" name="icon" class="form-control" required tabindex="2">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Tambah</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Table -->
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
                    decimal: ",",
                    thousands: ".",
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
