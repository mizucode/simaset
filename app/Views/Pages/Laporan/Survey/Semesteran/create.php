<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper mb-5 pt-3 px-4 ">
      <div class="container-fluid ">
        <div class="row justify-content-center ">
          <div class="col-12 ">
            <?php if (!empty($error)) : ?>
              <div class="alert alert-danger alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($error); ?>
              </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['update'])) : ?>
              <div class="alert alert-success alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($_SESSION['update']); ?>
              </div>
              <?php unset($_SESSION['update']); ?>
            <?php endif; ?>

            <div class="card bg-">
              <div class="card-header bg-navy mb-3">
                <h1 class="text-xl font-weight-bold">
                  FORMULIR SURVEY SARANA BERGERAK
                </h1>
              </div>
              <form action="/admin/sarana-bergerak/survey/tambah" method="POST" enctype="multipart/form-data">

                <div class="card-body">
                  <div class="row">
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS SURVEY
                        </h5>
                        <span class="form-text">Silahkan isi data identitas survey dengan lengkap.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="penanggung_jawab" class="fw-bold">Penanggung Jawab Survey <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                            placeholder="Contoh: Dr. John Doe, M.Kom" value=""
                            required>
                          <span class="form-text">
                            Masukkan nama lengkap penanggung jawab survey
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="semester" class="fw-bold">Semester <span class="text-danger">*</span></label>
                          <select class="form-control" id="semester" name="semester" required>
                            <option value="" disabled selected>Pilih semester</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                            <option value="Pendek">Pendek</option>
                          </select>
                          <span class="form-text">
                            Pilih semester saat survey dilakukan
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="tahun_akademik" class="fw-bold">Tahun Akademik <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik"
                            placeholder="Contoh: 2023/2024" value=""
                            required>
                          <span class="form-text">
                            Masukkan tahun akademik dalam format YYYY/YYYY
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="tanggal_pengecekan" class="fw-bold">Tanggal Pengecekan <span class="text-danger">*</span></label>
                          <input type="date" class="form-control" id="tanggal_pengecekan" name="tanggal_pengecekan"
                            value="" required>
                          <span class="form-text">
                            Masukkan tanggal pelaksanaan survey
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="lokasi_survey" class="fw-bold">Lokasi Survey <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="lokasi_survey" name="lokasi_survey"
                            placeholder="Contoh: Gedung A Lantai 2" value=""
                            required>
                          <span class="form-text">
                            Masukkan lokasi survey sarana bergerak
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 mt-4">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          DAFTAR SARANA BERGERAK
                        </h5>
                        <span class="form-text">Isi data sarana bergerak yang disurvey.</span>
                      </div>

                      <div id="sarana-container">
                        <!-- Template untuk input sarana bergerak -->
                        <div class="sarana-item py-4 px-4 mb-4 border rounded-md">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="nama_sarana" class="fw-bold">Nama Sarana <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_sarana[]" placeholder="Contoh: Kursi Kuliah" required>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="kondisi" class="fw-bold">Kondisi <span class="text-danger">*</span></label>
                                <select class="form-control" name="kondisi[]" required>
                                  <option value="" disabled selected>Pilih kondisi</option>
                                  <option value="Baik">Baik</option>
                                  <option value="Rusak Ringan">Rusak Ringan</option>
                                  <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="jumlah" class="fw-bold">Jumlah <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="jumlah[]" placeholder="Contoh: 10" required>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="keterangan" class="fw-bold">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan_sarana[]" placeholder="Masukan keterangan">
                              </div>
                            </div>
                          </div>
                          <button type="button" class="btn btn-danger btn-sm mt-2 remove-sarana">Hapus</button>
                        </div>
                      </div>

                      <button type="button" id="tambah-sarana" class="btn btn-success btn-sm">
                        <i class="fas fa-plus mr-2"></i>Tambah Sarana
                      </button>
                    </div>
                  </div>

                  <div class="card-footer text-right">
                    <a href="/admin/sarana-bergerak/survey" class="btn btn-secondary">
                      <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                      <i class="fas fa-save mr-2"></i>
                      Simpan Data Survey
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
      $('#tambah-sarana').click(function() {
        var newItem = $(`<div class="sarana-item py-4 px-4 mb-4 border rounded-md">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama_sarana" class="fw-bold">Nama Sarana <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_sarana[]" placeholder="Contoh: Kursi Kuliah" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="kondisi" class="fw-bold">Kondisi <span class="text-danger">*</span></label>
                <select class="form-control" name="kondisi[]" required>
                  <option value="" disabled selected>Pilih kondisi</option>
                  <option value="Baik">Baik</option>
                  <option value="Rusak Ringan">Rusak Ringan</option>
                  <option value="Rusak Berat">Rusak Berat</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="jumlah" class="fw-bold">Jumlah <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="jumlah[]" placeholder="Contoh: 10" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="keterangan" class="fw-bold">Keterangan</label>
                <input type="text" class="form-control" name="keterangan_sarana[]" placeholder="Masukan keterangan">
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-danger btn-sm mt-2 remove-sarana">Hapus</button>
        </div>`);

        $('#sarana-container').append(newItem);
      });

      // Menghapus item sarana
      $(document).on('click', '.remove-sarana', function() {
        if ($('.sarana-item').length > 1) {
          $(this).closest('.sarana-item').remove();
        } else {
          alert('Setidaknya harus ada satu item sarana');
        }
      });
    });
  </script>
</body>

</html>