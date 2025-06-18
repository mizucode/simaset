<!DOCTYPE html>
<html lang="en">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php require_once './app/Views/Components/navbar.php'; ?>
    <?php require_once './app/Views/Components/aside.php'; ?>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin menghapus data peminjaman sarana ATK ini?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <a id="deleteButton" href="#" class="btn btn-danger">Hapus</a> <!-- URL Hapus akan diatur oleh JavaScript jika diperlukan -->
          </div>
        </div>
      </div>
    </div>

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
    <div class="content-wrapper bg-white py-4 mb-5 px-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>
            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Pengembalian Sarana ATK</h3>
                <div class="ml-auto">
                  <button type="button" class="btn btn-light btn-sm mr-2" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter mr-1"></i> Filter Data
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
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
                        <th>Lokasi Barang</th>
                        <th>Aksi</th>
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
                              <?php $idSarana = $sarana['id_sarana_atk'] ?? $sarana['id'] ?? null; ?>
                              <?php if ($idSarana) : ?>
                                <a href="/admin/sarana/atk/kembali?edit=<?= htmlspecialchars($idSarana); ?>" class="btn btn-sm btn-success">
                                  <i class="fas fa-handshake mr-1"></i>Kembalikan
                                </a>
                              <?php else : ?>
                                -
                              <?php endif; ?>
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

    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-navy text-white">
            <h5 class="modal-title font-weight-bold" id="filterModalLabel">
              <i class="fas fa-filter mr-2"></i>Filter Data Pengembalian
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
              <!-- Filter Lokasi Barang -->
              <div class="card mb-4 border-navy">
                <div class="card-header bg-light-navy">
                  <h6 class="mb-0 font-weight-bold text-navy">
                    <i class="fas fa-map-marker-alt mr-2"></i>Lokasi Barang
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
                    <i class="far fa-calendar-check mr-2"></i>Tanggal Pengembalian
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

    <?php require_once './app/Views/Components/footer.php'; ?>
  </div>

  <?php require_once './app/Views/Components/script.php'; ?>
  <script>
    function parseDate(dateStr) {
      if (!dateStr || dateStr === '-') return null;
      var parts = dateStr.split('-');
      if (parts.length === 3) {
        return new Date(parts[2], parts[1] - 1, parts[0]);
      }
      return null;
    }
    $(document).ready(function() {
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
          "targets": [0, 10],
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
      $('#filterJenis').select2({
        placeholder: "Pilih Jenis Barang",
        allowClear: true,
        theme: 'bootstrap4',
        dropdownParent: $('#filterModal')
      });
      $('#filterLokasi').select2({
        placeholder: "Pilih Lokasi Barang",
        allowClear: true,
        theme: 'bootstrap4',
        dropdownParent: $('#filterModal')
      });
      $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
          var jenisValue = $('#filterJenis').val();
          var lokasiValue = $('#filterLokasi').val();
          if (jenisValue && data[3] !== jenisValue) {
            return false;
          }
          if (lokasiValue && data[9] !== lokasiValue) {
            return false;
          }
          var min = $('#filterTanggalMin').val();
          var max = $('#filterTanggalMax').val();
          var cellDatePinjam = data[7];
          var minKembali = $('#filterTanggalKembaliMin').val();
          var maxKembali = $('#filterTanggalKembaliMax').val();
          var cellDateKembali = data[8];
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
          if (min || max) {
            if (!datePinjam) return false;
            if (min && datePinjam < filterMinDate) {
              return false;
            }
            if (max && datePinjam > filterMaxDate) {
              return false;
            }
          }
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
      $('#applyFiltersBtn').on('click', function() {
        table.draw();
        $('#filterModal').modal('hide');
      });
      $('#resetFiltersBtn').on('click', function() {
        $('#filterJenis').val('').trigger('change');
        $('#filterLokasi').val('').trigger('change');
        $('#filterTanggalMin').val('');
        $('#filterTanggalMax').val('');
        $('#filterTanggalKembaliMin').val('');
        $('#filterTanggalKembaliMax').val('');
        table.draw();
      });
      $('.modal').on('click', function(e) {
        if ($(e.target).is('.modal')) {
          $(this).modal('hide');
        }
      });
    });
  </script>
</body>

</html>