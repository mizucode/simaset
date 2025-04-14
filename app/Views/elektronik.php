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
                                <h3 class="card-title mb-0">Data Inventaris Barang Elektronik Kampus</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-sm text-center">
                                        <thead class="bg-navy text-white">
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Kode</th>
                                                <th>Kategori</th>
                                                <th>Merk / Tipe</th>
                                                <th>Jumlah</th>
                                                <th>Kondisi</th>
                                                <th>Status</th>
                                                <th>Lokasi</th>
                                                <th>Tahun</th>
                                                <th>Tanggal Input</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-gray-50">
                                            <tr>
                                                <td>Proyektor Epson EB-S41</td>
                                                <td>ELK-001</td>
                                                <td>Proyektor</td>
                                                <td>Epson / EB-S41</td>
                                                <td>3</td>
                                                <td><span class="badge bg-success">Baik</span></td>
                                                <td><span class="badge bg-primary">Aktif</span></td>
                                                <td>Ruang Dosen Lantai 2</td>
                                                <td>2022</td>
                                                <td>2024-02-15</td>
                                            </tr>
                                            <tr>
                                                <td>Laptop Lenovo IdeaPad</td>
                                                <td>ELK-002</td>
                                                <td>Laptop</td>
                                                <td>Lenovo / IdeaPad 3</td>
                                                <td>5</td>
                                                <td><span class="badge bg-success">Baik</span></td>
                                                <td><span class="badge bg-primary">Aktif</span></td>
                                                <td>Lab Komputer</td>
                                                <td>2023</td>
                                                <td>2024-02-15</td>
                                            </tr>
                                            <tr>
                                                <td>Printer Canon G2010</td>
                                                <td>ELK-003</td>
                                                <td>Printer</td>
                                                <td>Canon / G2010</td>
                                                <td>2</td>
                                                <td><span class="badge bg-warning text-dark">Rusak Ringan</span></td>
                                                <td><span class="badge bg-secondary">Tidak Aktif</span></td>
                                                <td>Ruang TU</td>
                                                <td>2021</td>
                                                <td>2024-02-15</td>
                                            </tr>
                                            <tr>
                                                <td>Speaker Bluetooth JBL</td>
                                                <td>ELK-004</td>
                                                <td>Speaker</td>
                                                <td>JBL / Flip 5</td>
                                                <td>1</td>
                                                <td><span class="badge bg-danger">Rusak Berat</span></td>
                                                <td><span class="badge bg-secondary">Tidak Aktif</span></td>
                                                <td>Gudang Sarana</td>
                                                <td>2020</td>
                                                <td>2024-02-15</td>
                                            </tr>
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