<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

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

        <div class="content-wrapper bg-white py-4 mb-5 px-3">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <?php include './app/Views/Components/helper.php'; ?>


                        <?php if (!empty($errorMessage)) : ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($errorMessage); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card shadow-md">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                                <h3 class="h4 mb-0">Data Jenis Barang</h3>
                                <a href="/admin/barang/jenis-barang/tambah" class="btn btn-warning btn-sm ml-auto">
                                    <div class="text-dark">
                                        <i class="fas fa-plus mr-1"></i> Tambah Data
                                    </div>
                                </a>
                            </div>

                            <div class="card-body p-3">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-hover w-100">
                                        <thead class="bg-gray-100">
                                            <tr class="text-center align-middle">
                                                <th width="5%">No</th>
                                                <th width="15%">Kode Barang</th>
                                                <th width="30%">Nama Barang</th>
                                                <th width="20%">Kategori</th>
                                                <th width="30%">Aksi</th>
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
                    </div>
                </div>
            </div>
        </div>

        <?php include './app/Views/Components/foooter.php'; ?>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
        const exportTitle = 'Data Jenis Barang';

        $("#example1").DataTable({
            responsive: true,
            lengthChange: true,
            ordering: false,
            autoWidth: false,
            dom: '<"row"<"col-md-6"B><"col-md-6"f>>rt<"row"<"col-md-6"l><"col-md-6"p>>',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                zeroRecords: "Data tidak ditemukan"
            }
        });
    </script>

    <script>
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