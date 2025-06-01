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
                  <?= isset($tanah) ? 'EDIT DATA TANAH' : 'FORMULIR TAMBAH DATA TANAH' ?>
                </h1>
              </div>

              <form action="/admin/prasarana/tanah?edit=<?= htmlspecialchars($tanah['id']) ?>" method="POST" enctype="multipart/form-data">
                <?php if (isset($tanah)) : ?>
                  <input type="hidden" name="id" value="<?= htmlspecialchars($tanah['id']) ?>">
                <?php endif; ?>

                <div class="card-body">
                  <div class="row">
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS TANAH
                        </h5>
                        <span class="form-text">Silahkan isi data identitas tanah dengan lengkap.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="kode_aset" class="fw-bold">Kode Aset Tanah <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="kode_aset" name="kode_aset"
                            placeholder="Contoh: PRS-TNH-001"
                            value="<?= isset($tanah['kode_aset']) ? htmlspecialchars($tanah['kode_aset']) : '' ?>"
                            <?= (isset($tanah['kode_aset']) && !empty($tanah['kode_aset'])) ? 'readonly' : '' ?>
                            required>
                          <span class="form-text">
                            Masukan PRS-TNH-{nomor}
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="nama_aset" class="fw-bold">Nama Aset Tanah <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="nama_aset" name="nama_aset"
                            placeholder="Contoh: Tanah Kampus Dua"
                            value="<?= isset($tanah) ? htmlspecialchars($tanah['nama_aset']) : '' ?>"
                            required>
                          <span class="form-text">
                            Masukkan nama lengkap aset tanah.
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="luas" class="fw-bold">Luas Tanah (m²) <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="luas" name="luas"
                            placeholder="Contoh: 21"
                            value="<?= isset($tanah) ? htmlspecialchars($tanah['luas']) : '' ?>"
                            required>
                          <span class="form-text">
                            Masukkan luas tanah dalam satuan meter persegi .
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="lokasi" class="fw-bold">Lokasi Tanah <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="lokasi" name="lokasi" rows="2"
                            placeholder="Contoh: Jl. Raya Cigugur, Kuningan, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45511"
                            required><?= isset($tanah) ? htmlspecialchars($tanah['lokasi']) : '' ?></textarea>
                          <span class="form-text">
                            Masukkan alamat lengkap lokasi tanah.
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="nomor_sertifikat" class="fw-bold">Nomor Sertifikat <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="nomor_sertifikat" name="nomor_sertifikat"
                            placeholder="Contoh: 12.34.56.78.9.01234"
                            value="<?= isset($tanah) ? htmlspecialchars($tanah['nomor_sertifikat']) : '' ?>"
                            required>
                          <span class="form-text">
                            Masukkan nomor sertifikat tanah yang valid.
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="jenis_aset_id" class="fw-bold">Jenis Aset Tanah <span class="text-danger">*</span></label>
                          <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                            <option value="" disabled <?= !isset($tanah['jenis_aset_id']) ? 'selected' : '' ?>>Pilih jenis aset tanah</option>
                            <?php if (isset($jenisAsetId) && is_array($jenisAsetId)) : ?>
                              <?php foreach ($jenisAsetId as $ja_id) : ?>
                                <option value="<?= htmlspecialchars($ja_id['id']) ?>" <?= (isset($tanah) && $tanah['jenis_aset_id'] == $ja_id['id']) ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($ja_id['jenis_aset']) ?>
                                </option>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </select>
                          <span class="form-text">
                            Pilih jenis aset tanah dari daftar yang tersedia.
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="tgl_pajak" class="fw-bold">Tanggal Pajak <span class="text-danger">*</span></label>
                          <input type="date" class="form-control" id="tgl_pajak" name="tgl_pajak"
                            value="<?= isset($tanah) ? htmlspecialchars($tanah['tgl_pajak']) : '' ?>"
                            required>
                          <span class="form-text">
                            Masukkan tanggal pajak tanah.
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="col-12 mt-4">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          FUNGSI DAN KETERANGAN
                        </h5>
                        <span class="form-text">Isi data fungsi dan keterangan tanah.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="fungsi" class="fw-bold">Fungsi Tanah <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="fungsi" name="fungsi"
                            placeholder="Digunakan untuk lahan kampus dua."
                            value="<?= isset($tanah) ? htmlspecialchars($tanah['fungsi']) : '' ?>"
                            required>
                          <span class="form-text">
                            Jelaskan fungsi utama dari tanah ini.
                          </span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="keterangan" class="fw-bold">Keterangan <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="Masukan keterangan"
                            value="<?= isset($tanah) ? htmlspecialchars($tanah['keterangan']) : '' ?>"
                            required>
                          <span class="form-text">
                            Tambahkan keterangan tambahan jika diperlukan.
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card-footer text-right">
                    <a href="<?= isset($tanah) && isset($tanah['id']) ? ('/admin/prasarana/tanah?detail=' . htmlspecialchars($tanah['id'])) : '/admin/prasarana/tanah' ?>" class="btn btn-secondary">
                      <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                      <i class="fas fa-save mr-2"></i>
                      <?= isset($tanah) ? 'Update Data Tanah' : 'Simpan Data Tanah' ?>
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

</html>