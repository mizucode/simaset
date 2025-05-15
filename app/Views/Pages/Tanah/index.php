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
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a id="deleteButton" href="#" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-wrapper bg-white mb-5 pt-3 px-4">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <?php include './app/Views/Components/helper.php'; ?>
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title text-lg">
                                        Data Aset Tanah
                                    </h3>
                                    <a href="/admin/prasarana/tanah/tambah" class="btn btn-warning btn-sm">
                                        <i class="fas fa-plus mr-1"></i>Tambah Data
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">


                                <div class="table-responsive">
                                    <table id="tanahTable" class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr class="text-center">
                                                <th width="5%">No</th>
                                                <th width="15%">Nama Aset</th>
                                                <th width="12%">Nomor Sertifikat</th>
                                                <th width="8%">Luas (m²)</th>
                                                <th width="15%">Lokasi</th>
                                                <th width="12%">Tanggal Pajak</th>
                                                <th width="10%">Fungsi</th>
                                                <th width="10%">File Sertifikat</th>
                                                <th width="8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($tanahData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($tanahData as $td) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($td['nama_aset'] ?? '-'); ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($td['nomor_sertifikat'] ?? '-'); ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($td['luas'] ?? '-'); ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($td['lokasi'] ?? '-'); ?></td>
                                                        <td class="text-center"><?= !empty($td['tgl_pajak']) ? date('d-m-Y', strtotime($td['tgl_pajak'])) : '-'; ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($td['fungsi'] ?? '-'); ?></td>
                                                        <td class="text-center">
                                                            <?php if (!empty($td['file_sertifikat'])): ?>
                                                                <a href="/admin/prasarana/tanah?download=<?= htmlspecialchars($td['id']); ?>" download class="btn btn-primary btn-sm">
                                                                    <i class="fas fa-file-download"></i> Unduh
                                                                </a>
                                                            <?php else: ?>
                                                                <span class="badge badge-danger">Tidak Ada File</span>
                                                            <?php endif; ?>
                                                        </td>

                                                        <td class="text-center">
                                                            <a href="/admin/prasarana/tanah?detail=<?= $td['id']; ?>" class="btn btn-sm btn-info" title="Detail">
                                                                <i class="fas fa-eye"></i> Detail
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="9" class="text-center">Data tidak ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="dataTables_info">
                                            Menampilkan <?= count($tanahData) ?> data
                                        </div>
                                    </div>
                                    <!-- Pagination bisa ditambahkan jika diperlukan -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once './app/Views/Components/footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script>
        // Fungsi Export Excel
        document.getElementById('btnExportExcel').addEventListener('click', function() {
            const table = document.getElementById('tanahTable');
            const workbook = XLSX.utils.table_to_book(table);
            XLSX.writeFile(workbook, 'Data_Aset_Tanah.xlsx');
        });

        // Fungsi Pencarian
        document.getElementById('searchButton').addEventListener('click', function() {
            const searchText = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#tanahTable tbody tr');

            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchText) ? '' : 'none';
            });
        });

        // Fungsi untuk modal delete (diambil dari template lama)
        $(document).ready(function() {
            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                var deleteUrl = '/admin/prasarana/tanah?delete=' + id;
                $('#deleteButton').attr('href', deleteUrl);
                $('#deleteModal').modal('show');
            });

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

    <?php require_once './app/Views/Components/script.php'; ?>
</body>

</html>