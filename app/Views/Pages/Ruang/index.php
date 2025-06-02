<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white py-4 mb-5 px-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>

            <?php if (!empty($errorMessage)) : ?>
              <div class="alert alert-danger">
                <?php echo htmlspecialchars($errorMessage); ?>
              </div>
            <?php endif; ?>

            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Aset Ruang</h3>
                <a href="/admin/prasarana/ruang/tambah" class="btn btn-warning btn-sm ml-auto">
                  <div class="text-dark">
                    <i class="fas fa-plus mr-1"></i> Tambah Data
                  </div>
                </a>
              </div>

              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="ruangTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">Kode Ruang</th>
                        <th width="60%">Nama Ruang</th>
                        <th width="20%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($ruangData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($ruangData as $ruang) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($ruang['kode_ruang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($ruang['nama_ruang'] ?? '-'); ?></td>
                            <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/prasarana/ruang?detail=<?= $ruang['id']; ?>" class="btn btn-info btn-sm">
                                  <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include './app/Views/Components/footer.php'; ?>
  </div>

  <?php include './app/Views/Components/script.php'; ?>

  <script>
    $(function() {
      $("#ruangTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "columnDefs": [{
          "targets": [3], // Target kolom Aksi (3)
          "searchable": false, // Nonaktifkan pencarian
          "orderable": false // Nonaktifkan pengurutan
        }],
        language: {
          "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
          "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
          "lengthMenu": "Tampilkan _MENU_ entri",
          "loadingRecords": "Sedang memuat...",
          "processing": "Sedang memproses...",
          "search": "Cari:",
          "zeroRecords": "Tidak ditemukan data yang sesuai",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Selanjutnya",
            "previous": "Sebelumnya"
          },
          "aria": {
            "sortAscending": ": aktifkan untuk mengurutkan kolom ke atas",
            "sortDescending": ": aktifkan untuk mengurutkan kolom menurun"
          },
          "searchPlaceholder": "kata kunci pencarian",
          "thousands": "."
        },
        "buttons": [{
            extend: 'copy',
            title: 'Data Aset Ruang',
            exportOptions: {
              columns: [0, 1, 2] // Hanya ekspor kolom 0-2 (termasuk No)
            }
          },
          {
            extend: 'csv',
            title: 'Data Aset Ruang',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          {
            extend: 'excel',
            title: 'Data Aset Ruang',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          {
            extend: 'pdf',
            title: 'Data Aset Ruang',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          {
            extend: 'print',
            title: 'Data Aset Ruang',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          'colvis'
        ]
      }).buttons().container().appendTo('#ruangTable_wrapper .col-md-6:eq(0)');
    });
  </script>

</body>

</html>