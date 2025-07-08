<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>
<!-- Apply px-3 to body to match Ruang/detail.php -->

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
                    Detail Lapangan
                  </h3>
                  <div class="text-right">
                    <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#deleteModal" data-id="<?= $detailData['id']; ?>">
                      <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                    <a href="/admin/prasarana/lapang?edit=<?= $detailData['id']; ?>" class="btn btn-warning btn-sm mr-2">
                      <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="/admin/prasarana/lapang" class="btn btn-secondary btn-sm">
                      <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="row mb-4">
                  <!-- QR Code Section -->
                  <div class="col-md-3">
                    <div class="text-center d-flex flex-column align-items-center">
                      <?php
                      $namaLapang = $detailData['nama_lapang'] ?? 'Lapang Tidak Bernama';
                      $kodeLapang = $detailData['kode_lapang'] ?? 'KODE-TIDAK-ADA';
                      $lapangId = $detailData['id'] ?? uniqid();
                      $qrCanvasId = "qrCanvas_" . htmlspecialchars($lapangId);
                      ?>
                      <div>
                        <div class="stk-card" id="qrCardToExportLapang">
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
                              <span class="stk-item-name"><?= htmlspecialchars($namaLapang) ?></span>
                              <span class="stk-item-reg-number">KODE: <?= htmlspecialchars($kodeLapang) ?></span>
                            </div>
                            <div class="stk-qr-area">
                              <div id="<?= $qrCanvasId ?>" class="stk-qr-image-container" data-qr-content="<?= htmlspecialchars($lapangId) ?>"></div>
                              <span class="stk-scan-text text-navy pt-2">
                                <i class="fas fa-qrcode mr-1"></i> SCAN DI SINI
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button id="downloadQRLapang" class="btn btn-sm btn-success mt-4 mb-5">
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
                            Detail Informasi Lapangan
                          </h5>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-success"><i class="fas fa-barcode"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Kode Aset</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['kode_lapang'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-info"><i class="fas fa-signature"></i></span> <!-- Changed icon -->
                          <div class="info-box-content">
                            <span class="info-box-number">Nama Lapangan</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['nama_lapang'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-primary"><i class="fas fa-layer-group"></i></span> <!-- Changed icon -->
                          <div class="info-box-content">
                            <span class="info-box-number">Kategori</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['kategori'] ?? 'Belum terdata') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-warning"><i class="fas fa-ruler-combined"></i></span> <!-- Changed icon & color -->
                          <div class="info-box-content">
                            <span class="info-box-number">Luas</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['luas'] ?? '0') ?> m²</span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-purple"><i class="fas fa-cogs"></i></span> <!-- Changed icon -->
                          <div class="info-box-content">
                            <span class="info-box-number">Fungsi</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['fungsi'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <?php
                          $statusLapang = $detailData['status'] ?? 'Kosong';
                          $badgeClassStatus = 'secondary';
                          if ($statusLapang === 'Terpakai') $badgeClassStatus = 'success';
                          elseif ($statusLapang === 'Kosong') $badgeClassStatus = 'warning';
                          elseif ($statusLapang === 'Dalam Perbaikan') $badgeClassStatus = 'danger';
                          ?>
                          <span class="info-box-icon bg-<?= $badgeClassStatus ?>"><i class="fas fa-toggle-on"></i></span> <!-- Changed icon -->
                          <div class="info-box-content">
                            <span class="info-box-number">Status</span>
                            <span class="info-box-text">
                              <span class="badge badge-<?= $badgeClassStatus ?>">
                                <?= htmlspecialchars($statusLapang) ?>
                              </span>
                            </span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <?php
                          $kondisiLapang = $detailData['kondisi'] ?? 'Baik';
                          $badgeClassKondisi = 'secondary';
                          if ($kondisiLapang === 'Baik') $badgeClassKondisi = 'success';
                          elseif ($kondisiLapang === 'Rusak Ringan') $badgeClassKondisi = 'warning';
                          elseif ($kondisiLapang === 'Rusak Berat') $badgeClassKondisi = 'danger';
                          ?>
                          <span class="info-box-icon bg-<?= $badgeClassKondisi ?>"><i class="fas fa-heartbeat"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Kondisi Lapangan</span>
                            <span class="info-box-text">
                              <span class="badge badge-<?= $badgeClassKondisi ?>">
                                <?= htmlspecialchars($kondisiLapang) ?>
                              </span>
                            </span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-dark"><i class="fas fa-map-marker-alt"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Lokasi</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['lokasi'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-indigo"><i class="fas fa-archive"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Jenis Aset</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['jenis_aset'] ?? '-') ?></span>
                          </div>
                        </div>
                        <div class="info-box bg-light mb-3">
                          <span class="info-box-icon bg-maroon"><i class="fas fa-sticky-note"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-number">Keterangan</span>
                            <span class="info-box-text"><?= htmlspecialchars($detailData['keterangan'] ?? 'Tidak ada keterangan.') ?></span>
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
                    Barang Inventaris dalam Lapangan
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
                          <td colspan="6" class="text-center py-3">Tidak ada data barang di lapangan ini</td> <!-- Changed colspan to 6 -->
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
                  <a href="/admin/prasarana/lapang?tambah-dokumen=<?= htmlspecialchars($detailData['id']) ?>" class="btn btn-warning btn-sm ml-auto">
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
                        <th width="70%">Nama Dokumen</th> <!-- Adjusted width -->
                        <th width="30%">Link download</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($dokumenAsetLapang)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($dokumenAsetLapang as $barang): ?>
                          <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($barang['nama_dokumen'] ?? '-') ?></td>
                            <td class="text-center d-flex justify-content-center gap-2">
                              <a href="/admin/prasarana/lapang?preview-file-dokumen=<?= htmlspecialchars($barang['id'] ?? '-') ?>" class="btn btn-sm btn-primary" title="Preview" target="_blank">
                                <i class="fas fa-eye"></i> Preview
                              </a>
                              <a href="/admin/prasarana/lapang?download-dokumen=<?= htmlspecialchars($barang['id'] ?? '-') ?>" class="btn btn-sm btn-success" title="Download" download>
                                <i class="fas fa-download"></i> Unduh
                              </a>
                              <button type="button" class="btn btn-sm btn-danger" title="Hapus Dokumen" onclick="confirmDeleteLapangDokumen('<?= htmlspecialchars($barang['id'] ?? '') ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>', '<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Ini') ?>')">
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
                <!-- Dokumen Gambar -->
                <div class="border-bottom pb-2 my-5 d-flex justify-content-between align-items-center">
                  <h5 class="text-bold mb-0">
                    Dokumen Gambar
                  </h5>
                  <a href="/admin/prasarana/lapang?tambah-gambar=<?= htmlspecialchars($detailData['id']) ?>" class="btn btn-warning btn-sm ml-auto">
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
                              <img src="/admin/prasarana/lapang?preview-gambar=<?= htmlspecialchars($barang['id']) ?>"
                                alt="<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Lapang') ?>"
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
                            <h6 class="card-title text-center mb-3"><?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Lapang') ?></h6>
                            <div class="mt-auto text-center d-flex justify-content-center gap-2">
                              <button type="button" class="btn btn-sm btn-danger" title="Hapus Gambar" onclick="confirmDeleteLapangGambar('<?= htmlspecialchars($barang['id'] ?? '') ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>', '<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Gambar Ini') ?>')">
                                <i class="fas fa-trash"></i> Hapus
                              </button>
                              <a href="/admin/prasarana/lapang?preview-gambar=<?= htmlspecialchars($barang['id'] ?? '-') ?>" class="btn btn-sm btn-primary" title="Preview" target="_blank">
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
  <!-- Modal Hapus Data Lapang Utama -->
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
          <p>Apakah Anda yakin ingin menghapus lapang ini? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a id="deleteButton" href="#" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus Dokumen Lapang -->
  <div class="modal fade" id="deleteLapangDokumenModal" tabindex="-1" role="dialog" aria-labelledby="deleteLapangDokumenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteLapangDokumenModalLabel">Konfirmasi Hapus Dokumen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus dokumen <strong id="lapangDokumenNameModal"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a href="#" id="confirmDeleteLapangDokumenButton" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus Gambar Lapang -->
  <div class="modal fade" id="deleteLapangGambarModal" tabindex="-1" role="dialog" aria-labelledby="deleteLapangGambarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteLapangGambarModalLabel">Konfirmasi Hapus Gambar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus gambar <strong id="lapangGambarNameModal"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <a href="#" id="confirmDeleteLapangGambarButton" class="btn btn-danger">Hapus</a>
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
      // Meskipun tidak digunakan secara eksplisit pada card gambar, ini bisa berguna jika ada link lain dengan data-toggle="lightbox"
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
      });

      // Tangkap event klik tombol delete
      $('button[data-target="#deleteModal"]').on('click', function() {
        var id = $(this).data('id');
        var deleteUrl = '/admin/prasarana/lapang?delete=' + id;

        // Set URL hapus ke tombol Hapus di modal
        $('#deleteButton').attr('href', deleteUrl);
      });

      // QR Code Generation for Lapang Detail
      const qrContainerLapang = document.getElementById('<?= $qrCanvasId ?>');
      if (qrContainerLapang) {
        const lapangIdFromDataAttr = qrContainerLapang.getAttribute('data-qr-content');
        if (lapangIdFromDataAttr) {
          const qrBaseUrl = "<?= htmlspecialchars($BaseUrlQr ?? '', ENT_QUOTES, 'UTF-8') ?>"; // Pastikan $BaseUrlQr tersedia
          const qrPath = `/admin/prasarana/lapang?detail=${lapangIdFromDataAttr}`;
          const finalQrText = qrBaseUrl + qrPath;

          new QRCode(qrContainerLapang, {
            text: finalQrText,
            width: 150,
            height: 150,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
          });
        } else {
          qrContainerLapang.innerHTML = "<small>ID Lapang Error</small>";
        }
      }

      // Download QR Card for Lapang
      function downloadCardAsImageLapang(targetElementId, fileNamePrefix) {
        const targetElement = document.getElementById(targetElementId);
        if (!targetElement) {
          alert(`Tidak dapat menemukan elemen kartu QR untuk diunduh (${targetElementId}).`);
          return;
        }

        const namaLapangPHP = "<?= htmlspecialchars($namaLapang, ENT_QUOTES, 'UTF-8') ?>";
        const kodeLapangPHP = "<?= htmlspecialchars($kodeLapang, ENT_QUOTES, 'UTF-8') ?>";
        const fileName = `${fileNamePrefix}-Lapang-${namaLapangPHP.replace(/[^a-zA-Z0-9_.-]/g, '_')}-${kodeLapangPHP}.png`;

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

      const downloadButtonLapang = document.getElementById("downloadQRLapang");
      if (downloadButtonLapang) {
        downloadButtonLapang.addEventListener("click", function() {
          downloadCardAsImageLapang("qrCardToExportLapang", "QR");
        });
      }
    });

    function confirmDeleteLapangDokumen(dokumenId, lapangId, namaDokumen) {
      $('#lapangDokumenNameModal').text(namaDokumen || 'Dokumen Ini');
      var deleteUrl = `/admin/prasarana/lapang?delete-dokumen=${dokumenId}&lapang_id=${lapangId}`;
      $('#confirmDeleteLapangDokumenButton').attr('href', deleteUrl);
      $('#deleteLapangDokumenModal').modal('show');
    }

    function confirmDeleteLapangGambar(gambarId, lapangId, namaGambar) {
      $('#lapangGambarNameModal').text(namaGambar || 'Gambar Ini');
      var deleteUrl = `/admin/prasarana/lapang?delete-gambar=${gambarId}&lapang_id=${lapangId}`;
      $('#confirmDeleteLapangGambarButton').attr('href', deleteUrl);
      $('#deleteLapangGambarModal').modal('show');
    }
  </script>
</body>

</html>