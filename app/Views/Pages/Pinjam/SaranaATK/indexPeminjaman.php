<!DOCTYPE html>
<html lang="en">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php require_once './app/Views/Components/navbar.php'; ?>
    <?php require_once './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white mb-5 pt-3 px-4">
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
                <h3 class="h4 mb-0">Daftar Sarana ATK Tersedia untuk Dipinjam</h3>
              </div>

              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="saranaTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center">
                        <th width="5%">No</th>
                        <th width="15%">No Registrasi</th>
                        <th width="15%">Nama Barang</th>
                        <th width="15%">Jenis</th>
                        <th width="15%">Lokasi Saat Ini</th>
                        <th width="10%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($saranaData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($saranaData as $sarana) : ?>
                          <tr>
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($sarana['no_registrasi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['nama_detail_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['barang'] ?? '-'); ?></td>
                            <td class=""><?= htmlspecialchars($sarana['lokasi'] ?? '-'); ?></td>
                            <td class="text-center">
                              <?php $idSarana = $sarana['id_sarana_atk'] ?? $sarana['id'] ?? null; ?>
                              <?php if ($idSarana) : ?>
                                <a href="/admin/sarana/atk/pinjam?edit=<?= htmlspecialchars($idSarana); ?>" class="btn btn-sm btn-success"><i class="fas fa-handshake mr-1"></i>Pinjam</a>
                              <?php else : ?>
                                -
                              <?php endif; ?>
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

    <?php require_once './app/Views/Components/footer.php'; ?>
  </div>



  <?php require_once './app/Views/Components/script.php'; ?>
  <script>
    $(function() {
      $("#saranaTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "columnDefs": [{
          "targets": [0, 5], // Target kolom No (0) dan Aksi (5)
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
            title: 'Daftar Sarana ATK Tersedia untuk Dipinjam',
            exportOptions: {
              columns: [0, 1, 2, 3, 4] // No, No Registrasi, Nama Barang, Jenis, Lokasi
            }
          },
          {
            extend: 'csv',
            title: 'Daftar Sarana ATK Tersedia untuk Dipinjam',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'excel',
            title: 'Daftar Sarana ATK Tersedia untuk Dipinjam',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'pdf',
            title: 'Daftar Sarana ATK Tersedia untuk Dipinjam',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          'colvis'
        ]
      }).buttons().container().appendTo('#saranaTable_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>