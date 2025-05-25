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
                                    <?= isset($tanah) ? 'Edit Data Tanah' : 'Formulir Tambah Data Tanah' ?>
                                </h3>
                            </div>

                            <form action="<?= isset($tanah) ? '/admin/prasarana/tanah?edit=' . htmlspecialchars($tanah['id']) : '/admin/prasarana/tanah/tambah' ?>" method="POST" enctype="multipart/form-data">
                                <?php if (isset($tanah)) : ?>
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($tanah['id']) ?>">
                                <?php else : ?>
                                <?php endif; ?>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    IDENTITAS TANAH
                                                </h5>
                                                <div class="form-group mb-4">
                                                    <label for="kode_aset" class="font-weight-bold">Kode Aset Tanah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="kode_aset" name="kode_aset"
                                                            placeholder="Contoh: T001"
                                                            value="<?= isset($tanah) ? htmlspecialchars($tanah['kode_aset']) : '' ?>"

                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="nama_aset" class="font-weight-bold">Nama Aset Tanah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-landmark text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_aset" name="nama_aset"
                                                            placeholder="Contoh: Tanah Kampus Satu"
                                                            value="<?= isset($tanah) ? htmlspecialchars($tanah['nama_aset']) : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="luas" class="font-weight-bold">Luas Tanah (m²)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-ruler-combined text-primary"></i></span>
                                                        </div>
                                                        <input type="number" class="form-control" id="luas" name="luas"
                                                            placeholder="Masukkan luas tanah dalam meter persegi"
                                                            value="<?= isset($tanah) ? htmlspecialchars($tanah['luas']) : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="lokasi" class="font-weight-bold">Lokasi Tanah</label>
                                                    <textarea class="form-control" id="lokasi" name="lokasi" rows="2"
                                                        placeholder="Contoh: Jalan raya cigugur no. 14"
                                                        required><?= isset($tanah) ? htmlspecialchars($tanah['lokasi']) : '' ?></textarea>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="nomor_sertifikat" class="font-weight-bold">Nomor Sertifikat</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-certificate text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nomor_sertifikat" name="nomor_sertifikat"
                                                            placeholder="Masukan nomor sertifikat"
                                                            value="<?= isset($tanah) ? htmlspecialchars($tanah['nomor_sertifikat']) : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="jenis_aset_id" class="font-weight-bold">Jenis Aset Tanah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-tags text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                                                            <option value="" disabled <?= !isset($tanah['jenis_aset_id']) ? 'selected' : '' ?>>Pilih jenis aset tanah</option>
                                                            <?php foreach ($jenisAsetId as $ja_id) : ?>
                                                                <option value="<?= htmlspecialchars($ja_id['id']) ?>" <?= (isset($tanah) && $tanah['jenis_aset_id'] == $ja_id['id']) ? 'selected' : '' ?>>
                                                                    <?= htmlspecialchars($ja_id['jenis_aset']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="tgl_pajak" class="font-weight-bold">Tanggal Pajak</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tgl_pajak" name="tgl_pajak"
                                                            value="<?= isset($tanah) ? htmlspecialchars($tanah['tgl_pajak']) : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 ">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    FUNGSI DAN KETERANGAN
                                                </h5>
                                                <div class="form-group mb-4">
                                                    <label for="fungsi" class="font-weight-bold">Fungsi tanah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-cogs text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="fungsi" name="fungsi"
                                                            placeholder="Masukan fungsi tanah"
                                                            value="<?= isset($tanah) ? htmlspecialchars($tanah['fungsi']) : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-info-circle text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                                                            placeholder="Masukan keterangan"
                                                            value="<?= isset($tanah) ? htmlspecialchars($tanah['keterangan']) : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right"> <a href="<?= isset($tanah) && isset($tanah['id']) ? ('/admin/prasarana/tanah?detail=' . htmlspecialchars($tanah['id'])) : '/admin/prasarana/tanah' ?>" class="btn btn-secondary">
                                        <i class="fas fa-arrow-alt-circle-left mr-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save mr-2"></i>
                                        <?= isset($tanah) ? 'Update Data Tanah' : 'Simpan Data Tanah' ?>
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



</body>

</html>