<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>
<!-- Apply px-3 to match create.php -->

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">

    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <!-- Adjust padding to match create.php -->
    <div class="content-wrapper bg-white mb-5 pt-3">
      <div class="container-fluid ">
        <div class="row justify-content-center ">
          <div class="col-12 ">

            <?php if (!empty($_SESSION['error'])) : ?>
              <div class="alert alert-danger alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <?= htmlspecialchars($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
              </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['update'])) : ?>
              <div class="alert alert-success alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <?= htmlspecialchars($_SESSION['update']); ?>
              </div>
              <?php unset($_SESSION['update']); ?>
            <?php endif; ?>

            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <!-- Change h1 to h3 and update classes/text to match create.php -->
                <h3 class="card-title text-bold">
                  FORMULIR EDIT DATA BANGUNAN
                </h3>
              </div>

              <form action="/admin/prasarana/gedung?edit=<?= htmlspecialchars($gedung['id']) ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($gedung['id']) ?>">

                <div class="card-body">
                  <div class="row">
                    <!-- Data Identitas Gedung -->
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS BANGUNAN
                        </h5>
                        <span class="form-text">Silahkan perbarui data identitas bangunan dengan lengkap.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md hidden">
                        <div class="form-group">
                          <label for="kode_gedung" class="fw-bold">Kode Bangunan <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="kode_gedung" name="kode_gedung" value="<?= htmlspecialchars($gedung['kode_gedung'] ?? '') ?>" readonly required>
                          <span class="form-text">Kode bangunan unik. Tidak dapat diubah.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="nama_gedung" class="fw-bold">Nama Bangunan <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="nama_gedung" name="nama_gedung" value="<?= htmlspecialchars($gedung['nama_gedung'] ?? '') ?>" placeholder="Contoh: Gedung Rektorat" required>
                          <span class="form-text">Masukkan nama lengkap atau deskriptif untuk bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="luas" class="fw-bold">Luas Bangunan (m²) <span class="text-danger">*</span></label>
                          <input type="number" step="0.01" class="form-control" id="luas" name="luas" value="<?= htmlspecialchars($gedung['luas'] ?? '') ?>" placeholder="Masukkan luas gedung dalam meter persegi" required>
                          <span class="form-text">Masukkan luas total bangunan dalam meter persegi.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="jumlah_lantai" class="fw-bold">Jumlah Lantai <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="jumlah_lantai" name="jumlah_lantai" value="<?= htmlspecialchars($gedung['jumlah_lantai'] ?? '') ?>" placeholder="Masukkan jumlah lantai" required>
                          <span class="form-text">Masukkan jumlah lantai yang dimiliki bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="lokasi" class="fw-bold">Lokasi Bangunan <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="lokasi" name="lokasi" rows="2" placeholder="Contoh: Jalan Raya Cigugur No. 14, Kuningan, Jawa Barat" required><?= htmlspecialchars($gedung['lokasi'] ?? '') ?></textarea>
                          <span class="form-text">Masukkan alamat lengkap lokasi bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Jenis Aset -->
                        <div class="form-group">
                          <label for="jenis_aset_id" class="fw-bold">Jenis Aset <span class="text-danger">*</span></label>
                          <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                            <option value="" disabled <?= empty($gedung['jenis_aset_id']) ? 'selected' : '' ?>>Pilih Jenis Aset</option>
                            <?php foreach ($jenisAsetId as $ja) : ?>
                              <option value="<?= htmlspecialchars($ja['id']) ?>"
                                <?= (isset($gedung['jenis_aset_id']) && $gedung['jenis_aset_id'] == $ja['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($ja['jenis_aset']) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                          <span class="form-text">Pilih klasifikasi jenis aset untuk bangunan ini.</span>
                        </div>
                      </div>
                    </div>

                    <!-- Data Konstruksi Gedung -->
                    <div class="col-12 mt-4 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          KONSTRUKSI BANGUNAN
                        </h5>
                        <span class="form-text">Pilih jenis konstruksi dan kondisi terkini dari bangunan.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="kontruksi" class="fw-bold">Jenis Konstruksi <span class="text-danger">*</span></label>
                          <select class="form-control select2-custom" id="kontruksi" name="kontruksi" required>
                            <option value="" disabled <?= empty($gedung['kontruksi']) ? 'selected' : '' ?>>Pilih Jenis Konstruksi</option>

                            <optgroup label="Beton">
                              <option value="Beton Cor di Tempat - SRPM Khusus" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Beton Cor di Tempat - SRPM Khusus') ? 'selected' : '' ?>>Beton Cor di Tempat - SRPM Khusus</option>
                              <option value="Beton Cor di Tempat - SRPM Menengah" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Beton Cor di Tempat - SRPM Menengah') ? 'selected' : '' ?>>Beton Cor di Tempat - SRPM Menengah</option>
                              <option value="Beton Cor di Tempat - Dinding Geser (Shear Wall)" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Beton Cor di Tempat - Dinding Geser (Shear Wall)') ? 'selected' : '' ?>>Beton Cor di Tempat - Dinding Geser (Shear Wall)</option>
                              <option value="Beton Cor di Tempat - Sistem Ganda (Dual System)" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Beton Cor di Tempat - Sistem Ganda (Dual System)') ? 'selected' : '' ?>>Beton Cor di Tempat - Sistem Ganda (Dual System)</option>
                              <option value="Beton Pracetak (Precast Concrete)" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Beton Pracetak (Precast Concrete)') ? 'selected' : '' ?>>Beton Pracetak (Precast Concrete)</option>
                            </optgroup>

                            <optgroup label="Baja">
                              <option value="Rangka Baja - Rangka Kaku (Moment Resisting Frame)" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Rangka Baja - Rangka Kaku (Moment Resisting Frame)') ? 'selected' : '' ?>>Rangka Baja - Rangka Kaku (Moment Resisting Frame)</option>
                              <option value="Rangka Baja - Rangka Berpengaku (Braced Frame)" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Rangka Baja - Rangka Berpengaku (Braced Frame)') ? 'selected' : '' ?>>Rangka Baja - Rangka Berpengaku (Braced Frame)</option>
                              <option value="Struktur Atap Baja - Rangka Batang (Truss)" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Struktur Atap Baja - Rangka Batang (Truss)') ? 'selected' : '' ?>>Struktur Atap Baja - Rangka Batang (Truss)</option>
                              <option value="Struktur Atap Baja - Rangka Ruang (Space Frame)" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Struktur Atap Baja - Rangka Ruang (Space Frame)') ? 'selected' : '' ?>>Struktur Atap Baja - Rangka Ruang (Space Frame)</option>
                              <option value="Rangka Baja Ringan (Atap/Partisi)" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Rangka Baja Ringan (Atap/Partisi)') ? 'selected' : '' ?>>Rangka Baja Ringan (Atap/Partisi)</option>
                            </optgroup>

                            <optgroup label="Kayu">
                              <option value="Kayu - Konstruksi Solid Konvensional" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Kayu - Konstruksi Solid Konvensional') ? 'selected' : '' ?>>Kayu - Konstruksi Solid Konvensional</option>
                              <option value="Kayu - Rekayasa Glulam" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Kayu - Rekayasa Glulam') ? 'selected' : '' ?>>Kayu - Rekayasa Glulam</option>
                              <option value="Kayu - Rekayasa Cross-Laminated Timber (CLT)" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Kayu - Rekayasa Cross-Laminated Timber (CLT)') ? 'selected' : '' ?>>Kayu - Rekayasa Cross-Laminated Timber (CLT)</option>
                            </optgroup>

                            <optgroup label="Pasangan Bata (Masonry)">
                              <option value="Pasangan Bata - Dinding Pemikul Beban (Load-Bearing)" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Pasangan Bata - Dinding Pemikul Beban (Load-Bearing)') ? 'selected' : '' ?>>Pasangan Bata - Dinding Pemikul Beban (Load-Bearing)</option>
                              <option value="Pasangan Bata - Dinding Bata Terkekang (Confined Masonry)" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Pasangan Bata - Dinding Bata Terkekang (Confined Masonry)') ? 'selected' : '' ?>>Pasangan Bata - Dinding Bata Terkekang (Confined Masonry)</option>
                            </optgroup>

                            <optgroup label="Komposit">
                              <option value="COMP-SC" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'COMP-SC') ? 'selected' : '' ?>>Struktur Komposit Baja-Beton</option>
                            </optgroup>

                            <optgroup label="Panduan">
                              <option value="Tidak Diketahui" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Tidak Diketahui') ? 'selected' : '' ?>>Tidak Diketahui</option>
                              <option value="Lainnya" <?= (isset($gedung['kontruksi']) && $gedung['kontruksi'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya...</option>
                            </optgroup>

                          </select>
                          <span class="form-text">Pilih jenis sistem struktur dan material dominan pada bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="kondisi" class="fw-bold">Kondisi Bangunan <span class="text-danger">*</span></label>
                          <select class="form-control" id="kondisi" name="kondisi" required>
                            <option value="" disabled <?= empty($gedung['kondisi']) ? 'selected' : '' ?>>Pilih Kondisi Bangunan</option>
                            <option value="Baik" <?= ($gedung['kondisi'] ?? '') == 'Baik' ? 'selected' : '' ?>>Baik</option>
                            <option value="Rusak Ringan" <?= ($gedung['kondisi'] ?? '') == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak Ringan</option>
                            <option value="Rusak Berat" <?= ($gedung['kondisi'] ?? '') == 'Rusak Berat' ? 'selected' : '' ?>>Rusak Berat</option>
                          </select>
                          <span class="form-text">Pilih kondisi fisik bangunan secara umum.</span>
                        </div>
                      </div>
                    </div>

                    <!-- Data Kepemilikan dan Fungsi -->
                    <div class="col-12 mt-4">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          KEPEMILIKAN DAN FUNGSI
                        </h5>
                        <span class="form-text">Isi informasi mengenai unit kepemilikan dan fungsi utama bangunan.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Unit Kepemilikan -->
                        <div class="form-group">
                          <label for="unit_kepemilikan" class="fw-bold">Unit Kepemilikan <span class="text-danger">*</span></label>
                          <select class="form-control" name="unit_kepemilikan" id="unit_kepemilikan" required>
                            <option value="" disabled <?= empty($gedung['unit_kepemilikan']) ? 'selected' : '' ?>>Pilih Unit Kepemilikan</option>
                            <?php
                            $unitKepemilikanOptions = [
                              "Fakultas Pendidikan, Sosial, dan Teknologi",
                              "Fakultas Farmasi, Kesehatan, dan Sains",
                              "Universitas (Umum)"
                              // Tambahkan opsi lain jika perlu di sini
                            ];
                            foreach ($unitKepemilikanOptions as $option) : ?>
                              <option value="<?= htmlspecialchars($option) ?>" <?= (isset($gedung['unit_kepemilikan']) && $gedung['unit_kepemilikan'] == $option) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($option) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                          <span class="form-text">Pilih unit atau fakultas yang memiliki atau bertanggung jawab atas bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="fungsi" class="fw-bold">Fungsi Bangunan <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="fungsi" name="fungsi" value="<?= htmlspecialchars($gedung['fungsi'] ?? '') ?>" placeholder="Contoh: Perkuliahan, Perkantoran, Laboratorium" required>
                          <span class="form-text">Jelaskan fungsi utama dari bangunan ini (Contoh: Pendidikan, Perkantoran, Laboratorium, Ibadah, Olahraga, dll).</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="tahun_dibangun" class="fw-bold">Tanggal Dibangun <span class="text-danger">*</span></label>
                          <input type="date" class="form-control" id="tahun_dibangun" name="tahun_dibangun" value="<?= htmlspecialchars($gedung['tahun_dibangun'] ? date('Y-m-d', strtotime($gedung['tahun_dibangun'])) : '') ?>" required>
                          <span class="form-text">Masukkan tanggal bangunan ini didirikan.</span>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Jenis Bangunan -->
                        <div class="form-group">
                          <label for="jenis_bangunan" class="fw-bold">Jenis Bangunan <span class="text-danger">*</span></label>
                          <select class="form-control select2-custom" id="jenis_bangunan" name="jenis_bangunan" required>
                            <option value="" disabled <?= empty($gedung['jenis_bangunan']) ? 'selected' : '' ?>>Pilih Jenis Bangunan</option>

                            <optgroup label="Prasarana Inti Akademik (Pendidikan & Pembelajaran)">
                              <option value="Gedung Kuliah Bersama (GKB)" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Gedung Kuliah Bersama (GKB)') ? 'selected' : '' ?>>Gedung Kuliah Bersama (GKB)</option>
                              <option value="Gedung Fakultas" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Gedung Fakultas') ? 'selected' : '' ?>>Gedung Fakultas</option>
                              <option value="Gedung Program Pascasarjana" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Gedung Program Pascasarjana') ? 'selected' : '' ?>>Gedung Program Pascasarjana</option>
                              <option value="Perpustakaan Pusat" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Perpustakaan Pusat') ? 'selected' : '' ?>>Perpustakaan Pusat</option>
                              <option value="Perpustakaan Fakultas" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Perpustakaan Fakultas') ? 'selected' : '' ?>>Perpustakaan Fakultas</option>
                              <option value="Laboratorium Dasar" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Laboratorium Dasar') ? 'selected' : '' ?>>Laboratorium Dasar</option>
                              <option value="Laboratorium Lanjutan/Spesialis" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Laboratorium Lanjutan/Spesialis') ? 'selected' : '' ?>>Laboratorium Lanjutan/Spesialis</option>
                              <option value="Laboratorium Komputer & CBT Center" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Laboratorium Komputer & CBT Center') ? 'selected' : '' ?>>Laboratorium Komputer & CBT Center</option>
                              <option value="Studio (Desain/Seni)" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Studio (Desain/Seni)') ? 'selected' : '' ?>>Studio (Desain/Seni)</option>
                              <option value="Bengkel Kerja / Workshop" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Bengkel Kerja / Workshop') ? 'selected' : '' ?>>Bengkel Kerja / Workshop</option>
                              <option value="Ruang Microteaching" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Ruang Microteaching') ? 'selected' : '' ?>>Ruang Microteaching</option>
                            </optgroup>

                            <optgroup label="Prasarana Riset dan Inovasi">
                              <option value="Gedung Pusat Studi & Lembaga Penelitian" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Gedung Pusat Studi & Lembaga Penelitian') ? 'selected' : '' ?>>Gedung Pusat Studi & Lembaga Penelitian</option>
                              <option value="Laboratorium Riset Terpadu" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Laboratorium Riset Terpadu') ? 'selected' : '' ?>>Laboratorium Riset Terpadu</option>
                              <option value="Inkubator Bisnis dan Teknologi" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Inkubator Bisnis dan Teknologi') ? 'selected' : '' ?>>Inkubator Bisnis dan Teknologi</option>
                              <option value="Rumah Hewan Coba" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Rumah Hewan Coba') ? 'selected' : '' ?>>Rumah Hewan Coba</option>
                              <option value="Rumah Kaca (Greenhouse)" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Rumah Kaca (Greenhouse)') ? 'selected' : '' ?>>Rumah Kaca (Greenhouse)</option>
                            </optgroup>

                            <optgroup label="Prasarana Pelayanan Publik & Pengabdian Masyarakat">
                              <option value="Gedung Serbaguna / Auditorium" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Gedung Serbaguna / Auditorium') ? 'selected' : '' ?>>Gedung Serbaguna / Auditorium</option>
                              <option value="Pusat Layanan Kesehatan (Klinik/Medical Center)" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Pusat Layanan Kesehatan (Klinik/Medical Center)') ? 'selected' : '' ?>>Pusat Layanan Kesehatan (Klinik/Medical Center)</option>
                              <option value="Rumah Sakit Pendidikan" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Rumah Sakit Pendidikan') ? 'selected' : '' ?>>Rumah Sakit Pendidikan</option>
                              <option value="Apotek / Unit Farmasi" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Apotek / Unit Farmasi') ? 'selected' : '' ?>>Apotek / Unit Farmasi</option>
                              <option value="Lembaga Bantuan Hukum (LBH)" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Lembaga Bantuan Hukum (LBH)') ? 'selected' : '' ?>>Lembaga Bantuan Hukum (LBH)</option>
                              <option value="Pusat Layanan Psikologi" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Pusat Layanan Psikologi') ? 'selected' : '' ?>>Pusat Layanan Psikologi</option>
                            </optgroup>

                            <optgroup label="Prasarana Identitas & AIK">
                              <option value="Masjid Kampus" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Masjid Kampus') ? 'selected' : '' ?>>Masjid Kampus</option>
                              <option value="Gedung Pusat Studi AIK" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Gedung Pusat Studi AIK') ? 'selected' : '' ?>>Gedung Pusat Studi AIK</option>
                              <option value="Asrama Mahasiswa" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Asrama Mahasiswa') ? 'selected' : '' ?>>Asrama Mahasiswa</option>
                              <option value="Kantor Organisasi Otonom (IMM, HW, Tapak Suci)" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Kantor Organisasi Otonom (IMM, HW, Tapak Suci)') ? 'selected' : '' ?>>Kantor Organisasi Otonom (IMM, HW, Tapak Suci)</option>
                            </optgroup>

                            <optgroup label="Prasarana Kesejahteraan & Kemahasiswaan">
                              <option value="Gedung Pusat Kegiatan Mahasiswa (PKM)" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Gedung Pusat Kegiatan Mahasiswa (PKM)') ? 'selected' : '' ?>>Gedung Pusat Kegiatan Mahasiswa (PKM)</option>
                              <option value="Fasilitas Olahraga (Stadion/GOR/Lapangan)" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Fasilitas Olahraga (Stadion/GOR/Lapangan)') ? 'selected' : '' ?>>Fasilitas Olahraga (Stadion/GOR/Lapangan)</option>
                              <option value="Area Kuliner (Kantin/Food Court)" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Area Kuliner (Kantin/Food Court)') ? 'selected' : '' ?>>Area Kuliner (Kantin/Food Court)</option>
                              <option value="Toko Buku & Koperasi Mahasiswa" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Toko Buku & Koperasi Mahasiswa') ? 'selected' : '' ?>>Toko Buku & Koperasi Mahasiswa</option>
                              <option value="Guesthouse / Wisma Tamu" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Guesthouse / Wisma Tamu') ? 'selected' : '' ?>>Guesthouse / Wisma Tamu</option>
                            </optgroup>

                            <optgroup label="Prasarana Tata Kelola & Administrasi">
                              <option value="Gedung Rektorat / Administrasi Pusat" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Gedung Rektorat / Administrasi Pusat') ? 'selected' : '' ?>>Gedung Rektorat / Administrasi Pusat</option>
                              <option value="Gedung Dekanat" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Gedung Dekanat') ? 'selected' : '' ?>>Gedung Dekanat</option>
                              <option value="Kantor Unit Kerja (Prodi/Lembaga/Biro)" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Kantor Unit Kerja (Prodi/Lembaga/Biro)') ? 'selected' : '' ?>>Kantor Unit Kerja (Prodi/Lembaga/Biro)</option>
                              <option value="Ruang Arsip / Pusat Dokumentasi" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Ruang Arsip / Pusat Dokumentasi') ? 'selected' : '' ?>>Ruang Arsip / Pusat Dokumentasi</option>
                            </optgroup>

                            <optgroup label="Prasarana Umum, Utilitas & Infrastruktur">
                              <option value="Bangunan Utilitas (Gardu Listrik/Genset/IPAL)" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Bangunan Utilitas (Gardu Listrik/Genset/IPAL)') ? 'selected' : '' ?>>Bangunan Utilitas (Gardu Listrik/Genset/IPAL)</option>
                              <option value="Gudang" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Gudang') ? 'selected' : '' ?>>Gudang</option>
                              <option value="Pos Keamanan" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Pos Keamanan') ? 'selected' : '' ?>>Pos Keamanan</option>
                              <option value="Gedung Parkir" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Gedung Parkir') ? 'selected' : '' ?>>Gedung Parkir</option>
                            </optgroup>

                            <optgroup label="Unit Usaha (AUM-Bisnis)">
                              <option value="Hotel dan Pusat Pelatihan" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Hotel dan Pusat Pelatihan') ? 'selected' : '' ?>>Hotel dan Pusat Pelatihan</option>
                              <option value="SPBU" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'SPBU') ? 'selected' : '' ?>>SPBU</option>
                              <option value="Penerbitan dan Percetakan" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Penerbitan dan Percetakan') ? 'selected' : '' ?>>Penerbitan dan Percetakan</option>
                              <option value="Unit Agribisnis Komersial" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Unit Agribisnis Komersial') ? 'selected' : '' ?>>Unit Agribisnis Komersial</option>
                            </optgroup>

                            <optgroup label="Panduan">
                              <option value="Tidak Diketahui" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Tidak Diketahui') ? 'selected' : '' ?>>Tidak Diketahui</option>
                              <option value="Lainnya" <?= (isset($gedung['jenis_bangunan']) && $gedung['jenis_bangunan'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya...</option>
                            </optgroup>

                          </select>
                          <span class="form-text">Pilih jenis bangunan sesuai dengan fungsi utamanya.</span>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Keterangan -->
                        <div class="form-group">
                          <label for="keterangan" class="fw-bold">Keterangan</label>
                          <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan tambahan jika ada"><?= htmlspecialchars($gedung['keterangan'] ?? '') ?></textarea>
                          <span class="form-text">Tambahkan informasi atau catatan lain terkait bangunan ini.</span>
                        </div>
                      </div>
                    </div>

                  </div>
                </div> <!-- Penutup card-body -->

                <div class="card-footer text-right">
                  <?php
                  $backUrl = "/admin/prasarana/gedung"; // Default fallback
                  if (isset($gedung['id']) && !empty($gedung['id'])) {
                    // Link to detail page
                    $backUrl = "/admin/prasarana/gedung?detail=" . htmlspecialchars($gedung['id']);
                  }
                  ?>
                  <a href="<?= $backUrl ?>" class="btn btn-secondary">
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                  </button>
                </div>
              </form>
            </div> <!-- Penutup card -->
          </div> <!-- Penutup col-12 -->
        </div>
      </div> <!-- Penutup row -->
    </div> <!-- Penutup container-fluid -->
  </div>

  <?php include './app/Views/Components/footer.php'; ?>
  </div>

  <?php include './app/Views/Components/script.php'; ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize Select2 for Jenis Konstruksi
      $('#kontruksi').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Jenis Konstruksi",
        allowClear: true, // Optional: Adds a clear button
        width: '100%'
      });

      // Initialize Select2 for Jenis Bangunan
      $('#jenis_bangunan').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Jenis Bangunan",
        allowClear: true,
        width: '100%'
      });
    });
  </script>
</body>

</html>