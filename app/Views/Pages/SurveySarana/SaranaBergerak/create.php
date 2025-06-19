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
                  FORMULIR TAMBAH DATA SURVEY
                </h1>
              </div>
              <form action="/admin/survey/sarana/survey-barang/tambah" method="POST" enctype="multipart/form-data">

                <div class="card-body">
                  <div class="row">
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          SURVEY SARANA BERGERAK
                        </h5>
                        <span class="form-text">Silahkan isi data penanggung jawab dan lokasi survey.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="penanggung_jawab" class="fw-bold">Penanggung Jawab<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                            placeholder="Contoh: Muhammad Febrianoor" value=""
                            required>
                          <span class="form-text">
                            Masukan nama lengkap penanggung jawab survey.
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
                          </select>
                          <span class="form-text">
                            Pilih semester survey.
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="tahun_akademik" class="fw-bold">Tahun Akademik <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik"
                            placeholder="Contoh: 2025/2024" value=""
                            required>
                          <span class="form-text">
                            Masukkan tahun akademik pengisian survey
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="tanggal_pengecekan" class="fw-bold">Tanggal Pengecekan<span class="text-danger"> *</span></label>
                          <input type="date" class="form-control" id="tanggal_pengecekan" name="tanggal_pengecekan"
                            value="" required>
                          <span class="form-text">
                            Masukan tanggal pengecekan survey.
                          </span>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Lokasi Penempatan Barang -->
                        <div class="form-group">
                          <label for="lokasi" class="fw-bold">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                          <select class="form-control select2-custom" id="lokasi" name="lokasi_survey" required>
                            <option value="" disabled selected>Pilih atau ketik lokasi barang</option>
                            <optgroup label="Lapang">
                              <?php foreach ($lapangData as $lokasi_item) : ?> <!-- Ubah nama variabel agar tidak konflik -->
                                <option value="<?= htmlspecialchars($lokasi_item['nama_lapang']); ?>">
                                  <?= htmlspecialchars($lokasi_item['kode_lapang']); ?> - <?= htmlspecialchars($lokasi_item['nama_lapang']); ?>
                                </option>
                              <?php endforeach; ?>
                            </optgroup>
                            <optgroup label="Ruang">
                              <?php foreach ($ruangData as $lokasi_item) : ?> <!-- Ubah nama variabel agar tidak konflik -->
                                <option value="<?= htmlspecialchars($lokasi_item['nama_ruang']); ?>">
                                  <?= htmlspecialchars($lokasi_item['kode_ruang']); ?> - <?= htmlspecialchars($lokasi_item['nama_ruang']); ?>
                                </option>
                              <?php endforeach; ?>
                            </optgroup>
                          </select>
                          <span class="form-text">Pilih lokasi penempatan sarana saat ini.</span>
                        </div>
                      </div>






                    </div>


                  </div>

                  <div class="card-footer text-right">
                    <a href="/admin/prasarana/tanah" class="btn btn-secondary">
                      <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                      <i class="fas fa-save mr-2"></i>
                      Simpan Data Tanah
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
      $('#lokasi').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih atau ketik lokasi survey", // Placeholder spesifik untuk lokasi
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });
    });
  </script>


</body>

</html>