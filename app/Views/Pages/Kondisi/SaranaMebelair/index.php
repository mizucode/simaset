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
            Apakah Anda yakin ingin menghapus data sarana mebelair ini?
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
                <h3 class="h4 mb-0">Data Kondisi Sarana Mebelair</h3>
                <!-- Tombol Tambah Data tidak ada di sini, sesuai dengan halaman Pindah lainnya -->
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table id="saranaTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center">
                        <th width="5%">No</th>
                        <th width="15%">No Registrasi</th>
                        <th width="15%">Nama Barang</th>
                        <th width="15%">Jenis</th>
                        <th width="20%">Kondisi Saat Ini</th>
                        <th width="15%">Aksi</th>
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
                            <td><?= htmlspecialchars($sarana['barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['kondisi'] ?? '-'); ?></td>

                            <td class="text-center">
                              <a href="/admin/sarana/mebelair/kondisi?edit=<?= $sarana['id']; ?>" class="btn btn-sm btn-warning" title="Edit">
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
    $(document).ready(function() {
      $("#saranaTable").DataTable({
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
            title: 'Data Kondisi Sarana Mebelair',
            exportOptions: {
              columns: [0, 1, 2, 3, 4] // No, No Registrasi, Nama Barang, Jenis, Kondisi Saat Ini
            }
          },
          {
            extend: 'csv',
            title: 'Data Kondisi Sarana Mebelair',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'excel',
            title: 'Data Kondisi Sarana Mebelair',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          {
            extend: 'pdf',
            title: 'Data Kondisi Sarana Mebelair',
            exportOptions: {
              columns: [0, 1, 2, 3, 4]
            }
          },
          'colvis'
        ]
      }).buttons().container().appendTo('#saranaTable_wrapper .col-md-6:eq(0)');

      // Handle delete button click
      $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        var deleteUrl = '/admin/sarana/mebelair?delete=' + id; // Disesuaikan untuk mebelair
        $('#deleteButton').attr('href', deleteUrl);
        $('#deleteModal').modal('show');
      });

      // Handle actual deletion
      $('#deleteButton').click(function(e) {
        e.preventDefault();
        var deleteUrl = $(this).attr('href');

        $.ajax({
          url: deleteUrl,
          type: 'GET',
          data: {
            <?php if (isset($_SESSION['csrf_token'])): ?>
              _token: '<?= $_SESSION['csrf_token'] ?>'
            <?php endif; ?>
          },
          success: function(response) {
            $('#deleteModal').modal('hide');
            if (response.success) {
              Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: response.message || 'Data berhasil dihapus',
              }).then(() => {
                window.location.reload();
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: response.message || 'Terjadi kesalahan',
              });
            }
          },
          error: function(xhr) {
            $('#deleteModal').modal('hide');
            let errorMsg = 'Terjadi kesalahan saat menghubungi server';
            if (xhr.responseJSON && xhr.responseJSON.message) {
              errorMsg = xhr.responseJSON.message;
            }
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: errorMsg,
            });
          }
        });
      });
    });
  </script>
</body>

</html>