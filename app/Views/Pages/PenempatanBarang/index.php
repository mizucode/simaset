<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>


        <div class="content-wrapper bg-white py-4 mb-5 px-2">
            <div class="container-fluid">
                <?php include './app/Views/Components/helper.php'; ?>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="card">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                                <h3 class="h4 mb-0">Data Penempatan Barang Saat Ini</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered w-auto">
                                        <thead>
                                            <tr class="text-wrap">
                                                <th>No</th>
                                                <th class="text-nowrap">Nama Peminjam</th>
                                                <th>NIK</th>
                                                <th>Jabatan</th>
                                                <th>No Telepon</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah Barang</th>
                                                <th>Kondisi</th>
                                                <th>Tanggal Peminjaman</th>
                                                <th>Tanggal Pengembalian</th>
                                                <th>Status</th>
                                                <th>Tujuan Peminjaman</th>
                                                <th>Lokasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($peminjaman)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($peminjaman as $pm) : ?>
                                                    <tr>
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($pm['nama_peminjam'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($pm['nik'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($pm['jabatan'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($pm['no_telepon'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($pm['nama_barang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($pm['jumlah_barang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($pm['kondisi'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars(date('d-m-Y', strtotime($pm['tanggal_peminjaman'])) ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars(date('d-m-Y', strtotime($pm['tanggal_pengembalian'])) ?? '-'); ?></td>
                                                        <td>
                                                            <?php
                                                            $status = htmlspecialchars($pm['status'] ?? '-');
                                                            $badgeClass = 'badge-secondary';

                                                            if ($status === 'Dipinjamkan') {
                                                                $badgeClass = 'badge-success';
                                                            } elseif ($status === 'Kembali') {
                                                                $badgeClass = 'badge-primary';
                                                            } elseif ($status === 'Hilang') {
                                                                $badgeClass = 'badge-danger';
                                                            }

                                                            echo '<span class="badge ' . $badgeClass . ' p-2" style="font-size: 1rem;">' . $status . '</span>';
                                                            ?>
                                                        </td>

                                                        <td><?= htmlspecialchars($pm['tujuan_peminjaman'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($pm['lokasi'] ?? '-'); ?></td>
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
                            </div>
                        </div> <!-- card -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Form -->


    </div>
    <footer class="main-footer bg-white text-black">
        <strong>&copy; 2025 <a href="#">Lpptsi</a>. Umkuningan.</strong>
    </footer>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                ordering: true,
                "autoWidth": true,
                "stripe": false,
                screenY: true,


                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "zeroRecords": "Data tidak ditemukan"
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>