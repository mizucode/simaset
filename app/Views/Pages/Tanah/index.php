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
                                        <i class="fas fa-plus mr-1"></i> Tambah Data
                                    </div>
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="overflow-hidden">
                                    <table id="example1" class="table table-bordered table-responsive">
                                        <thead>
                                            <tr class="text-center align-middle bg-gray-100">
                                                <th class="align-middle">No</th>
                                                <th class="align-middle">Kode Aset</th>
                                                <th class="align-middle">Nama Aset</th>
                                                <th class="align-middle">Nomor Sertifikat</th>
                                                <th class="align-middle">Luas (m²)</th>
                                                <th class="align-middle">Jenis Aset</th>
                                                <th class="align-middle">Lokasi</th>
                                                <th class="align-middle text-nowrap">Tanggal Pajak</th>
                                                <th class="align-middle">Fungsi</th>
                                                <th class="align-middle">Keterangan</th>
                                                <th class="align-middle">File Sertifikat</th>
                                                <th class="align-middle">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($tanahData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($tanahData as $td) : ?>
                                                    <tr class="align-middle">
                                                        <td class="text-center align-middle"><?= $counter++; ?></td>
                                                        <td class="text-center align-middle"><?= htmlspecialchars($td['kode_aset'] ?? '-'); ?></td>
                                                        <td class="text-center align-middle"><?= htmlspecialchars($td['nama_aset'] ?? '-'); ?></td>
                                                        <td class="text-center align-middle"><?= htmlspecialchars($td['nomor_sertifikat'] ?? '-'); ?></td>
                                                        <td class="text-center align-middle"><?= htmlspecialchars($td['luas'] ?? '-'); ?> m²</td>
                                                        <td class="text-center align-middle text-nowrap">
                                                            <?php
                                                            $jenis_aset = htmlspecialchars($td['jenis_aset'] ?? '-');
                                                            $badgeClass = 'bg-gray-500';
                                                            if ($jenis_aset === 'Aset Tetap') {
                                                                $badgeClass = 'bg-green-500';
                                                            } elseif ($jenis_aset === 'Aset Tidak Tetap') {
                                                                $badgeClass = 'bg-blue-500';
                                                            }
                                                            echo '<span class="' . $badgeClass . ' text-white px-2 py-1 rounded text-sm w-[120px] text-center d-inline-block">' . $jenis_aset . '</span>';
                                                            ?>
                                                        </td>
                                                        <td class="text-center align-middle"><?= htmlspecialchars($td['lokasi'] ?? '-'); ?></td>
                                                        <td class="text-center align-middle"><?= htmlspecialchars(date('d-m-Y', strtotime($td['tgl_pajak'])) ?? '-'); ?></td>
                                                        <td class="text-center align-middle"><?= htmlspecialchars($td['fungsi'] ?? '-'); ?></td>
                                                        <td class="text-center align-middle"><?= htmlspecialchars($td['keterangan'] ?? '-'); ?></td>
                                                        <td class="text-center align-middle">
                                                            <?php if (!empty($td['file_sertifikat'])): ?>
                                                                <a href="/storage/sertifikat/<?= htmlspecialchars($td['file_sertifikat']); ?>" download class="btn btn-primary btn-sm">
                                                                    <i class="fas fa-download"></i> Download
                                                                </a>
                                                            <?php else: ?>
                                                                <div class="btn btn-danger btn-sm">
                                                                    Tidak Ada File
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div class="inline-flex flex-col items-center gap-2">
                                                                <button
                                                                    onclick="window.location.href='/admin/prasarana/tanah?edit=<?= $td['id']; ?>'"
                                                                    class="w-24 flex justify-center items-center rounded-lg bg-yellow-400 py-2 px-4 border border-transparent text-sm text-gray-700 transition-all shadow-sm hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 hover:text-white active:shadow-none gap-2 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                                    type="button">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </button>
                                                                <button
                                                                    type="button"
                                                                    data-id="<?= $td['id']; ?>"
                                                                    data-toggle="modal"
                                                                    data-target="#deleteModal"
                                                                    class="w-24 flex justify-center items-center rounded-lg bg-red-600 py-2 px-4 border border-transparent text-sm text-white transition-all shadow-sm hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 hover:text-white active:shadow-none gap-2 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr class="align-middle">
                                                    <td colspan="12" class="text-center align-middle">Data tidak ditemukan</td>
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

    <script>
        $(document).ready(function() {
            // Tangkap event klik tombol delete
            $('.btn-delete').on('click', function() {
                var id = $(this).data('id');
                var deleteUrl = '/admin/prasarana/tanah?delete=' + id;

                // Set URL hapus ke tombol Hapus di modal
                $('#deleteButton').attr('href', deleteUrl);

                // Tampilkan modal
                $('#deleteModal').modal('show');
            });
        });
    </script>

</body>

</html>