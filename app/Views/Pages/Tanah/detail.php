<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white mb-5 pt-3 px-4">

      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>
            <div class="card card-navy">
              <div class="card-header text-white">
                <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title mb-0">
                    Detail Data Tanah
                  </h3>
                  <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#modal-hapus">
                      <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                    <a href="/admin/prasarana/tanah?edit=<?= $detailData['id']; ?>" class="btn btn-warning btn-sm mr-2">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="/admin/prasarana/tanah" class="btn btn-secondary btn-sm">
                      <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                  </div>
                </div>
              </div>


              <div class="card-body">
                <div class="row mb-2">
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-danger"><i class="fas fa-id-card"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Nomor Sertifikat</span>
                        <span class="info-box-number"><?= htmlspecialchars($detailData['nomor_sertifikat']) ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-success"><i class="fas fa-map-marked-alt"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Nama Aset</span>
                        <span class="info-box-number"><?= htmlspecialchars($detailData['nama_aset']) ?></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-secondary"><i class="fas fa-calendar-alt"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Tanggal Pajak</span>
                        <span class="info-box-number"><?= htmlspecialchars($detailData['tgl_pajak']) ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-warning"><i class="fas fa-ruler-combined"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Luas Tanah</span>
                        <span class="info-box-number"><?= htmlspecialchars($detailData['luas']) ?> m²</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-12">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-primary"><i class="fas fa-map-marker-alt"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Lokasi</span>
                        <span class="info-box-number"><?= htmlspecialchars($detailData['lokasi']) ?></span>
                      </div>
                    </div>
                  </div>
                </div>



                <div class="border-bottom pb-2 mb-3">
                  <h5 class="text-bold">
                    Informasi Tambahan
                  </h5>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Fungsi</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['fungsi']) ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Jenis Aset</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['jenis_aset']) ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Keterangan</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['keterangan']) ?>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="border-bottom pb-2 mt-5 mb-3 flex justify-content-between">
                  <h5 class="text-bold">
                    Dokumen Gambar
                  </h5>
                  <a href="/admin/prasarana/tanah?tambah-dokumen=<?= htmlspecialchars($detailData['id']) ?>" class="btn btn-warning btn-sm ml-auto">
                    <div class="text-dark">
                      <i class="fas fa-plus mr-1"></i> Tambah Data
                    </div>
                  </a>
                </div>

                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                      <tr class="text-center">
                        <th width="5%">No</th>
                        <th width="70%">Nama Dokumen</th>
                        <th width="30%">Link download</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($dokumenAsetTanah)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($dokumenAsetTanah as $barang): ?>
                          <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($barang['nama_dokumen'] ?? '-') ?></td>
                            <td class="text-center">
                              <a href="/admin/prasarana/tanah?download-dokumen=<?= htmlspecialchars($barang['id'] ?? '-') ?>"
                                class="btn btn-sm btn-success" title="Download" download>
                                <i class="fas fa-download"></i> Download
                              </a>
                              <a href="/admin/prasarana/tanah?delete-dokumen=<?= htmlspecialchars($barang['id'] ?? '-') ?>"
                                class="btn btn-sm btn-danger" title="Hapus"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="3" class="text-center">Tidak ada data dokumen</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>

                <!-- Dokumentasi Gambar Section -->
                <div class="border-bottom pb-2 my-5 flex justify-content-between">
                  <h5 class="text-bold">
                    Dokumen Gambar
                  </h5>
                  <a href="/admin/prasarana/tanah?tambah-gambar=<?= htmlspecialchars($detailData['id']) ?>" class="btn btn-warning btn-sm ml-auto">
                    <div class="text-dark">
                      <i class="fas fa-plus mr-1"></i> Tambah Data
                    </div>
                  </a>
                </div>
                <div class="row mb-4">
                  <?php if (!empty($dokumenGambar)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($dokumenGambar as $barang): ?>
                      <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                          <div class="card-img-top splash-art-container position-relative" style="height: 200px; overflow: hidden;">
                            <?php if ($barang['path_dokumen'] && in_array(pathinfo($barang['path_dokumen'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp'])): ?>
                              <img src="/admin/prasarana/tanah?preview-gambar=<?= htmlspecialchars($barang['id']) ?>"
                                alt="<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Tanah') ?>"
                                class="img-fluid h-100 w-100"
                                style="object-fit: cover;"
                                loading="lazy">

                            <?php else: ?>
                              <div class="img-fluid h-100 w-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                Tidak ada preview
                              </div>
                            <?php endif; ?>
                          </div>
                          <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-center mb-3"><?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Tanah') ?></h6>
                            <div class="mt-auto text-center">
                              <a href="/admin/prasarana/tanah?delete-gambar=<?= htmlspecialchars($barang['id'] ?? '-') ?>"
                                class="btn btn-sm btn-danger" title="Hapus"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
                              </a>
                              <a href="/admin/prasarana/tanah?preview-gambar=<?= htmlspecialchars($barang['id'] ?? '-') ?>"
                                class="btn btn-sm btn-primary" title="Lihat">
                                <i class="fas fa-eye"></i> Lihat
                              </a>

                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <div class="col-12">
                      <div class="alert alert-info text-center" role="alert">
                        Tidak ada data dokumen
                      </div>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- Modal Konfirmasi Hapus -->

                <!-- End Dokumentasi Gambar Section -->
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
            <p>Apakah Anda yakin ingin menghapus data tanah ini? Data yang sudah dihapus tidak dapat dikembalikan.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <a href="/admin/prasarana/tanah?delete=<?= $detailData['id']; ?>" class="btn btn-danger">Hapus</a>
          </div>
        </div>
      </div>
    </div>

    <?php include './app/Views/Components/foooter.php'; ?>
  </div>

  <?php include './app/Views/Components/script.php'; ?>
</body>

</html>