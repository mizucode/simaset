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
                                <h3 class="card-title">Data Aset Gedung</h3>
                            </div>

                            <!-- Body Card -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-sm">
                                        <!-- Table Header -->
                                        <thead class="bg-navy text-white">
                                            <tr>
                                                <th>Kode Gedung</th>
                                                <th>Nama Gedung</th>
                                                <th>Lokasi</th>
                                                <th>Jumlah Lantai</th>
                                                <th>Luas Total (m²)</th>
                                                <th>Tahun Dibangun</th>
                                                <th>Kondisi</th>
                                                <th>Penanggung Jawab</th>
                                                <th>Kontak PJ</th>
                                                <th>Koordinat Lat</th>
                                                <th>Koordinat Long</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>

                                        <!-- Table Body -->
                                        <tbody>
                                            <tr>
                                                <td>GD001</td>
                                                <td>Gedung Rektorat</td>
                                                <td>Kampus A</td>
                                                <td>5</td>
                                                <td>1500.00</td>
                                                <td>2010</td>
                                                <td>baik</td>
                                                <td>Dr. Andi</td>
                                                <td>08123456789</td>
                                                <td>-6.200000</td>
                                                <td>106.816666</td>
                                                <td>Gedung pusat administrasi</td>
                                            </tr>
                                            <tr>
                                                <td>GD002</td>
                                                <td>Gedung Fakultas Teknik</td>
                                                <td>Kampus B</td>
                                                <td>3</td>
                                                <td>1000.00</td>
                                                <td>2015</td>
                                                <td>perlu_perbaikan</td>
                                                <td>Ibu Sari</td>
                                                <td>08234567890</td>
                                                <td>-6.201000</td>
                                                <td>106.817000</td>
                                                <td>Sedang renovasi atap</td>
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