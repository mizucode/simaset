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
                        <div class="card bg-white shadow-sm">
                            <div class="card-header bg-navy text-white">
                                <h3 class="card-title mb-0">Data Penempatan Barang Kampus</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-sm text-center">
                                        <thead class="bg-navy text-white">
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Kode</th>
                                                <th>Ruangan</th>
                                                <th>Gedung</th>
                                                <th>Kondisi</th>
                                                <th>Tanggal Penempatan</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-gray-50">
                                            <tr>
                                                <td>Proyektor Epson</td>
                                                <td>BRG-001</td>
                                                <td>Ruang 204</td>
                                                <td>Gedung A</td>
                                                <td><span class="badge bg-success">Baik</span></td>
                                                <td>2024-02-15</td>
                                                <td>Digunakan untuk presentasi kelas</td>
                                            </tr>
                                            <tr>
                                                <td>Kursi Lipat</td>
                                                <td>BRG-032</td>
                                                <td>Aula Besar</td>
                                                <td>Gedung C</td>
                                                <td><span class="badge bg-warning text-dark">Rusak Ringan</span></td>
                                                <td>2023-12-01</td>
                                                <td>Beberapa kaki kursi goyang</td>
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