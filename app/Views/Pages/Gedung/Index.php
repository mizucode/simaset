<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>
<!-- Apply px-3 to body to match BarangATK/index.php -->

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
                <div class="form-group row mb-3 align-items-center">
                  <label for="jenisBangunanFilter" class="col-md-2 col-form-label">Jenis Bangunan:</label>
                  <div class="col-md-10">
                    <select id="jenisBangunanFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Jenis Bangunan</option>
                      <?php if (!empty($jenisBangunanList)) : ?>
                        <?php foreach ($jenisBangunanList as $jenis) : ?>
                          <option value="<?= htmlspecialchars($jenis); ?>"><?= htmlspecialchars($jenis); ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3 align-items-center">
                  <label for="kondisiFilter" class="col-md-2 col-form-label">Kondisi:</label>
                  <div class="col-md-10">
                    <select id="kondisiFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Kondisi</option>
                      <option value="Baik">Baik</option>
                      <option value="Rusak Ringan">Rusak Ringan</option>
                      <option value="Rusak Berat">Rusak Berat</option>
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
                <h3 class="h4 mb-0">Data Aset Bangunan</h3>
                <!-- Simplified button structure -->
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
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">Kode Aset</th>
                        <th width="15%">Nama Gedung</th>
                        <th width="15%">Jenis Aset</th>
                        <th width="15%">Jenis Bangunan</th>
                        <th width="15%">Kondisi</th>
                        <th width="10%">Aksi</th>
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
                            <td><?= htmlspecialchars($gd['jenis_aset'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($gd['jenis_bangunan'] ?? '-'); ?></td>
                            <td class="text-center">
                              <?php
                              $kondisi = htmlspecialchars($gd['kondisi'] ?? 'Baik');
                              $badgeClass = $kondisi === 'Baik' ? 'success' : ($kondisi === 'Rusak Ringan' ? 'warning' : 'danger');
                              ?>
                              <span class="badge badge-<?= $badgeClass; ?>"><?= $kondisi; ?></span>
                            </td>
                            <td class="text-center">
                              <!-- Wrap button in div for consistent centering and spacing -->
                              <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/prasarana/gedung?detail=<?= $gd['id']; ?>" class="btn btn-sm btn-info" title="Detail">
                                  <i class="fas fa-eye mr-1"></i> Detail
                                </a>
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
      var table = $("#gedungTable").DataTable({ // Assign to variable 'table'
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "ordering": false,
        "columnDefs": [{
            "targets": 0, // For 'No' column
            "orderable": false,
            "searchable": false
          },
          {
            "targets": [6], // Target kolom Aksi (indeks 6 setelah penambahan Jenis Bangunan)
            "searchable": false,
            "orderable": false
          }
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // Matched dom from BarangATK
        // Removed "buttons" array and .buttons().container().appendTo()
        // language settings remain the same
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
        }
      });

      // 'No' column auto-increment logic
      table.on('draw.dt', function() {
        var PageInfo = table.page.info();
        table.column(0, {
          page: 'current'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });

      // Inisialisasi Select2 untuk filter jenis aset
      $('#jenisAsetFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Jenis Aset",
        allowClear: true,
        minimumResultsForSearch: 1,
        width: '100%'
      }).val(null).trigger('change'); // Set nilai awal ke null dan trigger change

      // Inisialisasi Select2 untuk filter jenis bangunan
      $('#jenisBangunanFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Jenis Bangunan",
        allowClear: true,
        minimumResultsForSearch: 1, // Sesuaikan jika daftar sangat panjang
        width: '100%'
      }).val(null).trigger('change');
      // Inisialisasi Select2 untuk filter kondisi
      $('#kondisiFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Kondisi",
        allowClear: true,
        minimumResultsForSearch: Infinity, // Tidak perlu search box untuk sedikit opsi
        width: '100%'
      }).val(null).trigger('change');

      // Fungsi filter untuk DataTables berdasarkan pilihan select2
      $('#jenisAsetFilter').on('change', function() {
        var val = $(this).val();
        var escapedVal = val ? $.fn.dataTable.util.escapeRegex(val.trim()) : '';
        table.column(3) // Index kolom 'Jenis Aset' (dimulai dari 0)
          .search(escapedVal ? '^\\s*' + escapedVal + '\\s*$' : '', true, false) // Penyesuaian regex
          .draw();
      });

      // Fungsi filter untuk DataTables berdasarkan pilihan select2 jenis bangunan
      $('#jenisBangunanFilter').on('change', function() {
        var val = $(this).val();
        var escapedVal = val ? $.fn.dataTable.util.escapeRegex(val.trim()) : '';
        table.column(4) // Index kolom 'Jenis Bangunan'
          .search(escapedVal ? '^\\s*' + escapedVal + '\\s*$' : '', true, false)
          .draw();
      });
      // Fungsi filter untuk DataTables berdasarkan pilihan select2 kondisi
      $('#kondisiFilter').on('change', function() {
        var val = $(this).val();
        var escapedVal = val ? $.fn.dataTable.util.escapeRegex(val.trim()) : '';
        table.column(5) // Index kolom 'Kondisi' (setelah Jenis Bangunan)
          .search(escapedVal ? '^\\s*' + escapedVal + '\\s*$' : '', true, false) // Penyesuaian regex
          .draw();
      });

      // Fungsi reset filter
      $('#resetFilter').on('click', function() {
        $('#jenisAsetFilter').val('').trigger('change'); // Reset select2 dan trigger change
        $('#jenisBangunanFilter').val('').trigger('change'); // Reset filter jenis bangunan
        $('#kondisiFilter').val('').trigger('change'); // Reset filter kondisi
        table.search('').columns().search('').draw(); // Hapus semua filter dari tabel
      });
    });
  </script>
</body>

</html>