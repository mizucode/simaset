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
                            <div class="card-header bg-navy text-white">
                                <h3 class="card-title">Data Aset Barang Bergerak</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-sm text-center">
                                        <thead class="bg-navy text-white">
                                            <tr>
                                                <th>Nama Kendaraan</th>
                                                <th>Jenis</th>
                                                <th>Merek</th>
                                                <th>Plat Nomor</th>
                                                <th>Lokasi</th>
                                                <th>Kondisi</th>
                                                <th>Status</th>
                                                <th>Tahun Perolehan</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-gray-50">
                                            <tr>
                                                <td>Honda Beat Biru</td>
                                                <td>Motor</td>
                                                <td>Honda</td>
                                                <td>AB 1234 XY</td>
                                                <td>Gedung Rektorat</td>
                                                <td><span class="badge bg-success">Baik</span></td>
                                                <td><span class="badge bg-primary">Digunakan</span></td>
                                                <td>2022</td>
                                                <td>Digunakan oleh bagian umum</td>
                                            </tr>
                                            <tr>
                                                <td>Grand Max Pick Up</td>
                                                <td>Mobil</td>
                                                <td>Daihatsu</td>
                                                <td>AB 9876 CD</td>
                                                <td>Garasi Kampus Tengah</td>
                                                <td><span class="badge bg-warning text-dark">Rusak Ringan</span></td>
                                                <td><span class="badge bg-secondary">Dalam Perbaikan</span></td>
                                                <td>2020</td>
                                                <td>Kerusakan pada sistem kelistrikan</td>
                                            </tr>
                                            <!-- Tambahkan baris lain sesuai data -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
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