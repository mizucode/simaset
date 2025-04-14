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
                                <h3 class="card-title">Data Barang Alat Tulis Kantor</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-sm">
                                        <thead class="bg-navy">
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Kode Barang</th>
                                                <th>Kategori</th>
                                                <th>Stok</th>
                                                <th>Satuan</th>
                                                <th>Harga Per Satuan</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Tanggal Expired</th>
                                                <th>Status</th>
                                                <th>Lokasi</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Pensil</td>
                                                <td>PENS001</td>
                                                <td>Alat Tulis</td>
                                                <td>100</td>
                                                <td>Buah</td>
                                                <td>Rp 1.500</td>
                                                <td>2025-04-01</td>
                                                <td>2026-04-01</td>
                                                <td>Tersedia</td>
                                                <td>Gudang A</td>
                                                <td>Pensil merk ABC</td>
                                            </tr>
                                            <tr>
                                                <td>Kertas HVS A4</td>
                                                <td>KERT001</td>
                                                <td>Kertas</td>
                                                <td>50</td>
                                                <td>Paket</td>
                                                <td>Rp 25.000</td>
                                                <td>2025-03-15</td>
                                                <td>2026-03-15</td>
                                                <td>Tersedia</td>
                                                <td>Gudang B</td>
                                                <td>1 Paket = 500 Lembar</td>
                                            </tr>
                                            <tr>
                                                <td>Spidol</td>
                                                <td>SPID001</td>
                                                <td>Alat Tulis</td>
                                                <td>30</td>
                                                <td>Buah</td>
                                                <td>Rp 10.000</td>
                                                <td>2025-03-20</td>
                                                <td>2026-03-20</td>
                                                <td>Habis</td>
                                                <td>Gudang C</td>
                                                <td>Spidol merk XYZ</td>
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