<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>
        <style>
            /* Scroll hanya tabel */
            .table-responsive {
                max-height: 400px;
                overflow-y: auto;
            }

            /* Tetap posisikan pagination + info di bawah */
            #example1_wrapper {
                display: flex;
                flex-direction: column;
            }

            #example1_wrapper .dataTables_paginate,
            #example1_wrapper .dataTables_info {
                position: sticky;
                bottom: 0;
                background: white;
                z-index: 10;
                padding: 10px 0;
            }
        </style>

        <div class="content-wrapper bg-white py-4 mb-5 px-5">
            <div class="container-fluid">
                <?php include './app/Views/Components/helper.php'; ?>

                <!-- Form Tambah Data -->
                <div class="row">
                    <div class="col-12">
                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                        <?php endif; ?>

                        <div class="card card-success card-outline">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Formulir Tambah Data Elektronik</h3>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                            <div class="card-body">
                                <form action="/admin/sarana/elektronik" method="POST">
                                    <input type="hidden" name="id">
                                    <input type="hidden" name="kategori_id" value="4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Barang</label>
                                                <select name="barang_id" class="form-control" required>
                                                    <option value="" disabled selected hidden>Pilih Barang</option>
                                                    <?php foreach ($barangData as $barang) : ?>
                                                        <?php if ($barang['kategori_id'] == 4) : ?>
                                                            <option value="<?= $barang['id']; ?>">
                                                                <?= htmlspecialchars($barang['kode_barang']); ?> - <?= htmlspecialchars($barang['nama_barang']); ?>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control" required>
                                                    <?php foreach ($statusOptions as $status) : ?>
                                                        <option value="<?= htmlspecialchars($status); ?>">
                                                            <?= htmlspecialchars(ucwords(str_replace('_', ' ', $status))); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Spesifikasi</label>
                                                <input type="text" name="spesifikasi" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Merk</label>
                                                <input type="text" name="merk" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tipe / Model</label>
                                                <input type="text" name="tipe_model" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input type="number" placeholder="1" name="jumlah" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="satuan">Satuan</label>
                                                <select name="satuan" class="form-control" required>
                                                    <option value="">-- Pilih Satuan --</option>
                                                    <option value="Unit">Unit</option>
                                                    <option value="Buah">Buah</option>
                                                    <option value="Pcs">Pcs</option>
                                                    <option value="Lembar">Lembar</option>
                                                    <option value="Kg">Kg</option>
                                                    <option value="Liter">Liter</option>
                                                    <option value="Box">Box</option>
                                                    <option value="Pack">Pack</option>
                                                    <option value="Set">Set</option>
                                                    <option value="Meter">Meter</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kondisi Terakhir</label>
                                                <select name="kondisi_terakhir" class="form-control" required>
                                                    <?php foreach ($kondisiTerakhirOptions as $kt) : ?>
                                                        <option value="<?= htmlspecialchars($kt); ?>">
                                                            <?= htmlspecialchars(ucwords(str_replace('_', ' ', $kt))); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text" name="keterangan" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- card -->
                    </div>
                </div>

                <!-- Tabel Data -->
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="card">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                                <h3 class="h4 mb-0">Data Barang Elektronik</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Status</th>
                                                <th>Spesifikasi</th>
                                                <th>Merk</th>
                                                <th>Tipe / Model</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Kondisi Terakhir</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($barangElektronikData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($barangElektronikData as $barang) : ?>
                                                    <tr>
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($barang['kode_barang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_barang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['status'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['spesifikasi'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['merk'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['tipe_model'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['jumlah'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['satuan'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['kondisi_terakhir'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['keterangan'] ?? '-'); ?></td>
                                                        <td class="text-nowrap">
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#modalBarang"
                                                                    data-id="<?= $barang['id']; ?>"
                                                                    data-barang_id="<?= $barang['barang_id']; ?>"
                                                                    data-kode="<?= $barang['kode_barang']; ?>"
                                                                    data-nama="<?= $barang['nama_barang']; ?>"
                                                                    data-status="<?= $barang['status']; ?>"
                                                                    data-jenis="<?= $barang['spesifikasi']; ?>"
                                                                    data-merk="<?= $barang['merk']; ?>"
                                                                    data-tipe="<?= $barang['tipe_model']; ?>"
                                                                    data-jumlah="<?= $barang['jumlah']; ?>"
                                                                    data-satuan="<?= $barang['satuan']; ?>"
                                                                    data-kondisi="<?= $barang['kondisi_terakhir']; ?>"
                                                                    data-keterangan="<?= $barang['keterangan']; ?>">
                                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                                </button>
                                                                <a href="/admin/sarana/elektronik?delete=<?= $barang['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="12" class="text-center">Data tidak ditemukan</td>
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

        <!-- Modal Form Edit -->
        <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary mb-0">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Form Data Barang</h3>
                        </div>
                        <form action="/admin/sarana/elektronik" method="POST">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="kategori_id" value="4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <select name="barang_id" id="barang_id" class="form-control" required>
                                                <option value="" disabled selected hidden>Pilih Barang</option>
                                                <?php foreach ($barangData as $barang) : ?>
                                                    <?php if ($barang['kategori_id'] == 4) : ?>
                                                        <option value="<?= $barang['id']; ?>">
                                                            <?= htmlspecialchars($barang['kode_barang']); ?> - <?= htmlspecialchars($barang['nama_barang']); ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <?php foreach ($statusOptions as $status) : ?>
                                                    <option value="<?= htmlspecialchars($status); ?>">
                                                        <?= htmlspecialchars(ucwords(str_replace('_', ' ', $status))); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Spesifikasi</label>
                                            <input type="text" name="spesifikasi" id="spesifikasi" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Merk</label>
                                            <input type="text" name="merk" id="merk" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipe / Model</label>
                                            <input type="text" name="tipe_model" id="tipe_model" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" placeholder="1" name="jumlah" id="jumlah" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan">Satuan</label>
                                            <select name="satuan" id="satuan" class="form-control" required>
                                                <option value="">-- Pilih Satuan --</option>
                                                <option value="Unit">Unit</option>
                                                <option value="Buah">Buah</option>
                                                <option value="Pcs">Pcs</option>
                                                <option value="Lembar">Lembar</option>
                                                <option value="Kg">Kg</option>
                                                <option value="Liter">Liter</option>
                                                <option value="Box">Box</option>
                                                <option value="Pack">Pack</option>
                                                <option value="Set">Set</option>
                                                <option value="Meter">Meter</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kondisi Terakhir</label>
                                            <select name="kondisi_terakhir" id="kondisi_terakhir" class="form-control" required>
                                                <?php foreach ($kondisiTerakhirOptions as $kt) : ?>
                                                    <option value="<?= htmlspecialchars($kt); ?>">
                                                        <?= htmlspecialchars(ucwords(str_replace('_', ' ', $kt))); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer bg-white text-black">
            <strong>&copy; 2025 <a href="#">Lpptsi</a>. Umkuningan.</strong>
        </footer>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
        $("#example1").DataTable({
            responsive: true,
            lengthChange: true,
            ordering: true,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                zeroRecords: "Data tidak ditemukan"
            }
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".btn-edit");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    document.getElementById("modalTitle").textContent = "Edit Data Barang";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";

                    document.getElementById("id").value = this.dataset.id;
                    document.getElementById("barang_id").value = this.dataset.barang_id;
                    document.getElementById("status").value = this.dataset.status;
                    document.getElementById("spesifikasi").value = this.dataset.jenis;
                    document.getElementById("merk").value = this.dataset.merk;
                    document.getElementById("tipe_model").value = this.dataset.tipe;
                    document.getElementById("jumlah").value = this.dataset.jumlah;
                    document.getElementById("satuan").value = this.dataset.satuan;
                    document.getElementById("kondisi_terakhir").value = this.dataset.kondisi;
                    document.getElementById("keterangan").value = this.dataset.keterangan;
                });
            });

            $('#modalBarang').on('hidden.bs.modal', function() {
                document.getElementById("modalTitle").textContent = "Form Data Barang";
                document.getElementById("submitBtn").textContent = "Simpan";
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("id").value = "";
            });
        });
    </script>
</body>

</html>