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
                <h5 class="mb-4">Status Proyek</h5>
                <table class="table table-striped w-100" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Product</th>
                            <th>Komentar</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($projects as $project)
                            @foreach ($project->Status as $status)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $project->nama_product }}</td>
                                    <td>
                                        @if ($status->status == 'Disetujui')
                                            <div class="text-success fw-bold mb-1">✅ Selamat! Proyek Anda telah disetujui
                                                dan ditampilkan di exhibition</div>
                                        @elseif ($status->status == 'Revisi')
                                            <div class="text-danger fw-bold mb-1">⚠️ Perlu revisi. Cek komentar mentor.
                                            </div>
                                        @else
                                            <div class="text-muted mb-1">Status: {{ $status->status }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($status->status == 'Disetujui')
                                            <span class="badge bg-purple" style="background: #845ef7;">✅ Disetujui</span>
                                        @elseif ($status->status == 'Revisi')
                                            <span class="badge bg-danger">⚠️ Revisi</span>
                                        @else
                                            <span class="badge bg-secondary">⏳ Diupload</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small text-muted">{{ $status->created_at->format('d M Y H:i') }}</div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#komentarModal{{ $status->id }}">
                                            Detail
                                        </button>

                                        <!-- Modal komentar -->
                                        <div class="modal fade" id="komentarModal{{ $status->id }}" tabindex="-1"
                                            aria-labelledby="komentarModalLabel{{ $status->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="komentarModalLabel{{ $status->id }}">
                                                            Komentar Mentor</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Tutup"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $status->comment }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>

                </table>
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
