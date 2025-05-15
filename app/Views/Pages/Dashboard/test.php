<!DOCTYPE html>
<html lang="en">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php require_once './app/Views/Components/navbar.php'; ?>
        <?php require_once './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white mb-5 pt-5 px-4">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title text-lg">
                                        Data Inventarisasi Sarpras Semesteran
                                    </h3>
                                    <a href="/admin/survey/semesteran/tambah" class="btn btn-warning btn-sm">
                                        <i class="fas fa-plus mr-1"></i>Tambah Data
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari data inventaris...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-secondary">
                                                <i class="fas fa-filter"></i> Filter
                                            </button>
                                            <button type="button" class="btn btn-outline-success" id="btnExportExcel">
                                                <i class="fas fa-file-excel"></i> Export Excel
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr class="text-center">
                                                <th width="5%">No</th>
                                                <th width="15%">Penanggung Jawab</th>
                                                <th width="10%">Semester</th>
                                                <th width="15%">Tahun Akademik</th>
                                                <th width="15%">Tanggal Pengecekan</th>
                                                <th width="15%">Lokasi Survey</th>
                                                <th width="13%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>John Doe</td>
                                                <td>Ganjil</td>
                                                <td>2023/2024</td>
                                                <td>15 Jan 2024</td>
                                                <td>Gedung A Lantai 2</td>
                                                <td>
                                                    <a href="/admin/survey/semesteran?edit=1" class="btn btn-info" title="Detail">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="dataTables_info">
                                            Menampilkan 1 sampai 3 dari 3 entri
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end">
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1">Sebelumnya</a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">Selanjutnya</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
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