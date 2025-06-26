<!DOCTYPE html>
<html lang="en">
<?php require_once './app/Views/Components/head.php'; ?>
<style>
  /* Navy Color Scheme */
  .bg-navy {
    background-color: #001f3f !important;
  }

  .bg-light-navy {
    background-color: #f0f4f8 !important;
  }

  .border-navy {
    border-color: #001f3f !important;
  }

  .btn-navy {
    background-color: #001f3f;
    color: white;
    border-color: #001f3f;
  }

  .btn-navy:hover {
    background-color: #003366;
    border-color: #003366;
    color: white;
  }
</style>

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
                <h3 class="h4 mb-0">Riwayat Peminjaman Sarana</h3>
                <div class="ml-auto">
                  <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter mr-1"></i> Filter Data
                  </button>
                </div>
              </div>

              <div class="card-body p-3">
                <?php
                $lokasiOptions = [];
                if (!empty($saranaData)) {
                  // Extract unique locations and remove empty values
                  $lokasiOptions = array_filter(array_unique(array_column($saranaData, 'lokasi_penempatan_barang')));
                  sort($lokasiOptions);
                }
                ?>
                <div class="table-responsive">
                  <table id="saranaTable" class="table table-bordered table-hover" style="width: 100%;">
                    <thead class="bg-light">
                      <tr class="text-center text-nowrap align-middle">
                        <th width="5%">No</th>
                        <th width="15%">No Registrasi</th>
                        <th width="15%">Nama Barang</th>
                        <th width="15%">Nama Peminjam</th>
                        <th width="15%">Nik/Nidn</th>
                        <th width="15%">No Hp</th>
                        <th width="10%">Tanggal Pengembalian</th>
                        <th width="10%">Tgl Kembali (Rencana)</th>
                        <th width="15%">Lokasi Pengembalian</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($saranaData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($saranaData as $sarana) : ?>
                          <tr class="text-nowrap">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($sarana['nomor_registrasi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['nama_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['nama_peminjam'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($sarana['nomor_identitas'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($sarana['nomor_hp_peminjam'] ?? '-'); ?></td>
                            <td class="text-center">
                              <span class="tgl-pinjam" data-tgl="<?= isset($sarana['tanggal_peminjaman']) ? htmlspecialchars($sarana['tanggal_peminjaman']) : ''; ?>">
                                <?= isset($sarana['tanggal_peminjaman']) && $sarana['tanggal_peminjaman'] !== '' && $sarana['tanggal_peminjaman'] !== '-' ? htmlspecialchars(date('d-m-Y', strtotime($sarana['tanggal_peminjaman']))) : '-'; ?>
                              </span>
                            </td>
                            <td class="text-center">
                              <span class="tgl-kembali" data-tgl="<?= isset($sarana['tanggal_rencana_pengembalian']) ? htmlspecialchars($sarana['tanggal_rencana_pengembalian']) : ''; ?>">
                                <?= isset($sarana['tanggal_rencana_pengembalian']) && $sarana['tanggal_rencana_pengembalian'] !== '' && $sarana['tanggal_rencana_pengembalian'] !== '-' ? htmlspecialchars(date('d-m-Y', strtotime($sarana['tanggal_rencana_pengembalian']))) : '-'; ?>
                              </span>
                            </td>
                            <td><?= htmlspecialchars($sarana['lokasi_penempatan_barang'] ?? '-'); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="10" class="text-center">Tidak ada data peminjaman yang tersedia.</td>
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

  <!-- Modal Filter -->
  <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-navy text-white">
          <h5 class="modal-title font-weight-bold" id="filterModalLabel">
            <i class="fas fa-filter mr-2"></i>Filter Riwayat Peminjaman
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <!-- Filter Nama Barang & Peminjam -->
            <div class="card mb-4 border-navy">
              <div class="card-header bg-light-navy">
                <h6 class="mb-0 font-weight-bold text-navy"><i class="fas fa-tags mr-2"></i>Detail Barang & Peminjam</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="filterNamaBarang" class="form-label">Nama Barang</label>
                    <input type="text" id="filterNamaBarang" class="form-control form-control-sm border-navy" placeholder="Cari Nama Barang...">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="filterNamaPeminjam" class="form-label">Nama Peminjam</label>
                    <input type="text" id="filterNamaPeminjam" class="form-control form-control-sm border-navy" placeholder="Cari Nama Peminjam...">
                  </div>
                </div>
              </div>
            </div>

            <!-- Filter Lokasi -->
            <div class="card mb-4 border-navy">
              <div class="card-header bg-light-navy">
                <h6 class="mb-0 font-weight-bold text-navy">
                  <i class="fas fa-map-marker-alt mr-2"></i>Lokasi Peminjaman
                </h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <select id="filterLokasi" class="form-control form-control-sm border-navy">
                      <option value="">Semua Lokasi</option>
                      <?php foreach ($lokasiOptions as $lokasi) : ?>
                        <option value="<?= htmlspecialchars($lokasi) ?>"><?= htmlspecialchars($lokasi) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <!-- Filter Tanggal Peminjaman -->
            <div class="card mb-4 border-navy">
              <div class="card-header bg-light-navy">
                <h6 class="mb-0 font-weight-bold text-navy">
                  <i class="far fa-calendar-alt mr-2"></i>Tanggal Peminjaman
                </h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="filterTanggalMin" class="form-label">Dari Tanggal</label>
                    <input type="date" id="filterTanggalMin" class="form-control form-control-sm border-navy">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="filterTanggalMax" class="form-label">Sampai Tanggal</label>
                    <input type="date" id="filterTanggalMax" class="form-control form-control-sm border-navy">
                  </div>
                </div>
              </div>
            </div>

            <!-- Filter Tanggal Rencana Pengembalian -->
            <div class="card border-navy">
              <div class="card-header bg-light-navy">
                <h6 class="mb-0 font-weight-bold text-navy">
                  <i class="far fa-calendar-check mr-2"></i>Tanggal Rencana Pengembalian
                </h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="filterTanggalKembaliMin" class="form-label">Dari Tanggal</label>
                    <input type="date" id="filterTanggalKembaliMin" class="form-control form-control-sm border-navy">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="filterTanggalKembaliMax" class="form-label">Sampai Tanggal</label>
                    <input type="date" id="filterTanggalKembaliMax" class="form-control form-control-sm border-navy">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>Tutup
          </button>
          <button type="button" class="btn btn-outline-danger btn-sm" id="resetFiltersBtn">
            <i class="fas fa-undo mr-1"></i>Reset
          </button>
          <button type="button" class="btn btn-navy btn-sm" id="applyFiltersBtn">
            <i class="fas fa-check mr-1"></i>Terapkan
          </button>
        </div>
      </div>
    </div>
  </div>

  <?php require_once './app/Views/Components/script.php'; ?>

  <script>
    // Improved date parsing function: only accept yyyy-mm-dd
    function parseDate(dateStr) {
      if (!dateStr || dateStr === '-') return null;

      // Only accept yyyy-mm-dd
      if (/^\d{4}-\d{2}-\d{2}$/.test(dateStr)) {
        return new Date(dateStr);
      }

      return null;
    }

    $(function() {
      const buttonExportTitle = 'Riwayat Peminjaman Sarana';
      const saranaTableOptions = {
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        paging: false,
        info: true,
        searching: true,
        ordering: false,
        scrollX: true, // Aktifkan horizontal scroll
        language: {
          emptyTable: "Tidak ada data yang tersedia pada tabel ini",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
          infoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
          lengthMenu: "Tampilkan _MENU_ entri",
          loadingRecords: "Sedang memuat...",
          processing: "Sedang memproses...",
          search: "Cari:",
          zeroRecords: "Tidak ditemukan data yang sesuai",
          paginate: {
            first: "Pertama",
            last: "Terakhir",
            next: "Selanjutnya",
            previous: "Sebelumnya"
          },
          aria: {
            sortAscending: ": aktifkan untuk mengurutkan kolom ke atas",
            sortDescending: ": aktifkan untuk mengurutkan kolom menurun"
          },
          decimal: ",",
          thousands: ".",
          searchPlaceholder: "kata kunci pencarian"
        },
        buttons: [{
            extend: 'copy',
            title: buttonExportTitle,
            exportOptions: {
              orthogonal: 'export'
            }
          },
          {
            extend: 'csv',
            title: buttonExportTitle,
            exportOptions: {
              orthogonal: 'export'
            }
          },
          {
            extend: 'excel',
            title: buttonExportTitle,
            exportOptions: {
              orthogonal: 'export'
            }
          },
          {
            extend: 'pdf',
            title: buttonExportTitle,
            exportOptions: {
              orthogonal: 'export'
            }
          },
          {
            extend: 'print',
            title: buttonExportTitle,
            exportOptions: {
              orthogonal: 'export'
            }
          },
          'colvis'
        ],
        dom: "<'row'<'col-sm-12 col-md-6'lB><'col-sm-12 col-md-6'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12'i>>",
        columnDefs: [{
          "targets": [0, 8],
          "searchable": false,
          "orderable": false
        }],
      };

      var table = $("#saranaTable").DataTable(saranaTableOptions);

      // Initialize Select2 for location filter
      $('#filterLokasi').select2({
        placeholder: "Pilih Lokasi",
        allowClear: true,
        width: '100%',
        dropdownParent: $('#filterModal')
      });

      // Custom filtering function
      $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
          var namaBarangFilter = $('#filterNamaBarang').val().toLowerCase();
          var namaPeminjamFilter = $('#filterNamaPeminjam').val().toLowerCase();
          var lokasiFilter = $('#filterLokasi').val();

          // Ambil data dari DOM, bukan dari array data[] (karena bisa hidden)
          var rowNode = $(table.row(dataIndex).node());
          var namaBarangData = rowNode.find('td:eq(2)').text().toLowerCase().trim();
          var namaPeminjamData = rowNode.find('td:eq(3)').text().toLowerCase().trim();
          var lokasiData = rowNode.find('td:eq(8)').text().toLowerCase().trim();
          var lokasiFilterVal = lokasiFilter ? lokasiFilter.trim().toLowerCase() : '';

          // Apply name filters
          if (namaBarangFilter && !namaBarangData.includes(namaBarangFilter)) {
            return false;
          }
          if (namaPeminjamFilter && !namaPeminjamData.includes(namaPeminjamFilter)) {
            return false;
          }

          // Apply location filter (allow partial match, ignore case and whitespace)
          if (lokasiFilterVal && lokasiData.indexOf(lokasiFilterVal) === -1) {
            return false;
          }

          // Date filters
          var minPinjam = $('#filterTanggalMin').val();
          var maxPinjam = $('#filterTanggalMax').val();
          // Ambil data-tgl dari span
          var cellDatePinjam = rowNode.find('.tgl-pinjam').data('tgl') || '';
          var datePinjam = parseDate(cellDatePinjam);

          if (minPinjam) {
            var minDate = new Date(minPinjam);
            if (!datePinjam || datePinjam < minDate) return false;
          }
          if (maxPinjam) {
            var maxDate = new Date(maxPinjam);
            if (!datePinjam || datePinjam > maxDate) return false;
          }

          // Return date filters
          var minKembali = $('#filterTanggalKembaliMin').val();
          var maxKembali = $('#filterTanggalKembaliMax').val();
          var cellDateKembali = rowNode.find('.tgl-kembali').data('tgl') || '';
          var dateKembali = parseDate(cellDateKembali);

          if (minKembali) {
            var minKembaliDate = new Date(minKembali);
            if (!dateKembali || dateKembali < minKembaliDate) return false;
          }
          if (maxKembali) {
            var maxKembaliDate = new Date(maxKembali);
            if (!dateKembali || dateKembali > maxKembaliDate) return false;
          }

          return true;
        }
      );

      $('#applyFiltersBtn').on('click', function() {
        table.draw();
        $('#filterModal').modal('hide');
      });

      $('#resetFiltersBtn').on('click', function() {
        $('#filterNamaBarang, #filterNamaPeminjam').val('');
        $('#filterLokasi').val('').trigger('change');
        $('#filterTanggalMin, #filterTanggalMax, #filterTanggalKembaliMin, #filterTanggalKembaliMax').val('');
        table.draw();
      });

      // Close modal when clicking outside
      $('.modal').on('click', function(e) {
        if ($(e.target).is('.modal')) {
          $(this).modal('hide');
        }
      });
    });
  </script>
</body>

</html>