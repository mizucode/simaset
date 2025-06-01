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

            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <h1 class="text-xl font-weight-bold">
                  Formulir Data Bangunan
                </h1>
              </div>

              <form action="/admin/prasarana/gedung/tambah" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="card-body">
                  <div class="row">
                    <!-- Data Identitas Bangunan -->
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS BANGUNAN
                        </h5>
                        <span class="form-text">Silahkan isi data identitas bangunan dengan lengkap.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Kode Bangunan -->
                        <div class="form-group">
                          <label for="kode_gedung" class="fw-bold">Kode Bangunan <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="kode_gedung" name="kode_gedung" placeholder="Contoh: GDG-REKTORAT" required>
                          <span class="form-text">Masukkan kode unik untuk bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Nama Bangunan -->
                        <div class="form-group">
                          <label for="nama_gedung" class="fw-bold">Nama Bangunan <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="nama_gedung" name="nama_gedung" placeholder="Contoh: Gedung Rektorat" required>
                          <span class="form-text">Masukkan nama lengkap atau deskriptif untuk bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Luas Bangunan -->
                        <div class="form-group">
                          <label for="luas" class="fw-bold">Luas Bangunan (m²) <span class="text-danger">*</span></label>
                          <input type="number" step="0.01" class="form-control" id="luas" name="luas" placeholder="Masukkan luas gedung dalam meter persegi" required>
                          <span class="form-text">Masukkan luas total bangunan dalam meter persegi.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Jumlah Lantai -->
                        <div class="form-group">
                          <label for="jumlah_lantai" class="fw-bold">Jumlah Lantai <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="jumlah_lantai" name="jumlah_lantai" placeholder="Masukkan jumlah lantai" required>
                          <span class="form-text">Masukkan jumlah lantai yang dimiliki bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Lokasi Bangunan -->
                        <div class="form-group">
                          <label for="lokasi" class="fw-bold">Lokasi Bangunan <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="lokasi" name="lokasi" rows="2" placeholder="Contoh: Jalan Raya Cigugur No. 14, Kuningan, Jawa Barat" required></textarea>
                          <span class="form-text">Masukkan alamat lengkap lokasi bangunan.</span>
                        </div>
                      </div>
                    </div>

                    <!-- Data Konstruksi Bangunan -->
                    <div class="col-12 mt-4 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          KONSTRUKSI BANGUNAN
                        </h5>
                        <span class="form-text">Pilih jenis konstruksi dan kondisi terkini dari bangunan.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Jenis Konstruksi -->
                        <div class="form-group">
                          <label for="kontruksi" class="fw-bold">Jenis Konstruksi <span class="text-danger">*</span></label>
                          <select class="form-control" id="kontruksi" name="kontruksi" required>
                            <option value="" disabled selected>Pilih Jenis Konstruksi</option>
                            <option value="Beton">Beton</option>
                            <option value="Baja">Baja</option>
                            <option value="Kayu">Kayu</option>
                            <option value="Kombinasi">Kombinasi</option>
                          </select>
                          <span class="form-text">Pilih jenis material konstruksi utama bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Kondisi Bangunan -->
                        <div class="form-group">
                          <label for="kondisi" class="fw-bold">Kondisi Bangunan <span class="text-danger">*</span></label>
                          <select class="form-control" id="kondisi" name="kondisi" required>
                            <option value="" disabled selected>Pilih Kondisi Bangunan</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                          </select>
                          <span class="form-text">Pilih kondisi fisik bangunan secara umum.</span>
                        </div>
                      </div>
                    </div>

                    <!-- Data Kepemilikan dan Fungsi -->
                    <div class="col-12 mt-4">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          KEPEMILIKAN DAN FUNGSI
                        </h5>
                        <span class="form-text">Isi informasi mengenai unit kepemilikan dan fungsi utama bangunan.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Unit Kepemilikan -->
                        <div class="form-group">
                          <label for="unit_kepemilikan" class="fw-bold">Unit Kepemilikan <span class="text-danger">*</span></label>
                          <select class="form-control" name="unit_kepemilikan" id="unit_kepemilikan" required>
                            <option value="" disabled selected>Pilih Unit Kepemilikan</option>
                            <option value="Fakultas Pendidikan, Sosial, dan Teknologi">Fakultas Pendidikan, Sosial, dan Teknologi</option>
                            <option value="Fakultas Farmasi, Kesehatan, dan Sains">Fakultas Farmasi, Kesehatan, dan Sains</option>
                            <option value="Universitas">Universitas (Umum)</option>
                            <!-- Tambahkan opsi lain jika perlu -->
                          </select>
                          <span class="form-text">Pilih unit atau fakultas yang memiliki atau bertanggung jawab atas bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Fungsi Bangunan -->
                        <div class="form-group">
                          <label for="fungsi" class="fw-bold">Fungsi Bangunan <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="fungsi" name="fungsi" placeholder="Contoh: Perkuliahan, Perkantoran, Laboratorium" required>
                          <span class="form-text">Jelaskan fungsi utama dari bangunan ini.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Jenis Aset -->
                        <div class="form-group">
                          <label for="jenis_aset_id" class="fw-bold">Jenis Aset <span class="text-danger">*</span></label>
                          <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                            <option value="" disabled selected>Pilih Jenis Aset</option>
                            <?php foreach ($jenisAsetId as $ja) : ?>
                              <option value="<?= htmlspecialchars($ja['id']) ?>">
                                <?= htmlspecialchars($ja['jenis_aset']) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                          <span class="form-text">Pilih klasifikasi jenis aset untuk bangunan ini.</span>
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
                    Simpan Data Bangunan
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

</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const namaGedungInput = document.getElementById('nama_gedung');
    const kodeGedungInput = document.getElementById('kode_gedung');

    function generateKodeBangunan() {
      let namaGedung = namaGedungInput.value.trim();

      if (namaGedung.length > 0) {
        // Ambil huruf pertama dari setiap kata, maksimal 3 kata pertama
        let singkatanArray = namaGedung
          .split(' ')
          .filter(kata => kata.length > 0)
          .slice(0, 3) // Ambil maksimal 3 kata pertama
          .map(kata => kata.charAt(0).toUpperCase());

        let singkatan = singkatanArray.join('');
        if (singkatan.length > 5) singkatan = singkatan.substring(0, 5); // Batasi panjang singkatan

        let kodeGedung = `GDG-${singkatan}`;
        if (!kodeGedungInput.dataset.manual) { // Hanya update jika tidak diisi manual
          kodeGedungInput.value = kodeGedung;
        }
      } else if (!kodeGedungInput.dataset.manual) {
        kodeGedungInput.value = '';
      }
    }
    namaGedungInput.addEventListener('input', generateKodeBangunan);
    kodeGedungInput.addEventListener('input', function() { // Tandai jika diisi manual
      kodeGedungInput.dataset.manual = "true";
    });
  });
</script>

</html>