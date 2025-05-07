<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white py-4 mb-5 px-2">
            <div class="container-fluid">
                <?php include './app/Views/Components/helper.php'; ?>
                <div class="row">
                    <div class="col-12">
                        <?php if (isset($error)) : ?>
                            <div style="color: red; background-color: #fdd; padding: 10px; margin-bottom: 10px;">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center align-content-center">
                                <h3 class="h4">Data Lapangan</h3>
                                <a href="/admin/prasarana/lapang/tambah" class="btn btn-warning text-dark ml-auto">
                                    <div class="text-dark d-flex flex-row align-items-center gap-2">
                                        <i class="fas fa-plus mr-1"></i>
                                        Tambah Data
                                    </div>
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="jsgrid-wrapper">
                                    <table class="jsgrid-table">
                                        <thead>
                                            <tr class="jsgrid-header-row">
                                                <th>No</th>
                                                <th>Kode Lapang</th>
                                                <th>Nama Lapang</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($lapangData) && is_array($lapangData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($lapangData as $lapang) : ?>
                                                    <tr class="jsgrid-row">
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($lapang['kode_lapang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($lapang['nama_lapang'] ?? '-'); ?></td>

                                                        <td>
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#modallapang"
                                                                    data-id="<?= $lapang['id']; ?>"
                                                                    data-kode="<?= $lapang['kode_lapang']; ?>"
                                                                    data-nama="<?= $lapang['nama_lapang']; ?>">
                                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                                </button>

                                                                <a href="/admin/prasarana/lapang?delete=<?= $lapang['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                                </a>
                                                            </div>
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
                            </div>
                        </div> <!-- card -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Form -->
        <div class="modal fade" id="modallapang" tabindex="-1" role="dialog" aria-labelledby="modallapangLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card card-primary mb-0">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Form Data lapang</h3>
                        </div>

                        <form action="/admin/prasarana/lapang" method="POST">
                            <input type="hidden" name="id" id="id">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Kode lapangan</label>
                                            <input type="text" name="kode_lapang" id="kode_lapang" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama lapangan</label>
                                            <input type="text" name="nama_lapang" id="nama_lapang" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                            </div>
                        </form>
                    </div> <!-- /.card -->
                </div>
            </div>
        </div>

        <footer class="main-footer bg-white text-black">
            <strong>&copy; 2025 <a href="#">Lpptsi</a>. Umkuningan.</strong>
        </footer>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".btn-edit");
            const modal = document.getElementById("modallapang");
            const modalTitle = document.getElementById("modalTitle");
            const submitBtn = document.getElementById("submitBtn");
            const idInput = document.getElementById("id");
            const kodeInput = document.getElementById("kode_lapang");
            const namaInput = document.getElementById("nama_lapang");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    modalTitle.textContent = "Edit Data lapang";
                    submitBtn.textContent = "Update Data";
                    submitBtn.className = "btn btn-warning";
                    idInput.value = this.dataset.id;
                    kodeInput.value = this.dataset.kode;
                    namaInput.value = this.dataset.nama;
                });
            });

            $('#modallapang').on('hidden.bs.modal', function() {
                modalTitle.textContent = "Form Data lapang";
                submitBtn.textContent = "Simpan";
                submitBtn.className = "btn btn-primary";
                document.querySelector("form").reset();
                idInput.value = "";
            });
        });
    </script>

</body>

</html>