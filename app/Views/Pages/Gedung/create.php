<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>
<!-- Apply px-3 to match Tanah/create.php -->

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>
    <!-- Adjust padding to match Tanah/create.php -->
    <div class="content-wrapper bg-white mb-5 pt-3 ">
      <div class="container-fluid ">
        <div class="row justify-content-center ">
          <div class="col-12 ">
            <?php if (!empty($error)) : ?>
              <div class="alert alert-danger alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <?= htmlspecialchars($error); ?>
              </div>
            <?php endif; ?>

            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <!-- Change h1 to h3 and update classes/text to match Tanah/create.php -->
                <h3 class="card-title text-bold">
                  FORMULIR TAMBAH DATA BANGUNAN
                </h3>
              </div>

              <form action="/admin/prasarana/gedung/tambah" method="POST" enctype="multipart/form-data">
                <!-- Removed hidden id field, not present in Tanah/create.php -->
                <div class="card-body">
                  <div class="row">
                    <!-- Data Identitas Bangunan -->
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS BANGUNAN
                        </h5>
                        <span class="form-text">Silahkan isi data identitas bangunan dengan lengkap.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md hidden"> <!-- Made hidden -->
                        <!-- Kode Bangunan -->
                        <div class="form-group">
                          <label for="kode_gedung_display" class="fw-bold">Kode Bangunan <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="kode_gedung_display" name="kode_gedung_display" <!-- id and name changed -->
                          placeholder="Akan di-generate otomatis" readonly>
                          <span class="form-text">Format: PRS-BNG-TAHUN-XXXX (akan di-generate otomatis berdasarkan tahun dibangun).</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Nama Bangunan -->
                        <div class="form-group">
                          <label for="nama_gedung" class="fw-bold">Nama Bangunan <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="nama_gedung" name="nama_gedung" placeholder="Contoh: Gedung Rektorat" required>
                          <span class="form-text">Masukkan nama lengkap atau deskriptif untuk bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Luas Bangunan -->
                        <div class="form-group">
                          <label for="luas" class="fw-bold">Luas Bangunan (m²) <span class="text-danger">*</span></label>
                          <input type="number" step="0.01" class="form-control" id="luas" name="luas" placeholder="Masukkan luas gedung dalam meter persegi" required>
                          <span class="form-text">Masukkan luas total bangunan dalam meter persegi.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Jumlah Lantai -->
                        <div class="form-group">
                          <label for="jumlah_lantai" class="fw-bold">Jumlah Lantai <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" id="jumlah_lantai" name="jumlah_lantai" placeholder="Masukkan jumlah lantai" required>
                          <span class="form-text">Masukkan jumlah lantai yang dimiliki bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Lokasi Bangunan -->
                        <div class="form-group">
                          <label for="lokasi" class="fw-bold">Lokasi Bangunan <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="lokasi" name="lokasi" rows="2" placeholder="Contoh: Jalan Raya Cigugur No. 14, Kuningan, Jawa Barat" required></textarea>
                          <span class="form-text">Masukkan alamat lengkap lokasi bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Jenis Aset -->
                        <div class="form-group">
                          <label for="jenis_aset_id" class="fw-bold">Jenis Aset <span class="text-danger">*</span></label>
                          <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                            <option value="" disabled selected>Pilih Jenis Aset</option>
                            <?php foreach ($jenisAsetId as $ja) : ?>
                              <option value="<?= htmlspecialchars($ja['id']) ?>">
                                <?= htmlspecialchars($ja['jenis_aset']) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                          <span class="form-text">Pilih klasifikasi jenis aset untuk bangunan ini.</span>
                        </div>
                      </div>
                    </div>

                    <!-- Data Konstruksi Bangunan -->
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
                            <option value="" disabled selected>Pilih Jenis Konstruksi</option>

                            <optgroup label="Beton">
                              <option value="Beton Cor di Tempat - SRPM Khusus">Beton Cor di Tempat - SRPM Khusus</option>
                              <option value="Beton Cor di Tempat - SRPM Menengah">Beton Cor di Tempat - SRPM Menengah</option>
                              <option value="Beton Cor di Tempat - Dinding Geser (Shear Wall)">Beton Cor di Tempat - Dinding Geser (Shear Wall)</option>
                              <option value="Beton Cor di Tempat - Sistem Ganda (Dual System)">Beton Cor di Tempat - Sistem Ganda (Dual System)</option>
                              <option value="Beton Pracetak (Precast Concrete)">Beton Pracetak (Precast Concrete)</option>
                            </optgroup>

                            <optgroup label="Baja">
                              <option value="Rangka Baja - Rangka Kaku (Moment Resisting Frame)">Rangka Baja - Rangka Kaku (Moment Resisting Frame)</option>
                              <option value="Rangka Baja - Rangka Berpengaku (Braced Frame)">Rangka Baja - Rangka Berpengaku (Braced Frame)</option>
                              <option value="Struktur Atap Baja - Rangka Batang (Truss)">Struktur Atap Baja - Rangka Batang (Truss)</option>
                              <option value="Struktur Atap Baja - Rangka Ruang (Space Frame)">Struktur Atap Baja - Rangka Ruang (Space Frame)</option>
                              <option value="Rangka Baja Ringan (Atap/Partisi)">Rangka Baja Ringan (Atap/Partisi)</option>
                            </optgroup>

                            <optgroup label="Kayu">
                              <option value="Kayu - Konstruksi Solid Konvensional">Kayu - Konstruksi Solid Konvensional</option>
                              <option value="Kayu - Rekayasa Glulam">Kayu - Rekayasa Glulam</option>
                              <option value="Kayu - Rekayasa Cross-Laminated Timber (CLT)">Kayu - Rekayasa Cross-Laminated Timber (CLT)</option>
                            </optgroup>

                            <optgroup label="Pasangan Bata (Masonry)">
                              <option value="Pasangan Bata - Dinding Pemikul Beban (Load-Bearing)">Pasangan Bata - Dinding Pemikul Beban (Load-Bearing)</option>
                              <option value="Pasangan Bata - Dinding Bata Terkekang (Confined Masonry)">Pasangan Bata - Dinding Bata Terkekang (Confined Masonry)</option>
                            </optgroup>

                            <optgroup label="Komposit">
                              <option value="COMP-SC">Struktur Komposit Baja-Beton</option>
                            </optgroup>

                            <optgroup label="Panduan">
                              <option value="Tidak Diketahui">Tidak Diketahui</option>
                              <option value="Lainnya">Lainnya...</option>
                            </optgroup>

                          </select>
                          <span class="form-text">Pilih jenis sistem struktur dan material dominan pada bangunan.</span>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Kondisi Bangunan -->
                        <div class="form-group">
                          <label for="kondisi" class="fw-bold">Kondisi Bangunan <span class="text-danger">*</span></label>
                          <select class="form-control" id="kondisi" name="kondisi" required>
                            <option value="" disabled selected>Pilih Kondisi Bangunan</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
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
                            <option value="" disabled selected>Pilih Unit Kepemilikan</option>
                            <option value="Fakultas Pendidikan, Sosial, dan Teknologi">Fakultas Pendidikan, Sosial, dan Teknologi</option>
                            <option value="Fakultas Farmasi, Kesehatan, dan Sains">Fakultas Farmasi, Kesehatan, dan Sains</option>
                            <option value="Universitas">Universitas (Umum)</option>
                            <!-- Tambahkan opsi lain jika perlu -->
                          </select>
                          <span class="form-text">Pilih unit atau fakultas yang memiliki atau bertanggung jawab atas bangunan.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Fungsi Bangunan -->
                        <div class="form-group">
                          <label for="fungsi" class="fw-bold">Fungsi Bangunan <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="fungsi" name="fungsi" placeholder="Contoh: Perkuliahan, Perkantoran, Laboratorium" required>
                          <span class="form-text">Jelaskan fungsi utama dari bangunan ini (Contoh: Pendidikan, Perkantoran, Laboratorium, Ibadah, Olahraga, dll).</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Tahun Dibangun -->
                        <div class="form-group">
                          <label for="tahun_dibangun" class="fw-bold">Tanggal Dibangun <span class="text-danger">*</span></label>
                          <input type="date" class="form-control" id="tahun_dibangun" name="tahun_dibangun"
                            required>
                          <span class="form-text">Masukkan tanggal bangunan ini didirikan.</span>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="jenis_bangunan" class="fw-bold">Jenis Bangunan <span class="text-danger">*</span></label>
                          <select class="form-control select2-custom" id="jenis_bangunan" name="jenis_bangunan" required>
                            <option value="" disabled selected>Pilih Jenis Bangunan</option>

                            <optgroup label="Prasarana Inti Akademik (Pendidikan & Pembelajaran)">
                              <option value="Gedung Kuliah Bersama (GKB)">Gedung Kuliah Bersama (GKB)</option>
                              <option value="Gedung Fakultas">Gedung Fakultas</option>
                              <option value="Gedung Program Pascasarjana">Gedung Program Pascasarjana</option>
                              <option value="Perpustakaan Pusat">Perpustakaan Pusat</option>
                              <option value="Perpustakaan Fakultas">Perpustakaan Fakultas</option>
                              <option value="Laboratorium Dasar">Laboratorium Dasar</option>
                              <option value="Laboratorium Lanjutan/Spesialis">Laboratorium Lanjutan/Spesialis</option>
                              <option value="Laboratorium Komputer & CBT Center">Laboratorium Komputer & CBT Center</option>
                              <option value="Studio (Desain/Seni)">Studio (Desain/Seni)</option>
                              <option value="Bengkel Kerja / Workshop">Bengkel Kerja / Workshop</option>
                              <option value="Ruang Microteaching">Ruang Microteaching</option>
                            </optgroup>

                            <optgroup label="Prasarana Riset dan Inovasi">
                              <option value="Gedung Pusat Studi & Lembaga Penelitian">Gedung Pusat Studi & Lembaga Penelitian</option>
                              <option value="Laboratorium Riset Terpadu">Laboratorium Riset Terpadu</option>
                              <option value="Inkubator Bisnis dan Teknologi">Inkubator Bisnis dan Teknologi</option>
                              <option value="Rumah Hewan Coba">Rumah Hewan Coba</option>
                              <option value="Rumah Kaca (Greenhouse)">Rumah Kaca (Greenhouse)</option>
                            </optgroup>

                            <optgroup label="Prasarana Pelayanan Publik & Pengabdian Masyarakat">
                              <option value="Gedung Serbaguna / Auditorium">Gedung Serbaguna / Auditorium</option>
                              <option value="Pusat Layanan Kesehatan (Klinik/Medical Center)">Pusat Layanan Kesehatan (Klinik/Medical Center)</option>
                              <option value="Rumah Sakit Pendidikan">Rumah Sakit Pendidikan</option>
                              <option value="Apotek / Unit Farmasi">Apotek / Unit Farmasi</option>
                              <option value="Lembaga Bantuan Hukum (LBH)">Lembaga Bantuan Hukum (LBH)</option>
                              <option value="Pusat Layanan Psikologi">Pusat Layanan Psikologi</option>
                            </optgroup>

                            <optgroup label="Prasarana Identitas & AIK">
                              <option value="Masjid Kampus">Masjid Kampus</option>
                              <option value="Gedung Pusat Studi AIK">Gedung Pusat Studi AIK</option>
                              <option value="Asrama Mahasiswa">Asrama Mahasiswa</option>
                              <option value="Kantor Organisasi Otonom (IMM, HW, Tapak Suci)">Kantor Organisasi Otonom (IMM, HW, Tapak Suci)</option>
                            </optgroup>

                            <optgroup label="Prasarana Kesejahteraan & Kemahasiswaan">
                              <option value="Gedung Pusat Kegiatan Mahasiswa (PKM)">Gedung Pusat Kegiatan Mahasiswa (PKM)</option>
                              <option value="Fasilitas Olahraga (Stadion/GOR/Lapangan)">Fasilitas Olahraga (Stadion/GOR/Lapangan)</option>
                              <option value="Area Kuliner (Kantin/Food Court)">Area Kuliner (Kantin/Food Court)</option>
                              <option value="Toko Buku & Koperasi Mahasiswa">Toko Buku & Koperasi Mahasiswa</option>
                              <option value="Guesthouse / Wisma Tamu">Guesthouse / Wisma Tamu</option>
                            </optgroup>

                            <optgroup label="Prasarana Tata Kelola & Administrasi">
                              <option value="Gedung Rektorat / Administrasi Pusat">Gedung Rektorat / Administrasi Pusat</option>
                              <option value="Gedung Dekanat">Gedung Dekanat</option>
                              <option value="Kantor Unit Kerja (Prodi/Lembaga/Biro)">Kantor Unit Kerja (Prodi/Lembaga/Biro)</option>
                              <option value="Ruang Arsip / Pusat Dokumentasi">Ruang Arsip / Pusat Dokumentasi</option>
                            </optgroup>

                            <optgroup label="Prasarana Umum, Utilitas & Infrastruktur">
                              <option value="Bangunan Utilitas (Gardu Listrik/Genset/IPAL)">Bangunan Utilitas (Gardu Listrik/Genset/IPAL)</option>
                              <option value="Gudang">Gudang</option>
                              <option value="Pos Keamanan">Pos Keamanan</option>
                              <option value="Gedung Parkir">Gedung Parkir</option>
                            </optgroup>

                            <optgroup label="Unit Usaha (AUM-Bisnis)">
                              <option value="Hotel dan Pusat Pelatihan">Hotel dan Pusat Pelatihan</option>
                              <option value="SPBU">SPBU</option>
                              <option value="Penerbitan dan Percetakan">Penerbitan dan Percetakan</option>
                              <option value="Unit Agribisnis Komersial">Unit Agribisnis Komersial</option>
                            </optgroup>

                            <optgroup label="Panduan">
                              <option value="Tidak Diketahui">Tidak Diketahui</option>
                              <option value="Lainnya">Lainnya...</option>
                            </optgroup>

                          </select>
                          <span class="form-text">Pilih jenis bangunan sesuai dengan fungsi utamanya.</span>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Keterangan -->
                        <div class="form-group">
                          <label for="keterangan" class="fw-bold">Keterangan</label>
                          <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                            placeholder="Masukkan keterangan tambahan jika ada"></textarea>
                          <span class="form-text">Tambahkan informasi atau catatan lain terkait bangunan ini.</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Added text-white to match Tanah/create.php -->
                <div class="card-footer text-right text-white">
                  <a href="/admin/prasarana/gedung" class="btn btn-secondary">
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Data Bangunan
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

  <script>
    $(document).ready(function() {
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