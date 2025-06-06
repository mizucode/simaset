<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Page-specific styles for DataTables -->
    <style>
      /* Style untuk memindahkan search box ke kanan dan memberikan border */
      .dataTables_wrapper .dataTables_filter {
        float: right !important;
        text-align: right !important;
      }

      .dataTables_filter input {
        border: 1px solid #ced4da !important;
        border-radius: 4px !important;
        padding: 6px 12px !important;
        margin-left: 5px !important;
        width: 250px !important;
        /* Optional: Atur lebar sesuai kebutuhan */
      }

      /* Optional: Style untuk label search */
      .dataTables_filter label {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        /* Memastikan konten di-align ke kanan */
      }

      /* Pastikan tombol DataTables terlihat bagus */
      .dt-buttons .btn {
        margin-right: 5px;
      }
    </style>

    <!-- Navbar -->
    <?php include './app/Views/Components/navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include './app/Views/Components/aside.php'; ?>
    <!-- /.sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-white py-4 mb-5 px-5">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; // For flash messages or other helpers 
            ?>

            <!-- Card: Data Prasarana Tanah -->
            <div class="card shadow-md">
              <div class="card-header bg-success bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Prasarana Tanah</h3>
                <button type="button" class="btn btn-tool ml-auto text-white" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-sm table-hover w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="10%">Kode Aset</th>
                        <th width="15%">Nama Aset</th>
                        <th width="10%">No Sertifikat</th>
                        <th width="8%">Luas(m²)</th>
                        <th width="10%">Jenis Aset</th>
                        <th width="10%">Tanggal Pajak</th>
                        <th width="10%">Fungsi</th>
                        <th width="15%">Lokasi</th>
                        <th width="7%">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($PrasaranaTanah)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($PrasaranaTanah as $barang) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($barang['kode_aset'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['nama_aset'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['nomor_sertifikat'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['luas'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['jenis_aset'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['tgl_pajak'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['fungsi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['lokasi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['keterangan'] ?? '-'); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="10" class="text-center">Data tidak ditemukan</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <!-- Card: Data Prasarana Bangunan -->
            <div class="card shadow-md">
              <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Prasarana Bangunan</h3>
                <button type="button" class="btn btn-tool ml-auto text-white" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="example2" class="table table-bordered table-sm table-hover w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th> <!-- 5% -->
                        <th width="10%">Kode Aset</th> <!-- 10% -->
                        <th width="15%">Nama Aset</th> <!-- 20% -->
                        <th width="5%">Jenis Aset</th> <!-- 10% -->
                        <th width="5%">Luas (m²)</th> <!-- 8% -->
                        <th width="5%">Kondisi</th> <!-- 8% -->
                        <th width="5%">Jumlah Lantai</th> <!-- 8% -->
                        <th width="8%">Kontruksi</th> <!-- 8% -->
                        <th width="8%">Fungsi</th> <!-- 8% -->
                        <th width="8%">Unit Kepemilikan</th> <!-- 8% -->
                        <th width="15%">Lokasi</th> <!-- 7% Total = 100% -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($PrasaranaBangunan)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($PrasaranaBangunan as $barang) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($barang['kode_gedung'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['nama_gedung'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['jenis_aset'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['luas'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['kondisi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['jumlah_lantai'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['kontruksi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['fungsi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['unit_kepemilikan'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['lokasi'] ?? '-'); ?></td>
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
            <!-- /.card -->

            <!-- Card: Data Prasarana Ruangan -->
            <div class="card shadow-md">
              <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Prasarana Ruangan</h3>
                <button type="button" class="btn btn-tool ml-auto text-white" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="example3" class="table table-bordered table-sm table-hover w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">Kode Aset</th> <!-- Perhatikan: sesuaikan field jika berbeda -->
                        <th width="30%">Nama Aset</th> <!-- Perhatikan: sesuaikan field jika berbeda -->
                        <th width="30%">Jenis Ruangan</th> <!-- Perhatikan: sesuaikan field jika berbeda -->
                        <th width="20%">Luas</th>
                        <th width="20%">Letak Gedung</th>
                        <th width="20%">Letak Lantai</th>
                        <th width="20%">Status</th>
                        <th width="20%">Kondisi</th>
                        <th width="20%">Kapasitas</th>
                        <th width="20%">Fungsi</th>
                        <th width="20%">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // PERHATIKAN: Variabel $PrasaranaRuangan (atau nama yang sesuai) seharusnya digunakan di sini.
                      // Juga, field seperti 'kode_ruang', 'nama_ruang', 'luas', 'nama_gedung', 'lantai', 'status', 'kondisi_ruang', 'kapasitas', 'fungsi', 'keterangan'.
                      if (!empty($PrasaranaRuang)) :
                        $counter = 1;
                        foreach ($PrasaranaRuang as $barang) :
                      ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($barang['kode_ruang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['nama_ruang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['jenis_ruangan'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['luas'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['nama_gedung'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['lantai'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['status'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['kondisi_ruang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['kapasitas'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['fungsi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['keterangan'] ?? '-'); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="12" class="text-center">Data tidak ditemukan</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <!-- Card: Data Prasarana Lapang -->
            <div class="card shadow-md">
              <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Prasarana Lapang</h3>
                <button type="button" class="btn btn-tool ml-auto text-white" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="example4" class="table table-bordered table-sm table-hover w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th> <!-- 5% -->
                        <th width="10%">Kode Aset</th> <!-- 10% -->
                        <th width="15%">Nama Aset</th> <!-- 15% -->
                        <th width="10%">Jenis Aset</th> <!-- 10% -->
                        <th width="7%">Luas (m²)</th> <!-- 7% -->
                        <th width="8%">Kategori</th> <!-- 8% -->
                        <th width="8%">Kondisi</th> <!-- 8% -->
                        <th width="8%">Status</th> <!-- 8% -->
                        <th width="10%">Fungsi</th> <!-- 10% -->
                        <th width="10%">Lokasi</th> <!-- 10% -->
                        <th width="9%">Keterangan</th> <!-- 9% Total = 100% -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // PERHATIKAN: Variabel $PrasaranaLapang (atau nama yang sesuai) seharusnya digunakan di sini.
                      // Field yang digunakan: 'kode_lapang', 'nama_lapang', 'jenis_aset', 'luas', 'kategori', 'kondisi', 'status', 'fungsi', 'lokasi', 'keterangan'.
                      if (!empty($PrasaranaLapang)) :
                        $counter = 1;
                        foreach ($PrasaranaLapang as $barang) :
                      ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($barang['kode_lapang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['nama_lapang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['jenis_aset'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['luas'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['kategori'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['kondisi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['status'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['fungsi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['lokasi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['keterangan'] ?? '-'); ?></td>
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
            <!-- /.card -->

          </div>
          <!-- /.col-12 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <?php include './app/Views/Components/footer.php'; // Koreksi nama file dari foooter.php 
    ?>
    <!-- /.footer -->

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <?php include './app/Views/Components/script.php'; ?>
  <!-- Pastikan script.php memuat jQuery, Bootstrap JS, dan AdminLTE JS -->

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

  <script>
    // Script untuk menangani event klik pada tombol delete (jika ada modal delete)
    $(document).ready(function() {
      $(document).on('click', 'button[data-target="#deleteModal"]', function() {
        var id = $(this).data('id');
        // Pastikan path URL ini sesuai dengan route Anda
        var deleteUrl = '/admin/barang/jenis-barang?delete=' + id;
        $('#deleteButton').attr('href', deleteUrl); // Asumsi ada tombol dengan id="deleteButton" di modal
      });
    });
  </script>
</body>

</html>