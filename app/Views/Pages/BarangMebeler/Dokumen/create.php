<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>


<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

  <div class="wrapper">

    <?php include './app/Views/Components/na1vbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white mb-5 pt-3  ">
      <div class="container-fluid ">
        <div class="row justify-content-center ">
          <div class="col-12 ">

            <?php include './app/Views/Components/helper.php'; ?>


            <?php if (!empty($error)) : ?>
              <div class="alert alert-danger alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <?= htmlspecialchars($error); ?>
              </div>
            <?php endif; ?>

            <div class="card">
              <div class="card-header bg-navy mb-3">
                <h3 class="card-title text-bold">
                  Tambah Dokumen Mebelair
                </h3>
              </div>

              <form action="/admin/sarana/mebelair?tambah-dokumen=<?= $mebelairData['id'] ?? '' ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          DATA DOKUMEN MEBELAIR
                        </h5>
                        <span class="form-text">Silahkan isi data dokumen mebelair dengan lengkap.</span>
                      </div>

                      <!-- Aset Mebelair -->
                      <div class="py-4 px-4 mb-4 border rounded-md hidden"> <!-- Removed hidden class -->
                        <div class="form-group">
                          <label for="aset_mebelair_id" class="fw-bold">Pilih Aset Mebelair</label>
                          <input type="text" class="form-control" id="aset_mebelair_id" name="aset_mebelair_id"
                            value="<?= htmlspecialchars($mebelairData['id'] ?? '') ?>" readonly>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="nama_dokumen" class="fw-bold">Nama Dokumen <span class="text-danger">*</span></label>
                          <input type="text" placeholder="Contoh: Faktur Pembelian Meja" class="form-control" id="nama_dokumen" name="nama_dokumen" value="" required>
                          <span class="form-text">Masukkan nama dokumen.</span>
                        </div>
                      </div>
                      <!-- Upload Dokumen -->
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="path_dokumen" class="fw-bold">Upload Dokumen Mebelair <span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="path_dokumen" name="path_dokumen" required>
                          <span class="form-text">Format file: PDF, JPG, PNG (maks. 5MB).</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right">
                  <?php
                  $backUrl = "/admin/sarana/mebelair"; // Default fallback
                  if (isset($mebelairData['no_registrasi']) && !empty($mebelairData['no_registrasi'])) {
                    $backUrl = "/admin/sarana/mebelair/detail/" . htmlspecialchars($mebelairData['no_registrasi']);
                  } elseif (isset($mebelairData['id'])) {
                    $backUrl = "/admin/sarana/mebelair?detail=" . htmlspecialchars($mebelairData['id']);
                  } ?>
                  <a href="<?= $backUrl ?>" class="btn btn-secondary">
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Data Dokumen
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
    // Script untuk menampilkan nama file yang dipilih pada input file custom Bootstrap
    const pathDokumenInput = document.getElementById('path_dokumen');
    if (pathDokumenInput) {
      pathDokumenInput.addEventListener('change', function(e) {
        var fileName = e.target.files[0]?.name || 'Pilih File';
        var nextSibling = e.target.nextElementSibling;
        // Jika Anda memiliki elemen untuk menampilkan nama file (misalnya, dengan class 'custom-file-label'),
        // Anda bisa uncomment dan sesuaikan baris berikut:
        // if (nextSibling && nextSibling.classList.contains('custom-file-label')) {
        //     nextSibling.innerText = fileName;
        // }
      });
    }
  </script>

</body>

</html>