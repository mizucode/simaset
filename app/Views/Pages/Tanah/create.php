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
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?= htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card card-navy">

                            <div class="card-header text-white">
                                <h3 class="text-lg">
                                    Formulir Data Tanah
                                </h3>

                            </div>

                            <form action="/admin/prasarana/tanah/tambah" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Identitas Tanah -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    IDENTITAS TANAH
                                                </h5>
                                                <!-- Nomor Sertifikat -->
                                                <div class="form-group mb-4">
                                                    <label for="kode_aset" class="font-weight-bold">Kode Aset</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="kode_aset" name="kode_aset" placeholder="Contoh: T001" readonly required>
                                                    </div>

                                                </div>
                                                <!-- Nama aset -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_aset" class="font-weight-bold">Nama Aset</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_aset" name="nama_aset" placeholder="Contoh: Tanah Kampus Satu" required>
                                                    </div>
                                                    <div class="text-slate-500 flex align-center text-sm pt-2">
                                                        <div>
                                                            Masukan nama aset
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Luas Tanah -->
                                                <div class="form-group mb-4">
                                                    <label for="luas" class="font-weight-bold">Luas Tanah (m²)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="number" class="form-control" id="luas" name="luas" placeholder="Masukkan luas tanah dalam meter persegi" required>
                                                    </div>
                                                </div>
                                                <!-- Alamat Tanah -->
                                                <div class="form-group mb-4">
                                                    <label for="lokasi" class="font-weight-bold">Lokasi Tanah</label>
                                                    <textarea class="form-control" id="lokasi" name="lokasi" rows="2" placeholder="Contoh: Jalan raya cigugur no. 14" required></textarea>
                                                </div>
                                                <!-- Jenis Hak -->

                                            </div>

                                            <!-- Data Status Tanah -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    STATUS TANAH
                                                </h5>
                                                <!-- Nomor sertifikat -->
                                                <div class="form-group mb-4">
                                                    <label for="nomor_sertifikat" class="font-weight-bold">Nomor Sertifikat</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nomor_sertifikat" name="nomor_sertifikat" placeholder="Masukan nomor sertifikat" required>
                                                    </div>
                                                </div>
                                                <!-- File Sertifikat -->
                                                <div class="form-group mb-4">
                                                    <label for="file_sertifikat" class="font-weight-bold">Upload Sertifikat Tanah (Jika Ada)</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="file_sertifikat" name="file_sertifikat" accept=".pdf,image/*">
                                                        <label class="custom-file-label" for="file_sertifikat">Pilih File Sertifikat</label>
                                                    </div>
                                                    <div class="text-slate-500 flex align-center text-sm pt-2">
                                                        <div>
                                                            File yang diperbolehkan: PDF, JPG, PNG, atau JPEG.
                                                        </div>
                                                    </div>
                                                </div>



                                                <!-- Aset Tanah -->
                                                <div class="form-group mb-4">
                                                    <label for="jenis_aset_id" class="font-weight-bold">Jenis Aset Tanah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                                                            <option value="" disabled selected>Pilih jenis aset tanah</option>
                                                            <?php foreach ($jenisAsetId as $id): ?>
                                                                <option value="<?= htmlspecialchars($id['id']) ?>">
                                                                    <?= htmlspecialchars($id['jenis_aset']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="tgl_pajak" class="font-weight-bold">Tanaggal Pajak</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tgl_pajak" name="tgl_pajak" placeholder="Masukan Tanaggal Pajak" required>
                                                    </div>
                                                </div>



                                            </div>

                                            <!-- Data Batas Tanah -->
                                            <div class="col-12 ">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    FUNGSI DAN KETERANGAN
                                                </h5>
                                                <!-- Fungsi Tanah -->
                                                <div class="form-group mb-4">
                                                    <label for="fungsi" class="font-weight-bold">Fungsi tanah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="fungsi" name="fungsi" placeholder="Masukan fungsi tanah" required>
                                                    </div>
                                                </div>
                                                <!-- Keterangan -->
                                                <div class="form-group mb-4">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukan keterangan" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right text-white">
                                    <a href="/admin/prasarana/tanah" class="btn btn-secondary "><span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali</a>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan Data Tanah
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
        document.addEventListener('DOMContentLoaded', function() {
            const namaAsetInput = document.getElementById('nama_aset');
            const kodeAsetInput = document.getElementById('kode_aset');

            namaAsetInput.addEventListener('input', function() {
                let namaAset = namaAsetInput.value.trim();

                if (namaAset.length > 0) {
                    // Ambil huruf pertama dari setiap kata
                    let singkatan = namaAset
                        .split(' ')
                        .filter(kata => kata.length > 0)
                        .map(kata => kata.charAt(0).toUpperCase())
                        .join('');

                    // Gabungkan dengan awalan TNH-
                    let kodeAset = `TNH-${singkatan}`;
                    kodeAsetInput.value = kodeAset;
                } else {
                    // Kosongkan jika nama aset kosong
                    kodeAsetInput.value = '';
                }
            });
        });
    </script>

    <script>
        document.getElementById('file_sertifikat').addEventListener('change', function(e) {
            var fileName = e.target.files[0]?.name || 'Pilih File Sertifikat';
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>

</body>

</html>