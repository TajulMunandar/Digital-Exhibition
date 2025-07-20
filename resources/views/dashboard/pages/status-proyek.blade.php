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
                                <td class="p-3">
                                    @php
                                        $mentorUsernames = [];
                                    @endphp
                                    @foreach ($project->MentorGroup as $group)
                                        @php
                                            $mentorUsername = optional($group->MentorProject->Mentor)->username;
                                        @endphp

                                        @if ($mentorUsername)
                                            @php
                                                $mentorUsernames[] = $mentorUsername;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if (count($mentorUsernames) > 0)
                                        {{ implode(', ', $mentorUsernames) }}
                                    @endif
                                </td>

                                <td>{{ $project->sesi_kelas }}</td>
                                <td>{{ $project->Kategori->batch ?? '-' }}</td>
                                <td>{{ $project->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    @php $latestStatus = $project->Status->last(); @endphp
                                    @if ($latestStatus)
                                        @if ($latestStatus->status == 'Disetujui')
                                            <span class="badge badge-setujui-outline">Disetujui</span>
                                        @else
                                            <span class="badge badge-revisi-outline">Revisi</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">Diupload</span>
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
