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
                    <a href="/admin/survey/sarana/sarana-atk?delete=<?= htmlspecialchars($surveyData['id'] ?? '-') ?>" class="btn btn-danger btn-sm mr-1">
                      <i class="fas fa-trash mr-1"></i> Hapus
                    </a>
                    <a href="/admin/survey/sarana/sarana-atk?edit=<?= htmlspecialchars($surveyData['id'] ?? '-') ?>" class="btn btn-warning btn-sm mr-1">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="/admin/survey/sarana/sarana-atk" class="btn btn-secondary btn-sm ">
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
                <div class="border-bottom pb-2 mb-3 flex justify-content-between">
                  <h5 class=" text-bold">
                    Daftar Inventaris Sarpras

                  </h5>
                  <a href="/admin/survey/sarana/sarana-atk?tambah-barang=<?= htmlspecialchars($surveyData['id'] ?? '') ?>" class="btn btn-warning btn-sm ml-auto">
                    <div class="text-dark">
                      <i class="fas fa-plus mr-1"></i> Tambah Data
                    </div>
                  </a>
                </div>

                <!-- Display Daftar Inventaris Sarpras -->
                <?php if (!empty($dataSurvey)) : ?>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No Registrasi</th>
                        <th>Nama Barang</th>
                        <th>Kondisi</th>
                        <th>lokasi</th>
                        <th width="10%" class="text-center">Hapus</th>
                        <!-- Add other relevant columns -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($dataSurvey as $index => $item) : ?>
                        <tr>
                          <td><?= $index + 1; ?></td>
                          <td><?= htmlspecialchars($item['no_registrasi'] ?? '-'); ?></td>
                          <td><?= htmlspecialchars($item['nama_barang'] ?? '-'); ?></td>
                          <td><?= htmlspecialchars($item['kondisi'] ?? '-'); ?></td>
                          <td><?= htmlspecialchars($item['lokasi'] ?? '-'); ?></td>
                          <td class="text-center">
                            <a href="/admin/survey/sarana/sarana-atk?delete-barang=<?= htmlspecialchars($item['id']) ?>"
                              class="btn btn-danger btn-sm"
                              onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini dari survey?');">
                              <i class="fas fa-trash mr-1"></i> Hapus
                            </a>
                          </td>
                          <!-- Add other relevant cells -->
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                <?php else : ?>
                  <p class="text-center">Belum ada data inventaris untuk survey ini.</p>
                <?php endif; ?>
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