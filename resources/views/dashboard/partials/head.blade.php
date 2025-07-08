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

  {{-- kurni --}}
   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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

      /* Modif Pagination Table */
      /* Warna pagination aktif */
      /* Warna pagination aktif */
    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
        background-color: rgba(33, 76, 224, 0.1);  /* warna latar belakang aktif */
        color: black;   /* warna teks */
        font-weight: bold
        border-color: #0d6efd;     /* warna border */
    }

    /* Warna tombol pagination biasa */
    .dataTables_wrapper .dataTables_paginate .page-link {
        color: black;             /* warna teks normal */
        border: 1px solid #dee2e6;  /* border normal */
    }

    /* Hover */
    .dataTables_wrapper .dataTables_paginate .page-link:hover {
        background-color: #e9ecef;
        color: #0d6efd;
    }

    table thead th {
            background-color: #8A3DFF !important;
            color: #F4F3F9 !important;
            text-align: center !important;  /* pastikan teks header center */
            vertical-align: middle;
        }

        table th, table td {
            text-align: center !important;
            vertical-align: middle !important; /* untuk vertikal tengah juga */
        }


  </style>
