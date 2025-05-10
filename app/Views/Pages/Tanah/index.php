<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <style>

        </style>

        <div class="content-wrapper bg-white py-4 mb-5 px-3 ">
            <div class="container-fluid ">
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']); // Menghapus pesan error setelah ditampilkan
                }
                ?>

                <?php var_dump($_POST) ?>
                <div class="row justify-content-center ">
                    <div class="col-auto">
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
                                            <tr class="text-nowrap">
                                                <th>No</th>
                                                <th>Kode Aset</th>
                                                <th>Nama Aset</th>
                                                <th>Nomor Sertifikat</th>
                                                <th>Luas</th>
                                                <th>Jenis Aset</th>
                                                <th>Lokasi</th>
                                                <th>Tanggal Pajak</th>
                                                <th>Fungsi</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($tanahData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($tanahData as $td) : ?>
                                                    <tr class="text-nowrap">
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($td['kode_aset'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($td['nama_aset'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($td['nomor_sertifikat'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($td['luas'] ?? '-'); ?></td>
                                                        <td class="text-center">
                                                            <?php
                                                            $jenis_aset = htmlspecialchars($td['jenis_aset'] ?? '-');
                                                            $badgeClass = 'bg-gray-500';
                                                            if ($jenis_aset === 'Aset Tetap') {
                                                                $badgeClass = 'bg-green-500';
                                                            } elseif ($jenis_aset === 'Aset Tidak Tetap') {
                                                                $badgeClass = 'bg-blue-500';
                                                            }
                                                            echo '<span class="' . $badgeClass . ' text-white px-3 py-1 rounded text-sm w-[120px] text-center d-inline-block">' . $jenis_aset . '</span>';
                                                            ?>
                                                        </td>
                                                        <td><?= htmlspecialchars($td['lokasi'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars(date('d-m-Y', strtotime($td['tgl_pajak'])) ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($td['fungsi'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($td['keterangan'] ?? '-'); ?></td>
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
        $("#example1").DataTable({
            responsive: true,
            lengthChange: true,
            ordering: false,
            autoWidth: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
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
</body>

</html>