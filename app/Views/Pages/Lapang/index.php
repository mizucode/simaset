<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">

    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>
    <div class="content-wrapper bg-white py-4 mb-5">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>

            <?php if (!empty($errorMessage)) : ?>
              <div class="alert alert-danger">
                <?php echo htmlspecialchars($errorMessage); ?>
              </div>
            <?php endif; ?>

            <div class="card shadow-md mb-3" style="border-top: 3px solid #001f3f;">
              <div class="card-header bg-light py-2">
                <h3 class="card-title mb-0" style="font-size: 1.1rem;">Filter Data</h3>
              </div>
              <div class="card-body pt-3 pb-3">
                <div class="form-group row mb-3 align-items-center">
                  <label for="kategoriFilter" class="col-md-2 col-form-label">Kategori:</label>
                  <div class="col-md-10">
                    <select id="kategoriFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Kategori</option>
                      <?php if (!empty($kategoriListForFilter)) : ?>
                        <?php foreach ($kategoriListForFilter as $kategori) : ?>
                          <option value="<?= htmlspecialchars($kategori); ?>"><?= htmlspecialchars($kategori); ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3 align-items-center">
                  <label for="statusFilter" class="col-md-2 col-form-label">Status:</label>
                  <div class="col-md-10">
                    <select id="statusFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Status</option>
                      <option value="Terpakai">Terpakai</option>
                      <option value="Kosong">Kosong</option>
                      <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                      <!-- Tambahkan status lain jika ada -->
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-0">
                  <div class="col-12 d-flex justify-content-start">
                    <button id="resetFilter" class="btn btn-secondary btn-sm px-4">Reset</button>
                  </div>
                </div>
              </div>
            </div>




            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Aset Lapang</h3>
                <a href="/admin/prasarana/lapang/tambah" class="btn btn-warning btn-sm ml-auto">
                  <div class="text-dark">
                    <i class="fas fa-plus mr-1"></i> Tambah Data
                  </div>
                </a>
              </div>

              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="lapangTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">Kode Lapang</th>
                        <th width="30%">Nama Lapang</th>
                        <th width="20%">Kategori</th>
                        <th width="15%">Status</th>
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
                            <td><?= htmlspecialchars($lapang['kategori'] ?? '-'); ?></td>
                            <td class="text-center">
                              <?php
                              $status = htmlspecialchars($lapang['status'] ?? 'Tidak Diketahui');
                              $badgeClassStatus = ($status === 'Terpakai') ? 'badge-success' : (($status === 'Kosong') ? 'badge-warning' : (($status === 'Dalam Perbaikan') ? 'badge-danger' : 'badge-secondary'));
                              ?>
                              <span class="badge <?= $badgeClassStatus; ?>"><?= $status; ?></span>
                            </td>
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

    <?php include './app/Views/Components/footer.php'; ?>
  </div>

  <?php include './app/Views/Components/script.php'; ?>

  <script>
    $(function() {
      var table = $("#lapangTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "ordering": false,
        "columnDefs": [{
            "targets": 0, // No
            "orderable": false,
            "searchable": false
          },
          {
            "targets": [5], // Aksi
            "searchable": false,
            "orderable": false
          }
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
              columns: [0, 1, 2, 3, 4] // No, Kode, Nama, Kategori, Status
            }
          },
          {
            extend: 'csv',
            title: 'Data Aset Lapang',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'excel',
            title: 'Data Aset Lapang',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'pdf',
            title: 'Data Aset Lapang',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'print',
            title: 'Data Aset Lapang',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          'colvis'
        ]
      });

      // Auto-increment 'No' column
      table.on('draw.dt', function() {
        var PageInfo = table.page.info();
        table.column(0, {
          page: 'current'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });

      // Initialize Select2 for filters
      $('#kategoriFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Kategori",
        allowClear: true,
        minimumResultsForSearch: 1, // Show search box if there's at least 1 item
        width: '100%'
      }).val(null).trigger('change');

      $('#statusFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Status",
        allowClear: true,
        minimumResultsForSearch: Infinity, // No search box for few options
        width: '100%'
      }).val(null).trigger('change');

      // Filter logic
      $('#kategoriFilter').on('change', function() {
        var val = $(this).val();
        var escapedVal = val ? $.fn.dataTable.util.escapeRegex(val.trim()) : '';
        table.column(3) // Index kolom 'Kategori'
          .search(escapedVal ? '^\\s*' + escapedVal + '\\s*$' : '', true, false)
          .draw();
      });

      $('#statusFilter').on('change', function() {
        var val = $(this).val();
        table.column(4) // Index kolom 'Status'
          .search(val ? '^' + $.fn.dataTable.util.escapeRegex(val) + '$' : '', true, false)
          .draw();
      });

      // Reset filter button
      $('#resetFilter').on('click', function() {
        $('#kategoriFilter').val('').trigger('change');
        $('#statusFilter').val('').trigger('change');
        table.search('').columns().search('').draw(); // Clear all table filters
      });
    });
  </script>

</body>

</html>