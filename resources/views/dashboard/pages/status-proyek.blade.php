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
                            <th>Sesi Kelas</th>
                            <th>Batch</th>
                            <th>Tanggal</th>
                            <th>Status</th>
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
                                    @foreach ($mentors as $mentor)
                                        <span class="badge bg-primary me-1">{{ $mentor->Mentor->username }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $project->sesi_kelas }}</td>
                                <td>{{ $project->Kategori->batch ?? '-' }}</td>
                                <td>{{ $project->created_at->format('d M Y') }}</td>
                                <td>
                                    @if ($project->Status->last()->exists())
                                        @if ($project->Status->last()->status == 'Disetujui')
                                            <span class="badge" style="background: purple">Disetujui</span>
                                        @else
                                            <span class="badge" style="background: red">Revisi</span>
                                        @endif
                                    @endif
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
