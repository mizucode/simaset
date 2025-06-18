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

  .input-group-text.bg-navy {
    background-color: #131313;
    color: white;
    border-color: #001f3f;
  }

  .form-control.border-navy:focus {
    border-color: #001f3f;
    box-shadow: 0 0 0 0.2rem rgba(0, 31, 63, 0.25);
  }
</style>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php require_once './app/Views/Components/navbar.php'; ?>
    <?php require_once './app/Views/Components/aside.php'; ?>

    <!-- Content wrapper without overflow -->
    <div class="content-wrapper bg-white py-4 mb-5">
      <div class="container-fluid px-3">
        <div class="row">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>
            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Peminjaman Sarana Bergerak</h3>
                <div class="ml-auto">
                  <button type="button" class="btn btn-light btn-sm mr-2" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter mr-1"></i> Filter Data
                  </button>
                  <a href="/admin/sarana/bergerak/pinjam/tambah" class="btn btn-warning btn-sm text-dark">
                    <i class="fas fa-plus mr-1"></i> Pinjam Barang
                  </a>
                </div>
              </div>

              <div class="card-body p-3">
                <?php
                $jenisOptions = [];
                if (!empty($saranaData)) {
                  $jenisOptions = array_unique(array_column($saranaData, 'barang'));
                  sort($jenisOptions);
                }

                $lokasiOptions = [];
                if (!empty($saranaData)) {
                  $lokasiOptions = array_unique(array_column($saranaData, 'lokasi'));
                  sort($lokasiOptions);
                }
                ?>

                <div class="table-responsive" style="overflow-x: auto;">
                  <table id="saranaTable" class="table table-bordered table-hover" style="width: 100%; min-width: 1200px;">
                    <thead class="bg-light">
                      <tr class="text-center text-nowrap">
                        <th>No</th>
                        <th>No Registrasi</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Nama Peminjam</th>
                        <th>No Identitas</th>
                        <th>No Hp Peminjam</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Lokasi Peminjaman</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($saranaData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($saranaData as $sarana) : ?>
                          <tr class="text-nowrap">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($sarana['no_registrasi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['nama_detail_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['nama_peminjam'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($sarana['identitas_peminjam'] ?? '-'); ?></td>
                            <td class="text-center">
                              <?php
                              $namaPeminjamUntukPesan = $sarana['nama_peminjam'] ?? 'Peminjam Yth';
                              $namaDetailBarangUntukPesan = $sarana['nama_detail_barang'] ?? 'Barang';
                              $noRegistrasiUntukPesan = $sarana['no_registrasi'] ?? 'N/A';
                              $pesanWA = BaseUrlQr::getWhatsappMessage($namaPeminjamUntukPesan, $namaDetailBarangUntukPesan, $noRegistrasiUntukPesan);
                              ?>
                              <a href="https://wa.me/<?= htmlspecialchars($sarana['no_hp_peminjam'] ?? '-'); ?>?text=<?= $pesanWA; ?>" target="_blank" class="btn btn-success btn-sm"><i class="fab fa-whatsapp mr-1"></i> Hubungi</a>
                            </td>
                            <td class="text-center">
                              <?php
                              $tanggal_peminjaman = $sarana['tanggal_peminjaman'] ?? null;
                              echo ($tanggal_peminjaman) ? htmlspecialchars(date('d-m-Y', strtotime($tanggal_peminjaman))) : '-';
                              ?>
                            </td>
                            <td class="text-center">
                              <?php
                              $tanggal_pengembalian = $sarana['tanggal_pengembalian'] ?? null;
                              echo ($tanggal_pengembalian !== '-' && !empty($tanggal_pengembalian) && $tanggal_pengembalian !== '0000-00-00') ? htmlspecialchars(date('d-m-Y', strtotime($tanggal_pengembalian))) : '-';
                              ?>
                            </td>
                            <td class=""><?= htmlspecialchars($sarana['lokasi'] ?? '-'); ?></td>
                            <td class="text-center">
                              <span class="badge bg-success"><?= htmlspecialchars($sarana['status'] ?? '-'); ?></span>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="11" class="text-center">Data tidak ditemukan</td>
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
            <i class="fas fa-filter mr-2"></i>Filter Data Peminjaman
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <!-- Filter Jenis Barang -->
            <div class="card mb-4 border-navy">
              <div class="card-header bg-light-navy">
                <h6 class="mb-0 font-weight-bold text-navy">
                  <i class="fas fa-boxes mr-2"></i>Jenis Barang
                </h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <select id="filterJenis" class="form-select form-control border-navy">
                      <option value="">Semua Jenis</option>
                      <?php foreach ($jenisOptions as $jenis) : ?>
                        <option value="<?= htmlspecialchars($jenis) ?>"><?= htmlspecialchars($jenis) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <!-- Filter Lokasi Peminjaman -->
            <div class="card mb-4 border-navy">
              <div class="card-header bg-light-navy">
                <h6 class="mb-0 font-weight-bold text-navy">
                  <i class="fas fa-map-marker-alt mr-2"></i>Lokasi Peminjaman
                </h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <select id="filterLokasi" class="form-select form-control border-navy">
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
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-navy text-white"><i class="far fa-calendar"></i></span>
                      </div>
                      <input type="date" id="filterTanggalMin" class="form-control border-navy">
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="filterTanggalMax" class="form-label">Sampai Tanggal</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-navy text-white"><i class="far fa-calendar"></i></span>
                      </div>
                      <input type="date" id="filterTanggalMax" class="form-control border-navy">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Filter Tanggal Pengembalian -->
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
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-navy text-white"><i class="far fa-calendar"></i></span>
                      </div>
                      <input type="date" id="filterTanggalKembaliMin" class="form-control border-navy">
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="filterTanggalKembaliMax" class="form-label">Sampai Tanggal</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-navy text-white"><i class="far fa-calendar"></i></span>
                      </div>
                      <input type="date" id="filterTanggalKembaliMax" class="form-control border-navy">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-2"></i>Tutup
          </button>
          <button type="button" class="btn btn-outline-danger" id="resetFiltersBtn">
            <i class="fas fa-undo mr-2"></i>Reset
          </button>
          <button type="button" class="btn btn-navy" id="applyFiltersBtn">
            <i class="fas fa-check mr-2"></i>Terapkan
          </button>
        </div>
      </div>
    </div>
  </div>

  </div>

  <?php require_once './app/Views/Components/script.php'; ?>
  <script>
    // Helper function to parse date dd-mm-yyyy to Date object
    function parseDate(dateStr) {
      if (!dateStr || dateStr === '-') return null;
      var parts = dateStr.split('-');
      if (parts.length === 3) {
        // Assuming dd-mm-yyyy
        return new Date(parts[2], parts[1] - 1, parts[0]);
      }
      return null;
    }

    $(document).ready(function() {
      // Initialize DataTable
      var table = $("#saranaTable").DataTable({
        "responsive": false,
        "scrollX": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "ordering": false,
        "columnDefs": [{
          "targets": [0], // Kolom "No" tidak bisa di-sort
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
          }
        }
      });

      // Initialize Select2 for filter dropdowns
      $('#filterJenis').select2({
        placeholder: "Pilih Jenis Barang",
        allowClear: true,
        theme: 'bootstrap4',
        dropdownParent: $('#filterModal')
      });

      $('#filterLokasi').select2({
        placeholder: "Pilih Lokasi Peminjaman",
        allowClear: true,
        theme: 'bootstrap4',
        dropdownParent: $('#filterModal')
      });

      // Custom filtering function for date range
      $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
          var jenisValue = $('#filterJenis').val();
          var lokasiValue = $('#filterLokasi').val();

          // Filter jenis dan lokasi
          if (jenisValue && data[3] !== jenisValue) {
            return false;
          }

          if (lokasiValue && data[9] !== lokasiValue) {
            return false;
          }

          // Filter tanggal
          var min = $('#filterTanggalMin').val();
          var max = $('#filterTanggalMax').val();
          var cellDatePinjam = data[7]; // Kolom Tanggal Peminjaman

          var minKembali = $('#filterTanggalKembaliMin').val();
          var maxKembali = $('#filterTanggalKembaliMax').val();
          var cellDateKembali = data[8]; // Kolom Tanggal Pengembalian

          var datePinjam = parseDate(cellDatePinjam);
          var dateKembali = parseDate(cellDateKembali);

          var filterMinDate = min ? new Date(min) : null;
          var filterMaxDate = max ? new Date(max) : null;
          var filterMinDateKembali = minKembali ? new Date(minKembali) : null;
          var filterMaxDateKembali = maxKembali ? new Date(maxKembali) : null;

          if (filterMinDate) filterMinDate.setHours(0, 0, 0, 0);
          if (filterMaxDate) filterMaxDate.setHours(23, 59, 59, 999);
          if (filterMinDateKembali) filterMinDateKembali.setHours(0, 0, 0, 0);
          if (filterMaxDateKembali) filterMaxDateKembali.setHours(23, 59, 59, 999);

          // Filter tanggal peminjaman
          if (min || max) {
            if (!datePinjam) return false;

            if (min && datePinjam < filterMinDate) {
              return false;
            }

            if (max && datePinjam > filterMaxDate) {
              return false;
            }
          }

          // Filter tanggal pengembalian
          if (minKembali || maxKembali) {
            if (!dateKembali) return false;

            if (minKembali && dateKembali < filterMinDateKembali) {
              return false;
            }

            if (maxKembali && dateKembali > filterMaxDateKembali) {
              return false;
            }
          }

          return true;
        }
      );

      // Apply filters when the "Terapkan Filter" button is clicked
      $('#applyFiltersBtn').on('click', function() {
        table.draw();
        $('#filterModal').modal('hide');
      });

      // Reset filters when the "Reset Filter" button is clicked
      $('#resetFiltersBtn').on('click', function() {
        $('#filterJenis').val('').trigger('change');
        $('#filterLokasi').val('').trigger('change');
        $('#filterTanggalMin').val('');
        $('#filterTanggalMax').val('');
        $('#filterTanggalKembaliMin').val('');
        $('#filterTanggalKembaliMax').val('');

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