<!DOCTYPE html>
<html lang="en">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php require_once './app/Views/Components/navbar.php'; ?>
    <?php require_once './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white py-4 mb-5 px-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>

            <!-- Filter Card -->
            <div class="card shadow-md mb-3" style="border-top: 3px solid #001f3f;">
              <div class="card-header bg-light">
                <h3 class="card-title">Filter Data</h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="jenisFilter" class="col-sm-2 col-form-label">Filter Berdasarkan Jenis:</label>
                  <div class="col-sm-4">
                    <select id="jenisFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Jenis</option>
                      <?php if (!empty($jenisList)) : ?>
                        <?php foreach ($jenisList as $jenis) : ?>
                          <option value="<?= htmlspecialchars($jenis); ?>"><?= htmlspecialchars($jenis); ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="col-sm-2 d-flex"> <!-- Jadikan kolom ini flex container -->
                    <button id="resetFilter" class="btn btn-secondary btn-sm align-self-stretch w-100">Reset Filter</button> <!-- Regangkan tombol secara vertikal dan buat lebar penuh di kolomnya -->
                  </div>
                </div>
              </div>
            </div>

            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">
                  Data Sarana Mebelair
                </h3>
                <a href="/admin/sarana/mebelair/download-qr" class="btn btn-success btn-sm ml-auto">
                  <i class="fas fa-save mr-1"></i> Download QR Code
                </a>
              </div>

              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="mebelairTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">No Registrasi</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th width="15%">Aksi</th>
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
                            <td><?= htmlspecialchars($sarana['barang'] ?? '-'); ?></td>
                            <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/sarana/mebelair?detail=<?= $sarana['id']; ?>" class="btn btn-info btn-sm">
                                  <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="5" class="text-center">Data tidak ditemukan</td>
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

  <?php require_once './app/Views/Components/script.php'; ?>
  <script>
    $(function() {
      var table = $("#mebelairTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,

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
        "ordering": false, // Menonaktifkan fitur ordering untuk semua kolom
        "columnDefs": [{
            "targets": 0, // Kolom "No"
            "orderable": false,
            "searchable": false // Kolom "No" tidak perlu bisa dicari
          },
          {
            "targets": [4], // Kolom "Aksi"
            "orderable": false // Pastikan kolom aksi tetap tidak bisa diurutkan (jika ordering utama diaktifkan)
          }
        ]
      });

      table.buttons().container().appendTo('#mebelairTable_wrapper .col-md-6:eq(0)');

      // Event listener untuk filter, sekarang akan bekerja karena 'table' adalah objek yang benar
      $('#jenisFilter').on('change', function() {
        var val = $(this).val();

        table.column(3) // Index kolom 'Jenis' adalah 3 (dimulai dari 0)
          .search(val ? '^' + val + '$' : '', true, false)
          .draw();
      });

      // Fungsi untuk mengatur ulang nomor urut setiap kali tabel digambar ulang
      table.on('draw.dt', function() {
        var PageInfo = table.page.info();
        table.column(0, {
          page: 'current'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });

      // Inisialisasi Select2 untuk filter jenis
      $('#jenisFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Jenis Barang",
        allowClear: false, // Menonaktifkan tombol clear (x)
        minimumResultsForSearch: 1, // Tampilkan kotak pencarian jika ada minimal 1 opsi (untuk autocomplete)
        width: '100%'
      });

      // Event listener untuk tombol reset filter
      $('#resetFilter').on('click', function() {
        $('#jenisFilter').val('').trigger('change'); // Reset dropdown dan trigger change event
        // table.column(3).search('').draw(); // Baris ini menjadi redundan karena trigger('change') sudah memanggil draw()
      });

    });
  </script>
</body>

</html>