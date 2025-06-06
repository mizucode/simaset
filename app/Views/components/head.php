<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Simaset | Umkuningan</title>
  <link rel="icon" href="/img/favicon.png" type="image/png" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css" />

  <!-- Tailwind CSS (hanya sekali) -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="/../../AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <link rel="stylesheet" href="/../../AdminLTE-3.2.0/dist/css/adminlte.min.css" />

  <!-- Select2 CSS -->
  <link rel="stylesheet" href="/../../AdminLTE-3.2.0/plugins/select2/css/select2.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

  <link rel="stylesheet" href="/../../AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="/../../AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/../../AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/../../AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="/../../AdminLTE-3.2.0/plugins/datatables-fixheader/css/fixedHeader.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">

  <!-- jsGrid CSS -->
  <link rel="stylesheet" href="/../../AdminLTE-3.2.0/plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="/../../AdminLTE-3.2.0/plugins/jsgrid/jsgrid-theme.min.css">

  <!-- jQuery (harus di load sebelum JS lainnya) -->
  <script src="/../../AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>

  <!-- FullCalendar CSS -->
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />



  <!-- Style Tambahan -->
  <style>
    /* Set default font family */
    body {
      font-family: 'Source Sans Pro', sans-serif;
    }

    .jsgrid-wrapper {
      overflow-x: auto;
      overflow-y: hidden;
      width: 100%;
      padding-bottom: 10px;
    }

    .jsgrid-table {
      border-collapse: collapse;
      width: max-content;
      min-width: 100%;
      margin-bottom: 10px;
    }

    .jsgrid-header-row th,
    .jsgrid-table td {
      padding: 8px 12px;
      border: 1px solid #ccc;
      text-align: center;
      white-space: nowrap;
    }

    .jsgrid-header-row {
      background-color: #f8f9fa;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .jsgrid-row:nth-child(even) {
      background-color: #f2f2f2;
    }

    .jsgrid-row:hover {
      background-color: #e9ecef;
    }

    .btn-edit {
      background-color: #ffc107;
      color: #000;
      border: none;
      padding: 4px 8px;
      border-radius: 4px;
    }

    .btn-delete {
      background-color: #dc3545;
      color: #fff;
      border: none;
      padding: 4px 8px;
      border-radius: 4px;
      margin-left: 4px;
    }
  </style>
  <style>
    /* Style dasar wrapper DataTables */
    .dataTables_wrapper {
      position: relative;
    }

    /* Membuat baris yang berisi kontrol length dan filter sejajar secara vertikal di tengah */
    .dataTables_wrapper>.row:first-child {
      align-items: center;
    }

    /* Style untuk bagian filter dan length */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
      display: inline-block;
      margin-bottom: 15px;
    }

    /* Style khusus untuk search filter */
    .dataTables_wrapper .dataTables_filter {
      float: right !important;
      text-align: right !important;
    }

    .dataTables_filter input {
      border: 1px solid #ced4da !important;
      border-radius: 4px !important;
      padding: 6px 12px !important;
      /* margin-left: 5px !important; /* Sudah diatur oleh gap pada label */
      /* margin-top: 5px; /* Penjajaran vertikal diatur oleh align-items pada .row dan label */
      width: 250px !important;
      height: 34px !important;
    }

    .dataTables_filter label {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 5px;
      /* Jarak konsisten antara label "Cari:" dan input */
    }

    /* Style untuk length menu */
    .dataTables_length {
      float: left !important;
      /* padding-top: 0; /* Pastikan tidak ada padding atas tambahan */
    }

    .dataTables_length label {
      display: flex;
      align-items: center;
      margin-bottom: 0;
      /* Pastikan label dan select sejajar dan rapi */
      gap: 5px;
      /* Jarak antara label "Tampilkan", select, dan label "entri" */
    }

    .dataTables_length select {
      border: 1px solid #ced4da !important;
      border-radius: 4px !important;
      height: 34px !important;
      width: auto !important;
    }

    /* Style untuk wrapper info dan pagination */
    .dataTables_wrapper .bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      border-top: 1px solid #eee !important;
      padding-top: 12px !important;
      margin-top: 12px !important;
      width: 100%;
    }

    .dataTables_wrapper .dataTables_info {
      color: #6c757d !important;
      font-size: 14px !important;
      padding: 8px 0 !important;
      float: left !important;
    }

    .dataTables_wrapper .dataTables_paginate {
      float: right !important;
      margin-top: 5px !important;
      padding-top: 0 !important;
      border-top: none !important;
    }

    /* Style untuk paging */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 5px 10px !important;
      margin: 0 2px !important;
      border: 1px solid #dee2e6 !important;
      border-radius: 3px !important;
      color: #495057 !important;
      background-color: white !important;
      transition: all 0.2s ease;
      font-size: 14px !important;
      line-height: 1.5 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background-color: #f8f9fa !important;
      color: #495057 !important;
      border-color: #dee2e6 !important;
      text-decoration: none !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
      background-color: #3c8dbc !important;
      color: white !important;
      border-color: #367fa9 !important;
      font-weight: normal !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
      color: #adb5bd !important;
      background-color: white !important;
      cursor: not-allowed !important;
      opacity: 0.7 !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {

      .dataTables_wrapper .dataTables_length,
      .dataTables_wrapper .dataTables_filter {
        float: none !important;
        width: 100% !important;
      }

      .dataTables_wrapper .dataTables_length {
        margin-bottom: 10px;
      }

      .dataTables_wrapper .dataTables_filter {
        margin-top: 10px !important;
        text-align: left !important;
      }

      .dataTables_wrapper .dataTables_filter input {
        width: 100% !important;
        margin-left: 0 !important;
      }

      .dataTables_wrapper .bottom {
        flex-direction: column;
        align-items: flex-start;
      }

      .dataTables_wrapper .dataTables_info,
      .dataTables_wrapper .dataTables_paginate {
        float: none !important;
        width: 100% !important;
        text-align: center !important;
        margin-top: 10px !important;
      }
    }
  </style>
</head>