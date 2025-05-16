<!DOCTYPE html>
<html lang="en">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php require_once './app/Views/Components/navbar.php'; ?>
        <?php require_once './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white mb-5 pt-3 px-4">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title text-lg">
                                        Pilih Kategori Pengeluaran Barang
                                    </h3>

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <h3>150</h3>
                                                <p>Data Barang</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-box"></i>
                                            </div>
                                            <a href="#" class="small-box-footer">
                                                Lihat <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->

                                    <!-- /.col -->
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>150</h3>
                                                <p>Data Barang Masuk</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-box-open"></i>
                                            </div>
                                            <a href="#" class="small-box-footer">
                                                Lihat <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- fix for small tambahdevices only -->
                                    <div class="clearfix hidden-md-up"></div>

                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="small-box bg-danger">
                                            <div class="inner">
                                                <h3>150</h3>
                                                <p>Data Barang Keluar</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-cart-arrow-down"></i>
                                            </div>
                                            <a href="#" class="small-box-footer">
                                                Lihat <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <h3>150</h3>
                                                <p>Data Jenis Barang</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-file"></i>
                                            </div>
                                            <a href="#" class="small-box-footer">
                                                Lihat <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <!-- /.col -->

                                    <!-- /.col -->
                                    <!-- /.col -->

                                    <!-- /.col -->
                                    <!-- /.col -->

                                    <!-- /.col -->
                                    <!-- /.col -->

                                    <!-- /.col -->

                                    <!-- /.col -->
                                    <!-- /.col -->

                                    <!-- /.col -->
                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once './app/Views/Components/footer.php'; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script>
        document.getElementById('btnExportExcel').addEventListener('click', function() {
            // Ambil tabel yang akan di-export
            const table = document.querySelector('.table');

            // Konversi tabel ke workbook SheetJS
            const workbook = XLSX.utils.table_to_book(table);

            // Generate file XLSX
            XLSX.writeFile(workbook, 'Laporan_Inventaris_Semesteran.xlsx', {
                bookType: 'xlsx',
                type: 'file'
            });
        });

        // Jika ingin menyesuaikan data sebelum export
        function exportToExcel() {
            const table = document.querySelector('.table');
            const rows = table.querySelectorAll('tr');
            const data = [];

            // Ambil header
            const headers = [];
            table.querySelectorAll('thead th').forEach(th => {
                headers.push(th.innerText);
            });
            data.push(headers);

            // Ambil data per row
            rows.forEach((row, index) => {
                // Skip header jika sudah diambil terpisah
                if (index === 0) return;

                const rowData = [];
                row.querySelectorAll('td').forEach(td => {
                    rowData.push(td.innerText);
                });
                data.push(rowData);
            });

            // Buat worksheet
            const ws = XLSX.utils.aoa_to_sheet(data);

            // Buat workbook
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Laporan");

            // Export ke file
            XLSX.writeFile(wb, 'Laporan_Inventaris.xlsx');
        }
    </script>

    <?php require_once './app/Views/Components/script.php'; ?>
</body>

</html>