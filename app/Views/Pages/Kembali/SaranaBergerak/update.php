<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>
<!-- Apply px-3 to match pinjam update.php -->

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>
    <!-- Apply bg-white and adjust padding -->
    <div class="content-wrapper bg-white mb-5 pt-3 ">
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

            <?php if (isset($_SESSION['update'])) : ?>
              <div class="alert alert-success alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($_SESSION['update']); ?>
              </div>
              <?php unset($_SESSION['update']); ?>
            <?php endif; ?>

            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <h3 class="card-title text-bold">
                  FORMULIR PENGEMBALIAN BARANG
                </h3>
              </div>

              <form action="/admin/sarana/bergerak/kembali?edit=<?= htmlspecialchars($sarana['id']) ?>" method="POST" enctype="multipart/form-data">
                <!-- Hidden Fields -->
                <input type="hidden" name="id" value="<?= htmlspecialchars($sarana['id']) ?>">
                <input type="hidden" name="kategori_barang_id" value="2">
                <input type="hidden" name="barang_id" value="<?= htmlspecialchars($sarana['barang_id']) ?>">
                <input type="hidden" name="merk" value="<?= htmlspecialchars($sarana['merk']) ?>">
                <input type="hidden" name="no_polisi" value="<?= htmlspecialchars($sarana['no_polisi']) ?>">
                <input type="hidden" name="spesifikasi" value="<?= htmlspecialchars($sarana['spesifikasi']) ?>">
                <input type="hidden" name="kondisi_barang_id" value="<?= htmlspecialchars($sarana['kondisi_barang_id']) ?>">
                <input type="hidden" name="sumber" value="<?= htmlspecialchars($sarana['sumber']) ?>">
                <input type="hidden" name="biaya_pembelian" value="<?= htmlspecialchars($sarana['biaya_pembelian']) ?>">
                <input type="hidden" name="tanggal_pembelian" value="<?= htmlspecialchars($sarana['tanggal_pembelian']) ?>">
                <input type="hidden" name="keterangan" value="<?= htmlspecialchars($sarana['keterangan']) ?>">

                <div class="card-body">
                  <div class="row">
                    <div class="col-12"> <!-- Wrapper for all sections -->

                      <!-- IDENTITAS BARANG -->
                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS BARANG
                          </h5>
                          <span class="form-text">Silahkan pastikan data barang sesuai dengan apa yang akan dikembalikan.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="no_registrasi" class="fw-bold">Nomor Registrasi <span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" id="no_registrasi" name="no_registrasi"
                              value="<?= htmlspecialchars($sarana['no_registrasi']) ?>" required>
                            <span class="form-text">Nomor registrasi barang yang akan dikembalikan (otomatis).</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="nama_detail_barang" class="fw-bold">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" id="nama_detail_barang" name="nama_detail_barang"
                              value="<?= htmlspecialchars($sarana['nama_detail_barang']) ?>" required>
                            <span class="form-text">Nama detail barang yang akan dikembalikan (otomatis).</span>
                          </div>
                        </div>
                      </div>

                      <!-- IDENTITAS PENGEMBALI -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS PENGEMBALIAN
                          </h5>
                          <span class="form-text">Isi data identitas pengembali.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="nama_peminjam" class="fw-bold">Nama Pengembali <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam"
                              placeholder="Contoh: Muhammad Febrianoor" value="<?= htmlspecialchars($sarana['nama_peminjam']) ?>" required>
                            <span class="form-text">Cek nama pengembali barang, jika pengembali berbeda dengan peminjam, silahkan isi nama pengembali.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="identitas_peminjam" class="fw-bold">Nomor Identitas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="identitas_peminjam" name="identitas_peminjam"
                              value="<?= htmlspecialchars($sarana['identitas_peminjam']) ?>" placeholder="Contoh: 211222047" required>
                            <span class="form-text">Masukan nomor identitas pengembali berupa nik/nidn/nim.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="no_hp_peminjam" class="fw-bold">Nomor HP Pengembali <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">+628</span>
                              </div>
                              <input type="text" class="form-control" id="no_hp_peminjam_suffix" name="no_hp_peminjam_suffix" value="<?= isset($sarana['no_hp_peminjam']) ? htmlspecialchars(ltrim(preg_replace('/^\+628/', '', $sarana['no_hp_peminjam']), '0')) : '' ?>" placeholder="Contoh: 123456789" pattern="[1-9][0-9]{8,11}" title="Masukkan 9-12 digit nomor HP setelah +628, contoh: 123456789" required>
                            </div>
                            <span class="form-text">Masukkan sisa nomor HP Anda setelah +628 (misal: <code class="text-primary">123456789</code> untuk nomor +628123456789). Pastikan nomor aktif WA.</span>
                            <input type="hidden" id="no_hp_peminjam" name="no_hp_peminjam">
                          </div>
                        </div>
                      </div>

                      <!-- Tanggal Peminjaman dan Pengembalian -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            Tanggal Peminjaman dan Pengembalian
                          </h5>
                          <span class="form-text">Sesuaikan data tanggal peminjaman dan rencana pengembalian.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="tanggal_peminjaman" class="fw-bold">Tanggal Pengembalian <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman"
                              value="<?= htmlspecialchars($sarana['tanggal_peminjaman'] ?? '') ?>" required>
                            <span class="form-text">Masukkan tanggal barang ini dipinjam.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="tanggal_pengembalian" class="fw-bold">Tanggal Rencana Pengembalian <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian"
                              value="<?= htmlspecialchars($sarana['tanggal_pengembalian'] ?? '') ?>" required>
                            <span class="form-text">Cek apakah sesuai dengan tanggal rencana barang ini akan dikembalikan.</span>
                          </div>
                        </div>
                      </div>

                      <!-- LOKASI PENGEMBALIAN DAN STATUS -->
                      <div class="col-12 mt-4"> <!-- Last section, no border-bottom -->
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            LOKASI PENGEMBALIAN
                          </h5>
                          <span class="form-text">Pilih lokasi dan status barang yang dikembalikan.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="lokasi" class="fw-bold">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                            <select class="form-control" id="lokasi" name="lokasi" required>
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
                            <span class="form-text">Pilih lokasi dari daftar atau ketik untuk mencari.</span>
                          </div>
                        </div>

                        <!-- Status diatur sebagai hidden input dengan nilai "Tersedia" -->
                        <input type="hidden" name="status" value="Tersedia">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right text-white">
                  <a href="/admin/sarana/bergerak/kembali" class="btn btn-secondary">
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    Submit Data Pengembalian
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

  <!-- Initialize Select2 and handle phone number -->
  <script>
    $(document).ready(function() {
      $('#lokasi').select2({
        placeholder: "Pilih atau ketik lokasi barang",
        allowClear: true,
        minimumResultsForSearch: 1,
        theme: 'bootstrap4',
      });
      // Gabungkan prefix +628 dan suffix sebelum submit
      $('form').on('submit', function() {
        var suffix = $('#no_hp_peminjam_suffix').val();
        if (suffix) {
          $('#no_hp_peminjam').val('+628' + suffix);
        }
      });
    });
  </script>

</body>

</html>