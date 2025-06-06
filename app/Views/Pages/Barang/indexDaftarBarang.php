<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white py-4 mb-5 px-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <?php if (!empty($error)) : ?>
              <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php include './app/Views/Components/helper.php'; ?>
            <div class="card">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4">Daftar Seluruh Barang</h3>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-sm table-hover w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">No Registrasi</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($allBarang)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($allBarang as $barang) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($barang['no_registrasi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['nama_detail_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['kategori'] ?? $barang['nama_kategori'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($barang['lokasi'] ?? '-'); ?></td>
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
            </div> <!-- card -->
          </div>
        </div>
      </div>
    </div>

    <?php include './app/Views/Components/footer.php'; ?>
  </div>

  <?php include './app/Views/Components/script.php'; ?>
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
      // Fungsi untuk inisialisasi DataTable
      function initDataTable(selector, buttonTitle) {
        const currentTableOptions = {
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
              title: buttonTitle,
              exportOptions: {
                orthogonal: 'export'
              }
            },
            {
              extend: 'csv',
              title: buttonTitle,
              exportOptions: {
                orthogonal: 'export'
              }
            },
            {
              extend: 'excel',
              title: buttonTitle,
              exportOptions: {
                orthogonal: 'export'
              }
            },
            {
              extend: 'pdf',
              title: buttonTitle,
              exportOptions: {
                orthogonal: 'export'
              }
            },
            {
              extend: 'print',
              title: buttonTitle,
              exportOptions: {
                orthogonal: 'export'
              }
            },
            'colvis'
          ],
          // DOM untuk mengatur tata letak elemen DataTables (lengthMenu, Buttons, Filter, Info)
          dom: "<'row'<'col-sm-12 col-md-6'lB><'col-sm-12 col-md-6'f>>" + // Baris 1: Length menu & Buttons di kiri, Filter di kanan
            "<'row'<'col-sm-12'tr>>" + // Baris 2: Tabel
            "<'row'<'col-sm-12'i>>", // Baris 3: Info di bawah (karena paging:false)
        };

        $(selector).DataTable(currentTableOptions);
      }

      // Inisialisasi DataTables untuk masing-masing tabel
      initDataTable('#example1', 'Data Prasarana Tanah');
      initDataTable('#example2', 'Data Prasarana Bangunan');
      initDataTable('#example3', 'Data Prasarana Ruang'); // Judul tombol sesuai
      initDataTable('#example4', 'Data Prasarana Lapang'); // Judul tombol sesuai
    });
  </script>
</body>

</html>