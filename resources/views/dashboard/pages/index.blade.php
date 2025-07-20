@extends('dashboard.partials.main')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <span class="mask opacity-10 border-radius-lg" style="background: #845ef7"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-8 text-start">
                                    <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                        <i class="fa-solid fa-users text-dark text-gradient text-lg opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                        {{ $akun }}
                                    </h5>
                                    <span class="text-white text-sm">Total Akun Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <span class="mask opacity-10 border-radius-lg" style="background: #845ef7"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-8 text-start">
                                    <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                        <i class="fa-solid fa-folder text-dark text-gradient text-lg opacity-10"
                                            aria-hidden="true"></i>
                                            <!-- <i class="fa-solid fa-folder"></i> -->
                                    </div>
                                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                        {{ $project }}
                                    </h5>
                                    <span class="text-white text-sm">Total Proyek Semua Batch</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card">
                        <span class="mask opacity-10 border-radius-lg" style="background: #845ef7"></span>
                        <div class="card-body p-3 position-relative">
                            <div class="row">
                                <div class="col-8 text-start">
                                    <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                        <i class="fa-solid fa-award text-dark text-gradient text-2xl opacity-10"
                                            aria-hidden="true"></i>
                                    </div>
                                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                        {{ $best }}
                                    </h5>
                                    <span class="text-white text-sm">Total Proyek Terbaik</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Jumlah Project Setiap Batch</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-bars" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const batchLabels = @json($batchLabels);
        const batchCounts = @json($batchCounts);
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: batchLabels.map(label => "Batch " + label),
                datasets: [{
                    label: "Jumlah Project",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "#845ef7",
                    data: batchCounts,
                    maxBarThickness: 12
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: true,
                            drawTicks: true,
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 15,
                            font: {
                                size: 14,
                                family: "Inter",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: true,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: true
                        },
                        ticks: {
                            display: true
                        },
                    },
                },
            },
        });
    </script>
@endsection
