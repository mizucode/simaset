<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white mb-5 pt-3 px-4">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title text-lg">
                                        Data Penerimaan Barang
                                    </h3>

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-3 mb-4">
                                        <div class="small-box bg-danger">
                                            <div class="inner" style="padding-bottom: 20px;">
                                                <h3 style="font-size: 1.6rem; margin-bottom: 5px;">Barang Bergerak</h3>
                                                <p class="w-50">Digunakan Untuk Menambahkan Barang Bergerak</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-truck-moving fa-2x"></i>
                                            </div>
                                            <a href="/admin/sarana/bergerak/tambah" class="small-box-footer">
                                                Tambahkan Data <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 mb-4">
                                        <div class="small-box bg-warning">
                                            <div class="inner" style="padding-bottom: 20px;">
                                                <h3 style="font-size: 1.6rem; margin-bottom: 5px;">Barang Mebelair</h3>
                                                <p class="w-50">Digunakan Untuk Menambahkan Barang Mebelair</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-couch fa-2x"></i>
                                            </div>
                                            <a href="/admin/sarana/mebelair/tambah" class="small-box-footer">
                                                Tambahkan Data <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 mb-4">
                                        <div class="small-box bg-info">
                                            <div class="inner" style="padding-bottom: 20px;">
                                                <h3 style="font-size: 1.6rem; margin-bottom: 5px;">Barang Elektronik</h3>
                                                <p class="w-50">Digunakan Untuk Menambahkan Barang Elektronik</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-laptop fa-2x"></i>
                                            </div>
                                            <a href="/admin/sarana/elektronik/tambah" class="small-box-footer">
                                                Tambahkan Data <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 mb-4">
                                        <div class="small-box bg-success">
                                            <div class="inner" style="padding-bottom: 20px;">
                                                <h3 style="font-size: 1.6rem; margin-bottom: 5px;">Barang ATK</h3>
                                                <p class="w-50">Digunakan Untuk Menambahkan Alat tulis Kantor</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-pencil-alt fa-2x"></i>
                                            </div>
                                            <a href="/admin/sarana/atk/tambah" class="small-box-footer">
                                                Tambahkan Data <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include './app/Views/Components/footer.php'; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script>
        document.getElementById('btnExportExcel').addEventListener('click', function() {
            // Ambil tabel yang akan di-export
            const table = document.querySelector('.table');

            // Konversi tabel ke workbook SheetJS
            const workbook = XLSX.utils.table_to_book(table);

            // Generate file XLSX
            XLSX.writeFile(workbook, 'Laporan_Penerimaan_Barang.xlsx', {
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
            XLSX.writeFile(wb, 'Laporan_Penerimaan_Barang.xlsx');
        }
    </script>

    <?php include './app/Views/Components/script.php'; ?>
</body>

</html>