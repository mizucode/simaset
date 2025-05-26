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
                            <div class="card-header text-white">
                                <h3 class="text-lg">
                                    <?= isset($sarana) ? 'Edit Data Sarana ATK' : 'Formulir Data Sarana ATK' ?>
                                </h3>
                            </div>

                            <form action="<?= isset($sarana) ? '/admin/sarana/atk?edit=' . htmlspecialchars($sarana['id']) : '/admin/sarana/atk/tambah' ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" value="<?= htmlspecialchars($sarana['id'] ?? '') ?>">
                                <input type="hidden" name="kategori_barang_id" value="3" id="kategori_barang_id"> <!-- ID Kategori ATK (sesuaikan jika beda) -->

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Identitas Sarana -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    IDENTITAS SARANA ATK
                                                </h5>
                                                <!-- Jenis Barang -->
                                                <div class="form-group mb-4 hidden">
                                                    <label for="barang_id" class="font-weight-bold text-dark mb-2">Jenis Barang ATK</label>
                                                    <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text border-0 bg-light">
                                                                <i class="fas fa-pencil-ruler text-primary"></i> <!-- Ikon ATK -->
                                                            </span>
                                                        </div>
                                                        <select class="form-control rounded border-0 select2-custom" id="barang_id" name="barang_id" required>
                                                            <option value="" <?= !isset($sarana['barang_id']) ? 'disabled selected' : 'disabled' ?>>
                                                                Pilih atau ketik jenis barang ATK
                                                            </option>
                                                            <?php foreach ($barangList as $barang): ?>
                                                                <?php if ($barang['kategori_id'] == 3): // Filter Kategori ATK (ID 3) 
                                                                ?>
                                                                    <option value="<?= htmlspecialchars($barang['id']) ?>"
                                                                        <?= isset($sarana['barang_id']) && $sarana['barang_id'] == $barang['id'] ? 'selected' : ''; ?>>
                                                                        <?= htmlspecialchars($barang['nama_barang']) ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <small class="form-text text-muted mt-1">Pilih jenis barang ATK dari daftar atau ketik untuk mencari</small>
                                                </div>
                                                <!-- Nama Detail Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_detail_barang" class="font-weight-bold">Nama Detail Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang"
                                                            placeholder="Contoh: Pensil 2B Faber Castell" readonly required
                                                            value="<?= htmlspecialchars($sarana['nama_detail_barang'] ?? '') ?>">
                                                    </div>
                                                </div>
                                                <!-- No Registrasi -->

                                            </div>

                                            <!-- Data Spesifikasi -->
                                            <div class="col-12 mb-5 hidden">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    SPESIFIKASI
                                                </h5>
                                                <!-- Merk -->
                                                <div class="form-group mb-4">
                                                    <label for="merk" class="font-weight-bold">Merk</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-copyright text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="merk" name="merk"
                                                            placeholder="Contoh: Faber Castell, Sinar Dunia, Joyko"
                                                            value="<?= htmlspecialchars($sarana['merk'] ?? '') ?>">
                                                    </div>
                                                </div>
                                                <!-- Spesifikasi -->
                                                <div class="form-group mb-4">
                                                    <label for="spesifikasi" class="font-weight-bold">Spesifikasi</label>
                                                    <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                                                        placeholder="Masukkan spesifikasi lengkap (ukuran, warna, tipe, dll)"><?= htmlspecialchars($sarana['spesifikasi'] ?? '') ?></textarea>
                                                </div>
                                            </div>

                                            <!-- Data Kondisi dan Kuantitas -->
                                            <div class="col-12 mb-5 ">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    KONDISI
                                                </h5>
                                                <!-- Kondisi Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="kondisi_barang_id" class="font-weight-bold">Kondisi Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-clipboard-check text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kondisi_barang_id" name="kondisi_barang_id" required>
                                                            <option value="" disabled <?= !isset($sarana) ? 'selected' : ''; ?>>Pilih Kondisi</option>
                                                            <?php foreach ($kondisiList as $kondisi): ?>
                                                                <option value="<?= htmlspecialchars($kondisi['id']) ?>" <?= isset($sarana) && $sarana['kondisi_barang_id'] == $kondisi['id'] ? 'selected' : ''; ?>>
                                                                    <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Jumlah -->
                                                <div class="form-group mb-4 hidden">
                                                    <label for="jumlah" class="font-weight-bold">Kuantitas</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-calculator text-primary"></i></span>
                                                        </div>
                                                        <input type="number" class="form-control" id="jumlah" name="jumlah"
                                                            value="<?= htmlspecialchars($sarana['jumlah'] ?? '1') ?>"
                                                            min="1" required>
                                                        <div class="input-group-append">
                                                            <select class="form-control" id="satuan" name="satuan" required> <!-- Dibuat required -->
                                                                <option value="Buah" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Buah') || !isset($sarana['satuan']) ? 'selected' : '' ?>>Buah</option>
                                                                <option value="Unit" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Unit') ? 'selected' : '' ?>>Unit</option>
                                                                <option value="Pack" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Pack') ? 'selected' : '' ?>>Pack</option> <!-- Diubah dari Pack ke Pak agar konsisten dengan sebelumnya -->
                                                                <option value="Rim" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Rim') ? 'selected' : '' ?>>Rim</option>
                                                                <option value="Lusin" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Lusin') ? 'selected' : '' ?>>Lusin</option>
                                                                <option value="Set" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Set') ? 'selected' : '' ?>>Set</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Biaya Pembelian -->
                                                <div class="form-group mb-4 hidden">
                                                    <label for="biaya_pembelian" class="font-weight-bold">Biaya Pembelian (Per Satuan)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-money-bill-wave text-primary"></i></span> <!-- Ikon diubah -->
                                                        </div>
                                                        <input type="number" class="form-control" id="biaya_pembelian" name="biaya_pembelian"
                                                            placeholder="Contoh: 2500 (tanpa titik/koma)" min="0"
                                                            value="<?= htmlspecialchars($sarana['biaya_pembelian'] ?? '') ?>">
                                                    </div>
                                                </div>
                                                <!-- Tanggal Pembelian -->
                                                <div class="form-group mb-4 hidden">
                                                    <label for="tanggal_pembelian" class="font-weight-bold">Tanggal Pembelian</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="far fa-calendar-alt text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian"
                                                            value="<?= htmlspecialchars($sarana['tanggal_pembelian'] ?? '') ?>"> <!-- required dihilangkan jika opsional, atau tambahkan jika wajib -->
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Tambahan -->
                                            <div class="col-12 hidden">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    LOKASI PEMINDAHAN
                                                </h5>
                                                <!-- Lokasi Penempatan Barang -->
                                                <div class="form-group mb-4 hidden">
                                                    <label for="lokasi" class="font-weight-bold text-dark mb-2">Lokasi Penempatan Barang</label>
                                                    <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text border-0 bg-light">
                                                                <i class="fas fa-map-marker-alt text-primary"></i> <!-- Ganti ikon -->
                                                            </span>
                                                        </div>
                                                        <select class="form-control rounded border-0 select2-custom" id="lokasi" name="lokasi" required>
                                                            <!-- <option value="" disabled>Pilih atau ketik lokasi barang</option> -->
                                                            <optgroup label="Lapang">
                                                                <?php foreach ($lapangData as $lokasi_item) : ?>
                                                                    <option value="<?= htmlspecialchars($lokasi_item['nama_lapang']); ?>" <?= ($sarana['lokasi'] == $lokasi_item['nama_lapang']) ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($lokasi_item['kode_lapang']); ?> - <?= htmlspecialchars($lokasi_item['nama_lapang']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                            <optgroup label="Ruang">
                                                                <?php foreach ($ruangData as $lokasi_item) : ?>
                                                                    <option value="<?= htmlspecialchars($lokasi_item['nama_ruang']); ?>" <?= ($sarana['lokasi'] == $lokasi_item['nama_ruang']) ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($lokasi_item['kode_ruang']); ?> - <?= htmlspecialchars($lokasi_item['nama_ruang']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <small class="form-text text-muted mt-1">Pilih lokasi dari daftar atau ketik untuk mencari</small>
                                                </div>
                                                <!-- Keterangan -->
                                                <div class="form-group mb-4">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                                                        placeholder="Tambahkan keterangan jika diperlukan (misal: stok minimal, tanggal kadaluarsa jika ada)"><?= htmlspecialchars($sarana['keterangan'] ?? '') ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- Penutup card-body -->

                                <div class="card-footer text-right text-white"> <!-- Pertimbangkan menghapus text-white -->
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