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
                                    <a href="/admin/transaksi/mutasi/barang-masuk/tambah" class="btn btn-warning btn-sm">
                                        <i class="fas fa-plus mr-1"></i>Tambah Data
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari data penerimaan...">
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
                                                <th width="10%">Tanggal Terima</th>
                                                <th width="15%">Sumber Barang</th>
                                                <th width="20%">Nama Barang</th>
                                                <th width="10%">Jumlah</th>
                                                <th width="10%">Kondisi</th>
                                                <th width="10%">No. Nota</th>
                                                <th width="10%">Keterangan</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($mutasiBM as $data):
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++ ?></td>
                                                    <td><?= date('d M Y', strtotime($data['tanggal_penerimaan'])) ?></td>
                                                    <td><?= htmlspecialchars($data['sumber_barang']) ?></td>
                                                    <td><?= htmlspecialchars($data['nama_barang']) ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($data['jumlah']) ?></td>
                                                    <td class="text-center">
                                                        <span class="badge <?= $data['kondisi'] == 'Baik' ? 'badge-success' : 'badge-danger' ?>">
                                                            <?= htmlspecialchars($data['kondisi']) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= htmlspecialchars($data['nomor_nota']) ?></td>
                                                    <td><?= htmlspecialchars($data['keterangan']) ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="/admin/transaksi/mutasi/barang-masuk?edit=<?= htmlspecialchars($data['id']) ?>" class="btn btn-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="/admin/transaksi/mutasi/barang-masuk?delete=<?= htmlspecialchars($data['id']) ?>" class="btn btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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