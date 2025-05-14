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
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a id="deleteButton" href="#" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-wrapper bg-white py-4 mb-5 px-3 ">
            <div class="container-fluid ">

                <div class="row justify-content-center ">
                    <div class="col-auto">
                        <?php include './app/Views/Components/helper.php'; ?>
                        <div class="card shadow-md">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center ">
                                <h3 class="h4 mb-0">Data Aset Tanah</h3>
                                <a href="/admin/prasarana/tanah/tambah" class="btn btn-warning btn-sm ml-auto">
                                    <div class="text-dark">
                                        <i class="fas fa-plus-circle mr-1"></i> Tambah Data
                                    </div>
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-sm table-bordered table-hover">
                                        <thead>
                                            <tr class="bg-gray-100 text-nowrap">
                                                <th class="text-center align-middle">No</th>
                                                <th class="text-center align-middle">Kode Aset</th>
                                                <th class="text-center align-middle">Nama Aset</th>
                                                <th class="text-center align-middle">Nomor Sertifikat</th>
                                                <th class="text-center align-middle">Luas (m²)</th>
                                                <th class="text-center align-middle">Jenis Aset</th>
                                                <th class="text-center align-middle">Lokasi</th>
                                                <th class="text-center align-middle text-nowrap">Tanggal Pajak</th>
                                                <th class="text-center align-middle">Fungsi</th>
                                                <th class="text-center align-middle">Keterangan</th>
                                                <th class="text-center align-middle">File Sertifikat</th>
                                                <th class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($tanahData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($tanahData as $td) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= $counter++; ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($td['kode_aset'] ?? '-'); ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($td['nama_aset'] ?? '-'); ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($td['nomor_sertifikat'] ?? '-'); ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($td['luas'] ?? '-'); ?> m²</td>
                                                        <td class="text-center align-middle">
                                                            <?php
                                                            $jenis_aset = htmlspecialchars($td['jenis_aset'] ?? '-');
                                                            $badgeClass = 'badge bg-secondary'; // Default gray
                                                            if ($jenis_aset === 'Aset Tetap') {
                                                                $badgeClass = 'badge bg-success';
                                                            } elseif ($jenis_aset === 'Aset Tidak Tetap') {
                                                                $badgeClass = 'badge bg-primary';
                                                            }
                                                            echo '<span class="' . $badgeClass . ' d-inline-block text-truncate" style="width: 120px;">' . $jenis_aset . '</span>';
                                                            ?>
                                                        </td>
                                                        <td class="text-center"><?= htmlspecialchars($td['lokasi'] ?? '-'); ?></td>
                                                        <td class="text-center"><?= htmlspecialchars(date('d-m-Y', strtotime($td['tgl_pajak'])) ?? '-'); ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($td['fungsi'] ?? '-'); ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($td['keterangan'] ?? '-'); ?></td>
                                                        <td class="text-center">
                                                            <?php if (!empty($td['file_sertifikat'])): ?>
                                                                <a href="/storage/sertifikat/<?= htmlspecialchars($td['file_sertifikat']); ?>" download class="btn btn-primary btn-sm">
                                                                    <i class="fas fa-file-download"></i> Unduh
                                                                </a>
                                                            <?php else: ?>
                                                                <span class="badge badge-danger">Tidak Ada File</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex justify-content-center gap-1">
                                                                <a href="/admin/prasarana/tanah?edit=<?= $td['id']; ?>"
                                                                    class="btn btn-warning btn-sm px-2"
                                                                    title="Edit Data">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <button type="button"
                                                                    data-id="<?= $td['id']; ?>"
                                                                    data-toggle="modal"
                                                                    data-target="#deleteModal"
                                                                    class="btn btn-danger btn-sm px-2 delete-btn"
                                                                    title="Hapus Data">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            </div>
                                                        </td>
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
                            </div> <!-- card-body -->
                        </div> <!-- card -->
                    </div>
                </div>
            </div>
        </div>

        <?php include './app/Views/Components/foooter.php'; ?>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
        const exportTitle = 'Data Aset Tanah';
        const exportButtons = ['csv', 'excel', 'pdf', 'print'].map(type => ({
            extend: type,
            title: exportTitle
        }));
        exportButtons.push({
            extend: 'colvis',
            text: 'Tampilkan/Sembunyikan Kolom'
        });

        $("#example1").DataTable({
            responsive: true,
            lengthChange: true,
            ordering: false,
            autoWidth: false,
            buttons: exportButtons,
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
            },
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>

    <!DOCTYPE html>
    <html lang="en">
    <!-- ... (bagian head dan lainnya tetap sama) ... -->

    <script>
        $(document).ready(function() {
            // Tangkap event klik tombol delete
            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                var deleteUrl = '/admin/prasarana/tanah?delete=' + id;

                // Set URL hapus ke tombol Hapus di modal
                $('#deleteButton').attr('href', deleteUrl);
                $('#deleteButton').data('id', id);

                // Tampilkan modal
                $('#deleteModal').modal('show');
            });

            // Tambahkan event untuk tombol Hapus di modal
            $('#deleteButton').click(function(e) {
                e.preventDefault();
                var deleteUrl = $(this).attr('href');

                // Lakukan request hapus
                $.ajax({
                    url: deleteUrl,
                    type: 'GET', // Karena menggunakan parameter query (?delete=)
                    data: {
                        <?php if (isset($_SESSION['csrf_token'])): ?>
                            _token: '<?= $_SESSION['csrf_token'] ?>' // CSRF token
                        <?php endif; ?>
                    },
                    success: function(response) {
                        // Tutup modal
                        $('#deleteModal').modal('hide');

                        // Tampilkan notifikasi sukses
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
                        } else if (xhr.statusText) {
                            errorMsg = xhr.statusText;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMsg,
                        });

                        console.error('Error:', xhr.responseText);
                    }
                });
            });
        });
    </script>

</body>

</html>