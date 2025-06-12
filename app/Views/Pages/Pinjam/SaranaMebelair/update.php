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
              <div class="card-header bg-navy mb-3">
                <h1 class="text-xl font-weight-bold">
                  FORMULIR PEMINJAMAN BARANG
                </h1>
              </div>

              <form action="/admin/sarana/mebelair/pinjam?edit=<?= htmlspecialchars($sarana['id']) ?>" method="POST" enctype="multipart/form-data">
                <!-- Hidden Fields -->
                <input type="hidden" name="id" value="<?= htmlspecialchars($sarana['id']) ?>">
                <input type="hidden" name="kategori_barang_id" value="2">
                <input type="hidden" name="barang_id" value="<?= htmlspecialchars($sarana['barang_id']) ?>">
                <input type="hidden" name="merk" value="<?= htmlspecialchars($sarana['merk']) ?>">
                <input type="hidden" name="spesifikasi" value="<?= htmlspecialchars($sarana['spesifikasi']) ?>">
                <input type="hidden" name="kondisi_barang_id" value="<?= htmlspecialchars($sarana['kondisi_barang_id']) ?>">
                <input type="hidden" name="sumber" value="<?= htmlspecialchars($sarana['sumber']) ?>">
                <input type="hidden" name="biaya_pembelian" value="<?= htmlspecialchars($sarana['biaya_pembelian']) ?>">
                <input type="hidden" name="tanggal_pembelian" value="<?= htmlspecialchars($sarana['tanggal_pembelian']) ?>">
                <input type="hidden" name="keterangan" value="<?= htmlspecialchars($sarana['keterangan']) ?>">

                <div class="card-body">
                  <div class="row">
                    <div class="col-12 border-bottom">

                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS BARANG
                        </h5>
                        <span class="form-text">Silahkan pastikan data barang sesuai dengan apa yang akan dipinjam.</span>
                      </div>

                      <div class=" py-4 px-4 mb-4 border rounded-md">
                        <div class="">
                          <label for="no_registrasi" class="fw-normal ">Nomor Registrasi <span class="text-danger">*</span></label>
                          <input type="text" readonly class="form-control" id="no_registrasi" name="no_registrasi"
                            value="<?= htmlspecialchars($sarana['no_registrasi']) ?>"
                            required>
                        </div>
                      </div>

                      <div class=" py-4 px-4 mb-4 border rounded-md">
                        <div class="">
                          <label for="nama_detail_barang" class="fw-normal ">Nama Barang <span class="text-danger">*</span></label>
                          <input type="text" readonly class="form-control" id="nama_detail_barang" name="nama_detail_barang"
                            value="<?= htmlspecialchars($sarana['nama_detail_barang']) ?>"
                            required>
                        </div>
                      </div>

                    </div>
                    <div class="col-12 mt-4 border-bottom">
                      <!-- Data Identitas Sarana -->
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS PEMINJAM
                        </h5>
                        <span class="form-text">Isi data identitas peminjam.</span>
                      </div>

                      <div class=" py-4 px-4 mb-4 border rounded-md">
                        <div class="">
                          <label for="nama_peminjam" class="fw-normal ">Nama Peminjam <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam"
                            placeholder="Contoh: Muhammad Febrianoor" required>
                          <span class="form-text">
                            Masukan nama lengkap peminjam.
                          </span>

                        </div>
                      </div>
                      <div class=" py-4 px-4 mb-4 border rounded-md">
                        <div class="">
                          <label for="identitas_peminjam" class="fw-normal ">Nomor Identitas <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="identitas_peminjam" name="identitas_peminjam"
                            placeholder="Contoh: 211222047" required>
                          <span class="form-text">
                            Masukan nomor identitas peminjam berupa nik/nidn/nim.
                          </span>

                        </div>
                      </div>
                      <div class=" py-4 px-4 mb-4 border rounded-md">
                        <div class="">
                          <label for="no_hp_peminjam" class="fw-normal ">Nomor HP Peminjam <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="no_hp_peminjam" name="no_hp_peminjam"
                            placeholder="Contoh: 081234567890" required>
                          <span class="form-text">
                            Masukan nomor hp peminjam dan harus aktif wa.
                          </span>

                        </div>
                      </div>

                      <!-- Data Tambahan -->

                    </div>
                    <div class="col-12 mt-4 border-bottom">
                      <!-- Data Identitas Sarana -->
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          Tanggal Peminjaman dan Pengembalian </h5>
                        <span class="form-text">Isi data tanggal peminjaman dan rencana pengembalian.</span>
                      </div>

                      <div class=" py-4 px-4 mb-4 border rounded-md">
                        <div class="">
                          <label for="tanggal_peminjaman" class="fw-normal ">Tanggal Peminjaman <span class="text-danger">*</span></label>
                          <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman"
                            value="<?= htmlspecialchars($sarana['tanggal_peminjaman'] ?? date('Y-m-d')) ?>" required>
                          <span class="form-text">
                            Masukkan tanggal barang ini dipinjam.
                          </span>

                        </div>
                      </div>
                      <div class=" py-4 px-4 mb-4 border rounded-md">
                        <div class="">
                          <label for="tanggal_pengembalian" class="fw-normal ">Tanggal Rencana Pengembalian <span class="text-danger">*</span></label>
                          <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian"
                            value="<?= htmlspecialchars($sarana['tanggal_pengembalian'] ?? '') ?>" required>
                          <span class="form-text">
                            Masukkan tanggal rencana barang ini akan dikembalikan.
                          </span>

                        </div>
                      </div>

                      <!-- Data Tambahan -->

                    </div>
                    <div class="col-12 mt-4 border-bottom">
                      <!-- Data Identitas Sarana -->
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          LOKASI PEMINJAMAN
                        </h5>

                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <label for="lokasi" class="fw-normal">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                        <select class="form-select" id="lokasi" name="lokasi" required>
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
                        <span class="form-text">
                          Pilih lokasi dari daftar atau ketik untuk mencari.
                        </span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div>
                          <label for="status" class="fw-normal">Status <span class="text-danger">*</span></label>
                          <select class="form-select" name="status" aria-label="Default select example" required>
                            <option value="" disabled <?= !isset($sarana['status']) ? 'selected' : '' ?>>Pilih Status</option>
                            <option value="Terpakai" <?= (isset($sarana['status']) && $sarana['status'] == 'Terpakai') ? 'selected' : '' ?>>Terpakai</option>
                            <option value="Dipinjam" <?= (isset($sarana['status']) && $sarana['status'] == 'Dipinjam') ? 'selected' : '' ?>>Dipinjam</option>
                            <option value="Tersedia" <?= (isset($sarana['status']) && $sarana['status'] == 'Tersedia') ? 'selected' : '' ?>>Tersedia</option>
                          </select>
                          <span class="form-text">
                            Pilih ke status dipinjamkan jika barang tersebut dipinjam.
                          </span>
                        </div>
                      </div>








                      <!-- Data Tambahan -->

                    </div>
                  </div>

                  <div class="card-footer text-right">
                    <a href="/admin/sarana/mebelair/pinjam/tambah" class="btn btn-secondary">
                      <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                      <i class="fas fa-save mr-2"></i>
                      Update Data Sarana Mebelair
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
      $('#lokasi').select2({
        placeholder: "Pilih atau ketik lokasi barang",
        allowClear: true,
        minimumResultsForSearch: 1,
        theme: 'bootstrap4',
      });
    });
  </script>


</body>

</html>