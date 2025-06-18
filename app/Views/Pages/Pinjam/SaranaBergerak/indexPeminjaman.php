<!DOCTYPE html>
<html lang="en">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php require_once './app/Views/Components/navbar.php'; ?>
    <?php require_once './app/Views/Components/aside.php'; ?>
    <div class="content-wrapper bg-white mb-5 py-4">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>
            <?php if (!empty($errorMessage)) : ?>
              <div class="alert alert-danger">
                <?php echo htmlspecialchars($errorMessage); ?>
              </div>
            <?php endif; ?>

            <?php
            $jenisOptions = [];
            $lokasiOptions = [];
            if (!empty($saranaData)) {
              // Asumsi 'barang' adalah kolom untuk Jenis Barang dari query getAllStatusExDipinjam
              $jenisOptions = array_unique(array_column($saranaData, 'barang'));
              sort($jenisOptions);
              $lokasiOptions = array_unique(array_column($saranaData, 'lokasi'));
              sort($lokasiOptions);
            }
            ?>

            <!-- Filter Card -->
            <div class="card shadow-md mb-3" style="border-top: 3px solid #001f3f;">
              <div class="card-header bg-light py-2">
                <h3 class="card-title mb-0" style="font-size: 1.1rem;">Filter Data</h3>
              </div>
              <div class="card-body pt-3 pb-3">
                <div class="row">
                  <div class="col-md-6 mb-2 mb-md-0">
                    <label for="filterJenis" class="form-label">Jenis Barang:</label>
                    <select id="filterJenis" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Jenis</option>
                      <?php foreach ($jenisOptions as $jenis) : ?>
                        <option value="<?= htmlspecialchars($jenis) ?>"><?= htmlspecialchars($jenis) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="filterLokasi" class="form-label">Lokasi Saat Ini:</label>
                    <select id="filterLokasi" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Lokasi</option>
                      <?php foreach ($lokasiOptions as $lokasi) : ?>
                        <option value="<?= htmlspecialchars($lokasi) ?>"><?= htmlspecialchars($lokasi) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 d-flex justify-content-start">
                    <button id="resetFiltersBtn" class="btn btn-secondary btn-sm px-4">Reset Filter</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Filter Card -->

            <!-- Table Card -->
            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Daftar Sarana Bergerak Tersedia untuk Dipinjam</h3>
              </div>

              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="saranaTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">No Registrasi</th>
                        <th width="15%">Nama Barang</th>
                        <th width="15%">Jenis</th>
                        <th width="20%">Lokasi Saat Ini</th>
                        <th width="10%">Aksi</th>
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
                            <td class="text-center"><?= htmlspecialchars($sarana['barang'] ?? '-'); ?></td>
                            <td class=""><?= htmlspecialchars($sarana['lokasi'] ?? '-'); ?></td>
                            <td class="text-center">
                              <?php // Asumsikan ID ada di $sarana['id_sarana_bergerak'] atau $sarana['id'] 
                              ?>
                              <?php $idSarana = $sarana['id_sarana_bergerak'] ?? ($sarana['id'] ?? null); ?>
                              <?php if ($idSarana) : ?>
                                <a href="/admin/sarana/bergerak/pinjam?edit=<?= htmlspecialchars($idSarana); ?>" class="btn btn-sm btn-success"><i class="fas fa-handshake mr-1"></i>Pinjam</a>
                              <?php else : ?>
                                -
                              <?php endif; ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="6" class="text-center">Tidak ada barang yang bisa dipinjam.</td>
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

      <?php require_once './app/Views/Components/footer.php'; ?>
    </div>



    <?php require_once './app/Views/Components/script.php'; ?>
    <script>
      $(function() {
        var table = $("#saranaTable").DataTable({ // Assign DataTable to a variable
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
          "paging": true,
          "info": true,
          "searching": true,
          "ordering": false, // Menonaktifkan ordering global
          "columnDefs": [{
            "targets": [0, 5], // Kolom "No" dan "Aksi"
            "searchable": false // Tetap nonaktifkan pencarian untuk kolom No dan Aksi
          }],
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
        });

        // Initialize Select2 for filters
        $('#filterJenis').select2({
          placeholder: "Pilih Jenis Barang",
          allowClear: false,
          theme: 'bootstrap4',
          width: '100%'
        });

        $('#filterLokasi').select2({
          placeholder: "Pilih Lokasi",
          allowClear: false,
          theme: 'bootstrap4',
          width: '100%'
        });

        // Apply filters
        $('#filterJenis').on('change', function() {
          table.column(3).search(this.value).draw(); // Kolom "Jenis" adalah index ke-3
        });

        $('#filterLokasi').on('change', function() {
          table.column(4).search(this.value).draw(); // Kolom "Lokasi Saat Ini" adalah index ke-4
        });

        // Reset filters
        $('#resetFiltersBtn').on('click', function() {
          $('#filterJenis').val('').trigger('change');
          $('#filterLokasi').val('').trigger('change');
          // table.search('').columns().search('').draw(); // Baris ini akan mereset global search juga, jika diperlukan
        });
      });
    </script>
</body>

</html>