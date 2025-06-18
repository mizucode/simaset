<!DOCTYPE html>
<html lang="en">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php require_once './app/Views/Components/navbar.php'; ?>
    <?php require_once './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white py-4 mb-5 ">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>

            <div class="card shadow-md mb-3" style="border-top: 3px solid #001f3f;">
              <div class="card-header bg-light py-2">
                <h3 class="card-title mb-0" style="font-size: 1.1rem;">Filter Data</h3>
              </div>
              <div class="card-body pt-3 pb-3">
                <div class="form-group row mb-3 align-items-center">
                  <label for="kategoriFilter" class="col-md-1 col-form-label">Kategori:</label>
                  <div class="col-md-11">
                    <select id="kategoriFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Kategori</option>
                      <?php if (!empty($kategoriList)) : ?>
                        <?php foreach ($kategoriList as $kategori) : ?>
                          <option value="<?= htmlspecialchars($kategori['nama_kategori']); ?>"><?= htmlspecialchars($kategori['nama_kategori']); ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-0">
                  <div class="col-12 d-flex justify-content-start">
                    <button id="resetFilter" class="btn btn-secondary btn-sm px-4">Reset</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Daftar Jenis Barang</h3>
                <a href="/admin/barang/jenis-barang/tambah" class="btn btn-warning btn-sm ml-auto">
                  <div class="text-dark">
                    <i class="fas fa-plus mr-1"></i> Tambah Data
                  </div>
                </a>
              </div>
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="jenisTable" class="table table-bordered table-striped w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">Kode Barang</th>
                        <th width="30%">Nama Barang</th>
                        <th width="20%">Kategori</th>
                        <th width="15%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($jenisBarangData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($jenisBarangData as $barang) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center"><?= htmlspecialchars($barang['kode_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['nama_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($barang['nama_kategori'] ?? '-'); ?></td>
                            <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">
                                <button onclick="window.location.href='/admin/barang/jenis-barang?edit=<?= $barang['id']; ?>'" class="btn btn-warning btn-sm">
                                  <i class="fas fa-edit mr-1"></i> Edit
                                </button>
                                <button type="button" data-id="<?= $barang['id']; ?>" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm">
                                  <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
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
                    Apakah Anda yakin ingin menghapus data jenis barang ini?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a id="deleteButton" href="#" class="btn btn-danger">Hapus</a>
                  </div>
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
      var table = $("#jenisTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "ordering": false,
        "language": {
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
          }
        },
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
      });

      $('#kategoriFilter').on('change', function() {
        var val = $(this).val();
        table.column(3) // Index kolom 'Kategori'
          .search(val ? '^' + val + '$' : '', true, false)
          .draw();
      });

      $('#resetFilter').on('click', function() {
        $('#kategoriFilter').val('').trigger('change');
      });

      $('#kategoriFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Kategori Barang",
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });
    });

    $(document).ready(function() {
      $('button[data-target="#deleteModal"]').on('click', function() {
        var id = $(this).data('id');
        var deleteUrl = '/admin/barang/jenis-barang?delete=' + id;
        $('#deleteButton').attr('href', deleteUrl);
        $('#deleteModal').modal('show');
      });
    });
  </script>
</body>

</html>