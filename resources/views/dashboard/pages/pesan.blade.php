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
                            <th>Tipe Pesan</th>
                            <th>Email</th>
                            <th>Nama Investor</th>
                            <th>Instansi</th>
                            <th>Alamat Instansi</th>
                            <th>Isi Pesan</th>
                            <th>Dikirim Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesans as $index => $pesan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pesan->type_pesan }}</td>
                                <td>{{ $pesan->email }}</td>
                                <td>{{ $pesan->nama_investor }}</td>
                                <td>{{ $pesan->instansi }}</td>
                                <td>{{ $pesan->alamat_instansi }}</td>
                                <td>{{ $pesan->pesan }}</td>
                                <td>{{ $pesan->created_at->format('d M Y H:i') }}</td>
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
