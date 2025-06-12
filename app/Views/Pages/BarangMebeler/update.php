<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white mb-5 pt-3 px-4 ">
      <div class="container-fluid">
        <div class="row justify-content-center ">
          <div class="col-12">
            <?php if (!empty($_SESSION['error'])) : ?>
              <div class="alert alert-danger alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['update'])) : // Untuk pesan sukses (diubah ke 'update' untuk konsistensi)
            ?>
              <div class="alert alert-success alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($_SESSION['update']); ?>
                <?php unset($_SESSION['update']); ?>
              </div>
            <?php endif; ?>


            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <h1 class="text-xl font-weight-bold">
                  <?= isset($sarana) ? 'Edit Data Sarana Mebelair' : 'Formulir Data Sarana Mebelair' ?>
                </h1>
              </div>

              <form action="<?= isset($sarana) ? '/admin/sarana/mebelair?edit=' . $sarana['id'] : '/admin/sarana/mebelair/tambah' ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= htmlspecialchars($sarana['id'] ?? '') ?>">
                <input type="hidden" name="kategori_barang_id" value="2" id="kategori_barang_id">

                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <!-- Data Identitas Sarana -->
                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS SARANA MEBELAIR
                          </h5>
                          <span class="form-text">Silahkan perbarui data identitas sarana mebelair dengan lengkap.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Jenis Barang -->
                          <div class="form-group">
                            <label for="barang_id" class="fw-bold">Jenis Barang Mebelair <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="barang_id" name="barang_id" required>
                              <option value="" <?= !isset($sarana['barang_id']) ? 'disabled selected' : 'disabled' ?>>
                                Pilih atau ketik jenis barang
                              </option>
                              <?php foreach ($barangList as $barang): ?>
                                <?php if ($barang['kategori_id'] == 2): // Filter Kategori Mebelair (ID 2) 
                                ?>
                                  <option value="<?= htmlspecialchars($barang['id']) ?>"
                                    <?= isset($sarana['barang_id']) && $sarana['barang_id'] == $barang['id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($barang['nama_barang']) ?>
                                  </option>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih jenis barang dari daftar atau ketik untuk mencari.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Nomor Registrasi -->
                          <div class="form-group">
                            <label for="no_registrasi" class="fw-bold">Nomor Registrasi</label>
                            <input type="text" class="form-control" id="no_registrasi" name="no_registrasi_display"
                              value="<?= htmlspecialchars($sarana['no_registrasi'] ?? 'Akan digenerate otomatis') ?>" readonly>
                            <span class="form-text">Nomor registrasi akan digenerate otomatis saat penambahan data baru.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Nama Detail Barang -->
                          <div class="form-group">
                            <label for="nama_detail_barang" class="fw-bold">Nama Detail Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang"
                              placeholder="Contoh: Meja Rapat Kayu Jati" required
                              value="<?= htmlspecialchars($sarana['nama_detail_barang'] ?? '') ?>">
                            <span class="form-text">Masukkan nama lengkap atau deskriptif untuk sarana mebelair.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Spesifikasi -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            SPESIFIKASI
                          </h5>
                          <span class="form-text">Isi informasi spesifikasi sarana mebelair.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Merk -->
                          <div class="form-group">
                            <label for="merk" class="fw-bold">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk"
                              placeholder="Contoh: IKEA, Informa, Olympic"
                              value="<?= htmlspecialchars($sarana['merk'] ?? '') ?>">
                            <span class="form-text">Masukkan merk produk jika ada.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Bahan -->
                          <div class="form-group">
                            <label for="bahan" class="fw-bold">Bahan</label>
                            <select class="form-control" id="bahan" name="bahan">
                              <option value="" <?= !isset($sarana['bahan']) ? 'selected disabled' : 'disabled' ?>>Pilih Bahan...</option>
                              <option value="Kayu" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Kayu') ? 'selected' : '' ?>>Kayu</option>
                              <option value="Besi" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Besi') ? 'selected' : '' ?>>Besi</option>
                              <option value="Aluminium" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Aluminium') ? 'selected' : '' ?>>Aluminium</option>
                              <option value="Stainless Steel" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Stainless Steel') ? 'selected' : '' ?>>Stainless Steel</option>
                              <option value="Rotan" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Rotan') ? 'selected' : '' ?>>Rotan</option>
                              <option value="Plastik" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Plastik') ? 'selected' : '' ?>>Plastik</option>
                              <option value="Kaca" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Kaca') ? 'selected' : '' ?>>Kaca</option>
                              <option value="Bambu" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Bambu') ? 'selected' : '' ?>>Bambu</option>
                              <option value="Kulit" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Kulit') ? 'selected' : '' ?>>Kulit</option>
                              <option value="Kain" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Kain') ? 'selected' : '' ?>>Kain</option>
                            </select>
                            <span class="form-text">Pilih bahan utama sarana.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Spesifikasi -->
                          <div class="form-group">
                            <label for="spesifikasi" class="fw-bold">Spesifikasi</label>
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                              placeholder="Masukkan spesifikasi lengkap (ukuran PxLxT, warna, fitur, dll)"><?= htmlspecialchars($sarana['spesifikasi'] ?? '') ?></textarea>
                            <span class="form-text">Jelaskan spesifikasi teknis sarana.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Kondisi dan Kuantitas -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            KONDISI, SUMBER, & KUANTITAS
                          </h5>
                          <span class="form-text">Isi informasi kondisi, sumber, dan kuantitas sarana.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Kondisi Barang -->
                          <div class="form-group">
                            <label for="kondisi_barang_id" class="fw-bold">Kondisi Barang <span class="text-danger">*</span></label>
                            <select class="form-control" id="kondisi_barang_id" name="kondisi_barang_id" required>
                              <option value="" disabled <?= !isset($sarana['kondisi_barang_id']) ? 'selected' : ''; ?>>Pilih Kondisi</option>
                              <?php foreach ($kondisiList as $kondisi): ?>
                                <option value="<?= htmlspecialchars($kondisi['id']) ?>"
                                  <?= isset($sarana['kondisi_barang_id']) && $sarana['kondisi_barang_id'] == $kondisi['id'] ? 'selected' : ''; ?>>
                                  <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih kondisi fisik sarana saat ini.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Sumber -->
                          <div class="form-group">
                            <label for="sumber" class="fw-bold">Sumber Perolehan</label>
                            <select class="form-control" id="sumber" name="sumber">
                              <option value="" <?= !isset($sarana['sumber']) || empty($sarana['sumber']) ? 'selected disabled' : 'disabled' ?>>Pilih Sumber</option>
                              <option value="APBD" <?= isset($sarana) && $sarana['sumber'] == 'APBD' ? 'selected' : ''; ?>>APBD</option>
                              <option value="APBN" <?= isset($sarana) && $sarana['sumber'] == 'APBN' ? 'selected' : ''; ?>>APBN</option>
                              <option value="Hibah" <?= isset($sarana) && $sarana['sumber'] == 'Hibah' ? 'selected' : ''; ?>>Hibah</option>
                              <option value="CSR" <?= isset($sarana) && $sarana['sumber'] == 'CSR' ? 'selected' : ''; ?>>CSR Perusahaan</option>
                              <option value="Lainnya" <?= isset($sarana) && $sarana['sumber'] == 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                            </select>
                            <span class="form-text">Pilih sumber perolehan sarana.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Jumlah -->
                          <div class="form-group">
                            <label for="jumlah" class="fw-bold">Kuantitas <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="jumlah" name="jumlah"
                                value="<?= htmlspecialchars($sarana['jumlah'] ?? '1') ?>"
                                min="1" required>
                              <div class="input-group-append">
                                <select class="form-control" id="satuan" name="satuan" required>
                                  <option value="Unit" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Unit') || !isset($sarana['satuan']) ? 'selected' : '' ?>>Unit</option>
                                  <option value="Buah" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Buah') ? 'selected' : '' ?>>Buah</option>
                                  <option value="Set" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Set') ? 'selected' : '' ?>>Set</option>
                                  <option value="Pasang" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Pasang') ? 'selected' : '' ?>>Pasang</option>
                                </select>
                              </div>
                            </div>
                            <span class="form-text">Masukkan jumlah dan satuan barang.</span>
                          </div>
                        </div>

                        <!-- Data Tambahan -->


                        <!-- Status & Informasi Peminjaman -->
                        <div class="col-12 mt-4 border-bottom">
                          <div class="border-bottom pb-2 mb-3">
                            <h5 class="text-bold fs-4 text-navy">
                              STATUS & INFORMASI PEMINJAMAN
                            </h5>
                            <span class="form-text">Isi status sarana dan detail peminjam jika sarana sedang dipinjam.</span>
                          </div>

                          <div class="py-4 px-4 mb-4 border rounded-md">
                            <div class="form-group">
                              <label for="status" class="fw-bold">Status <span class="text-danger">*</span></label>
                              <select class="form-control" name="status" id="status" aria-label="Pilih Status Sarana" required>
                                <option value="" disabled <?= !isset($sarana['status']) ? 'selected' : '' ?>>Pilih Status</option>
                                <option value="Tersedia" <?= (isset($sarana['status']) && $sarana['status'] == 'Tersedia') ? 'selected' : '' ?>>Tersedia</option>
                                <option value="Dipinjam" <?= (isset($sarana['status']) && $sarana['status'] == 'Dipinjam') ? 'selected' : '' ?>>Dipinjam</option>
                                <option value="Terpakai" <?= (isset($sarana['status']) && $sarana['status'] == 'Terpakai') ? 'selected' : '' ?>>Terpakai</option>
                                <option value="Rusak Ringan" <?= (isset($sarana['status']) && $sarana['status'] == 'Rusak Ringan') ? 'selected' : '' ?>>Rusak Ringan</option>
                                <option value="Rusak Berat" <?= (isset($sarana['status']) && $sarana['status'] == 'Rusak Berat') ? 'selected' : '' ?>>Rusak Berat</option>
                                <option value="Hilang" <?= (isset($sarana['status']) && $sarana['status'] == 'Hilang') ? 'selected' : '' ?>>Hilang</option>
                              </select>
                              <span class="form-text">
                                Pilih status sarana saat ini. Jika "Dipinjam", lengkapi detail peminjam.
                              </span>
                            </div>
                          </div>

                          <div class="py-4 px-4 mb-4 border rounded-md">
                            <div class="form-group">
                              <label for="nama_peminjam" class="fw-bold">Nama Peminjam</label>
                              <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam"
                                placeholder="Contoh: Muhammad Febrianoor" value="<?= htmlspecialchars($sarana['nama_peminjam'] ?? '') ?>">
                              <span class="form-text">
                                Masukkan nama lengkap peminjam jika status "Dipinjam".
                              </span>
                            </div>
                          </div>

                          <div class="py-4 px-4 mb-4 border rounded-md">
                            <div class="form-group">
                              <label for="identitas_peminjam" class="fw-bold">Nomor Identitas Peminjam</label>
                              <input type="text" class="form-control" id="identitas_peminjam" name="identitas_peminjam"
                                placeholder="Contoh: NIK/NIDN/NIM" value="<?= htmlspecialchars($sarana['identitas_peminjam'] ?? '') ?>">
                              <span class="form-text">
                                Masukkan nomor identitas peminjam (NIK/NIDN/NIM).
                              </span>
                            </div>
                          </div>

                          <div class="py-4 px-4 mb-4 border rounded-md">
                            <div class="form-group">
                              <label for="no_hp_peminjam" class="fw-bold">Nomor HP Peminjam</label>
                              <input type="text" class="form-control" id="no_hp_peminjam" name="no_hp_peminjam"
                                placeholder="Contoh: 081234567890" value="<?= htmlspecialchars($sarana['no_hp_peminjam'] ?? '') ?>">
                              <span class="form-text">
                                Masukkan nomor HP peminjam yang aktif WhatsApp.
                              </span>
                            </div>
                          </div>

                          <div class="py-4 px-4 mb-4 border rounded-md">
                            <div class="form-group">
                              <label for="tanggal_peminjaman" class="fw-bold">Tanggal Peminjaman</label>
                              <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" value="<?= htmlspecialchars($sarana['tanggal_peminjaman'] ?? '') ?>">
                              <span class="form-text">Masukkan tanggal barang ini dipinjam.</span>
                            </div>
                          </div>
                          <div class="py-4 px-4 mb-4 border rounded-md">
                            <div class="form-group">
                              <label for="tanggal_pengembalian" class="fw-bold">Tanggal Rencana Pengembalian</label>
                              <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" value="<?= htmlspecialchars($sarana['tanggal_pengembalian'] ?? '') ?>">
                              <span class="form-text">Masukkan tanggal rencana barang ini akan dikembalikan.</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 mt-4">
                          <div class="border-bottom pb-2 mb-3">
                            <h5 class="text-bold fs-4 text-navy">
                              INFORMASI TAMBAHAN
                            </h5>
                            <span class="form-text">Isi informasi tambahan terkait sarana.</span>
                          </div>
                          <div class="py-4 px-4 mb-4 border rounded-md">
                            <div class="form-group">
                              <label for="lokasi" class="fw-bold">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                              <select class="form-control select2-custom" id="lokasi" name="lokasi" required>
                                <option value="" <?= !isset($sarana['lokasi']) || empty($sarana['lokasi']) ? 'disabled selected' : 'disabled' ?>>
                                  Pilih atau ketik lokasi barang
                                </option>
                                <optgroup label="Lapang">
                                  <?php foreach ($lapangData as $itemLokasi) : ?>
                                    <option value="<?= htmlspecialchars($itemLokasi['nama_lapang']); ?>"
                                      <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_lapang'] ? 'selected' : '') ?>>
                                      <?= htmlspecialchars($itemLokasi['kode_lapang']); ?> - <?= htmlspecialchars($itemLokasi['nama_lapang']); ?>
                                    </option>
                                  <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Ruang">
                                  <?php foreach ($ruangData as $itemLokasi) : ?>
                                    <option value="<?= htmlspecialchars($itemLokasi['nama_ruang']); ?>"
                                      <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_ruang'] ? 'selected' : '') ?>>
                                      <?= htmlspecialchars($itemLokasi['kode_ruang']); ?> - <?= htmlspecialchars($itemLokasi['nama_ruang']); ?>
                                    </option>
                                  <?php endforeach; ?>
                                </optgroup>
                              </select>
                              <span class="form-text">Pilih lokasi penempatan sarana saat ini.</span>
                            </div>
                          </div>
                          <div class="py-4 px-4 mb-4 border rounded-md">
                            <!-- Keterangan -->
                            <div class="form-group">
                              <label for="keterangan" class="fw-bold">Keterangan</label>
                              <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                                placeholder="Tambahkan keterangan jika diperlukan"><?= htmlspecialchars($sarana['keterangan'] ?? '') ?></textarea>
                              <span class="form-text">Tambahkan catatan khusus tentang sarana ini jika ada.</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-md-end">
                      <a href="/admin/sarana/mebelair" class="btn btn-secondary mb-2 mb-md-0 mr-md-2"> <!-- Tombol kembali ke daftar mebelair -->
                        <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                      </a>
                      <button type="submit" class="btn btn-primary mb-2 mb-md-0" id="submitBtn">
                        <i class="fas fa-save mr-2"></i>
                        <?= isset($sarana) ? 'Update Data Sarana Mebelair' : 'Simpan Data Sarana Mebelair' ?>
                      </button>
                    </div>
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

  <!-- Initialize Select2 -->
  <script>
    $(document).ready(function() {
      // Jenis Barang Mebelair
      $('#barang_id').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih atau ketik jenis barang",
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });

      $('#lokasi').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih atau ketik lokasi barang",
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });
    });
  </script>
</body>

</html>