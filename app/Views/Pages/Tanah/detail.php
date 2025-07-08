<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white mb-5 pt-3 px-3">

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
                    <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#deleteTanahModal" data-id="<?= htmlspecialchars($detailData['id'] ?? ''); ?>">
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
                      <span class="info-box-icon bg-info"><i class="fas fa-barcode"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Kode Aset</span>
                        <span class="info-box-text"><?= htmlspecialchars($detailData['kode_aset'] ?? '-') ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-danger"><i class="fas fa-id-card"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Nomor Sertifikat</span>
                        <span class="info-box-text"><?= htmlspecialchars($detailData['nomor_sertifikat']) ?></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-success"><i class="fas fa-map-marked-alt"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Nama Aset</span>
                        <span class="info-box-text"><?= htmlspecialchars($detailData['nama_aset']) ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-secondary"><i class="fas fa-calendar-alt"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Tanggal Pajak</span>
                        <span class="info-box-text"><?= htmlspecialchars($detailData['tgl_pajak']) ?></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-warning"><i class="fas fa-ruler-combined"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Luas Tanah</span>
                        <span class="info-box-text"><?= htmlspecialchars($detailData['luas']) ?> m²</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-box bg-light">
                      <span class="info-box-icon bg-purple"><i class="fas fa-sitemap"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-number">Jenis Aset</span>
                        <span class="info-box-text"><?= htmlspecialchars($detailData['jenis_aset'] ?? '-') ?></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="border-bottom pb-2 mb-3">
                  <h5 class="text-bold">
                    Detail Informasi Tanah
                  </h5>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Jenis Aset</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['jenis_aset'] ?? '-') ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Sumber Perolehan</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['sumber_perolehan'] ?? '-') ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Perolehan</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= $detailData['tanggal_perolehan'] ? htmlspecialchars(date('d F Y', strtotime($detailData['tanggal_perolehan']))) : '-' ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Harga Perolehan</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        Rp <?= $detailData['harga_perolehan_rp'] ? htmlspecialchars(number_format($detailData['harga_perolehan_rp'], 0, ',', '.')) : '-' ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Alamat Lengkap</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['alamat_lengkap'] ?? '-') ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Koordinat Centroid Latitude</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['koordinat_centroid_lat'] ?? '-') ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Koordinat Centroid Longitude</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['koordinat_centroid_lon'] ?? '-') ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Lokasi</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['lokasi'] ?? '-') ?>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>NJOP Bumi per m²</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        Rp <?= $detailData['njop_bumi_per_m2'] ? htmlspecialchars(number_format($detailData['njop_bumi_per_m2'], 0, ',', '.')) : '-' ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Unit Pengguna</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['unit_pengguna'] ?? '-') ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Status Kepemilikan</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['status_kepemilikan'] ?? '-') ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Jenis Sertifikat</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['jenis_sertifikat'] ?? '-') ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Terbit Sertifikat</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= $detailData['tanggal_terbit_sertifikat'] ? htmlspecialchars(date('d F Y', strtotime($detailData['tanggal_terbit_sertifikat']))) : '-' ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Nama Pemegang Hak</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['nama_pemegang_hak'] ?? '-') ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Fungsi</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['fungsi'] ?? '-') ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <label>Keterangan</label>
                      <p class="form-control-plaintext border rounded p-2 bg-light">
                        <?= htmlspecialchars($detailData['keterangan'] ?? '-') ?>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="border-bottom pb-2 mt-4 mb-3 flex justify-content-between">
                  <h5 class="text-bold">
                    Dokumen Tanah
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
                              <a href="/admin/prasarana/tanah?preview-file-dokumen=<?= htmlspecialchars($barang['id'] ?? '-') ?>"
                                class="btn btn-sm btn-primary mr-1" title="Preview" target="_blank">
                                <i class="fas fa-eye"></i> Preview
                              </a>
                              <a href="/admin/prasarana/tanah?download-dokumen=<?= htmlspecialchars($barang['id'] ?? '-') ?>" class="btn btn-sm btn-success mr-1" title="Download" download>
                                <i class="fas fa-download"></i> Download
                              </a>
                              <button type="button" class="btn btn-sm btn-danger" title="Hapus"
                                onclick="confirmDeleteTanahDokumen('<?= htmlspecialchars($barang['id'] ?? '') ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>', '<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Ini') ?>')">
                                <i class="fas fa-trash"></i> Hapus
                              </button>
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
                            <div class="mt-auto text-center d-flex justify-content-center gap-2">
                              <button type="button" class="btn btn-sm btn-danger" title="Hapus Gambar"
                                onclick="confirmDeleteTanahGambar('<?= htmlspecialchars($barang['id'] ?? '') ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>', '<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Gambar Ini') ?>')">
                                <i class="fas fa-trash"></i> Hapus
                              </button>
                              <a href="/admin/prasarana/tanah?preview-gambar=<?= htmlspecialchars($barang['id'] ?? '-') ?>" class="btn btn-sm btn-primary" title="Preview" target="_blank">
                                <i class="fas fa-eye"></i> Preview
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

                <!-- End Dokumentasi Gambar Section -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Hapus Data Tanah -->
    <div class="modal fade" id="deleteTanahModal" tabindex="-1" role="dialog" aria-labelledby="deleteTanahModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="deleteTanahModalLabel">Konfirmasi Hapus Data Tanah</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus data tanah <strong id="tanahNameModal"></strong>? Tindakan ini tidak dapat dibatalkan dan akan menghapus semua dokumen terkait.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <a href="#" id="confirmDeleteTanahButton" class="btn btn-danger">Hapus</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Konfirmasi Hapus Dokumen Tanah -->
    <div class="modal fade" id="deleteDokumenModal" tabindex="-1" role="dialog" aria-labelledby="deleteDokumenModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="deleteDokumenModalLabel">Konfirmasi Hapus Dokumen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus dokumen <strong id="dokumenNameModal"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <a href="#" id="confirmDeleteDokumenButton" class="btn btn-danger">Hapus</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Konfirmasi Hapus Gambar Tanah -->
    <div class="modal fade" id="deleteGambarModal" tabindex="-1" role="dialog" aria-labelledby="deleteGambarModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="deleteGambarModalLabel">Konfirmasi Hapus Gambar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus gambar <strong id="gambarNameModal"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <a href="#" id="confirmDeleteGambarButton" class="btn btn-danger">Hapus</a>
          </div>
        </div>
      </div>
    </div>

    <?php include './app/Views/Components/footer.php'; ?>
  </div>
  <?php include './app/Views/Components/script.php'; ?>
  <script>
    function confirmDeleteTanahDokumen(dokumenId, tanahId, namaDokumen) {
      $('#dokumenNameModal').text(namaDokumen || 'Dokumen Ini');
      var deleteUrl = `/admin/prasarana/tanah?delete-dokumen=${dokumenId}&tanah_id=${tanahId}`;
      $('#confirmDeleteDokumenButton').attr('href', deleteUrl);
      $('#deleteDokumenModal').modal('show');
    }

    function confirmDeleteTanahGambar(gambarId, tanahId, namaGambar) {
      $('#gambarNameModal').text(namaGambar || 'Gambar Ini');
      var deleteUrl = `/admin/prasarana/tanah?delete-gambar=${gambarId}&tanah_id=${tanahId}`;
      $('#confirmDeleteGambarButton').attr('href', deleteUrl);
      $('#deleteGambarModal').modal('show');
    }

    $(document).ready(function() {
      $('#deleteTanahModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var tanahId = button.data('id');
        var tanahName = "<?= htmlspecialchars($detailData['nama_aset'] ?? 'Data Tanah Ini'); ?>";
        var modal = $(this);
        modal.find('#tanahNameModal').text(tanahName);
        var deleteUrl = '/admin/prasarana/tanah?delete=' + tanahId;
        modal.find('#confirmDeleteTanahButton').attr('href', deleteUrl);
      });
    });
  </script>
</body>

</html>