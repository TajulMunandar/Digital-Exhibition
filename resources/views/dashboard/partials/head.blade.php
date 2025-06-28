  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  {{-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png"> --}}
  <title>
      Digital Exhibition - {{ $pages }}
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('dashboard/assets/css/soft-ui-dashboard.css?v=1.1.0') }}" rel="stylesheet" />
  <style>
      .nav-link .nav-link-text {
          color: black !important;
      }

      /* Saat aktif: ubah warna tulisan jadi ungu */
      .nav-link.active .nav-link-text {
          color: #893ef1 !important;
      }

      .nav-link.active .icon-shape {
          background-color: #893ef1 !important;
          color: white !important;
          /* agar ikon terlihat jika sebelumnya hitam */
      }

      /* Opsional: jika ingin ikon Font Awesome berubah warna juga */
      .nav-link.active .icon-shape i {
          color: white !important;
      }
  </style>
