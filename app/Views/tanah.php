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
                                <h3 class="card-title">Data Aset Tanah</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-sm">
                                        <thead class="bg-navy">
                                            <tr>
                                                <th>Nama Tanah</th>
                                                <th>Luas</th>
                                                <th>Alamat</th>
                                                <th>Jenis Tanah</th>
                                                <th>Status Kepemilikan</th>
                                                <th>Nilai Tanah</th>
                                                <th>Koordinat Lat</th>
                                                <th>Koordinat Long</th>
                                                <th>Tanggal Tercatat</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Contoh Tanah A</td>
                                                <td>1000 m²</td>
                                                <td>Jl. Contoh No. 123</td>
                                                <td>Perkebunan</td>
                                                <td>Milik Pemerintah</td>
                                                <td>Rp 500.000.000</td>
                                                <td>-6.200000</td>
                                                <td>106.816666</td>
                                                <td>2023-05-01</td>
                                                <td>Tidak ada</td>
                                            </tr>
                                            <tr>
                                                <td>Contoh Tanah B</td>
                                                <td>800 m²</td>
                                                <td>Jl. Lain No. 456</td>
                                                <td>Tanah Kosong</td>
                                                <td>Hibah</td>
                                                <td>Rp 350.000.000</td>
                                                <td>-6.201000</td>
                                                <td>106.817000</td>
                                                <td>2023-07-20</td>
                                                <td>Siap dikembangkan</td>
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