<!DOCTYPE html>
<html lang="en">
<?php include 'components/head.php' ?>

<body
    class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'components/navbar.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include 'components/aside.php' ?>
        <!-- End Sidebar -->

        <!-- content-wrapper -->
        <div class="content-wrapper bg-white py-4 px-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-white">
                            <!-- Header Card -->
                            <div class="card-header bg-navy text-white">
                                <h3 class="card-title">Data Aset Ruangan</h3>
                            </div>

                            <!-- Body Card -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="">
                                        <h5 class="text-navy">Data Ruangan - Gedung Rektorat</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover text-sm">
                                                <thead class="bg-primary text-white">
                                                    <tr>
                                                        <th>Kode Ruangan</th>
                                                        <th>Nama Ruangan</th>
                                                        <th>Lantai</th>
                                                        <th>Luas (m²)</th>
                                                        <th>Fungsi</th>
                                                        <th>Kapasitas</th>
                                                        <th>Kondisi</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>RKT01</td>
                                                        <td>Ruang Rapat Utama</td>
                                                        <td>1</td>
                                                        <td>120.00</td>
                                                        <td>Ruang Rapat</td>
                                                        <td>40</td>
                                                        <td>baik</td>
                                                        <td>Digunakan untuk rapat pimpinan</td>
                                                    </tr>
                                                    <tr>
                                                        <td>RKT02</td>
                                                        <td>Kantor Rektor</td>
                                                        <td>2</td>
                                                        <td>80.00</td>
                                                        <td>Perkantoran</td>
                                                        <td>5</td>
                                                        <td>baik</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>RKT03</td>
                                                        <td>Ruang Administrasi</td>
                                                        <td>1</td>
                                                        <td>100.00</td>
                                                        <td>Administrasi</td>
                                                        <td>8</td>
                                                        <td>baik</td>
                                                        <td>Untuk pengelolaan dokumen</td>
                                                    </tr>
                                                    <tr>
                                                        <td>RKT04</td>
                                                        <td>Ruang Arsip</td>
                                                        <td>1</td>
                                                        <td>60.00</td>
                                                        <td>Penyimpanan</td>
                                                        <td>0</td>
                                                        <td>perlu_perbaikan</td>
                                                        <td>Lembab, perlu perbaikan dinding</td>
                                                    </tr>
                                                    <tr>
                                                        <td>RKT05</td>
                                                        <td>Ruang Tunggu Tamu</td>
                                                        <td>1</td>
                                                        <td>50.00</td>
                                                        <td>Lobby</td>
                                                        <td>15</td>
                                                        <td>baik</td>
                                                        <td>Dilengkapi sofa dan meja tamu</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tabel Ruangan -->


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>




        <!-- End content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer bg-white text-black">
            <strong>Copyright &copy; 2025 <a href="#">Lpptsi. </a>Umkuningan.</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Script -->
    <?php include 'components/script.php' ?>
    <!-- End Script -->
</body>

</html>