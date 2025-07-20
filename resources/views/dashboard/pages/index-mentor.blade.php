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
                <h5 class="mb-4">Daftar Project</h5>
                <table class="table table-striped w-100" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Group</th>
                            <th>Mentor Group</th>
                            <th>Kategori</th>
                            <th>Sesi Kelas</th>
                            <th>Batch</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $index => $project)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $project->nama_group }}</td>

                                {{-- Mentor dari kategori->mentorProject --}}
                                <td>
                                    @php
                                        $mentors = $project->Kategori->MentorProject ?? [];
                                    @endphp
                                    @foreach ($mentors as $key => $mentor)
                                        <span class="badge bg-primary me-1">
                                            {{ $mentor->Mentor->username }}
                                        </span>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>


                                <td>{{ $project->Kategori->nama ?? '-' }}</td>
                                <td>{{ $project->sesi_kelas }}</td>
                                <td>{{ $project->Kategori->batch ?? '-' }}</td>
                                <td>{{ $project->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('detail-project', $project->id) }}" style="background: #8A3DFF">
                                        Tinjau
                                    </a>
                                    <!-- {{-- <button class="btn btn-primary" style="background: #8A3DFF" data-bs-toggle="modal" data-bs-target="#detailModal{{ $project->id }}">Detail</button> --}}
                                    {{-- <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $project->id }}">
                                        Tinjau
                                    </button> --}} -->
                                </td>
                            </tr>
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
