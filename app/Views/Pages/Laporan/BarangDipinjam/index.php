<!DOCTYPE html>
<html lang="en">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php require_once './app/Views/Components/navbar.php'; ?>
    <?php require_once './app/Views/Components/aside.php'; ?>

    <!-- Modal Konfirmasi Hapus -->


    <div class="content-wrapper bg-white py-4 mb-5 px-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>
            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Peminjaman Sarana ATK</h3>

              </div>

              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="saranaTable" class="table table-bordered table-hover">
                    <thead class="bg-light">
                      <tr class="text-center">
                        <th width="5%">No</th>
                        <th width="15%">No Registrasi</th>
                        <th width="15%">Nama Barang</th>
                        <th width="15%">Nama Peminjam</th>
                        <th width="15%">Nik/Nidn</th>
                        <th width="15%">No Hp</th>
                        <th width="15%">Lokasi Saat Ini</th>
                        <th width="10%">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($saranaData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($saranaData as $sarana) : ?>
                          <tr>
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($sarana['no_registrasi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['nama_detail_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['nama_peminjam'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($sarana['identitas_peminjam'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($sarana['no_hp_peminjam'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['lokasi'] ?? '-'); ?></td>
                            <td class="text-center">
                              <span class="badge bg-success"><?= htmlspecialchars($sarana['status'] ?? '-'); ?></span>
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

    <?php require_once './app/Views/Components/footer.php'; ?>
  </div>

  <?php require_once './app/Views/Components/script.php'; ?>
  <!-- DataTables & Plugins -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

  <script>
    $(function() {
      const buttonExportTitle = 'Data Peminjaman Sarana ATK';
      const saranaTableOptions = {
        responsive: true,
        lengthChange: true, // Menampilkan opsi jumlah entri per halaman
        autoWidth: false,
        paging: false, // Menonaktifkan paginasi bawaan, semua data tampil
        info: true, // Menampilkan informasi jumlah entri
        searching: true, // Mengaktifkan fitur pencarian
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
          paginate: { // Meskipun paging:false, terjemahan ini baik untuk konsistensi
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
        dom: "<'row'<'col-sm-12 col-md-6'lB><'col-sm-12 col-md-6'f>>" + // Baris 1: Length menu & Buttons di kiri, Filter di kanan
          "<'row'<'col-sm-12'tr>>" + // Baris 2: Tabel
          "<'row'<'col-sm-12'i>>", // Baris 3: Info di bawah (karena paging:false)
        columnDefs: [{
          "targets": [7], // Target kolom Status (indeks 7)
          "searchable": false, // Nonaktifkan pencarian
          "orderable": false // Nonaktifkan pengurutan
        }],
      };
      $("#saranaTable").DataTable(saranaTableOptions);
    });
  </script>
</body>

</html>