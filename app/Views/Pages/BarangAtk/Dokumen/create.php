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

            <div class="card bg-">
              <div class="card-header bg-navy mb-3">
                <h1 class="text-xl font-weight-bold">
                  Tambah Dokumen ATK
                </h1>
              </div>

              <form action="/admin/sarana/atk?tambah-dokumen=<?= $dokumenData['id'] ?? '' ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          DATA DOKUMEN ATK
                        </h5>
                        <span class="form-text">Silahkan isi data dokumen ATK dengan lengkap.</span>
                      </div>

                      <!-- Aset ATK -->
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="aset_atk_id" class="fw-bold">Pilih Aset ATK</label>
                          <input type="text" class="form-control" id="aset_atk_id" name="aset_atk_id"
                            value="<?= htmlspecialchars($dokumenData['id']) ?>" readonly>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="nama_dokumen" class="fw-bold">Nama Dokumen <span class="text-danger">*</span></label>
                          <input type="text" placeholder="Contoh: Faktur Pembelian ATK" class="form-control" id="nama_dokumen" name="nama_dokumen" value="" required>
                          <span class="form-text">Masukkan nama dokumen.</span>
                        </div>
                      </div>
                      <!-- Upload Dokumen -->
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="path_dokumen" class="fw-bold">Upload Dokumen ATK <span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="path_dokumen" name="path_dokumen" required>
                          <span class="form-text">Format file: PDF, JPG, PNG, DOC, DOCX (maks. 5MB).</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right">
                  <a href="/admin/sarana/atk?detail=<?= htmlspecialchars($dokumenData['id']) ?>" class="btn btn-secondary">
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
    // Script untuk menampilkan nama file yang dipilih pada input file standar (jika diperlukan)
    // Untuk input standar, browser biasanya sudah menampilkan nama file.
    // Jika Anda menggunakan custom file input Bootstrap, script ini perlu disesuaikan.
    document.getElementById('path_dokumen').addEventListener('change', function(e) {
      // var fileName = e.target.files[0]?.name || 'Pilih file dokumen';
      // var nextSibling = e.target.nextElementSibling; // Untuk .custom-file-label
      // if (nextSibling && nextSibling.classList.contains('custom-file-label')) nextSibling.innerText = fileName;
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
      const fileInput = document.getElementById('path_dokumen');
      if (fileInput.files.length > 0) {
        const fileSize = fileInput.files[0].size / 1024 / 1024; // in MB
        if (fileSize > 5) {
          e.preventDefault();
          alert('Ukuran file terlalu besar. Maksimal 5MB');
          return false;
        }
        // Validasi tipe file (opsional, bisa ditambahkan jika perlu)
        // const validTypes = ['application/pdf', 'image/jpeg', 'image/png', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        // if (!validTypes.includes(fileInput.files[0].type)) {
        //     e.preventDefault();
        //     alert('Format file tidak didukung. Harap upload PDF, JPG, PNG, DOC, atau DOCX.');
        //     return false;
        // }
      }
      return true;
    });
  </script>

</body>

</html>