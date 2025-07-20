@extends('dashboard.partials.main')

@section('content')
    <div class="row p-2">
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
                <h5 class="mb-3">Pesan Masuk</h5>
                <table class="table table-striped w-100" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Investor</th>
                            <th>Isi Pesan</th>
                            <th>Tipe Pesan</th>
                            <th>Dikirim Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesans as $index => $pesan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pesan->nama_investor }}</td>
                                <td>{{ \Illuminate\Support\Str::words($pesan->pesan, 7, ' ...') }}</td>
                                <td>{{ $pesan->type_pesan }}</td>
                                <td>{{ $pesan->created_at->format('d M Y H:i') }}</td>
                                {{-- <td>{{ $index + 1 }}</td> --}}
                               <td>
                                    <button class="btn btn-primary" style="background: #8A3DFF" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $pesan->id }}">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @foreach ($pesans as $pesan)
        <div class="modal fade" id="detailModal{{ $pesan->id }}" tabindex="1"
            aria-labelledby="detailModalLabel{{ $pesan->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="detailModalLabel{{ $pesan->id }}">Detail Pesan</h5>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <h6 class="text-muted">Type Pesan</h6>
                            <h6 class="fw-bold">{{ $pesan->type_pesan }}</h6>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Tanggal</h6>
                            <h6 class="fw-bold">{{ $pesan->created_at->format('d M Y H:i') }}</h6>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Nama</h6>
                            <h6 class="fw-bold">{{ $pesan->nama_investor }}</h6>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Nama Industri / Instansi</h6>
                            <h6 class="fw-bold">{{ $pesan->instansi }}</h6>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Email</h6>
                            <h6 class="fw-bold">{{ $pesan->email }}</h6>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Alamat Perusahaan</h6>
                            <h6 class="fw-bold">{{ $pesan->alamat_instansi }}</h6>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Deskripsi</h6>
                            <h6 class="fw-bold">
                                {{ $pesan->pesan }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
