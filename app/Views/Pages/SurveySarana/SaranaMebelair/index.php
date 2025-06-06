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
                <h3 class="h4 mb-0">Data Survey Sarana Mebelair</h3>
                <a href="/admin/survey/sarana/sarana-mebelair/tambah" class="btn btn-warning btn-sm ml-auto">
                  <div class="text-dark">
                    <i class="fas fa-plus mr-1"></i> Tambah Data
                  </div>
                </a>
              </div>

              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="surveySaranaTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="20%">Penanggung Jawab</th>
                        <th width="15%">Semester</th>
                        <th width="15%">Tahun Akademik</th>
                        <th width="15%">Tanggal Pengecekan</th>
                        <th width="20%">Lokasi Survey</th>
                        <th width="10%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($surveyData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($surveyData as $data) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td><?= htmlspecialchars($data['penanggung_jawab'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($data['semester'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($data['tahun_akademik'] ?? '-'); ?></td>
                            <td class="text-center"><?= isset($data['tanggal_pengecekan']) ? date('d M Y', strtotime($data['tanggal_pengecekan'])) : '-'; ?></td>
                            <td><?= htmlspecialchars($data['lokasi_survey'] ?? '-'); ?></td>
                            <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/survey/sarana/sarana-mebelair?detail=<?= $data['id']; ?>" class="btn btn-info btn-sm">
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
      $("#surveySaranaTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "columnDefs": [{
          "targets": [6], // Target kolom Aksi
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
            title: 'Data Survey Sarana Mebelair',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5] // Kolom yang akan diekspor
            }
          },
          {
            extend: 'csv',
            title: 'Data Survey Sarana Mebelair',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5]
            }
          },
          {
            extend: 'excel',
            title: 'Data Survey Sarana Mebelair',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5]
            }
          },
          {
            extend: 'pdf',
            title: 'Data Survey Sarana Mebelair',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5]
            }
          },
          {
            extend: 'print',
            title: 'Data Survey Sarana Mebelair',
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5]
            }
          },
          'colvis'
        ]
      }).buttons().container().appendTo('#surveySaranaTable_wrapper .col-md-6:eq(0)');
    });
  </script>

</body>

</html>