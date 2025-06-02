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
                  <?= isset($sarana) ? 'Edit Data Sarana ATK' : 'Formulir Data Sarana ATK' ?>
                </h1>
              </div>

              <form action="<?= isset($sarana) ? '/admin/sarana/atk?edit=' . htmlspecialchars($sarana['id']) : '/admin/sarana/atk/tambah' ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= htmlspecialchars($sarana['id'] ?? '') ?>">
                <input type="hidden" name="kategori_barang_id" value="3" id="kategori_barang_id"> <!-- ID Kategori ATK (sesuaikan jika beda) -->

                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <!-- Section 1: IDENTITAS SARANA ATK -->
                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS SARANA ATK
                          </h5>
                          <span class="form-text">Silahkan isi data identitas sarana ATK dengan lengkap.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md hidden"> <!-- Original: form-group hidden -->
                          <div class="form-group">
                            <label for="barang_id" class="font-weight-bold">Jenis Barang ATK <span class="text-danger">*</span></label>
                            <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                              <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light">
                                  <i class="fas fa-pencil-ruler text-primary"></i>
                                </span>
                              </div>
                              <select class="form-control rounded border-0 select2-custom" id="barang_id" name="barang_id" required>
                                <option value="" <?= !isset($sarana['barang_id']) ? 'disabled selected' : 'disabled' ?>>
                                  Pilih atau ketik jenis barang ATK
                                </option>
                                <?php foreach ($barangList as $barang): ?>
                                  <?php if ($barang['kategori_id'] == 3): ?>
                                    <option value="<?= htmlspecialchars($barang['id']) ?>"
                                      <?= isset($sarana['barang_id']) && $sarana['barang_id'] == $barang['id'] ? 'selected' : ''; ?>>
                                      <?= htmlspecialchars($barang['nama_barang']) ?>
                                    </option>
                                  <?php endif; ?>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <span class="form-text text-muted mt-1">Pilih jenis barang ATK dari daftar atau ketik untuk mencari.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="nama_detail_barang" class="font-weight-bold">Nama Detail Barang <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                              </div>
                              <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang"
                                placeholder="Contoh: Pensil 2B Faber Castell" readonly required
                                value="<?= htmlspecialchars($sarana['nama_detail_barang'] ?? '') ?>">
                            </div>
                            <span class="form-text">Nama detail barang (readonly).</span>
                          </div>
                        </div>
                      </div>

                      <!-- Section 2: SPESIFIKASI -->
                      <div class="col-12 mt-4 border-bottom hidden"> <!-- Original: col-12 mb-5 hidden -->
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            SPESIFIKASI
                          </h5>
                          <span class="form-text">Isi data spesifikasi barang ATK.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="merk" class="font-weight-bold">Merk</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-copyright text-primary"></i></span>
                              </div>
                              <input type="text" class="form-control" id="merk" name="merk"
                                placeholder="Contoh: Faber Castell, Sinar Dunia, Joyko"
                                value="<?= htmlspecialchars($sarana['merk'] ?? '') ?>">
                            </div>
                            <span class="form-text">Masukkan merk barang ATK.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="spesifikasi" class="font-weight-bold">Spesifikasi</label>
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                              placeholder="Masukkan spesifikasi lengkap (ukuran, warna, tipe, dll)"><?= htmlspecialchars($sarana['spesifikasi'] ?? '') ?></textarea>
                            <span class="form-text">Jelaskan spesifikasi detail barang.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Section 3: KONDISI -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            KONDISI
                          </h5>
                          <span class="form-text">Pilih kondisi barang ATK saat ini.</span>
                        </div>

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
                                  <option value="<?= htmlspecialchars($kondisi['id']) ?>" <?= isset($sarana['kondisi_barang_id']) && $sarana['kondisi_barang_id'] == $kondisi['id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                  </option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <span class="form-text">Pilih kondisi aktual barang.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md hidden"> <!-- Original: form-group hidden -->
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
                                <select class="form-control" id="satuan" name="satuan" required>
                                  <option value="Buah" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Buah') || !isset($sarana['satuan']) ? 'selected' : '' ?>>Buah</option>
                                  <option value="Unit" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Unit') ? 'selected' : '' ?>>Unit</option>
                                  <option value="Pack" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Pack') ? 'selected' : '' ?>>Pack</option>
                                  <option value="Rim" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Rim') ? 'selected' : '' ?>>Rim</option>
                                  <option value="Lusin" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Lusin') ? 'selected' : '' ?>>Lusin</option>
                                  <option value="Set" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Set') ? 'selected' : '' ?>>Set</option>
                                </select>
                              </div>
                            </div>
                            <span class="form-text">Masukkan jumlah barang dan pilih satuannya.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md hidden"> <!-- Original: form-group hidden -->
                          <div class="form-group">
                            <label for="biaya_pembelian" class="font-weight-bold">Biaya Pembelian (Per Satuan)</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-money-bill-wave text-primary"></i></span>
                              </div>
                              <input type="number" class="form-control" id="biaya_pembelian" name="biaya_pembelian"
                                placeholder="Contoh: 2500 (tanpa titik/koma)" min="0"
                                value="<?= htmlspecialchars($sarana['biaya_pembelian'] ?? '') ?>">
                            </div>
                            <span class="form-text">Masukkan biaya pembelian per satuan barang (opsional).</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md hidden"> <!-- Original: form-group hidden -->
                          <div class="form-group">
                            <label for="tanggal_pembelian" class="font-weight-bold">Tanggal Pembelian</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="far fa-calendar-alt text-primary"></i></span>
                              </div>
                              <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian"
                                value="<?= htmlspecialchars($sarana['tanggal_pembelian'] ?? '') ?>">
                            </div>
                            <span class="form-text">Masukkan tanggal pembelian barang (opsional).</span>
                          </div>
                        </div>
                      </div>

                      <!-- Section 4: LOKASI PEMINDAHAN -->
                      <div class="col-12 mt-4 hidden"> <!-- Original: col-12 hidden -->
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            LOKASI PEMINDAHAN
                          </h5>
                          <span class="form-text">Isi data lokasi dan keterangan tambahan.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md hidden"> <!-- Original: form-group hidden -->
                          <div class="form-group">
                            <label for="lokasi" class="font-weight-bold">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                            <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                              <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light">
                                  <i class="fas fa-map-marker-alt text-primary"></i>
                                </span>
                              </div>
                              <select class="form-control rounded border-0 select2-custom" id="lokasi" name="lokasi" required>
                                <optgroup label="Lapang">
                                  <?php foreach ($lapangData as $lokasi_item) : ?>
                                    <option value="<?= htmlspecialchars($lokasi_item['nama_lapang']); ?>" <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $lokasi_item['nama_lapang']) ? 'selected' : '' ?>>
                                      <?= htmlspecialchars($lokasi_item['kode_lapang']); ?> - <?= htmlspecialchars($lokasi_item['nama_lapang']); ?>
                                    </option>
                                  <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Ruang">
                                  <?php foreach ($ruangData as $lokasi_item) : ?>
                                    <option value="<?= htmlspecialchars($lokasi_item['nama_ruang']); ?>" <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $lokasi_item['nama_ruang']) ? 'selected' : '' ?>>
                                      <?= htmlspecialchars($lokasi_item['kode_ruang']); ?> - <?= htmlspecialchars($lokasi_item['nama_ruang']); ?>
                                    </option>
                                  <?php endforeach; ?>
                                </optgroup>
                              </select>
                            </div>
                            <span class="form-text text-muted mt-1">Pilih lokasi penempatan barang.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md"> <!-- This form-group was not hidden originally -->
                          <div class="form-group">
                            <label for="keterangan" class="font-weight-bold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                              placeholder="Tambahkan keterangan jika diperlukan (misal: stok minimal, tanggal kadaluarsa jika ada)"><?= htmlspecialchars($sarana['keterangan'] ?? '') ?></textarea>
                            <span class="form-text">Tambahkan keterangan tambahan jika diperlukan.</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> <!-- Penutup card-body -->

                <div class="card-footer text-right">
                  <a href="/admin/sarana/atk/kondisi" class="btn btn-secondary"> <!-- Tombol kembali ke daftar ATK -->
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    <?= isset($sarana) ? 'Update Data Sarana ATK' : 'Simpan Data Sarana ATK' ?>
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
      // Jenis Barang ATK
      $('#barang_id').select2({
        placeholder: "Pilih atau ketik jenis barang ATK",
        allowClear: false,
        minimumResultsForSearch: 1,
      }).on('change', function() {
        generateNoRegistrasiATK();
      });

      $('#lokasi').select2({
        placeholder: "Pilih atau ketik lokasi barang",
        allowClear: false,
        minimumResultsForSearch: 1,
      });

      // Fungsi generate nomor registrasi untuk ATK
      const noRegInputATK = document.getElementById('no_registrasi');

      function generateNoRegistrasiATK() {
        const barangId = $('#barang_id').val();

        // Hanya generate jika field no_registrasi kosong
        if (barangId && noRegInputATK.value.trim() === '') {
          const barangText = $('#barang_id').find('option:selected').text().trim().substring(0, 4).toUpperCase().replace(/\s/g, '');
          const timestamp = new Date().getTime().toString().slice(-3);
          const kategoriKode = "ATK";

          noRegInputATK.value = `${kategoriKode}-${barangText}-${barangId}-${timestamp}`;
        } else if (!barangId && noRegInputATK.value.startsWith('ATK-')) {
          // Jika barang dikosongkan dan no_reg masih format auto, kosongkan juga
          // noRegInputATK.value = ''; // Atau biarkan, tergantung preferensi
        }
      }

      // Panggil saat load jika mode edit dan no_reg kosong tapi barang_id ada
      if ($('#id').val() !== '' && noRegInputATK.value.trim() === '' && $('#barang_id').val()) {
        generateNoRegistrasiATK();
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