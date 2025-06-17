<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>
    <?php include './app/Views/Components/css.php'; ?>

    <style>
      .stk-card .stk-logo-wrapper img {
        width: 70px;
        height: auto;
      }

      .stk-card .stk-favicon-wrapper img {
        width: 35px;
        height: auto;
      }
    </style>

    <div class="content-wrapper bg-white mb-5 pt-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>
            <div class="card card-navy">
              <div class="card-header text-white">
                <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title text-lg">
                    Detail Barang Elektronik
                  </h3>
                  <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#deleteModal" data-id="<?= htmlspecialchars($detailData['id'] ?? ''); ?>">
                      <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                    <!-- Tautan Edit menggunakan no_registrasi -->
                    <a href="/admin/sarana/elektronik/edit/<?= htmlspecialchars($detailData['no_registrasi']); ?>" class="btn btn-warning btn-sm mr-2">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="/admin/sarana/elektronik" class="btn btn-secondary btn-sm">
                      <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="">
                      <div class="text-center d-flex flex-column align-items-center">
                        <?php
                        $namaBarang = $detailData['nama_detail_barang'] ?? 'Barang Tidak Bernama';
                        $nomorRegistrasi = $detailData['no_registrasi'] ?? 'REG-TIDAK-ADA';
                        $qrCanvasId = "qrCanvas_" . htmlspecialchars($detailData['id'] ?? uniqid());
                        $qrPinjamCanvasId = "qrPinjamCanvas_" . htmlspecialchars($detailData['id'] ?? uniqid());
                        ?>
                        <div>
                          <div class="stk-card" id="qrCardToExport">
                            <div class="stk-content">
                              <div class="stk-header">
                                <div class="stk-logo-wrapper">
                                  <img src="/img/logo.png" alt="Logo Perusahaan">
                                </div>
                                <div class="stk-favicon-wrapper">
                                  <img src="/img/logopng.png" alt="Favicon">
                                </div>
                              </div>
                              <div class="stk-item-info">
                                <span class="stk-item-name"><?= htmlspecialchars($namaBarang) ?></span>
                                <span class="stk-item-reg-number">REG: <?= htmlspecialchars($nomorRegistrasi) ?></span>
                              </div>
                              <div class="stk-qr-area">
                                <!-- Konten QR akan menjadi URL detail dengan no_registrasi -->
                                <div id="<?= $qrCanvasId ?>" class="stk-qr-image-container" data-qr-content="<?= htmlspecialchars($nomorRegistrasi) ?>" data-qr-type="detail"></div>
                                <span class="stk-scan-text text-navy pt-2">
                                  <i class="fas fa-qrcode mr-1"></i> SCAN DI SINI
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>

                        <button id="downloadQR" class="btn btn-sm btn-success mt-4 mb-5">
                          <i class="fas fa-download mr-1"></i> Download QR Card
                        </button>

                        <?php if (isset($detailData['status']) && $detailData['status'] === 'Tersedia') : ?>
                          <hr class="w-100">
                          <h6 class="text-bold text-navy mt-3 mb-4">QR Peminjaman Barang Tersedia</h6>
                          <div>
                            <div class="stk-card" id="qrPinjamCardToExport">
                              <div class="stk-content">
                                <div class="stk-header">
                                  <div class="stk-logo-wrapper">
                                    <img src="/img/logo.png" alt="Logo Perusahaan">
                                  </div>
                                  <div class="stk-favicon-wrapper">
                                    <img src="/img/logopng.png" alt="Favicon">
                                  </div>
                                </div>
                                <div class="stk-item-info">
                                  <span class="stk-item-name"><?= htmlspecialchars($namaBarang) ?></span>
                                  <span class="stk-item-reg-number">REG: <?= htmlspecialchars($nomorRegistrasi) ?></span>
                                </div>
                                <div class="stk-qr-area">
                                  <div id="<?= $qrPinjamCanvasId ?>" class="stk-qr-image-container" data-qr-pinjam-content="<?= htmlspecialchars($detailData['id'] ?? '') ?>"></div>
                                  <span class="stk-scan-text text-navy pt-2"><i class="fas fa-hand-holding-medical mr-1"></i> PINJAM BARANG</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <button id="downloadQRPinjam" class="btn btn-sm btn-primary mt-3 mb-4">
                            <i class="fas fa-download mr-1"></i> Download QR Peminjaman Barang
                          </button>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-9">
                    <div class="card">
                      <div class="card-body">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold">
                            Informasi Tambahan
                          </h5>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-success"><i class="fas fa-barcode"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Nomor Registrasi</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['no_registrasi'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-info"><i class="fas fa-box-open"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Nama Barang</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['nama_detail_barang'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-success"><i class="fas fa-bolt"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Jenis Barang</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['nama_barang'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-purple"><i class="fas fa-trademark"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Merk</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['merk'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-secondary"><i class="fas fa-tag"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Tipe</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['tipe'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-success"><i class="fas fa-clipboard-check"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Kondisi</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['nama_kondisi'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-blue"><i class="fas fa-boxes"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Jumlah</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['jumlah'] ?? '1') ?> <?= htmlspecialchars($detailData['satuan'] ?? 'Unit') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-warning"><i class="fas fa-cash-register"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Biaya Pembelian</span>
                            <span class="info-box-text text-wrap text-justify">
                              <?= isset($detailData['biaya_pembelian']) ? 'Rp. ' . number_format((float)$detailData['biaya_pembelian'], 0, ',', '.') : '-' ?>
                            </span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-navy"><i class="fas fa-calendar-alt"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Tanggal Pembelian</span>
                            <span class="info-box-text text-wrap text-justify">
                              <?php
                              if (!empty($detailData['tanggal_pembelian'])) {
                                try {
                                  $tanggal = new DateTime($detailData['tanggal_pembelian']);
                                  echo htmlspecialchars($tanggal->format('d-m-Y'));
                                } catch (Exception $e) {
                                  echo htmlspecialchars($detailData['tanggal_pembelian']) . ' (format tidak valid)';
                                }
                              } else {
                                echo '-';
                              }
                              ?>
                            </span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-primary"><i class="fas fa-database"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Sumber</span>
                            <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['sumber'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Lokasi</span>
                            <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['lokasi'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-warning"><i class="fas fa-clipboard-list"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Spesifikasi</span>
                            <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['spesifikasi'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light">
                          <span class="info-box-icon bg-danger"><i class="fas fa-info-circle"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Keterangan</span>
                            <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['keterangan'] ?? 'Tidak ada keterangan') ?></span>
                          </div>
                        </div>
                        <!-- Tampilkan Informasi Peminjaman/Pengembalian jika status Dipinjam atau Tersedia dengan data peminjam -->
                        <?php
                        $showPeminjamanInfo = isset($detailData['status']) && $detailData['status'] == 'Dipinjam';
                        $showPengembalianInfo = isset($detailData['status']) && $detailData['status'] == 'Tersedia' && !empty($detailData['nama_peminjam']);
                        ?>
                        <?php if ($showPeminjamanInfo || $showPengembalianInfo) : ?>
                          <div class="border-top pt-3 mt-4">
                            <h5 class="text-bold text-navy">
                              <?php if ($showPeminjamanInfo) : ?>
                                Informasi Peminjaman
                              <?php elseif ($showPengembalianInfo) : ?>
                                Informasi Pengembalian Barang
                              <?php endif; ?>
                            </h5>
                          </div>
                          <div class="info-box bg-light">
                            <span class="info-box-icon bg-info"><i class="fas fa-info-circle"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-number">Status Barang</span>
                              <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['status'] ?? 'Tidak Diketahui') ?></span>
                            </div>
                          </div>
                          <div class="info-box bg-light">
                            <span class="info-box-icon bg-primary"><i class="fas fa-user"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-number">Nama</span>
                              <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['nama_peminjam'] ?? '-') ?></span>
                            </div>
                          </div>
                          <div class="info-box bg-light">
                            <span class="info-box-icon bg-secondary"><i class="fas fa-id-card"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-number">Identitas</span>
                              <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['identitas_peminjam'] ?? '-') ?></span>
                            </div>
                          </div>
                          <div class="info-box bg-light">
                            <span class="info-box-icon bg-teal"><i class="fas fa-phone"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-number">No. HP</span>
                              <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['no_hp_peminjam'] ?? '-') ?></span>
                            </div>
                          </div>
                          <div class="info-box bg-light">
                            <span class="info-box-icon bg-info"><i class="far fa-calendar-alt"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-number">Tanggal Peminjaman</span>
                              <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['tanggal_peminjaman'] ?? '-') ?></span>
                            </div>
                          </div>
                          <div class="info-box bg-light">
                            <span class="info-box-icon bg-warning"><i class="far fa-calendar-check"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-number">Tanggal Pengembalian</span>
                              <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['tanggal_pengembalian'] ?? '-') ?></span>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="border-bottom pb-2 mt-5 mb-3 d-flex justify-content-between align-items-center">
                  <h5 class="text-bold mb-0">
                    File Dokumen
                  </h5>
                  <a href="/admin/sarana/elektronik?tambah-dokumen=<?= htmlspecialchars($detailData['id'] ?? '') ?>" class="btn btn-warning btn-sm">
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
                        <th width="30%">Tindakan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($dokumenSaranaElektronik)) : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($dokumenSaranaElektronik as $barang) : ?>
                          <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($barang['nama_dokumen'] ?? '-') ?></td>
                            <td class="text-center">
                              <a href="/admin/sarana/elektronik?preview-file-dokumen=<?= htmlspecialchars($barang['id'] ?? '') ?>" class="btn btn-sm btn-info" title="Preview" target="_blank">
                                <i class="fas fa-eye"></i> Preview
                              </a>
                              <a href="/admin/sarana/elektronik?download-dokumen=<?= htmlspecialchars($barang['id'] ?? '') ?>" class="btn btn-sm btn-success" title="Download">
                                <i class="fas fa-download"></i> Download
                              </a>
                              <button type="button" class="btn btn-sm btn-danger" title="Hapus" onclick="confirmDeleteDokumen('<?= htmlspecialchars($barang['id'] ?? '') ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>', '<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Ini') ?>')">
                                <i class="fas fa-trash"></i> Hapus
                              </button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="3" class="text-center">Tidak ada data dokumen</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>

                <div class="border-bottom pb-2 my-5 d-flex justify-content-between align-items-center">
                  <h5 class="text-bold mb-0">
                    Dokumen Gambar
                  </h5>
                  <a href="/admin/sarana/elektronik?tambah-gambar=<?= htmlspecialchars($detailData['id'] ?? '') ?>" class="btn btn-warning btn-sm">
                    <div class="text-dark">
                      <i class="fas fa-plus mr-1"></i> Tambah Data
                    </div>
                  </a>
                </div>
                <div class="row mb-4">
                  <?php if (!empty($dokumenGambarElektronik)) : ?>
                    <?php foreach ($dokumenGambarElektronik as $gambar) : ?>
                      <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                          <div class="card-img-top position-relative" style="height: 200px; overflow: hidden;">
                            <?php
                            $pathGambar = $gambar['path_dokumen'] ?? null;
                            $idGambar = htmlspecialchars($gambar['id'] ?? '');
                            $namaDokumenGambar = htmlspecialchars($gambar['nama_dokumen'] ?? 'Dokumen Gambar');
                            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                            $extension = $pathGambar ? strtolower(pathinfo($pathGambar, PATHINFO_EXTENSION)) : '';
                            ?>
                            <?php if ($pathGambar && in_array($extension, $allowedExtensions)) : ?>
                              <img src="/admin/sarana/elektronik?preview-gambar=<?= $idGambar ?>" alt="<?= $namaDokumenGambar ?>" class="img-fluid h-100 w-100" style="object-fit: cover;" loading="lazy">
                            <?php else : ?>
                              <div class="img-fluid h-100 w-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                Preview Tidak Tersedia
                              </div>
                            <?php endif; ?>
                          </div>
                          <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-center mb-3 text-truncate" title="<?= $namaDokumenGambar ?>"><?= $namaDokumenGambar ?></h6>
                            <div class="mt-auto text-center">
                              <a href="/admin/sarana/elektronik?preview-gambar=<?= $idGambar ?>" class="btn btn-sm btn-primary" title="Lihat" target="_blank">
                                <i class="fas fa-eye"></i> Lihat
                              </a>
                              <button type="button" class="btn btn-sm btn-danger" title="Hapus Gambar" onclick="confirmDeleteGambar('<?= $idGambar ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>', '<?= $namaDokumenGambar ?>')">
                                <i class="fas fa-trash"></i> Hapus
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <div class="col-12">
                      <div class="alert alert-info text-center" role="alert">
                        Tidak ada dokumen gambar.
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Barang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus barang <strong id="itemNameModal"></strong>? Tindakan ini tidak dapat dibatalkan dan akan menghapus semua dokumen terkait.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <a href="/admin/sarana/elektronik?delete=<?= htmlspecialchars($detailData['id'] ?? '') ?>" id="confirmDeleteButton" class="btn btn-danger">Hapus</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Konfirmasi Hapus Dokumen -->
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

    <!-- Modal Konfirmasi Hapus Gambar -->
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

  <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

  <script>
    function confirmDeleteDokumen(dokumenId, saranaId, namaDokumen) {
      $('#dokumenNameModal').text(namaDokumen || 'Dokumen Ini');
      var deleteUrl = `/admin/sarana/elektronik?delete-dokumen=${dokumenId}&sarana_id=${saranaId}`;
      $('#confirmDeleteDokumenButton').attr('href', deleteUrl);
      $('#deleteDokumenModal').modal('show');
    }

    function confirmDeleteGambar(gambarId, saranaId, namaGambar) {
      $('#gambarNameModal').text(namaGambar || 'Gambar Ini');
      var deleteUrl = `/admin/sarana/elektronik?delete-gambar=${gambarId}&sarana_id=${saranaId}`;
      $('#confirmDeleteGambarButton').attr('href', deleteUrl);
      $('#deleteGambarModal').modal('show');
    }

    $(document).ready(function() {

      $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var itemId = button.data('id');
        var itemName = "<?= htmlspecialchars($detailData['nama_detail_barang'] ?? 'Barang Ini') ?>";
        var modal = $(this);
        modal.find('#itemNameModal').text(itemName);
        var deleteUrl = '/admin/sarana/elektronik?delete=' + itemId;
        modal.find('#confirmDeleteButton').attr('href', deleteUrl);
      });

      const qrContainer = document.getElementById('<?= $qrCanvasId ?>');
      if (qrContainer) {
        const nomorRegFromDataAttr = qrContainer.getAttribute('data-qr-content');
        if (nomorRegFromDataAttr && nomorRegFromDataAttr !== 'REG-TIDAK-ADA') {
          const qrBaseUrl = "<?= $BaseUrlQr; ?>";
          const qrPath = `/admin/sarana/elektronik/detail/${nomorRegFromDataAttr}`;
          const finalQrText = qrBaseUrl + qrPath;

          console.log("Konten QR (Detail) yang akan digenerate:", finalQrText);

          new QRCode(qrContainer, {
            text: finalQrText,
            width: 150,
            height: 150,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
          });
        } else {
          console.error("Nomor Registrasi tidak valid untuk QR Detail:", nomorRegFromDataAttr);
          qrContainer.innerHTML = "<small>No. Registrasi Error</small>";
        }
      }

      function downloadCardAsImage(targetElementId, fileNamePrefix) {
        const targetElement = document.getElementById(targetElementId);
        if (!targetElement) {
          alert(`Tidak dapat menemukan elemen kartu QR untuk diunduh (${targetElementId}).`);
          return;
        }

        const namaBarangPHP = "<?= htmlspecialchars($namaBarang, ENT_QUOTES, 'UTF-8') ?>";
        const nomorRegPHP = "<?= htmlspecialchars($nomorRegistrasi, ENT_QUOTES, 'UTF-8') ?>";
        const fileName = `${fileNamePrefix}-${namaBarangPHP.replace(/[^a-zA-Z0-9_.-]/g, '_')}-${nomorRegPHP}.png`;

        html2canvas(targetElement, {
          scale: 5,
          useCORS: true,
          logging: false,
          backgroundColor: '#FFFFFF'
        }).then(canvas => {
          const link = document.createElement("a");
          link.download = fileName;
          link.href = canvas.toDataURL("image/png");
          link.click();
        }).catch(err => {
          console.error(`Gagal membuat gambar kartu QR (${targetElementId}):`, err);
          alert(`Gagal membuat gambar kartu QR. Cek console untuk detail.`);
        });
      }

      const downloadButton = document.getElementById("downloadQR");
      if (downloadButton) {
        downloadButton.addEventListener("click", function() {
          downloadCardAsImage("qrCardToExport", "QR");
        });
      }

      const downloadPinjamButton = document.getElementById("downloadQRPinjam");
      if (downloadPinjamButton) {
        downloadPinjamButton.addEventListener("click", function() {
          downloadCardAsImage("qrPinjamCardToExport", "QR-Pinjam");
        });
      }

      const qrPinjamContainer = document.getElementById('<?= $qrPinjamCanvasId ?>');
      if (qrPinjamContainer) {
        const itemIdForPinjam = qrPinjamContainer.getAttribute('data-qr-pinjam-content');
        if (itemIdForPinjam) {
          const qrBaseUrl = "<?= $BaseUrlQr; ?>";
          const qrPinjamPath = `/admin/sarana/elektronik/pinjam?edit=${itemIdForPinjam}`;
          const finalQrPinjamText = qrBaseUrl + qrPinjamPath;
          new QRCode(qrPinjamContainer, {
            text: finalQrPinjamText,
            width: 150,
            height: 150,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
          });
        } else {
          qrPinjamContainer.innerHTML = "<small>ID Barang Error</small>";
        }
      }
    });
  </script>
</body>

</html>