<!DOCTYPE html>
<html lang="en">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php require_once './app/Views/Components/navbar.php'; ?>
    <?php require_once './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white py-4 mb-5 px-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>
            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">
                  Data Aset Lapang
                </h3>
                <a href="/admin/prasarana/lapang/tambah" class="btn btn-warning btn-sm ml-auto">
                  <div class="text-dark">
                    <i class="fas fa-plus mr-1"></i> Tambah Data
                  </div>
                </a>
              </div>
            </div>

            <div class="card-body p-3">
              <div class="table-responsive">
                <table id="lapangTable" class="table table-bordered w-100">
                  <thead class="bg-gray-100">
                    <tr class="text-center align-middle">
                      <th width="5%">No</th>
                      <th width="15%">Kode Lapang</th>
                      <th width="60%">Nama Lapang</th>
                      <th width="15%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($lapangData)) : ?>
                      <?php $counter = 1; ?>
                      <?php foreach ($lapangData as $lapang) : ?>
                        <tr class="align-middle">
                          <td class="text-center"><?= $counter++; ?></td>
                          <td class="text-center"><?= htmlspecialchars($lapang['kode_lapang'] ?? '-'); ?></td>
                          <td><?= htmlspecialchars($lapang['nama_lapang'] ?? '-'); ?></td>
                          <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                              <a href="/admin/prasarana/lapang?detail=<?= $lapang['id']; ?>" class="btn btn-info btn-sm">
                                <i class="fas fa-eye mr-1"></i> Detail
                              </a>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td colspan="4" class="text-center">Data tidak ditemukan</td>
                      </tr>
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

  <?php require_once './app/Views/Components/footer.php'; ?>
  </div>
  <?php require_once './app/Views/Components/script.php'; ?>

  <script>
    $(function() {
      $("#lapangTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "columnDefs": [{
          "targets": [3], // Target kolom Aksi (indeks 3)
          "searchable": false, // Nonaktifkan pencarian pada kolom Aksi
          "orderable": false // Nonaktifkan pengurutan pada kolom Aksi
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
            title: 'Data Aset Lapang',
            exportOptions: {
              columns: [0, 1, 2] // Hanya ekspor kolom No, Kode Lapang, Nama Lapang
            }
          },
          {
            extend: 'csv',
            title: 'Data Aset Lapang',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          {
            extend: 'excel',
            title: 'Data Aset Lapang',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          {
            extend: 'pdf',
            title: 'Data Aset Lapang',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          {
            extend: 'print',
            title: 'Data Aset Lapang',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          'colvis'
        ]
      }).buttons().container().appendTo('#lapangTable_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>