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
            Apakah Anda yakin ingin menghapus data barang elektronik ini?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <a id="deleteButton" href="#" class="btn btn-danger">Hapus</a>
          </div>
        </div>
      </div>
    </div>

    <div class="content-wrapper bg-white py-4 mb-5 px-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>
            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Barang Elektronik Siap Pindah</h3>
                <!-- Jika ada tombol tambah, bisa diletakkan di sini seperti di Tanah/index.php -->
                <!-- <a href="/admin/sarana/elektronik/pindah/tambah" class="btn btn-warning btn-sm ml-auto">
                                    <div class="text-dark"><i class="fas fa-plus mr-1"></i> Tambah Data</div>
                                </a> -->
              </div>

              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="elektronikTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">No Registrasi</th>
                        <th width="15%">Nama Barang</th>
                        <th width="15%">Jenis</th>
                        <th width="15%">Lokasi Saat Ini</th>
                        <th width="15%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($saranaData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($saranaData as $barang) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($barang['no_registrasi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['nama_detail_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['lokasi'] ?? '-'); ?></td>
                            <td class="text-center">
                              <a href="/admin/sarana/elektronik/pindah?edit=<?= $barang['id']; ?>" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i> Edit
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="6" class="text-center">Data tidak ditemukan</td>
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
      $("#elektronikTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "columnDefs": [{
          "targets": [5], // Target kolom Aksi
          "searchable": false,
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
          },
          "searchPlaceholder": "kata kunci pencarian",
          "thousands": "."
        },
        "buttons": [{
            extend: 'copy',
            title: 'Data Barang Elektronik Siap Pindah',
            exportOptions: {
              columns: [0, 1, 2, 3, 4] // No, No Registrasi, Nama Barang, Jenis, Lokasi
            }
          },
          {
            extend: 'csv',
            title: 'Data Barang Elektronik Siap Pindah',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'excel',
            title: 'Data Barang Elektronik Siap Pindah',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'pdf',
            title: 'Data Barang Elektronik Siap Pindah',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          'colvis'
        ]
      }).buttons().container().appendTo('#elektronikTable_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html>