<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white mb-5 pt-3 ">
      <div class="container-fluid ">
        <div class="row justify-content-center ">
          <div class="col-12">
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
                  FORMULIR TAMBAH DATA LAPANG
                </h3>
              </div>

              <form action="/admin/prasarana/lapang/tambah" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">

                      <!-- Data Identitas Lapang -->
                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS LAPANG
                          </h5>
                          <span class="form-text">Silahkan isi data identitas lapang dengan lengkap.</span>
                        </div>

                        <!-- Kode Lapang -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group mb-4">
                            <label for="kode_lapang" class="fw-bold">Kode Lapang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kode_lapang" name="kode_lapang" placeholder="Akan di-generate otomatis" readonly required>
                            <span class="form-text">Format: PRS-LPG-XXXX (di-generate otomatis).</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Nama Lapang -->
                          <div class="form-group">
                            <label for="nama_lapang" class="fw-bold">Nama Lapang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_lapang" name="nama_lapang" placeholder="Contoh: Lapangan Basket Utama" required>
                            <span class="form-text">Masukkan nama lengkap atau deskriptif untuk lapang.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Luas -->
                          <div class="form-group">
                            <label for="luas" class="fw-bold">Luas Lapang (m²) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="luas" name="luas" placeholder="Masukkan luas lapang dalam meter persegi" required>
                            <span class="form-text">Masukkan luas total lapang dalam meter persegi.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Kategori -->
                          <div class="form-group">
                            <label for="kategori" class="fw-bold">Kategori Lapang</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Contoh: Olahraga, Upacara, Parkir">
                            <span class="form-text">Masukkan kategori atau jenis lapang (misal: Olahraga, Upacara, Parkir).</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Jenis Aset -->
                          <div class="form-group">
                            <label for="jenis_aset_id" class="fw-bold">Jenis Aset <span class="text-danger">*</span></label>
                            <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                              <option value="" disabled selected>Pilih Jenis Aset</option>
                              <?php foreach ($jenisAsetList as $jenisAset): ?>
                                <option value="<?= htmlspecialchars($jenisAset['id']) ?>">
                                  <?= htmlspecialchars($jenisAset['jenis_aset']) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih klasifikasi jenis aset untuk lapang ini.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Lokasi -->
                          <div class="form-group">
                            <label for="lokasi" class="fw-bold">Lokasi <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="lokasi" name="lokasi" rows="2" placeholder="Contoh: Area Belakang Gedung Rektorat" required></textarea>
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
                          <div class="form-group">
                            <label for="status" class="fw-bold">Status Lapang <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                              <option value="" disabled selected>Pilih status lapang</option>
                              <option value="Terpakai">Terpakai</option>
                              <option value="Kosong">Kosong</option>
                              <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                            </select>
                            <span class="form-text">Pilih status penggunaan lapang saat ini.</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Kondisi Lapang -->
                          <div class="form-group">
                            <label for="kondisi" class="fw-bold">Kondisi Lapang <span class="text-danger">*</span></label>
                            <select class="form-control" id="kondisi" name="kondisi" required>
                              <option value="" disabled selected>Pilih kondisi lapang</option>
                              <option value="Baik">Baik</option>
                              <option value="Rusak Ringan">Rusak Ringan</option>
                              <option value="Rusak Berat">Rusak Berat</option>
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
                          <!-- Fungsi -->
                          <div class="form-group">
                            <label for="fungsi" class="fw-bold">Fungsi</label>
                            <input type="text" class="form-control" id="fungsi" name="fungsi" placeholder="Contoh: Kegiatan Olahraga, Upacara Bendera">
                            <span class="form-text">Jelaskan fungsi utama dari lapang ini (opsional).</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Keterangan -->
                          <div class="form-group">
                            <label for="keterangan" class="fw-bold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                            <span class="form-text">Tambahkan catatan atau keterangan lain yang relevan (opsional).</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right">
                  <a href="/admin/prasarana/lapang" class="btn btn-secondary">
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Data Lapang
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

  <!-- Initialize Select2 -->
  <script>
    $(document).ready(function() {
      $('#jenis_aset_id').select2({
        placeholder: "Pilih Jenis Aset",
        allowClear: true,
        minimumResultsForSearch: Infinity, // Sembunyikan kotak pencarian jika tidak banyak opsi
        theme: 'bootstrap4'
      });

      $('#status').select2({
        placeholder: "Pilih Status Lapang",
        allowClear: true,
        minimumResultsForSearch: Infinity,
        theme: 'bootstrap4'
      });

      $('#kondisi').select2({
        placeholder: "Pilih Kondisi Lapang",
        allowClear: true,
        minimumResultsForSearch: Infinity,
        theme: 'bootstrap4'
      });
    });
  </script>

</body>

</html>