<!DOCTYPE html>
<html lang="en">
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
                <h3 class="h4 mb-0">Data Aset Bangunan</h3>
                <a href="/admin/prasarana/gedung/tambah" class="btn btn-warning btn-sm ml-auto">
                  <div class="text-dark">
                    <i class="fas fa-plus mr-1"></i> Tambah Data
                  </div>
                </a>
              </div>

              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="gedungTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center">
                        <th width="5%">No</th>
                        <th width="15%">Kode Bangunan</th>
                        <th width="60%">Nama Bangunan</th>
                        <th width="20%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($gedungData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($gedungData as $gd) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($gd['kode_gedung'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($gd['nama_gedung'] ?? '-'); ?></td>
                            <td class="text-center">
                              <a href="/admin/prasarana/gedung?detail=<?= $gd['id']; ?>" class="btn btn-sm btn-info" title="Detail">
                                <i class="fas fa-eye"></i> Detail
                              </a>
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

    <?php include './app/Views/Components/footer.php'; ?>
  </div>

  <?php include './app/Views/Components/script.php'; ?>

  <script>
    $(function() {
      $("#gedungTable").DataTable({
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
            title: 'Data Aset Bangunan',
            exportOptions: {
              columns: [0, 1, 2] // Hanya ekspor kolom No, Kode Bangunan, Nama Bangunan
            }
          },
          {
            extend: 'csv',
            title: 'Data Aset Bangunan',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          {
            extend: 'excel',
            title: 'Data Aset Bangunan',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          {
            extend: 'pdf',
            title: 'Data Aset Bangunan',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          {
            extend: 'print',
            title: 'Data Aset Bangunan',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          'colvis'
        ]
      }).buttons().container().appendTo('#gedungTable_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>