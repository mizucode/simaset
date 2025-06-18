<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>
<!-- Apply px-3 to body to match create.php -->

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>
    <div class="content-wrapper bg-white mb-5 pt-3 "> <!-- Removed px-4 -->
      <div class="container-fluid ">
        <div class="row justify-content-center ">
          <div class="col-12 ">
            <?php if (!empty($error)) : ?>
              <div class="alert alert-danger alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <?= htmlspecialchars($error); ?>
              </div>
            <?php endif; ?>

            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <h3 class="card-title text-bold">
                  EDIT DATA LAPANG
                </h3>
              </div>

              <form action="<?= isset($lapang) ? '/admin/prasarana/lapang?edit=' . $lapang['id'] : '/admin/prasarana/lapang/tambah' ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $lapang['id'] ?>">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <!-- Data Identitas Lapang -->
                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS LAPANG
                          </h5>
                          <span class="form-text">Silahkan perbarui data identitas lapang dengan lengkap.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <!-- Kode Lapang -->
                          <div class="form-group mb-4">
                            <label for="kode_lapang" class="font-weight-bold">Kode Lapang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kode_lapang" name="kode_lapang" value="<?= htmlspecialchars($lapang['kode_lapang'] ?? '') ?>" readonly required>
                            <span class="form-text">Kode unik untuk lapang (tidak dapat diubah).</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Nama Lapang -->
                          <div class="form-group mb-4">
                            <label for="nama_lapang" class="font-weight-bold">Nama Lapang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_lapang" name="nama_lapang" value="<?= htmlspecialchars($lapang['nama_lapang'] ?? '') ?>" required>
                            <span class="form-text">Masukkan nama lengkap atau deskriptif untuk lapang.</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Luas -->
                          <div class="form-group mb-4">
                            <label for="luas" class="font-weight-bold">Luas Lapang (m²) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="luas" name="luas" value="<?= htmlspecialchars($lapang['luas'] ?? '') ?>" required>
                            <span class="form-text">Masukkan luas total lapang dalam meter persegi.</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Kategori -->
                          <div class="form-group mb-4">
                            <label for="kategori" class="font-weight-bold">Kategori Lapang</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?= htmlspecialchars($lapang['kategori'] ?? '') ?>">
                            <span class="form-text">Masukkan kategori atau jenis lapang (misal: Olahraga, Upacara, Parkir).</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Lokasi -->
                          <div class="form-group mb-4">
                            <label for="lokasi" class="font-weight-bold">Lokasi <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="lokasi" name="lokasi" rows="2" required><?= htmlspecialchars($lapang['lokasi'] ?? '') ?></textarea>
                            <span class="form-text">Masukkan deskripsi detail lokasi lapang.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Kondisi Lapang -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            KONDISI LAPANG
                          </h5>
                          <span class="form-text">Pilih status dan kondisi terkini dari lapang.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Status -->
                          <div class="form-group mb-4">
                            <label for="status" class="font-weight-bold">Status Lapang <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                              <option value="" disabled>Pilih status lapang</option>
                              <option value="Terpakai" <?= ($lapang['status'] ?? '') == 'Terpakai' ? 'selected' : '' ?>>Terpakai</option>
                              <option value="Kosong" <?= ($lapang['status'] ?? '') == 'Kosong' ? 'selected' : '' ?>>Kosong</option>
                              <option value="Dalam Perbaikan" <?= ($lapang['status'] ?? '') == 'Dalam Perbaikan' ? 'selected' : '' ?>>Dalam Perbaikan</option>
                            </select>
                            <span class="form-text">Pilih status penggunaan lapang saat ini.</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Kondisi -->
                          <div class="form-group mb-4">
                            <label for="kondisi" class="font-weight-bold">Kondisi Lapang <span class="text-danger">*</span></label>
                            <select class="form-control" id="kondisi" name="kondisi" required>
                              <option value="" disabled>Pilih kondisi lapang</option>
                              <option value="Baik" <?= ($lapang['kondisi'] ?? '') == 'Baik' ? 'selected' : '' ?>>Baik</option>
                              <option value="Rusak Ringan" <?= ($lapang['kondisi'] ?? '') == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak Ringan</option>
                              <option value="Rusak Berat" <?= ($lapang['kondisi'] ?? '') == 'Rusak Berat' ? 'selected' : '' ?>>Rusak Berat</option>
                            </select>
                            <span class="form-text">Pilih kondisi fisik lapang secara umum.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Tambahan -->
                      <div class="col-12 mt-4">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            INFORMASI TAMBAHAN
                          </h5>
                          <span class="form-text">Isi fungsi utama dan keterangan tambahan jika ada.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Jenis Aset -->
                          <div class="form-group mb-4">
                            <label for="jenis_aset_id" class="font-weight-bold">Jenis Aset <span class="text-danger">*</span></label>
                            <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                              <option value="" disabled>Pilih Jenis Aset</option>
                              <?php foreach ($jenisAsetList as $jenisAset): ?>
                                <option value="<?= $jenisAset['id'] ?>" <?= $jenisAset['id'] == ($lapang['jenis_aset_id'] ?? '') ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($jenisAset['jenis_aset']) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih klasifikasi jenis aset untuk lapang ini.</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Fungsi -->
                          <div class="form-group mb-4">
                            <label for="fungsi" class="font-weight-bold">Fungsi</label>
                            <input type="text" class="form-control" id="fungsi" name="fungsi" value="<?= htmlspecialchars($lapang['fungsi'] ?? '') ?>">
                            <span class="form-text">Jelaskan fungsi utama dari lapang ini (opsional).</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Keterangan -->
                          <div class="form-group mb-4">
                            <label for="keterangan" class="font-weight-bold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2"><?= htmlspecialchars($lapang['keterangan'] ?? '') ?></textarea>
                            <span class="form-text">Tambahkan catatan atau keterangan lain yang relevan (opsional).</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right text-white">
                  <a href="/admin/prasarana/lapang?detail=<?= htmlspecialchars($lapang['id']) ?>" class="btn btn-secondary">
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i> Perbarui Data Lapang
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include './app/Views/Components/footer.php'; ?>
  </div>

  <?php include './app/Views/Components/script.php'; ?>
  <script>
    $(document).ready(function() {
      // Initialize Select2 for all select elements
      $('select').select2({
        theme: 'bootstrap4',
        placeholder: $(this).data('placeholder') || 'Pilih salah satu',
        allowClear: Boolean($(this).data('allow-clear')) || false,
      });
    });
  </script>
</body>

</html>