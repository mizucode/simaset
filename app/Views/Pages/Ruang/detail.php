<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>
<!-- Apply px-3 to body to match Gedung/detail.php -->

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>
    <?php include './app/Views/Components/css.php'; ?> <!-- Ensure this includes necessary CSS -->

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

    <div class="content-wrapper bg-white mb-5 pt-3"> <!-- Removed px-4 -->
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>
            <div class="card card-navy">
              <div class="card-header text-white">
                <div class="d-flex justify-content-between align-items-center">
                  <h3 class="card-title text-lg">
                    Detail Ruangan
                  </h3>
                  <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#deleteModal" data-id="<?= $detailData['id']; ?>">
                      <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                    <a href="/admin/prasarana/ruang?edit=<?= $detailData['id']; ?>" class="btn btn-warning btn-sm mr-2">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="/admin/prasarana/ruang" class="btn btn-secondary btn-sm">
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
                      $namaRuang = $detailData['nama_ruang'] ?? 'Ruang Tidak Bernama';
                      $kodeRuang = $detailData['kode_ruang'] ?? 'KODE-TIDAK-ADA';
                      $ruangId = $detailData['id'] ?? uniqid();
                      $qrCanvasId = "qrCanvas_" . htmlspecialchars($ruangId);
                      ?>
                      <div>
                        <div class="stk-card" id="qrCardToExportRuang">
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
                              <span class="stk-item-name"><?= htmlspecialchars($namaRuang) ?></span>
                              <span class="stk-item-reg-number">KODE: <?= htmlspecialchars($kodeRuang) ?></span>
                            </div>
                            <div class="stk-qr-area">
                              <div id="<?= $qrCanvasId ?>" class="stk-qr-image-container" data-qr-content="<?= htmlspecialchars($ruangId) ?>"></div>
                              <span class="stk-scan-text text-navy pt-2">
                                <i class="fas fa-qrcode mr-1"></i> SCAN DI SINI
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button id="downloadQRRuang" class="btn btn-sm btn-success mt-4 mb-5">
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
                            Detail Informasi Ruangan
                          </h5>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-success"><i class="fas fa-barcode"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Kode Ruangan</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['kode_ruang'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-info"><i class="fas fa-door-open"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Nama Ruangan</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['nama_ruang'] ?? 'Ruang A1') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-primary"><i class="fas fa-building"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Letak Gedung</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['nama_gedung'] ?? 'Belum terdata') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-warning"><i class="fas fa-layer-group"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Letak Lantai</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['lantai'] ?? '1') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-purple"><i class="fas fa-ruler-combined"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Luas</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['luas'] ?? '50') ?> m²</span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-secondary"><i class="fas fa-users"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Kapasitas</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['kapasitas'] ?? '30') ?> orang</span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-<?= ($detailData['status'] ?? 'Terpakai') === 'Terpakai' ? 'success' : (($detailData['status'] ?? 'Terpakai') === 'Kosong' ? 'warning' : 'danger') ?>"><i class="fas fa-toggle-on"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Status</span>
                            <span class="info-box-text">
                              <span class="badge badge-<?= ($detailData['status'] ?? 'Terpakai') === 'Terpakai' ? 'success' : (($detailData['status'] ?? 'Terpakai') === 'Kosong' ? 'warning' : 'danger') ?>">
                                <?= htmlspecialchars($detailData['status'] ?? 'Terpakai') ?>
                              </span>
                            </span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-dark"><i class="fas fa-person-booth"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Jenis Ruangan</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['jenis_ruangan'] ?? 'Umum') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-<?= ($detailData['kondisi_ruang'] ?? 'Baik') === 'Baik' ? 'success' : (($detailData['kondisi_ruang'] ?? 'Baik') === 'Rusak Ringan' ? 'warning' : 'danger') ?>"><i class="fas fa-heartbeat"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Kondisi Ruang</span>
                            <span class="info-box-text">
                              <span class="badge badge-<?= ($detailData['kondisi_ruang'] ?? 'Baik') === 'Baik' ? 'success' : (($detailData['kondisi_ruang'] ?? 'Baik') === 'Rusak Ringan' ? 'warning' : 'danger') ?>">
                                <?= htmlspecialchars($detailData['kondisi_ruang'] ?? 'Baik') ?>
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
                          <span class="info-box-icon bg-maroon"><i class="fas fa-sticky-note"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Keterangan</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['keterangan'] ?? '-') ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- End card-body -->

              <div class="px-3"> <!-- Wrapper for tables and document sections -->
                <div class="border-bottom pb-2 mb-3 mt-5">
                  <h5 class="text-bold mb-0">
                    Barang Inventaris dalam Ruangan
                  </h5>
                </div>

                <div class="table-responsive">
                  <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="15%">Nomor Registrasi</th>
                        <th width="30%">Nama Barang</th>
                        <th width="15%">Jenis Barang</th>
                        <th width="20%">Kategori Barang</th>
                        <th width="10%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($filteredBarangList)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($filteredBarangList as $barang): ?>
                          <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($barang['no_registrasi'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($barang['nama_detail_barang'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($barang['barang'] ?? '-') ?></td> <!-- Ini adalah nama jenis barang (misal: Laptop, Meja) -->
                            <td><?= htmlspecialchars($barang['kategori'] ?? '-') ?></td> <!-- Ini adalah nama kategori barang (misal: Elektronik, Mebelair) -->
                            <td class="text-center">
                              <?php
                              $detailUrl = '#';
                              if (isset($barang['kategori_barang_id']) && isset($barang['no_registrasi'])) {
                                switch ($barang['kategori_barang_id']) {
                                  case 1: // Bergerak
                                    $detailUrl = "/admin/sarana/bergerak/detail/" . htmlspecialchars($barang['no_registrasi']);
                                    break;
                                  case 2: // Mebelair
                                    $detailUrl = "/admin/sarana/mebelair/detail/" . htmlspecialchars($barang['no_registrasi']);
                                    break;
                                  case 3: // ATK
                                    $detailUrl = "/admin/sarana/atk/detail/" . htmlspecialchars($barang['no_registrasi']);
                                    break;
                                  case 4: // Elektronik
                                    $detailUrl = "/admin/sarana/elektronik/detail/" . htmlspecialchars($barang['no_registrasi']);
                                    break;
                                }
                              }
                              ?>
                              <a href="<?= $detailUrl ?>" class="btn btn-info btn-sm" title="Detail Barang">
                                <i class="fas fa-eye mr-1"></i> Detail
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="6" class="text-center py-3">Tidak ada data barang di ruangan ini</td> <!-- Changed colspan to 5 -->
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
                  <a href="/admin/prasarana/ruang?tambah-dokumen=<?= htmlspecialchars($detailData['id']) ?>" class="btn btn-warning btn-sm">
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
                      <?php if (!empty($dokumenAsetRuang)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($dokumenAsetRuang as $barang): ?>
                          <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($barang['nama_dokumen'] ?? '-') ?></td>
                            <td class="text-center">
                              <a href="/admin/prasarana/ruang?preview-file-dokumen=<?= htmlspecialchars($barang['id'] ?? '-') ?>" class="btn btn-sm btn-primary mr-1" title="Preview" target="_blank">
                                <i class="fas fa-eye"></i> Preview
                              </a>
                              <a href="/admin/prasarana/ruang?download-dokumen=<?= htmlspecialchars($barang['id'] ?? '-') ?>" class="btn btn-sm btn-success" title="Download" download>
                                <i class="fas fa-download"></i> Unduh
                              </a>
                              <button type="button" class="btn btn-sm btn-danger" title="Hapus Dokumen" onclick="confirmDeleteRuangDokumen('<?= htmlspecialchars($barang['id'] ?? '') ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>', '<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Ini') ?>')">
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
                <div class="border-bottom pb-2 my-5 d-flex justify-content-between align-items-center">
                  <h5 class="text-bold mb-0">
                    Dokumen Gambar
                  </h5>
                  <a href="/admin/prasarana/ruang?tambah-gambar=<?= htmlspecialchars($detailData['id']) ?>" class="btn btn-warning btn-sm">
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
                              <img src="/admin/prasarana/ruang?preview-gambar=<?= htmlspecialchars($barang['id']) ?>"
                                alt="<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Ruang') ?>"
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
                            <h6 class="card-title text-center mb-3"><?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Ruang') ?></h6>
                            <div class="mt-auto text-center d-flex justify-content-center gap-2">
                              <button type="button" class="btn btn-sm btn-danger" title="Hapus Gambar" onclick="confirmDeleteRuangGambar('<?= htmlspecialchars($barang['id'] ?? '') ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>', '<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Gambar Ini') ?>')">
                                <i class="fas fa-trash"></i> Hapus
                              </button>
                              <a href="/admin/prasarana/ruang?preview-gambar=<?= htmlspecialchars($barang['id'] ?? '-') ?>" class="btn btn-sm btn-primary mr-1" title="Preview" target="_blank">
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
              </div> <!-- End px-3 wrapper -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Hapus Data Ruang Utama -->
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
          <p>Apakah Anda yakin ingin menghapus ruangan ini? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a id="deleteButton" href="#" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus Dokumen Ruang -->
  <div class="modal fade" id="deleteRuangDokumenModal" tabindex="-1" role="dialog" aria-labelledby="deleteRuangDokumenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteRuangDokumenModalLabel">Konfirmasi Hapus Dokumen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus dokumen <strong id="ruangDokumenNameModal"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a href="#" id="confirmDeleteRuangDokumenButton" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus Gambar Ruang -->
  <div class="modal fade" id="deleteRuangGambarModal" tabindex="-1" role="dialog" aria-labelledby="deleteRuangGambarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteRuangGambarModalLabel">Konfirmasi Hapus Gambar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus gambar <strong id="ruangGambarNameModal"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a href="#" id="confirmDeleteRuangGambarButton" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>
  <?php include './app/Views/Components/footer.php'; ?>

  <?php include './app/Views/Components/script.php'; ?>

  <!-- Ekstensi untuk lightbox gambar -->
  <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

  <script>
    $(document).ready(function() {
      // Inisialisasi lightbox untuk gambar dokumentasi
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
      });

      // Tangkap event klik tombol delete
      $('button[data-target="#deleteModal"]').on('click', function() {
        var id = $(this).data('id');
        var deleteUrl = '/admin/prasarana/ruang?delete=' + id;

        // Set URL hapus ke tombol Hapus di modal
        $('#deleteButton').attr('href', deleteUrl);
      });

      // QR Code Generation for Ruang Detail
      const qrContainerRuang = document.getElementById('<?= $qrCanvasId ?>');
      if (qrContainerRuang) {
        const ruangIdFromDataAttr = qrContainerRuang.getAttribute('data-qr-content');
        if (ruangIdFromDataAttr) {
          const qrBaseUrl = "<?= htmlspecialchars($BaseUrlQr ?? '', ENT_QUOTES, 'UTF-8') ?>";
          const qrPath = `/admin/prasarana/ruang?detail=${ruangIdFromDataAttr}`;
          const finalQrText = qrBaseUrl + qrPath;

          new QRCode(qrContainerRuang, {
            text: finalQrText,
            width: 150,
            height: 150,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
          });
        } else {
          qrContainerRuang.innerHTML = "<small>ID Ruang Error</small>";
        }
      }

      // Download QR Card for Ruang
      function downloadCardAsImageRuang(targetElementId, fileNamePrefix) {
        const targetElement = document.getElementById(targetElementId);
        if (!targetElement) {
          alert(`Tidak dapat menemukan elemen kartu QR untuk diunduh (${targetElementId}).`);
          return;
        }

        const namaRuangPHP = "<?= htmlspecialchars($namaRuang, ENT_QUOTES, 'UTF-8') ?>";
        const kodeRuangPHP = "<?= htmlspecialchars($kodeRuang, ENT_QUOTES, 'UTF-8') ?>";
        const fileName = `${fileNamePrefix}-Ruang-${namaRuangPHP.replace(/[^a-zA-Z0-9_.-]/g, '_')}-${kodeRuangPHP}.png`;

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

      const downloadButtonRuang = document.getElementById("downloadQRRuang");
      if (downloadButtonRuang) {
        downloadButtonRuang.addEventListener("click", function() {
          downloadCardAsImageRuang("qrCardToExportRuang", "QR");
        });
      }
    });

    function confirmDeleteRuangDokumen(dokumenId, ruangId, namaDokumen) {
      $('#ruangDokumenNameModal').text(namaDokumen || 'Dokumen Ini');
      var deleteUrl = `/admin/prasarana/ruang?delete-dokumen=${dokumenId}&ruang_id=${ruangId}`; // ruang_id mungkin tidak perlu jika controller bisa ambil dari dokumenId
      $('#confirmDeleteRuangDokumenButton').attr('href', deleteUrl);
      $('#deleteRuangDokumenModal').modal('show');
    }

    function confirmDeleteRuangGambar(gambarId, ruangId, namaGambar) {
      $('#ruangGambarNameModal').text(namaGambar || 'Gambar Ini');
      var deleteUrl = `/admin/prasarana/ruang?delete-gambar=${gambarId}&ruang_id=${ruangId}`; // ruang_id mungkin tidak perlu
      $('#confirmDeleteRuangGambarButton').attr('href', deleteUrl);
      $('#deleteRuangGambarModal').modal('show');
    }
  </script>
</body>

</html>