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
                  FORMULIR TAMBAH DATA RUANG
                </h1>
              </div>

              <form action="/admin/prasarana/ruang/tambah" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <!-- Data Identitas Ruang -->
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS RUANG
                        </h5>
                        <span class="form-text">Silahkan isi data identitas ruang dengan lengkap.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Gedung -->
                        <div class="form-group">
                          <label for="gedung_id" class="fw-bold">Gedung <span class="text-danger">*</span></label>
                          <select class="form-control" id="gedung_id" name="gedung_id" required>
                            <option value="" disabled selected>Pilih Gedung</option>
                            <?php foreach ($gedungList as $gedung): ?>
                              <option value="<?= htmlspecialchars($gedung['id']) ?>">
                                <?= htmlspecialchars($gedung['kode_gedung']) ?> - <?= htmlspecialchars($gedung['nama_gedung']) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                          <span class="form-text">Pilih gedung tempat ruang berada.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Jenis Ruang -->
                        <div class="form-group">
                          <label for="jenis_ruangan" class="fw-bold">Jenis Ruangan <span class="text-danger">*</span></label>
                          <select class="form-control" id="jenis_ruangan" name="jenis_ruangan" required>
                            <option value="" disabled selected>Pilih Jenis Ruangan</option>
                            <option value="Ruang Kelas">Ruang Kelas</option>
                            <option value="Laboratorium">Laboratorium</option>
                            <option value="Ruang Seminar">Ruang Seminar</option>
                            <option value="Ruang Sidang">Ruang Sidang</option>
                            <option value="Ruang Dosen">Ruang Dosen</option>
                            <option value="Ruang Kaprodi">Ruang Kaprodi</option>
                            <option value="Perpustakaan">Perpustakaan</option>
                            <option value="Ruang Baca">Ruang Baca</option>
                            <option value="Ruang Multimedia">Ruang Multimedia</option>
                            <option value="Ruang UKM">Ruang UKM</option>
                            <option value="Kantin">Kantin</option>
                            <option value="Toilet">Toilet</option>
                            <option value="Gudang">Gudang</option>
                            <option value="Mushola">Mushola</option>
                          </select>
                          <span class="form-text">Pilih jenis ruangan dari daftar yang tersedia.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Kode Ruang -->
                        <div class="form-group">
                          <label for="kode_ruang" class="fw-bold">Kode Ruang <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="kode_ruang" name="kode_ruang" placeholder="Contoh: R-GEDUNA-RKA" required>
                          <span class="form-text">Masukkan kode unik untuk ruang. Gunakan RNG</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Nama Ruang -->
                        <div class="form-group">
                          <label for="nama_ruang" class="fw-bold">Nama Ruang <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" placeholder="Contoh: Ruang Kelas A1" required>
                          <span class="form-text">Masukkan nama lengkap atau deskriptif untuk ruang.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Kapasitas -->
                        <div class="form-group">
                          <label for="kapasitas" class="fw-bold">Kapasitas</label>
                          <input type="text" class="form-control" id="kapasitas" name="kapasitas" placeholder="Contoh: 30 orang">
                          <span class="form-text">Masukkan kapasitas maksimal ruang (opsional).</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Lantai -->
                        <div class="form-group">
                          <label for="lantai" class="fw-bold">Letak Lantai <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="lantai" name="lantai" placeholder="Contoh: 1" required>
                          <span class="form-text">Masukkan nomor lantai tempat ruang berada.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Luas -->
                        <div class="form-group">
                          <label for="luas" class="fw-bold">Luas Ruang (m²)</label>
                          <input type="text" class="form-control" id="luas" name="luas" placeholder="Contoh: 50">
                          <span class="form-text">Masukkan luas ruang dalam satuan meter persegi (opsional).</span>
                        </div>
                      </div>
                    </div>

                    <!-- Data Kondisi Ruang -->
                    <div class="col-12 mt-4">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          KONDISI RUANG
                        </h5>
                        <span class="form-text">Pilih status dan kondisi terkini dari ruang.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Status -->
                        <div class="form-group">
                          <label for="status" class="fw-bold">Status Ruang <span class="text-danger">*</span></label>
                          <select class="form-control" id="status" name="status" required>
                            <option value="" disabled selected>Pilih status ruang</option>
                            <option value="Terpakai">Terpakai</option>
                            <option value="Kosong">Kosong</option>
                            <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                          </select>
                          <span class="form-text">Pilih status penggunaan ruang saat ini.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Kondisi Ruang -->
                        <div class="form-group">
                          <label for="kondisi_ruang" class="fw-bold">Kondisi Ruang <span class="text-danger">*</span></label>
                          <select class="form-control" id="kondisi_ruang" name="kondisi_ruang" required>
                            <option value="" disabled selected>Pilih kondisi ruang</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                          </select>
                          <span class="form-text">Pilih kondisi fisik ruang secara umum.</span>
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
                          <input type="text" class="form-control" id="fungsi" name="fungsi" placeholder="Contoh: Ruang perkuliahan teori">
                          <span class="form-text">Jelaskan fungsi utama dari ruang ini (opsional).</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="keterangan" class="fw-bold">Keterangan</label>
                          <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                          <span class="form-text">Tambahkan catatan atau keterangan lain yang relevan (opsional).</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card-footer text-right">
                    <a href="/admin/prasarana/ruang" class="btn btn-secondary">
                      <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                      <i class="fas fa-save mr-2"></i>
                      Simpan Data Ruang
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

  <!-- Initialize Select2 for Gedung -->
  <!-- Initialize Select2 -->
  <script>
    $(document).ready(function() {
      $('#gedung_id').select2({
        placeholder: "Pilih Gedung",
        allowClear: true, // Memungkinkan untuk menghapus pilihan
        minimumResultsForSearch: 1, // Menampilkan kotak pencarian jika ada minimal 1 opsi
        theme: 'bootstrap4' // Menggunakan tema Bootstrap 4 untuk Select2
      });

      $('#jenis_ruangan').select2({
        placeholder: "Pilih Jenis Ruangan",
        allowClear: true,
        minimumResultsForSearch: 1, // Atau -1 jika tidak ingin ada search box untuk jenis ruangan
        theme: 'bootstrap4' // Menggunakan tema Bootstrap 4 untuk Select2
      });

      // Script generateKodeRuang yang ada di bawah akan tetap berfungsi karena Select2
      // memicu event 'change' pada elemen select asli (<select id="gedung_id">)
      // dan juga memperbarui nilainya.
    });
  </script>

  <!-- Script for Kode Ruang generation (existing) -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const namaRuangInput = document.getElementById('nama_ruang');
      const kodeRuangInput = document.getElementById('kode_ruang');
      const gedungSelect = document.getElementById('gedung_id');

      function generateKodeRuang() {
        let namaRuang = namaRuangInput.value.trim();
        let gedungId = gedungSelect.value;
        let selectedGedungOption = gedungSelect.options[gedungSelect.selectedIndex];
        let gedungText = "";

        if (selectedGedungOption && selectedGedungOption.value !== "") {
          gedungText = selectedGedungOption.text;
        }

        if (namaRuang.length > 0 && gedungId && gedungText.length > 0) {
          let namaSingkatGedung = gedungText.split(' ').map(kata => kata.charAt(0).toUpperCase()).join('');
          if (namaSingkatGedung.length > 4) namaSingkatGedung = namaSingkatGedung.substring(0, 4);

          let namaSingkatRuang = namaRuang.split(' ').map(kata => kata.charAt(0).toUpperCase()).join('');
          if (namaSingkatRuang.length > 4) namaSingkatRuang = namaSingkatRuang.substring(0, 4);

          let kodeRuang = `R-${namaSingkatGedung}-${namaSingkatRuang}`;
          if (!kodeRuangInput.dataset.manual) {
            kodeRuangInput.value = kodeRuang;
          }
        } else if (!kodeRuangInput.dataset.manual) {
          kodeRuangInput.value = '';
        }
      }

      namaRuangInput.addEventListener('input', generateKodeRuang);
      gedungSelect.addEventListener('change', generateKodeRuang);
      kodeRuangInput.addEventListener('input', function() {
        kodeRuangInput.dataset.manual = "true";
      });
    });
  </script>
</body>

</html>