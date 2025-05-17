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
                        <?php include './app/Views/Components/helper.php'; ?>
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title text-lg">
                                        Data Aset Ruang
                                    </h3>
                                    <a href="/admin/prasarana/ruang/tambah" class="btn btn-warning btn-sm ml-auto">
                                        <div class="text-dark">
                                            <i class="fas fa-plus mr-1"></i> Tambah Data
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="ruangTable" class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr class="text-center">
                                                <th width="5%">No</th>
                                                <th width="15%">Kode Ruang</th>
                                                <th width="60%">Nama Ruang</th>
                                                <th width="20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($ruangData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($ruangData as $ruang) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= $counter++; ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($ruang['kode_ruang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($ruang['nama_ruang'] ?? '-'); ?></td>
                                                        <td class="text-center">
                                                            <a href="/admin/prasarana/ruang?detail=<?= $ruang['id']; ?>" class="btn btn-sm btn-info" title="Detail">
                                                                <i class="fas fa-eye"></i> Detail
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="dataTables_info">
                                            Menampilkan <?= count($ruangData) ?> data
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
        // Fungsi Export Excel
        document.getElementById('btnExportExcel').addEventListener('click', function() {
            const table = document.getElementById('ruangTable');
            const workbook = XLSX.utils.table_to_book(table);
            XLSX.writeFile(workbook, 'Data_Aset_Ruang.xlsx');
        });

        // Fungsi Pencarian
        document.getElementById('searchButton').addEventListener('click', function() {
            const searchText = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#ruangTable tbody tr');

            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchText) ? '' : 'none';
            });
        });
    </script>

    <?php include './app/Views/Components/script.php'; ?>
</body>

</html>