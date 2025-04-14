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
                                <h3 class="card-title">Data Aset Mebel</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-sm">
                                        <thead class="bg-navy">
                                            <tr>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Kondisi</th>
                                                <th>Lokasi</th>
                                                <th>Tanggal Pembelian</th>
                                                <th>Harga</th>
                                                <th>Supplier</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>MBL001</td>
                                                <td>Meja Kantor</td>
                                                <td>10</td>
                                                <td>Baik</td>
                                                <td>Gedung A, Ruang 101</td>
                                                <td>2023-01-15</td>
                                                <td>Rp 1.500.000</td>
                                                <td>Supplier X</td>
                                                <td>Tidak ada</td>
                                            </tr>
                                            <tr>
                                                <td>MBL002</td>
                                                <td>Kursi Kantor</td>
                                                <td>20</td>
                                                <td>Perlu Perbaikan</td>
                                                <td>Gedung B, Ruang 202</td>
                                                <td>2022-10-10</td>
                                                <td>Rp 500.000</td>
                                                <td>Supplier Y</td>
                                                <td>Sudah rusak bagian sandaran</td>
                                            </tr>
                                            <tr>
                                                <td>MBL003</td>
                                                <td>Lemari Arsip</td>
                                                <td>5</td>
                                                <td>Rusak</td>
                                                <td>Gedung C, Ruang 305</td>
                                                <td>2021-05-20</td>
                                                <td>Rp 2.000.000</td>
                                                <td>Supplier Z</td>
                                                <td>Tidak bisa dikunci</td>
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