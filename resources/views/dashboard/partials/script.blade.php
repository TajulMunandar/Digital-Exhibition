 <!--   Core JS Files   -->
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="{{ asset('dashboard/assets/js/core/popper.min.js') }}"></script>
 <script src="{{ asset('dashboard/assets/js/core/bootstrap.min.js') }}"></script>
 <script src="{{ asset('dashboard/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
 <script src="{{ asset('dashboard/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
 <script src="{{ asset('dashboard/assets/js/plugins/chartjs.min.js') }}"></script>
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
 <script>
     var win = navigator.platform.indexOf('Win') > -1;
     if (win && document.querySelector('#sidenav-scrollbar')) {
         var options = {
             damping: '0.5'
         }
         Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
     }
 </script>
 <!-- Github buttons -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>
 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
 <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="{{ asset('dashboard/assets/js/soft-ui-dashboard.min.js?v=1.1.0') }}"></script>
