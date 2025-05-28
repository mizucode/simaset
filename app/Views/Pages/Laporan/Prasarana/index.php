<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
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

    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>



    <div class="content-wrapper bg-white py-4 mb-5 px-5">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>

            <div class="card collapsed-card shadow-md">
              <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
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
                        <th width="15%">Kode Aset</th>
                        <th width="30%">Nama Prasarana</th>
                        <th width="20%">Jenis Aset</th>
                        <th width="20%">Tanggal Pajak</th>
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
                            <td><?= htmlspecialchars($barang['jenis_aset'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['tgl_pajak'] ?? '-'); ?></td>
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

            <div class="card collapsed-card shadow-md">
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
                        <th width="5%">No</th>
                        <th width="15%">Kode Aset</th>
                        <th width="30%">Nama Prasarana</th>
                        <th width="20%">Jenis Aset</th>
                        <th width="20%">Tanggal Pajak</th>
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
                            <td><?= htmlspecialchars($barang['tgl_pajak'] ?? '-'); ?></td>
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

            <div class="card collapsed-card shadow-md">
              <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Prasarana Ruangan</h3>
                <button type="button" class="btn btn-tool ml-auto text-white" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>

              <div class="card-body  p-3">
                <div class="table-responsive">
                  <table id="example3" class="table table-bordered table-sm table-hover w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">Kode Aset</th>
                        <th width="30%">Nama Prasarana</th>
                        <th width="20%">Jenis Aset</th>
                        <th width="20%">Tanggal Pajak</th>
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
                            <td><?= htmlspecialchars($barang['tgl_pajak'] ?? '-'); ?></td>
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

            <div class="card collapsed-card shadow-md ">
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
                        <th width="5%">No</th>
                        <th width="15%">Kode Aset</th>
                        <th width="30%">Nama Prasarana</th>
                        <th width="20%">Jenis Aset</th>
                        <th width="20%">Tanggal Pajak</th>
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
                            <td><?= htmlspecialchars($barang['tgl_pajak'] ?? '-'); ?></td>
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

    <?php include './app/Views/Components/foooter.php'; ?>
  </div>

  <?php include './app/Views/Components/script.php'; ?>
  <!-- Pastikan script.php memuat jQuery, Bootstrap JS, dan AdminLTE JS -->
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script> <!-- Jika menggunakan Bootstrap 4 styling -->
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script> <!-- Jika menggunakan Bootstrap 4 styling -->
  <!-- Buttons -->
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script> <!-- Jika menggunakan Bootstrap 4 styling -->
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
          lengthChange: true,
          autoWidth: false,
          paging: false,
          info: true,
          searching: true,
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
          dom: "<'row'<'col-sm-12 col-md-6'lB><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12'i>>", // Info diletakkan di baris sendiri karena paging:false
        };

        $(selector).DataTable(currentTableOptions);
      }

      initDataTable('#example1', 'Data Prasarana Tanah');
      initDataTable('#example2', 'Data Prasarana Bangunan');
      initDataTable('#example3', 'Data Prasarana Ruang');
      initDataTable('#example4', 'Data Prasarana Lapang');
    });
  </script>

  <script>
    $(document).ready(function() {

      $(document).on('click', 'button[data-target="#deleteModal"]', function() {
        var id = $(this).data('id');
        var deleteUrl = '/admin/barang/jenis-barang?delete=' + id;
        $('#deleteButton').attr('href', deleteUrl);
      });
    });
  </script>
</body>

</html>