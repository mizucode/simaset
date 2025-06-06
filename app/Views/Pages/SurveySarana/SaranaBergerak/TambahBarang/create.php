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
                  FORMULIR TAMBAH DATA BARANG SURVEY
                </h1>
              </div>
              <form action="/admin/survey/sarana/sarana-bergerak?tambah-barang=<?= htmlspecialchars($surveyData['id']) ?>" method="POST" enctype="multipart/form-data">

                <input type="text" hidden name="survey_sarana_bergerak_id" value="<?= htmlspecialchars($surveyData['id']) ?>" id="">

                <div class="card-body">
                  <div class="row">
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          SURVEY SARANA BERGERAK
                        </h5>
                        <span class="form-text">Silahkan isi data barang yang disurvey.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Gedung -->
                        <div class="form-group">
                          <label for="nama_barang" class="fw-bold">Nama Barang <span class="text-danger"> *</span></label>
                          <select class="form-control" id="nama_barang" name="nama_barang" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            <?php foreach ($barangBergerak as $barang): ?>
                              <option value="<?= htmlspecialchars($barang['nama_detail_barang']) ?>" data-no-registrasi="<?= htmlspecialchars($barang['no_registrasi']) ?>">
                                <?= htmlspecialchars($barang['no_registrasi']) ?> - <?= htmlspecialchars($barang['nama_detail_barang']) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                          <span class="form-text">Pilih barang bergerak.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="no_registrasi" class="fw-bold">No Registrasi<span class="text-danger"> *</span></label>
                          <input type="text" class="form-control" id="no_registrasi" name="no_registrasi"
                            placeholder="Contoh: 2025/2024" value=""
                            required readonly>
                          <span class="form-text">
                            Masukkan tahun akademik pengisian survey
                          </span>
                        </div>
                      </div>






                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <label for="kondisi" class="font-weight-bold">Kondisi Barang</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-clipboard-check text-primary"></i></span>
                          </div>
                          <select class="form-control" id="kondisi" name="kondisi" required>
                            <option value="" disabled <?= !isset($sarana['kondisi_barang_id']) ? 'selected' : ''; ?>>Pilih Kondisi</option>
                            <?php foreach ($kondisiBarang as $kondisi) : ?>
                              <option value="<?= htmlspecialchars($kondisi['nama_kondisi']) ?>" <?= isset($sarana['kondisi']) && $sarana['kondisi'] == $kondisi['nama_kondisi'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <span class="form-text">Pilih kondisi aktual sarana.</span>
                      </div>
                      <!-- Sumber -->
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Lokasi Penempatan Barang -->
                        <div class="form-group">
                          <label for="lokasi" class="fw-bold">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                          <select class="form-control select2-custom" id="lokasi" name="lokasi" required>
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
      $('#nama_barang').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih atau ketik lokasi survey", // Placeholder spesifik untuk lokasi
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });

      $('#nama_barang').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var noRegistrasi = selectedOption.data('no-registrasi');
        $('#no_registrasi').val(noRegistrasi);
      });
    });
  </script>


</body>

</html>