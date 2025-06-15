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

            <?php include './app/Views/Components/helper.php'; ?>

            <div class="card">
              <div class="card-header bg-navy mb-3">
                <h3 class="card-title text-bold">
                  Tambah Dokumen Bergerak
                </h3>
              </div>

              <form action="/admin/sarana/bergerak?tambah-dokumen=<?= $dokumenData['id'] ?? '' ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          DATA DOKUMEN BERGERAK
                        </h5>
                        <span class="form-text">Silahkan isi data dokumen bergerak dengan lengkap.</span>
                      </div>

                      <!-- Aset Barang Bergerak -->
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="aset_bergerak_id" class="fw-bold">Pilih Aset Bergerak</label>
                          <input type="text" class="form-control" id="aset_bergerak_id" name="aset_bergerak_id"
                            value="<?= htmlspecialchars($dokumenData['id']) ?>" readonly>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="nama_dokumen" class="fw-bold">Nama Dokumen <span class="text-danger">*</span></label>
                          <input type="text" placeholder="Contoh: STNK Mobil Avanza" class="form-control" id="nama_dokumen" name="nama_dokumen" value="" required>
                          <span class="form-text">Masukkan nama dokumen.</span>
                        </div>
                      </div>
                      <!-- Upload Dokumen -->
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="path_dokumen" class="fw-bold">Upload Dokumen Bergerak <span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="path_dokumen" name="path_dokumen" required>
                          <span class="form-text">Format file: PDF, JPG, PNG (maks. 5MB).</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right">
                  <?php
                  $backUrl = "/admin/sarana/bergerak"; // Default fallback
                  if (isset($dokumenData['no_registrasi']) && !empty($dokumenData['no_registrasi'])) {
                    $backUrl = "/admin/sarana/bergerak/detail/" . htmlspecialchars($dokumenData['no_registrasi']);
                  } elseif (isset($dokumenData['id'])) { // Fallback to id if no_registrasi not set, though ideally it should be
                    // This fallback to ?detail might be removed if no_registrasi is enforced
                    $backUrl = "/admin/sarana/bergerak?detail=" . htmlspecialchars($dokumenData['id']);
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
    // Script untuk menampilkan nama file yang dipilih, jika diperlukan.
    // Sesuaikan ID 'path_dokumen' jika berbeda.
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