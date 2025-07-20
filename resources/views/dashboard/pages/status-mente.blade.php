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
                            <th>Komentar</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($projects as $project)
                            @foreach ($project->Status as $status)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ \Illuminate\Support\Str::words($status->comment, 7, ' ...') }}</td>
                                    <td>
                                        @if ($status->status == 'Disetujui')
                                            <span class="badge badge-setujui-outline">Disetujui</span>
                                        @elseif ($status->status == 'Revisi')
                                            <span class="badge badge-revisi-outline">Revisi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small text-muted">{{ $status->created_at->format('d M Y H:i') }}</div>
                                    </td>
                                    <td class="text-center">
                                        <span class="btn btn-primary py-2" style="background: #8A3DFF" data-bs-toggle="modal" data-bs-target="#komentarModal{{ $status->id }}">Detail</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    @foreach ($project->Status as $status)
        <div class="modal fade" id="komentarModal{{ $status->id }}" tabindex="-1"
            aria-labelledby="komentarModalLabel{{ $status->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="komentarModalLabel{{ $status->id }}">Informasi Detail</h5>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <h6 class="text-muted">Status</h6>
                            <h6 class="fw-bold">
                                @if ($status->status == 'Disetujui')
                                    <span class="badge badge-setujui-outline">Disetujui</span>
                                @elseif ($status->status == 'Revisi')
                                    <span class="badge badge-revisi-outline">Revisi</span>
                                @endif
                            </h6>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Tanggal</h6>
                            <h6 class="fw-bold">{{ $status->created_at->format('d M Y H:i') }}</h6>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Catatan Revisi</h6>
                            <h6 class="fw-bold">{{ $status->comment }}</h6>
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

@section('css')
    @section('css')
        <style>

        .badge-revisi-outline {
            border: 1px solid #E0594C;
            color: #E0594C;
            background-color: rgba(224, 89, 76, 0.1);
            font-weight: 600;
            font-size: 0.675rem;
            text-transform: capitalize;
        }

        .badge-setujui-outline {
            border: 1px solid #4CAF50;
            color: #4CAF50;
            background-color: rgba(76, 175, 80, 0.1);
            font-weight: 600;
            font-size: 0.675rem;
            text-transform: capitalize;
        }
            
        </style>
    @endsection
