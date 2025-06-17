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
                    Detail Bangunan
                  </h3>
                  <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#deleteModal" data-id="<?= $detailData['id']; ?>">
                      <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                    <a href="/admin/prasarana/gedung?edit=<?= $detailData['id']; ?>" class="btn btn-warning btn-sm mr-2">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="/admin/prasarana/gedung" class="btn btn-secondary btn-sm">
                      <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <!-- QR Code Section -->
                  <div class="col-md-3">
                    <div class="text-center d-flex flex-column align-items-center">
                      <?php
                      $namaGedung = $detailData['nama_gedung'] ?? 'Gedung Tidak Bernama';
                      $kodeGedung = $detailData['kode_gedung'] ?? 'KODE-TIDAK-ADA';
                      $gedungId = $detailData['id'] ?? uniqid();
                      $qrCanvasId = "qrCanvas_" . htmlspecialchars($gedungId);
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
                              <span class="stk-item-name"><?= htmlspecialchars($namaGedung) ?></span>
                              <span class="stk-item-reg-number">KODE: <?= htmlspecialchars($kodeGedung) ?></span>
                            </div>
                            <div class="stk-qr-area">
                              <div id="<?= $qrCanvasId ?>" class="stk-qr-image-container" data-qr-content="<?= htmlspecialchars($gedungId) ?>"></div>
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
                    </div>
                  </div>
                  <!-- Details Section -->
                  <div class="col-md-9">
                    <div class="card">
                      <div class="card-body">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold">
                            Informasi Tambahan
                          </h5>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-success"><i class="fas fa-barcode"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Kode Bangunan</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['kode_gedung'] ?? 'GDG-001') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-info"><i class="fas fa-building"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Nama Bangunan</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['nama_gedung'] ?? 'Gedung A') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-warning"><i class="fas fa-layer-group"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Jumlah Lantai</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['jumlah_lantai'] ?? '4') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-primary"><i class="fas fa-ruler-combined"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Luas</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['luas'] ?? '50') ?> m²</span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-purple"><i class="fas fa-hard-hat"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Konstruksi</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['kontruksi'] ?? 'Tidak ada data') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-<?= ($detailData['kondisi'] ?? 'Baik') === 'Baik' ? 'success' : (($detailData['kondisi'] ?? 'Baik') === 'Rusak Ringan' ? 'warning' : 'danger') ?>">
                            <i class="fas fa-info-circle"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-number">Kondisi</span>
                            <span class="info-box-text">
                              <span class="badge badge-<?= ($detailData['kondisi'] ?? 'Baik') === 'Baik' ? 'success' : (($detailData['kondisi'] ?? 'Baik') === 'Rusak Ringan' ? 'warning' : 'danger') ?>">
                                <?= htmlspecialchars($detailData['kondisi'] ?? 'Baik') ?>
                              </span>
                            </span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-indigo"><i class="fas fa-cogs"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Fungsi</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['fungsi'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-maroon"><i class="fas fa-tag"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Jenis Aset</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['jenis_aset'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-teal"><i class="fas fa-university"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Unit Kepemilikan</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['unit_kepemilikan'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-lime"><i class="fas fa-calendar-check"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Tahun Dibangun</span>
                            <span class="info-box-text"><?= $detailData['tahun_dibangun'] ? htmlspecialchars(date('d F Y', strtotime($detailData['tahun_dibangun']))) : '-' ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-fuchsia"><i class="fas fa-city"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Jenis Bangunan</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['jenis_bangunan'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-olive"><i class="fas fa-map-marker-alt"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Lokasi</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['lokasi'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-secondary"><i class="fas fa-info"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Keterangan</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['keterangan'] ?? '-') ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="px-3">
                <div class="border-bottom pb-2 mb-3 mt-5">
                  <h5 class="text-bold mb-0">
                    Daftar Ruangan Pada Bangunan
                  </h5>
                </div>

                <div class="table-responsive <?php if (empty($filteredRuangList)): echo 'pb-1';
                                              endif; ?>">
                  <table id="ruangTable" class="table table-bordered table-hover">
                    <thead class="bg-light">
                      <tr class="align-middle text-center">
                        <th width="5%">No</th> <!-- Tetap -->
                        <th width="35%">Nama Ruang</th> <!-- Ditambah -->
                        <th width="10%">Kapasitas</th>
                        <th width="10%">Letak Lantai</th> <!-- Dikurangi -->
                        <th width="15%">Status</th> <!-- Tetap -->
                        <th width="25%">Jenis Ruangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($filteredRuangList)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($filteredRuangList as $ruang): ?>
                          <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($ruang['nama_ruang'] ?? '-') ?></td>
                            <td class="text-center"><?= htmlspecialchars($ruang['kapasitas'] ?? '-') ?></td>
                            <td class="text-center"><?= htmlspecialchars($ruang['lantai'] ?? '-') ?></td>
                            <td class="text-center">
                              <?php if (isset($ruang['status'])): ?>
                                <?php if ($ruang['status'] == 'Terpakai'): ?>
                                  <span class="badge badge-success">Terpakai</span>
                                <?php elseif ($ruang['status'] == 'Kosong'): ?>
                                  <span class="badge badge-warning">Kosong</span>
                                <?php else: ?>
                                  <span class="badge badge-danger"><?= htmlspecialchars($ruang['status']) ?></span>
                                <?php endif; ?>
                              <?php else: ?>
                                -
                              <?php endif; ?>
                            </td>

                            <td><?= htmlspecialchars($ruang['jenis_ruangan'] ?? '-') ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="6" class="text-center py-3">Tidak ada data ruangan pada bangunan ini.</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>

                <!-- Dokumen -->
                <div class="border-bottom pb-2 mt-5 mb-3 d-flex justify-content-between align-items-center">
                  <h5 class="text-bold mb-0">
                    File Dokumen
                  </h5>
                  <a href="/admin/prasarana/gedung?tambah-dokumen=<?= htmlspecialchars($detailData['id']) ?>" class="btn btn-warning btn-sm">
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
                      <?php if (!empty($dokumenAsetGedung)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($dokumenAsetGedung as $barang): ?>
                          <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($barang['nama_dokumen'] ?? '-') ?></td>
                            <td class="text-center">
                              <a href="/admin/prasarana/gedung?download-dokumen=<?= htmlspecialchars($barang['id'] ?? '-') ?>" class="btn btn-sm btn-success mr-1" title="Download" download>
                                <i class="fas fa-download"></i> Download
                              </a>
                              <button type="button" class="btn btn-sm btn-danger" title="Hapus Dokumen"
                                onclick="confirmDeleteGedungDokumen('<?= htmlspecialchars($barang['id'] ?? '') ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>', '<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Ini') ?>')">
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
                <div class="border-bottom pb-2 my-5 d-flex justify-content-between align-items-center">
                  <h5 class="text-bold mb-0">
                    Dokumen Gambar
                  </h5>
                  <a href="/admin/prasarana/gedung?tambah-gambar=<?= htmlspecialchars($detailData['id']) ?>" class="btn btn-warning btn-sm">
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
                              <img src="/admin/prasarana/gedung?preview-gambar=<?= htmlspecialchars($barang['id']) ?>"
                                alt="<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Gedung') ?>"
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
                            <h6 class="card-title text-center mb-3"><?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Gedung') ?></h6>
                            <div class="mt-auto text-center d-flex justify-content-center gap-2">
                              <button type="button" class="btn btn-sm btn-danger" title="Hapus Gambar"
                                onclick="confirmDeleteGedungGambar('<?= htmlspecialchars($barang['id'] ?? '') ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>', '<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Gambar Ini') ?>')">
                                <i class="fas fa-trash"></i> Hapus
                              </button>
                              <a href="/admin/prasarana/gedung?preview-gambar=<?= htmlspecialchars($barang['id'] ?? '-') ?>" class="btn btn-sm btn-primary" title="Preview" target="_blank">
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
              </div>



            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Hapus Data Gedung Utama -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus data bangunan ini?
            Tindakan ini akan menghapus seluruh data ruangan yang terkait dan tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a id="deleteButton" href="#" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus Dokumen Gedung -->
  <div class="modal fade" id="deleteGedungDokumenModal" tabindex="-1" role="dialog" aria-labelledby="deleteGedungDokumenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteGedungDokumenModalLabel">Konfirmasi Hapus Dokumen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus dokumen <strong id="gedungDokumenNameModal"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a href="#" id="confirmDeleteGedungDokumenButton" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus Gambar Gedung -->
  <div class="modal fade" id="deleteGedungGambarModal" tabindex="-1" role="dialog" aria-labelledby="deleteGedungGambarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteGedungGambarModalLabel">Konfirmasi Hapus Gambar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus gambar <strong id="gedungGambarNameModal"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a href="#" id="confirmDeleteGedungGambarButton" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>
  <?php include './app/Views/Components/footer.php'; ?>
  </div>

  <?php include './app/Views/Components/script.php'; ?>

  <!-- Ekstensi untuk lightbox gambar -->
  <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

  <script>
    function confirmDeleteGedungDokumen(dokumenId, gedungId, namaDokumen) {
      $('#gedungDokumenNameModal').text(namaDokumen || 'Dokumen Ini');
      var deleteUrl = `/admin/prasarana/gedung?delete-dokumen=${dokumenId}&gedung_id=${gedungId}`;
      $('#confirmDeleteGedungDokumenButton').attr('href', deleteUrl);
      $('#deleteGedungDokumenModal').modal('show');
    }

    function confirmDeleteGedungGambar(gambarId, gedungId, namaGambar) {
      $('#gedungGambarNameModal').text(namaGambar || 'Gambar Ini');
      var deleteUrl = `/admin/prasarana/gedung?delete-gambar=${gambarId}&gedung_id=${gedungId}`;
      $('#confirmDeleteGedungGambarButton').attr('href', deleteUrl);
      $('#deleteGedungGambarModal').modal('show');
    }

    $(document).ready(function() {
      // Inisialisasi lightbox untuk gambar dokumentasi
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
      });

      // Tangkap event klik tombol delete
      $('button[data-target="#deleteModal"]').on('click', function() {
        var id = $(this).data('id');
        var deleteUrl = '/admin/prasarana/gedung?delete=' + id;
        // Set URL hapus ke tombol Hapus di modal
        $('#deleteButton').attr('href', deleteUrl);
      });

      // QR Code Generation for Gedung Detail
      const qrContainer = document.getElementById('<?= $qrCanvasId ?>');
      if (qrContainer) {
        const gedungIdFromDataAttr = qrContainer.getAttribute('data-qr-content');
        if (gedungIdFromDataAttr) {
          const qrBaseUrl = "<?= $BaseUrlQr ?? '' ?>";
          const qrPath = `/admin/prasarana/gedung?detail=${gedungIdFromDataAttr}`;
          const finalQrText = qrBaseUrl + qrPath;

          new QRCode(qrContainer, {
            text: finalQrText,
            width: 150,
            height: 150,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
          });
        } else {
          qrContainer.innerHTML = "<small>ID Gedung Error</small>";
        }
      }

      // Download QR Card
      function downloadCardAsImage(targetElementId, fileNamePrefix) {
        const targetElement = document.getElementById(targetElementId);
        if (!targetElement) {
          alert(`Tidak dapat menemukan elemen kartu QR untuk diunduh (${targetElementId}).`);
          return;
        }

        const namaGedungPHP = "<?= htmlspecialchars($namaGedung, ENT_QUOTES, 'UTF-8') ?>";
        const kodeGedungPHP = "<?= htmlspecialchars($kodeGedung, ENT_QUOTES, 'UTF-8') ?>";
        const fileName = `${fileNamePrefix}-Gedung-${namaGedungPHP.replace(/[^a-zA-Z0-9_.-]/g, '_')}-${kodeGedungPHP}.png`;

        html2canvas(targetElement, {
            scale: 5,
            useCORS: true,
            logging: false,
            backgroundColor: '#FFFFFF'
          })
          .then(canvas => {
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

      if ($.fn.DataTable) {
        $("#ruangTable").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "searching": false,
          "paging": false,
          "info": false,
          "ordering": false
        });
      }
    });
  </script>
</body>

</html>