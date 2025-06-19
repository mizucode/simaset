<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>


    <div class="content-wrapper bg-white mb-5 pt-3 px-4">
      <?php include './app/Views/Components/helper.php'; ?>
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card card-navy">
              <div class="card-header text-white">
                <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title text-lg">
                    Detail Inventarisasi Sarpras
                  </h3>

                  <div class="text-right">
                    <a href="/admin/survey/sarana/survey-barang?delete=<?= htmlspecialchars($surveyData['id'] ?? '-') ?>"
                      class="btn btn-danger btn-sm mr-1"
                      onclick="return confirm('Apakah Anda yakin ingin menghapus data survey ini?');">
                      <i class="fas fa-trash mr-1"></i> Hapus
                    </a>
                    <a href="/admin/survey/sarana/survey-barang?edit=<?= htmlspecialchars($surveyData['id'] ?? '-') ?>" class="btn btn-warning btn-sm mr-1">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="/admin/survey/sarana/survey-barang" class="btn btn-secondary btn-sm ">
                      <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-info"><i class="fas fa-user-tie"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-number">Penanggung Jawab</span>
                        <span class="info-box-text"><?= htmlspecialchars($surveyData['penanggung_jawab'] ?? '-') ?></span>

                      </div>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-success"><i class="fas fa-calendar-alt"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Semester</span>
                        <span class="info-box-text"><?= htmlspecialchars($surveyData['semester'] ?? '-') ?> - <?= htmlspecialchars($surveyData['tahun_akademik'] ?? '-') ?></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-warning"><i class="fas fa-calendar-day"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Tanggal Pengecekan</span>
                        <span class="info-box-text"><?= htmlspecialchars($surveyData['tanggal_pengecekan'] ?? '-') ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-primary"><i class="fas fa-map-marker-alt"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Lokasi Survey</span>
                        <span class="info-box-text"><?= htmlspecialchars($surveyData['lokasi_survey'] ?? '-') ?></span>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="border-bottom pb-2 mb-3">
                  <h5 class="text-bold">
                    Barang Inventaris di Lokasi Survey
                  </h5>
                </div>

                <!-- Tombol Tambah Barang ke Survey -->
                <div class="mb-3">
                  <a href="/admin/survey/sarana/survey-barang?tambah-barang=<?= htmlspecialchars($surveyData['id'] ?? '') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah Barang ke Survey Ini
                  </a>
                </div>

                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                      <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Barang</th>
                        <th width="20%">No Registrasi</th>
                        <th width="20%">Kondisi Aktual</th>
                        <th width="20%">Lokasi Aktual</th>
                        <th width="10%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Asumsi variabel $surveyInventarisItems berisi data dari data_survey_bb untuk survey ini
                      // Variabel ini harus di-passing dari controller
                      // Contoh: $surveyInventarisItems = SurveySaranaBergerak::getAllDataInventaris($conn, $surveyData['id']);
                      ?>
                      <?php if (!empty($surveyInventarisItems)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($surveyInventarisItems as $item): ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($item['nama_barang'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($item['no_registrasi'] ?? '-') ?></td>
                            <td>
                              <?php if (isset($item['kondisi'])): ?>
                                <?php
                                $kondisiText = htmlspecialchars($item['kondisi']);
                                $badgeClass = 'badge-light'; // Default
                                if ($kondisiText === 'Baik') {
                                  $badgeClass = 'badge-success';
                                } elseif ($kondisiText === 'Rusak Ringan') {
                                  $badgeClass = 'badge-warning';
                                } elseif ($kondisiText === 'Rusak Berat') {
                                  $badgeClass = 'badge-danger';
                                }
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= $kondisiText ?></span>
                              <?php else: ?>
                                -
                              <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($item['lokasi'] ?? '-') ?></td>
                            <td class="text-center">
                              <a href="/admin/survey/sarana/survey-barang?delete-barang=<?= htmlspecialchars($item['id']) ?>"
                                class="btn btn-xs btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus item barang ini dari survey?');"
                                title="Hapus Item dari Survey">
                                <i class="fas fa-trash"></i>
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="6" class="text-center">Belum ada data barang yang ditambahkan untuk survey ini.</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
                <!-- End Display Daftar Inventaris Sarpras -->
              </div>


              <div class="card-footer text-right">



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="modal-hapus-label">Konfirmasi Hapus Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus data inventaris ini? Data yang sudah dihapus tidak dapat dikembalikan.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger">Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <?php include './app/Views/Components/footer.php'; ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

  <?php include './app/Views/Components/script.php'; ?>

  <!-- Ekstensi untuk lightbox gambar -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>



  <script>
    $(document).ready(function() {
      // Inisialisasi lightbox untuk gambar dokumentasi
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
      });
    });
  </script>
</body>

</html>