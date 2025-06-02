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
                  Data Sarana Bergerak
                </h3>

                <a href="/admin/sarana/bergerak/download-qr" class="btn btn-success btn-sm ml-auto">
                  <div class="">
                    <i class="fas fa-save mr-1"></i> Download QR Code
                  </div>
                </a>
              </div> <!-- .card-header -->
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="saranaTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">No Registrasi</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>No Polisi</th>
                        <th width="15%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($saranaData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($saranaData as $sarana) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($sarana['no_registrasi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['nama_detail_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['barang'] ?? '-'); ?></td>

                            <td class="text-center"><?= htmlspecialchars($sarana['no_polisi'] ?? '-'); ?></td>


                            <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/sarana/bergerak?detail=<?= $sarana['id']; ?>" class="btn btn-info btn-sm">
                                  <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="6" class="text-center">Data tidak ditemukan</td>
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
      $("#saranaTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "columnDefs": [{
          "targets": [5], // Target kolom Aksi (indeks 5)
          "searchable": false,
          "orderable": false
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
            title: 'Data Sarana Bergerak',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            } // No, No Registrasi, Nama Barang, Jenis, No Polisi
          },
          {
            extend: 'csv',
            title: 'Data Sarana Bergerak',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'excel',
            title: 'Data Sarana Bergerak',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'pdf',
            title: 'Data Sarana Bergerak',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'print',
            title: 'Data Sarana Bergerak',
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