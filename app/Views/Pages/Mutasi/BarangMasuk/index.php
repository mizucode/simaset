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
                                <style>
                                    .custom-dashboard-card .small-box {
                                        border-radius: 0.375rem;
                                        /* Sedikit lebih rounded */
                                        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
                                        transition: all 0.3s ease-in-out;
                                        height: 100%;
                                        /* Penting untuk equal height */
                                        display: flex;
                                        flex-direction: column;
                                    }

                                    .custom-dashboard-card .small-box:hover {
                                        transform: translateY(-4px);
                                        box-shadow: 0 5px 15px rgba(0, 0, 0, .2);
                                    }

                                    .custom-dashboard-card .small-box .inner {
                                        padding: 15px;
                                        /* Padding yang konsisten */
                                        flex-grow: 1;
                                        /* Membuat konten inner mengisi ruang yang tersedia */
                                    }

                                    .custom-dashboard-card .small-box .inner h3 {
                                        font-size: 1.5rem;
                                        /* Sedikit disesuaikan untuk keseimbangan */
                                        margin-bottom: 0.5rem;
                                        /* Jarak ke paragraf */
                                        font-weight: 600;
                                        /* Lebih tebal jika belum */
                                        color: inherit;
                                        /* Memastikan warna teks kontras dengan background */
                                    }

                                    .custom-dashboard-card .small-box .inner p {
                                        font-size: 0.875rem;
                                        /* Ukuran deskripsi yang lebih kecil */
                                        line-height: 1.5;
                                        /* Keterbacaan baris */
                                        margin-bottom: 0;
                                        /* Hapus margin bawah jika footer langsung di bawah */
                                    }

                                    /* .custom-dashboard-card .small-box .icon { */
                                    /* Styling ikon default AdminLTE biasanya sudah cukup baik. */
                                    /* Jika Anda ingin override: */
                                    /* opacity: 0.7; */
                                    /* transition: all .3s linear; */
                                    /* } */

                                    /* .custom-dashboard-card .small-box:hover .icon { */
                                    /* font-size: 95px;  Contoh efek hover pada ikon jika diperlukan */
                                    /* opacity: 0.5; */
                                    /* } */

                                    .custom-dashboard-card .small-box .small-box-footer {
                                        padding: 10px 0;
                                        /* Sedikit padding vertikal */
                                        margin-top: auto;
                                        /* Mendorong footer ke bagian bawah card */
                                    }
                                </style>

                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-3 mb-4 custom-dashboard-card">
                                        <div class="small-box bg-danger">
                                            <div class="inner">
                                                <h3>Barang Bergerak</h3>
                                                <p>Tambah Barang Bergerak</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-truck-moving fa-3x"></i>
                                            </div>
                                            <a href="/admin/sarana/bergerak/tambah" class="small-box-footer">
                                                Tambahkan Data <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 mb-4 custom-dashboard-card">
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <h3>Barang Mebelair</h3>
                                                <p>Tambah Barang Mebelair</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-couch fa-3x"></i>
                                            </div>
                                            <a href="/admin/sarana/mebelair/tambah" class="small-box-footer">
                                                Tambahkan Data <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 mb-4 custom-dashboard-card">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>Barang Elektronik</h3>
                                                <p>Tambah Barang Elektronik</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-laptop fa-3x"></i>
                                            </div>
                                            <a href="/admin/sarana/elektronik/tambah" class="small-box-footer">
                                                Tambahkan Data <i class="fas fa-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-3 mb-4 custom-dashboard-card">
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <h3>Barang ATK</h3>
                                                <p>Tambah Alat Tulis Kantor</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-pencil-alt fa-3x"></i>
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