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
            <div class="card card-navy">
              <div class="card-header text-white">
                <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title text-lg">
                    Data Barang ATK Siap Pindah
                  </h3>

                </div>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table id="atkTable" class="table table-bordered table-hover">
                    <thead class="bg-light">
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
                        <?php foreach ($saranaData as $barang) : ?>
                          <tr>
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($barang['no_registrasi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['nama_detail_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['lokasi'] ?? '-'); ?></td>
                            <td class="text-center">
                              <a href="/admin/sarana/atk/pindah?edit=<?= $barang['id']; ?>" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i> Edit
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="8" class="text-center">Data tidak ditemukan</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>

                <div class="row mt-3">
                  <div class="col-md-6">
                    <div class="dataTables_info">
                      Menampilkan <?= count($saranaData) ?> data
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="float-right">
                      <!-- Pagination can be added here if needed -->
                    </div>
                  </div>
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
      $("#atkTable").DataTable({
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
            title: 'Data Barang ATK',
            exportOptions: {
              columns: [0, 1, 2, 3, 4] // Kolom yang akan diekspor: No, No Registrasi, Nama Barang, Jenis, Lokasi
            }
          },
          {
            extend: 'csv',
            title: 'Data Barang ATK',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'excel',
            title: 'Data Barang ATK',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'pdf',
            title: 'Data Barang ATK',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'print',
            title: 'Data Barang ATK',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          'colvis'
        ]
      }).buttons().container().appendTo('#atkTable_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>