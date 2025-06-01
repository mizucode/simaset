<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white mb-5 pt-3 px-4 ">
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

            <?php if (isset($_SESSION['update'])) : ?>
              <div class="alert alert-success alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <?= htmlspecialchars($_SESSION['update']); ?>
              </div>
              <?php unset($_SESSION['update']); ?>
            <?php endif; ?>

            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <h1 class="text-xl font-weight-bold">
                  <?= isset($gedung) ? 'Edit Data Gedung' : 'Formulir Data Gedung Baru' ?>
                  </h3>
              </div>

              <form action="<?= isset($gedung) ? '/admin/prasarana/gedung?edit=' . $gedung['id'] : '/admin/prasarana/gedung/tambah' ?>" method="POST">
                <?php if (isset($gedung)) : ?>
                  <input type="hidden" name="id" value="<?= htmlspecialchars($gedung['id']) ?>">
                <?php endif; ?>

                <div class="card-body">
                  <div class="row">
                    <!-- Data Identitas Gedung -->
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS GEDUNG
                        </h5>
                        <span class="form-text">Silahkan <?= isset($gedung) ? 'perbarui' : 'isi' ?> data identitas gedung dengan lengkap.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="kode_gedung" class="fw-bold">Kode Gedung <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="kode_gedung" name="kode_gedung"
                            value="<?= isset($gedung) ? htmlspecialchars($gedung['kode_gedung']) : '' ?>"
                            <?= isset($gedung) ? 'readonly' : '' ?> required>
                          <span class="form-text">Masukkan kode unik untuk gedung. Akan terisi otomatis jika membuat data baru.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="nama_gedung" class="fw-bold">Nama Gedung <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="nama_gedung" name="nama_gedung"
                            value="<?= isset($gedung) ? htmlspecialchars($gedung['nama_gedung']) : '' ?>"
                            placeholder="Contoh: Gedung Rektorat" required>
                          <span class="form-text">Masukkan nama lengkap atau deskriptif untuk gedung.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="luas" class="fw-bold">Luas Gedung (m²) <span class="text-danger">*</span></label>
                          <input type="number" step="0.01" class="form-control" id="luas" name="luas"
                            value="<?= isset($gedung) ? htmlspecialchars($gedung['luas']) : '' ?>"
                            placeholder="Masukkan luas gedung dalam meter persegi" required>
                          <span class="form-text">Masukkan luas total gedung dalam meter persegi.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="jumlah_lantai" class="fw-bold">Jumlah Lantai <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="jumlah_lantai" name="jumlah_lantai"
                            value="<?= isset($gedung) ? htmlspecialchars($gedung['jumlah_lantai']) : '' ?>"
                            placeholder="Masukkan jumlah lantai" required>
                          <span class="form-text">Masukkan jumlah lantai yang dimiliki gedung.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="lokasi" class="fw-bold">Lokasi Gedung <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="lokasi" name="lokasi" rows="2"
                            placeholder="Contoh: Jalan raya cigugur no. 14" required><?= isset($gedung) ? htmlspecialchars($gedung['lokasi']) : '' ?></textarea>
                          <span class="form-text">Masukkan alamat lengkap lokasi gedung.</span>
                        </div>
                      </div>
                    </div>

                    <!-- Data Konstruksi Gedung -->
                    <div class="col-12 mt-4 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          KONSTRUKSI GEDUNG
                        </h5>
                        <span class="form-text">Pilih jenis konstruksi dan kondisi terkini dari gedung.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="kontruksi" class="fw-bold">Jenis Konstruksi <span class="text-danger">*</span></label>
                          <select class="form-control" id="kontruksi" name="kontruksi" required>
                            <option value="" disabled <?= !isset($gedung) ? 'selected' : '' ?>>Pilih jenis konstruksi</option>
                            <option value="Beton" <?= (isset($gedung) && $gedung['kontruksi'] == 'Beton') ? 'selected' : '' ?>>Beton</option>
                            <option value="Baja" <?= (isset($gedung) && $gedung['kontruksi'] == 'Baja') ? 'selected' : '' ?>>Baja</option>
                            <option value="Kayu" <?= (isset($gedung) && $gedung['kontruksi'] == 'Kayu') ? 'selected' : '' ?>>Kayu</option>
                            <option value="Kombinasi" <?= (isset($gedung) && $gedung['kontruksi'] == 'Kombinasi') ? 'selected' : '' ?>>Kombinasi</option>
                          </select>
                          <span class="form-text">Pilih jenis material konstruksi utama gedung.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="kondisi" class="fw-bold">Kondisi Gedung <span class="text-danger">*</span></label>
                          <select class="form-control" id="kondisi" name="kondisi" required>
                            <option value="" disabled <?= !isset($gedung) ? 'selected' : '' ?>>Pilih kondisi gedung</option>
                            <option value="Baik" <?= (isset($gedung) && $gedung['kondisi'] == 'Baik') ? 'selected' : '' ?>>Baik</option>
                            <option value="Rusak Ringan" <?= (isset($gedung) && $gedung['kondisi'] == 'Rusak Ringan') ? 'selected' : '' ?>>Rusak Ringan</option>
                            <option value="Rusak Berat" <?= (isset($gedung) && $gedung['kondisi'] == 'Rusak Berat') ? 'selected' : '' ?>>Rusak Berat</option>
                          </select>
                          <span class="form-text">Pilih kondisi fisik gedung secara umum.</span>
                        </div>
                      </div>
                    </div>

                    <!-- Data Kepemilikan dan Fungsi -->
                    <div class="col-12 mt-4">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          KEPEMILIKAN DAN FUNGSI
                        </h5>
                        <span class="form-text">Isi informasi mengenai unit kepemilikan dan fungsi utama gedung.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Unit Kepemilikan -->
                        <div class="form-group">
                          <label for="unit_kepemilikan" class="fw-bold">Unit Kepemilikan <span class="text-danger">*</span></label>
                          <select class="form-control" name="unit_kepemilikan" id="unit_kepemilikan" required>
                            <option value="" disabled <?= !isset($gedung['unit_kepemilikan']) || empty($gedung['unit_kepemilikan']) ? 'selected' : '' ?>>Pilih Unit Kepemilikan</option>
                            <?php
                            $unitKepemilikanOptions = [
                              "Fakultas Pendidikan, Sosial, dan Teknologi",
                              "Fakultas Farmasi, Kesehatan, dan Sains",
                              "Universitas (Umum)"
                              // Tambahkan opsi lain jika perlu di sini
                            ];
                            foreach ($unitKepemilikanOptions as $option) : ?>
                              <option value="<?= htmlspecialchars($option) ?>" <?= (isset($gedung['unit_kepemilikan']) && $gedung['unit_kepemilikan'] == $option) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($option) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                          <span class="form-text">Pilih unit atau fakultas yang memiliki atau bertanggung jawab atas bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="fungsi" class="fw-bold">Fungsi Gedung <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="fungsi" name="fungsi"
                            value="<?= isset($gedung) ? htmlspecialchars($gedung['fungsi']) : '' ?>"
                            placeholder="Contoh: Perkantoran, Pendidikan" required>
                          <span class="form-text">Jelaskan fungsi utama dari gedung ini.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="jenis_aset_id" class="fw-bold">Jenis Aset <span class="text-danger">*</span></label>
                          <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                            <option value="" disabled <?= !isset($gedung) ? 'selected' : '' ?>>Pilih jenis aset</option>
                            <?php foreach ($jenisAsetId as $id): ?>
                              <option value="<?= htmlspecialchars($id['id']) ?>"
                                <?= (isset($gedung) && $gedung['jenis_aset_id'] == $id['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($id['jenis_aset']) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                          <span class="form-text">Pilih klasifikasi jenis aset untuk gedung ini.</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right">
                  <a href="/admin/prasarana/gedung" class="btn btn-secondary">
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    <?= isset($gedung) ? 'Update Data Gedung' : 'Simpan Data Gedung' ?>
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
    document.addEventListener('DOMContentLoaded', function() {
      const namaGedungInput = document.getElementById('nama_gedung');
      const kodeGedungInput = document.getElementById('kode_gedung');

      // Only generate kode gedung if we're creating new data
      <?php if (!isset($gedung)): ?>
        namaGedungInput.addEventListener('input', function() {
          let namaGedung = namaGedungInput.value.trim();

          if (namaGedung.length > 0) {
            // Ambil huruf pertama dari setiap kata
            let singkatan = namaGedung
              .split(' ')
              .filter(kata => kata.length > 0)
              .map(kata => kata.charAt(0).toUpperCase())
              .join('');

            // Gabungkan dengan awalan GDG-
            let kodeGedung = `GDG-${singkatan}`;
            kodeGedungInput.value = kodeGedung;
          } else {
            // Kosongkan jika nama gedung kosong
            kodeGedungInput.value = '';
          }
        });
      <?php endif; ?>
    });
  </script>
</body>

</html>