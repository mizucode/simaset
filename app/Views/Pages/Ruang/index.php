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
                  <label for="gedungFilter" class="col-md-2 col-form-label">Gedung:</label>
                  <div class="col-md-10">
                    <select id="gedungFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Gedung</option>
                      <?php if (!empty($gedungListForFilter)) : ?>
                        <?php foreach ($gedungListForFilter as $gedung) : ?>
                          <option value="<?= htmlspecialchars($gedung); ?>"><?= htmlspecialchars($gedung); ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3 align-items-center">
                  <label for="jenisRuanganFilter" class="col-md-2 col-form-label">Jenis Ruangan:</label>
                  <div class="col-md-10">
                    <select id="jenisRuanganFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Jenis Ruangan</option>
                      <?php if (!empty($jenisRuanganList)) : ?>
                        <?php foreach ($jenisRuanganList as $jenis) : ?>
                          <option value="<?= htmlspecialchars($jenis); ?>"><?= htmlspecialchars($jenis); ?></option>
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
                        <th width="12%">Kode Ruang</th>
                        <th width="20%">Nama Ruang</th>
                        <th width="15%">Gedung</th>
                        <th width="15%">Jenis Ruangan</th>
                        <th width="10%">Status</th>
                        <th width="10%">Kondisi</th>
                        <th width="10%">Aksi</th>
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
                            <td><?= htmlspecialchars($ruang['nama_gedung'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($ruang['jenis_ruangan'] ?? '-'); ?></td>
                            <td class="text-center">
                              <?php
                              $status = htmlspecialchars($ruang['status'] ?? 'Tidak Diketahui');
                              $badgeClassStatus = 'badge-secondary'; // Default badge
                              if ($status === 'Terpakai') $badgeClassStatus = 'badge-success';
                              elseif ($status === 'Kosong') $badgeClassStatus = 'badge-warning';
                              elseif ($status === 'Dalam Perbaikan') $badgeClassStatus = 'badge-danger';
                              ?>
                              <span class="badge <?= $badgeClassStatus; ?>"><?= $status; ?></span>
                            </td>
                            <td class="text-center">
                              <?php
                              $kondisi = htmlspecialchars($ruang['kondisi_ruang'] ?? 'Baik');
                              $badgeClassKondisi = $kondisi === 'Baik' ? 'badge-success' : ($kondisi === 'Rusak Ringan' ? 'badge-warning' : 'badge-danger');
                              ?>
                              <span class="badge <?= $badgeClassKondisi; ?>"><?= $kondisi; ?></span>
                            </td>
                            <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/prasarana/ruang?detail=<?= $ruang['id']; ?>" class="btn btn-info btn-sm">
                                  <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                              </div>
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
      var table = $("#ruangTable").DataTable({
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
            "targets": [7], // Aksi
            "searchable": false,
            "orderable": false
          }
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" + // Matched dom from BarangATK
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
      $('#gedungFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Gedung",
        allowClear: true,
        minimumResultsForSearch: 1,
        width: '100%'
      }).val(null).trigger('change'); // Set nilai awal ke null dan trigger change

      $('#jenisRuanganFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Jenis Ruangan",
        allowClear: true,
        minimumResultsForSearch: 1,
        width: '100%'
      }).val(null).trigger('change'); // Set nilai awal ke null dan trigger change

      $('#statusFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Status",
        allowClear: true,
        minimumResultsForSearch: Infinity, // No search box for few options
        width: '100%'
      }).val(null).trigger('change'); // Set nilai awal ke null dan trigger change

      // Filter logic
      $('#gedungFilter').on('change', function() {
        var val = $(this).val();
        var escapedVal = val ? $.fn.dataTable.util.escapeRegex(val.trim()) : '';
        table.column(3) // Index kolom 'Gedung'
          .search(escapedVal ? '^\\s*' + escapedVal + '\\s*$' : '', true, false)
          .draw();
      });

      $('#jenisRuanganFilter').on('change', function() {
        var val = $(this).val();
        var escapedVal = val ? $.fn.dataTable.util.escapeRegex(val.trim()) : '';
        table.column(4) // Index kolom 'Jenis Ruangan'
          .search(escapedVal ? '^\\s*' + escapedVal + '\\s*$' : '', true, false)
          .draw();
      });

      $('#statusFilter').on('change', function() {
        var val = $(this).val();
        table.column(5) // Index kolom 'Status'
          .search(val ? '^' + $.fn.dataTable.util.escapeRegex(val) + '$' : '', true, false)
          .draw();
      });

      // Reset filter button
      $('#resetFilter').on('click', function() {
        $('#gedungFilter').val('').trigger('change');
        $('#jenisRuanganFilter').val('').trigger('change');
        $('#statusFilter').val('').trigger('change');
        table.search('').columns().search('').draw(); // Clear all table filters
      });
    });
  </script>

</body>

</html>