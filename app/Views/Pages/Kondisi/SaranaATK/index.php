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
                        Apakah Anda yakin ingin menghapus data barang ATK ini?
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
                                        Data Barang ATK
                                    </h3>

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="atkTable" class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr class="text-center">
                                                <th width="5%">No</th>
                                                <th width="15%">No Registrasi</th>
                                                <th width="15%">Nama Barang</th>
                                                <th width="15%">Jenis</th>
                                                <th width="15%">Kondisi Saat Ini</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($saranaData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($saranaData as $barang) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= $counter++; ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($barang['no_registrasi'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_detail_barang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['barang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['kondisi'] ?? '-'); ?></td>
                                                        <td class="text-center">
                                                            <a href="/admin/sarana/atk/kondisi?edit=<?= $barang['id']; ?>" class="btn btn-sm btn-warning" title="Edit">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="dataTables_info">
                                            Menampilkan <?= count($saranaData) ?> data
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="float-right">
                                            <!-- Pagination can be added here if needed -->
                                        </div>
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

    <script>
        $(document).ready(function() {
            // Handle delete button click
            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                var deleteUrl = '/admin/sarana/atk?delete=' + id;
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

    <?php require_once './app/Views/Components/script.php'; ?>
</body>

</html>