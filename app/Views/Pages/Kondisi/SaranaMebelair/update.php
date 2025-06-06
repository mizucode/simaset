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
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($error); ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['success_message'])) : // Untuk pesan sukses 
            ?>
              <div class="alert alert-success alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($_SESSION['success_message']); ?>
                <?php unset($_SESSION['success_message']); ?>
              </div>
            <?php endif; ?>


            <div class="card card-navy">
              <div class="card-header bg-navy mb-3">
                <h1 class="text-xl font-weight-bold">
                  <?= isset($sarana) ? 'Edit Data Sarana Mebelair' : 'Formulir Data Sarana Mebelair' ?>
                </h1>
              </div>

              <form action="<?= isset($sarana) ? '/admin/sarana/mebelair/kondisi?edit=' . $sarana['id'] : '/admin/sarana/mebelair/tambah' ?>" method="POST" enctype="multipart/form-data">
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
                          <span class="form-text">Silahkan isi data identitas sarana mebelair dengan lengkap.</span>
                        </div>

                        <!-- Jenis Barang -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group">
                            <label for="barang_id" class="font-weight-bold">Jenis Barang Mebelair <span class="text-danger">*</span></label>
                            <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                              <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light">
                                  <i class="fas fa-chair text-primary"></i> <!-- Ikon Mebelair -->
                                </span>
                              </div>
                              <select class="form-control rounded border-0 select2-custom" id="barang_id" name="barang_id" required>
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
                            </div>
                            <span class="form-text text-muted mt-1">Pilih jenis barang mebelair dari daftar atau ketik untuk mencari.</span>
                          </div>
                        </div>

                        <!-- Nama Detail Barang -->
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="nama_detail_barang" class="font-weight-bold">Nama Detail Barang <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                              </div>
                              <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang" readonly
                                placeholder="Contoh: Meja Rapat Kayu Jati" required
                                value="<?= htmlspecialchars($sarana['nama_detail_barang'] ?? '') ?>">
                            </div>
                            <span class="form-text">Nama detail barang (readonly).</span>
                          </div>
                        </div>
                        <!-- No Registrasi -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group">
                            <label for="no_registrasi" class="font-weight-bold">No. Registrasi <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-id-card text-primary"></i></span>
                              </div>
                              <input type="text" class="form-control" id="no_registrasi" name="no_registrasi"
                                placeholder="Akan terisi otomatis" readonly required
                                value="<?= htmlspecialchars($sarana['no_registrasi'] ?? '') ?>">
                            </div>
                            <span class="form-text text-muted mt-1">Nomor registrasi akan digenerate otomatis berdasarkan pilihan jenis barang.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Spesifikasi -->
                      <div class="col-12 mt-4 border-bottom hidden">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            SPESIFIKASI
                          </h5>
                          <span class="form-text">Isi data spesifikasi barang mebelair.</span>
                        </div>
                        <!-- Merk -->
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="merk" class="font-weight-bold">Merk</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-copyright text-primary"></i></span>
                              </div>
                              <input type="text" class="form-control" id="merk" name="merk"
                                placeholder="Contoh: IKEA, Informa, Olympic"
                                value="<?= htmlspecialchars($sarana['merk'] ?? '') ?>">
                            </div>
                            <span class="form-text">Masukkan merk barang mebelair.</span>
                          </div>
                        </div>
                        <!-- Bahan -->
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="bahan" class="font-weight-bold">Bahan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-gem text-primary"></i></span> <!-- Icon changed for 'bahan' -->
                              </div>
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
                            </div>
                            <span class="form-text">Pilih bahan utama barang mebelair.</span>
                          </div>
                        </div>
                        <!-- Spesifikasi -->
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="spesifikasi" class="font-weight-bold">Spesifikasi</label>
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                              placeholder="Masukkan spesifikasi lengkap (ukuran PxLxT, warna, fitur, dll)"><?= htmlspecialchars($sarana['spesifikasi'] ?? '') ?></textarea>
                            <span class="form-text">Jelaskan spesifikasi detail barang.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Kondisi dan Kuantitas -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            KONDISI
                          </h5>
                          <span class="form-text">Pilih kondisi barang mebelair saat ini.</span>
                        </div>
                        <!-- Kondisi Barang -->
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="kondisi_barang_id" class="font-weight-bold">Kondisi Barang <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-clipboard-check text-primary"></i></span>
                              </div>
                              <select class="form-control" id="kondisi_barang_id" name="kondisi_barang_id" required>
                                <option value="" disabled <?= !isset($sarana['kondisi_barang_id']) ? 'selected' : ''; ?>>Pilih Kondisi</option>
                                <?php foreach ($kondisiList as $kondisi): ?>
                                  <option value="<?= htmlspecialchars($kondisi['id']) ?>"
                                    <?= isset($sarana['kondisi_barang_id']) && $sarana['kondisi_barang_id'] == $kondisi['id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                  </option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <span class="form-text">Pilih kondisi aktual barang.</span>
                          </div>
                        </div>

                        <!-- Sumber -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group">
                            <label for="sumber" class="font-weight-bold">Sumber Perolehan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-hand-holding-usd text-primary"></i></span>
                              </div>
                              <select class="form-control" id="sumber" name="sumber">
                                <option value="" selected disabled>Pilih Sumber</option>
                                <option value="APBD" <?= isset($sarana) && $sarana['sumber'] == 'APBD' ? 'selected' : ''; ?>>APBD</option>
                                <option value="APBN" <?= isset($sarana) && $sarana['sumber'] == 'APBN' ? 'selected' : ''; ?>>APBN</option>
                                <option value="Hibah" <?= isset($sarana) && $sarana['sumber'] == 'Hibah' ? 'selected' : ''; ?>>Hibah</option>
                                <option value="CSR" <?= isset($sarana) && $sarana['sumber'] == 'CSR' ? 'selected' : ''; ?>>CSR Perusahaan</option>
                                <option value="Lainnya" <?= isset($sarana) && $sarana['sumber'] == 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                              </select>
                            </div>
                            <span class="form-text">Pilih sumber perolehan barang (opsional).</span>
                          </div>
                        </div>
                        <!-- Jumlah -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group">
                            <label for="jumlah" class="font-weight-bold">Kuantitas <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-calculator text-primary"></i></span>
                              </div>
                              <input type="number" class="form-control" id="jumlah" name="jumlah"
                                value="<?= htmlspecialchars($sarana['jumlah'] ?? '1') ?>"
                                min="1" required>
                              <div class="input-group-append">
                                <select class="form-control" id="satuan" name="satuan" required> <!-- Pastikan required jika memang wajib -->
                                  <option value="Unit" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Unit') || !isset($sarana['satuan']) ? 'selected' : '' ?>>Unit</option>
                                  <option value="Buah" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Buah') ? 'selected' : '' ?>>Buah</option>
                                  <option value="Set" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Set') ? 'selected' : '' ?>>Set</option>
                                  <option value="Pasang" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Pasang') ? 'selected' : '' ?>>Pasang</option>
                                </select>
                              </div>
                            </div>
                            <span class="form-text">Masukkan jumlah barang dan pilih satuannya.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Tambahan -->
                      <div class="col-12 mt-4 hidden"> <!-- No border-bottom if it's the last section -->
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            LOKASI PEMINDAHAN
                          </h5>
                          <span class="form-text">Isi data lokasi dan keterangan tambahan.</span>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md"> <!-- This field itself is not hidden, but parent section is -->
                          <div class="form-group">
                            <label for="lokasi" class="font-weight-bold">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                            <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                              <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light">
                                  <i class="fas fa-map-marker-alt text-primary"></i> <!-- Ikon Lokasi -->
                                </span>
                              </div>
                              <select class="form-control rounded border-0 select2-custom" id="lokasi" name="lokasi" required>
                                <option value="" <?= !isset($sarana['lokasi']) || empty($sarana['lokasi']) ? 'disabled selected' : 'disabled' ?>>
                                  Pilih atau ketik lokasi barang
                                </option>
                                <optgroup label="Lapang">
                                  <?php foreach ($lapangData as $itemLokasi) : ?>
                                    <option value="<?= htmlspecialchars($itemLokasi['nama_lapang']); ?>"
                                      <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_lapang']) ? 'selected' : '' ?>>
                                      <?= htmlspecialchars($itemLokasi['kode_lapang']); ?> - <?= htmlspecialchars($itemLokasi['nama_lapang']); ?>
                                    </option>
                                  <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Ruang">
                                  <?php foreach ($ruangData as $itemLokasi) : ?>
                                    <option value="<?= htmlspecialchars($itemLokasi['nama_ruang']); ?>"
                                      <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_ruang']) ? 'selected' : '' ?>>
                                      <?= htmlspecialchars($itemLokasi['kode_ruang']); ?> - <?= htmlspecialchars($itemLokasi['nama_ruang']); ?>
                                    </option>
                                  <?php endforeach; ?>
                                </optgroup>
                              </select>
                            </div>
                            <span class="form-text text-muted mt-1">Pilih lokasi penempatan barang.</span>
                          </div>
                        </div>
                        <!-- Keterangan -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group">
                            <label for="keterangan" class="font-weight-bold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                              placeholder="Tambahkan keterangan jika diperlukan"><?= htmlspecialchars($sarana['keterangan'] ?? '') ?></textarea>
                            <span class="form-text">Tambahkan keterangan tambahan jika diperlukan.</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> <!-- Penutup card-body -->
                <div class="card-footer text-right">
                  <a href="/admin/sarana/mebelair/kondisi" class="btn btn-secondary"> <!-- Tombol kembali ke daftar mebelair -->
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    <?= isset($sarana) ? 'Update Data Sarana Mebelair' : 'Simpan Data Sarana Mebelair' ?>
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

  <!-- Initialize Select2 -->
  <script>
    $(document).ready(function() {
      // Jenis Barang Mebelair
      $('#barang_id').select2({
        placeholder: "Pilih atau ketik jenis barang mebelair",
        allowClear: false,
        minimumResultsForSearch: 1,
      }).on('change', function() {
        generateNoRegistrasi();
      });

      $('#lokasi').select2({
        placeholder: "Pilih atau ketik lokasi barang",
        allowClear: false,
        minimumResultsForSearch: 1,
      });

      const noRegInput = document.getElementById('no_registrasi'); // Pastikan elemen ini ada di HTML

      function generateNoRegistrasi() {
        const barangId = $('#barang_id').val();

        if (noRegInput) { // Pastikan elemen noRegInput ada
          // Hanya generate jika field no_registrasi kosong
          if (barangId && noRegInput.value.trim() === '') {
            const barangText = $('#barang_id').find('option:selected').text().trim().substring(0, 3).toUpperCase().replace(/\s/g, '');
            const timestamp = new Date().getTime().toString().slice(-4);
            const kategoriKode = "MBL";

            noRegInput.value = `REG-${kategoriKode}-${barangText}-${barangId}-${timestamp}`;
          } else if (!barangId && noRegInput.value.startsWith('REG-MBL-')) {
            // Jika barang dikosongkan dan no_reg masih format auto, kosongkan juga (opsional)
            // noRegInput.value = ''; 
          }
        }
      }

      // Panggil saat load jika mode edit dan no_reg kosong tapi barang_id ada
      // atau jika mode tambah, no_reg kosong dan barang_id sudah ada (misal dari old input)
      if (noRegInput && noRegInput.value.trim() === '' && $('#barang_id').val()) {
        generateNoRegistrasi();
      }
    });
  </script>
  <style>
    .select2-custom-wrapper .select2-selection {
      border: none !important;
      background: transparent !important;
      height: auto !important;
      padding: 0 !important;
    }

    .select2-custom-wrapper .select2-selection__rendered {
      padding-left: 10px !important;
      line-height: inherit !important;
    }

    .select2-custom-wrapper .select2-selection__arrow {
      height: 100% !important;
    }

    .select2-dropdown {
      border: 1px solid #ddd !important;
    }

    .select2-custom-wrapper .select2-selection--single:focus {
      outline: none !important;
    }

    .select2-custom-wrapper .select2-selection--single {
      height: 38px !important;
      display: flex !important;
      align-items: center !important;
    }

    /* .card-footer { background-color: #f8f9fa; border-top: 1px solid #dee2e6; } */
  </style>

</body>

</html>