<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">

    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>
    <div class="content-wrapper bg-white py-4 !mb-[10rem]">
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
                  <label for="jenisAsetFilter" class="col-md-2 col-form-label">Jenis Aset:</label>
                  <div class="col-md-10">
                    <select id="jenisAsetFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Jenis Aset</option>
                      <?php if (!empty($jenisAsetList)) : ?>
                        <?php foreach ($jenisAsetList as $jenis) : ?>
                          <option value="<?= htmlspecialchars($jenis['jenis_aset']); ?>"><?= htmlspecialchars($jenis['jenis_aset']); ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
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
                <h3 class="h4 mb-0">Data Aset Tanah</h3>
                <div class="ml-auto d-flex flex-column flex-sm-row align-items-sm-center">
                  <a href="/admin/prasarana/tanah/tambah" class="btn btn-warning btn-sm mb-2 mb-sm-0">
                    <i class="fas fa-plus mr-1"></i> Tambah Data
                  </a>
                </div>
              </div>

              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="tanahTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="20%">Kode Aset</th>
                        <th width="25%">Nama Aset</th>
                        <th width="15%">Jenis Aset</th>
                        <th width="25%">Nomor Sertifikat</th>
                        <th width="15%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($tanahData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($tanahData as $td) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td><?= htmlspecialchars($td['kode_aset'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($td['nama_aset'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($td['jenis_aset'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($td['nomor_sertifikat'] ?? '-'); ?></td>
                            <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/prasarana/tanah?detail=<?= $td['id']; ?>" class="btn btn-info btn-sm">
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
      var table = $("#tanahTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "ordering": false,
        "columnDefs": [{
            "targets": 0,
            "orderable": false,
            "searchable": false
          },
          {
            "targets": [5], // Kolom "Aksi"
            "searchable": false,
            "orderable": false
          }
        ],
        "language": {
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
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      });

      $('#jenisAsetFilter').on('change', function() {
        var val = $(this).val();
        var escapedVal = val ? $.fn.dataTable.util.escapeRegex(val.trim()) : '';
        table.column(3) // Index kolom 'Jenis Aset'
          .search(escapedVal ? '^\\s*' + escapedVal + '\\s*$' : '', true, false)
          .draw();
      });

      table.on('draw.dt', function() {
        var PageInfo = table.page.info();
        table.column(0, {
          page: 'current'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });

      $('#jenisAsetFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Jenis Aset",
        allowClear: true,
        minimumResultsForSearch: 1,
        width: '100%'
      }).val(null).trigger('change');;

      $('#resetFilter').on('click', function() {
        $('#jenisAsetFilter').val('').trigger('change');
        table.search('').columns().search('').draw();
      });
    });
  </script>


</body>

</html>