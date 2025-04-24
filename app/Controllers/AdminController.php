<?php
require_once __DIR__ . '/../Models/Tanah.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/Gedung.php';
require_once __DIR__ . '/../Models/Ruangan.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/BarangBergerak.php';
require_once __DIR__ . '/../Models/BarangMebeler.php';
require_once __DIR__ . '/../Models/Atk.php';
require_once __DIR__ . '/../Models/BarangElektronik.php';
require_once __DIR__ . '/../Models/PenempatanBarang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';

class AdminController
{
    private function renderView(string $view, $data = [])
    {
        // Ekstrak data agar bisa dipakai langsung sebagai variabel di view
        extract($data);
        require_once __DIR__ . "/../Views/{$view}.php";
    }

    public function index()
    {
        $this->renderView('admin');
    }

    public function barang()
    {
        global $conn;

        // Ambil data barang dan ruangan
        $barangData = Barang::getAllData($conn);
        $ruanganList = Ruangan::getAllData($conn); // Asumsi Lokasi adalah tabel yang menyimpan ruangan

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id = $_POST['id'] ?? null;
            $nama_barang = $_POST['nama_barang'];
            $kategori_id = $_POST['kategori_id'];
            $subkategori_id = $_POST['subkategori_id'] ?? null;
            $ruangan_id = $_POST['ruangan_id'] ?? null;
            $lapang_id = $_POST['lapang_id'] ?? null;
            $kode_barang = $_POST['kode_barang'];
            $tahun_perolehan = $_POST['tahun_perolehan'] ?? null;
            $kondisi_id = $_POST['kondisi_id'];
            $jumlah = $_POST['jumlah'];

            try {
                if ($id) {
                    // Update data
                    $success = Barang::updateData(
                        $conn,
                        $id,
                        $nama_barang,
                        $kategori_id,
                        $subkategori_id,
                        $ruangan_id,
                        $lapang_id,
                        $kode_barang,
                        $tahun_perolehan,
                        $kondisi_id,
                        $jumlah
                    );
                } else {
                    // Simpan data baru
                    $success = Barang::storeData(
                        $conn,
                        $nama_barang,
                        $kategori_id,
                        $subkategori_id,
                        $ruangan_id,
                        $lapang_id,
                        $kode_barang,
                        $tahun_perolehan,
                        $kondisi_id,
                        $jumlah
                    );
                }

                if ($success) {
                    // Redirect ke halaman barang
                    header('Location: /admin/sarana/barang');
                    exit();
                } else {
                    // Tampilkan error jika gagal
                    $this->renderView('barang', [
                        'barangData' => $barangData,
                        'ruanganList' => $ruanganList,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                // Tampilkan error database
                $this->renderView('barang', [
                    'barangData' => $barangData,
                    'ruanganList' => $ruanganList,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }

        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            // Hapus data
            $id = $_GET['delete'];
            Barang::deleteData($conn, $id);
            header('Location: /admin/sarana/barang');
            exit();
        }

        // Render default view
        $this->renderView('barang', [
            'barangData' => $barangData,
            'ruanganList' => $ruanganList
        ]);
    }

    public function exportTanah()
    {
        global $conn;
        // Ambil semua data tanah
        $tanahData = Tanah::getAllData($conn);
        $this->renderView('export/exportTanah', [
            'tanahData' => $tanahData,
        ]);
    }

    public function tanah()
    {
        global $conn;

        // Hapus data
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id = $_GET['delete'];
            Tanah::deleteData($conn, $id);
            header('Location: /admin/prasarana/tanah');
            exit();
        }

        // Edit data → ambil data untuk isi form
        $editData = null;
        if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
            $id = $_GET['edit'];
            $editData = Tanah::getById($conn, $id);
        }

        // Store atau Update data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null;
            $nama_lokasi = $_POST['nama_lokasi'];
            $alamat = $_POST['alamat'];
            $luas = $_POST['luas'];
            $status_kepemilikan = $_POST['status_kepemilikan'];
            $no_sertifikat = $_POST['no_sertifikat'];
            $tanggal_perolehan = $_POST['tanggal_perolehan'];
            $penggunaan = $_POST['penggunaan'];
            $keterangan = $_POST['keterangan'];

            try {
                if ($id) {
                    // UPDATE
                    $success = Tanah::updateData($conn, $id, $nama_lokasi, $alamat, $luas, $status_kepemilikan, $no_sertifikat, $tanggal_perolehan, $penggunaan, $keterangan);
                } else {
                    // STORE
                    $success = Tanah::storeData($conn, $nama_lokasi, $alamat, $luas, $status_kepemilikan, $no_sertifikat, $tanggal_perolehan, $penggunaan, $keterangan);
                }

                if ($success) {
                    header('Location: /admin/prasarana/tanah');
                    exit();
                } else {
                    $this->renderView('tanah', ['error' => 'Gagal menyimpan atau mengupdate data.']);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('tanah', ['error' => 'Error DB: ' . $e->getMessage()]);
                return;
            }
        }

        // Ambil semua data tanah
        $tanahData = Tanah::getAllData($conn);
        $this->renderView('tanah', [
            'tanahData' => $tanahData,
            'editData' => $editData
        ]);
    }

    public function gedung()
    {
        global $conn;

        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id = $_GET['delete'];
            Gedung::deleteData($conn, $id);
            header('Location: /admin/prasarana/gedung');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_gedung'] ?? null;

            // Ambil data dari form
            $kode_gedung        = $_POST['kode_gedung'];
            $nama_gedung        = $_POST['nama_gedung'];
            $lokasi             = $_POST['lokasi'];
            $alamat             = $_POST['alamat'];
            $luas_tanah         = $_POST['luas_tanah'];
            $luas_bangunan      = $_POST['luas_bangunan'];
            $jumlah_lantai      = $_POST['jumlah_lantai'];
            $tahun_dibangun     = $_POST['tahun_dibangun'];
            $tahun_perolehan    = $_POST['tahun_perolehan'];
            $nilai_perolehan    = $_POST['nilai_perolehan'];
            $status_kepemilikan = $_POST['status_kepemilikan'];
            $status_penggunaan  = $_POST['status_penggunaan'];
            $kondisi            = $_POST['kondisi'];
            $pengguna           = $_POST['pengguna'];
            $dokumen_legalitas  = $_POST['dokumen_legalitas'];
            $keterangan         = $_POST['keterangan'];

            try {
                if ($id) {
                    $success = Gedung::updateData(
                        $conn,
                        $id,
                        $kode_gedung,
                        $nama_gedung,
                        $lokasi,
                        $alamat,
                        $luas_tanah,
                        $luas_bangunan,
                        $jumlah_lantai,
                        $tahun_dibangun,
                        $tahun_perolehan,
                        $nilai_perolehan,
                        $status_kepemilikan,
                        $status_penggunaan,
                        $kondisi,
                        $pengguna,
                        $dokumen_legalitas,
                        $keterangan
                    );
                } else {
                    $success = Gedung::storeData(
                        $conn,
                        $kode_gedung,
                        $nama_gedung,
                        $lokasi,
                        $alamat,
                        $luas_tanah,
                        $luas_bangunan,
                        $jumlah_lantai,
                        $tahun_dibangun,
                        $tahun_perolehan,
                        $nilai_perolehan,
                        $status_kepemilikan,
                        $status_penggunaan,
                        $kondisi,
                        $pengguna,
                        $dokumen_legalitas,
                        $keterangan
                    );
                }

                if ($success) {
                    header('Location: /admin/prasarana/gedung');
                    exit(); // Penting!
                } else {
                    $this->renderView('gedung', ['error' => 'Gagal menyimpan atau mengupdate data.']);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('gedung', ['error' => 'Error DB: ' . $e->getMessage()]);
                return;
            }
        }

        // Proses GET atau setelah redirect
        $gedungData = Gedung::getAllData($conn);
        $this->renderView('gedung', [
            'gedungData' => $gedungData,
            // 'editData' => $editData
        ]);
    }


    public function ruangan()
    {
        global $conn;

        $ruanganData = Ruangan::getAllData($conn);
        $gedungList = Gedung::getAll($conn); // ✅ ambil data gedung

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // ambil data dari form
            $id = $_POST['id'] ?? null;
            $kode_ruangan = $_POST['kode_ruangan'];
            $nama_ruangan = $_POST['nama_ruangan'];
            $lokasi = $_POST['lokasi'];
            $id_gedung = $_POST['id_gedung'];
            $kapasitas = $_POST['kapasitas'];
            $jenis_ruangan = $_POST['jenis_ruangan'];
            $luas = $_POST['luas'];
            $status_penggunaan = $_POST['status_penggunaan'];
            $keterangan = $_POST['keterangan'];

            try {
                if ($id) {
                    $success = Ruangan::updateData($conn, $id, $kode_ruangan, $nama_ruangan, $lokasi, $id_gedung, $kapasitas, $jenis_ruangan, $luas, $status_penggunaan, $keterangan);
                } else {
                    $success = Ruangan::storeData($conn, $kode_ruangan, $nama_ruangan, $lokasi, $id_gedung, $kapasitas, $jenis_ruangan, $luas, $status_penggunaan, $keterangan);
                }

                if ($success) {
                    header('Location: /admin/prasarana/ruangan');
                    exit();
                } else {
                    $this->renderView('ruangan', [
                        'ruanganData' => $ruanganData,
                        'gedungList' => $gedungList,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('ruangan', [
                    'ruanganData' => $ruanganData,
                    'gedungList' => $gedungList,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }

        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id = $_GET['delete'];
            Ruangan::deleteData($conn, $id);
            header('Location: /admin/prasarana/ruangan');
            exit();
        }

        // render default view
        $this->renderView('ruangan', [
            'ruanganData' => $ruanganData,
            'gedungList' => $gedungList
        ]);
    }

    public function lapang()
    {
        global $conn;

        // Ambil semua data lapang
        $lapangData = Lapang::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id_lapangan = $_POST['id_lapangan'] ?? null;
            $kode_lapangan = $_POST['kode_lapangan'];
            $nama_lapangan = $_POST['nama_lapangan'];
            $lokasi = $_POST['lokasi'];
            $jenis_lapangan = $_POST['jenis_lapangan'];
            $luas = $_POST['luas'];
            $tahun_dibangun = $_POST['tahun_dibangun'] ?? null;
            $kondisi = $_POST['kondisi'];
            $status_kepemilikan = $_POST['status_kepemilikan'];
            $dokumen_legalitas = $_POST['dokumen_legalitas'] ?? null;
            $pengguna = $_POST['pengguna'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                if ($id_lapangan) {
                    // Update data yang sudah ada
                    $success = Lapang::updateData(
                        $conn,
                        $id_lapangan,
                        $kode_lapangan,
                        $nama_lapangan,
                        $lokasi,
                        $jenis_lapangan,
                        $luas,
                        $tahun_dibangun,
                        $kondisi,
                        $status_kepemilikan,
                        $dokumen_legalitas,
                        $pengguna,
                        $keterangan
                    );
                } else {
                    // Simpan data baru
                    $success = Lapang::storeData(
                        $conn,
                        $kode_lapangan,
                        $nama_lapangan,
                        $lokasi,
                        $jenis_lapangan,
                        $luas,
                        $tahun_dibangun,
                        $kondisi,
                        $status_kepemilikan,
                        $dokumen_legalitas,
                        $pengguna,
                        $keterangan
                    );
                }

                if ($success) {
                    header('Location: /admin/prasarana/lapang');
                    exit();
                } else {
                    $this->renderView('lapang', [
                        'lapangData' => $lapangData,
                        'error' => 'Gagal menyimpan atau mengupdate data lapang.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('lapang', [
                    'lapangData' => $lapangData,
                    'error' => 'Error database: ' . $e->getMessage()
                ]);
                return;
            }
        }

        // Handle delete request
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id_lapangan = $_GET['delete'];
            Lapang::deleteData($conn, $id_lapangan);
            header('Location: /admin/prasarana/lapang');
            exit();
        }

        // Render default view
        $this->renderView('lapang', [
            'lapangData' => $lapangData,
            'jenisLapanganOptions' => ['Olahraga', 'Upacara', 'Taman', 'Parkir', 'Lainnya'],
            'kondisiOptions' => ['Baik', 'Rusak Ringan', 'Rusak Berat'],
            'statusKepemilikanOptions' => ['Milik Kampus', 'Sewa', 'Pinjam Pakai']
        ]);
    }
    public function bergerak()
    {
        global $conn;

        // Ambil semua data barang bergerak
        $barangData = BarangBergerak::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id_bb = $_POST['id_bb'] ?? null;
            $kode_bb = $_POST['kode_bb'];
            $nama_bb = $_POST['nama_bb'];
            $merk_tipe = $_POST['merk_tipe'];
            $tipe_kendaraan = $_POST['tipe_kendaraan'];
            $plat_nomor = $_POST['plat_nomor'];
            $tahun_perolehan = $_POST['tahun_perolehan'] ?? null;
            $kondisi = $_POST['kondisi'];
            $jumlah = $_POST['jumlah'];
            $satuan = $_POST['satuan'];
            $lokasi = $_POST['lokasi'];
            $sumber_perolehan = $_POST['sumber_perolehan'];
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                if ($id_bb) {
                    // Update data yang sudah ada
                    $success = BarangBergerak::updateData(
                        $conn,
                        $id_bb,
                        $kode_bb,
                        $nama_bb,
                        $merk_tipe,
                        $tipe_kendaraan,
                        $plat_nomor,
                        $tahun_perolehan,
                        $kondisi,
                        $jumlah,
                        $satuan,
                        $lokasi,
                        $sumber_perolehan,
                        $keterangan
                    );
                } else {
                    // Simpan data baru
                    $success = BarangBergerak::storeData(
                        $conn,
                        $kode_bb,
                        $nama_bb,
                        $merk_tipe,
                        $tipe_kendaraan,
                        $plat_nomor,
                        $tahun_perolehan,
                        $kondisi,
                        $jumlah,
                        $satuan,
                        $lokasi,
                        $sumber_perolehan,
                        $keterangan
                    );
                }

                if ($success) {
                    header('Location: /admin/sarana/bergerak');
                    exit();
                } else {
                    $this->renderView('bergerak', [
                        'barangData' => $barangData,
                        'error' => 'Gagal menyimpan atau mengupdate data barang.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('bergerak', [
                    'barangData' => $barangData,
                    'error' => 'Error database: ' . $e->getMessage()
                ]);
                return;
            }
        }

        // Handle delete request
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id_bb = $_GET['delete'];
            BarangBergerak::deleteData($conn, $id_bb);
            header('Location: /admin/sarana/bergerak');
            exit();
        }

        // Render default view
        $this->renderView('bergerak', [
            'barangData' => $barangData,
            'kondisiOptions' => ['Baik', 'Rusak Ringan', 'Rusak Berat'],
            'sumberPerolehanOptions' => ['Pembelian', 'Hibah', 'Lainnya'],
            'tipeKendaraanOptions' => ['Mobil', 'Motor']
        ]);
    }
    public function mebeler()
    {
        global $conn;

        // Ambil data barang mebeler dan ruangan
        $barangMebelerData = BarangMebeler::getAllData($conn);
        $ruanganList = Ruangan::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id = $_POST['id'] ?? null;
            $nama_mebeler = $_POST['nama_mebeler'];
            $kode_mebeler = $_POST['kode_mebeler'];
            $jenis_mebel = $_POST['jenis_mebel'];
            $jumlah = $_POST['jumlah'];
            $kondisi = $_POST['kondisi'];
            $id_ruangan = $_POST['id_ruangan'];
            $tahun_pengadaan = $_POST['tahun_pengadaan'] ?? null;
            $keterangan = $_POST['keterangan'];

            try {
                if ($id) {
                    // Update data
                    $success = BarangMebeler::updateData($conn, $id, $nama_mebeler, $kode_mebeler, $jenis_mebel, $jumlah, $kondisi, $id_ruangan, $tahun_pengadaan, $keterangan);
                } else {
                    // Simpan data baru
                    $success = BarangMebeler::storeData($conn, $nama_mebeler, $kode_mebeler, $jenis_mebel, $jumlah, $kondisi, $id_ruangan, $tahun_pengadaan, $keterangan);
                }

                if ($success) {
                    // Redirect ke halaman mebeler
                    header('Location: /admin/sarana/mebeler');
                    exit();
                } else {
                    // Tampilkan error jika gagal
                    $this->renderView('mebeler', [
                        'barangMebelerData' => $barangMebelerData,
                        'ruanganList' => $ruanganList,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                // Tampilkan error database
                $this->renderView('mebeler', [
                    'barangMebelerData' => $barangMebelerData,
                    'ruanganList' => $ruanganList,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }

        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            // Hapus data
            $id = $_GET['delete'];
            BarangMebeler::deleteData($conn, $id);
            header('Location: /admin/sarana/mebeler');
            exit();
        }

        // Render default view
        $this->renderView('mebeler', [
            'barangMebelerData' => $barangMebelerData,
            'ruanganList' => $ruanganList
        ]);
    }
    public function atk()
    {
        global $conn;

        // Ambil semua data ATK
        $atkData = Atk::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id_atk = $_POST['id_atk'] ?? null;
            $kode_atk = $_POST['kode_atk'];
            $nama_atk = $_POST['nama_atk'];
            $merk = $_POST['merk'];
            $jumlah = $_POST['jumlah'];
            $satuan = $_POST['satuan'];
            $kondisi = $_POST['kondisi'];
            $lokasi = $_POST['lokasi'];
            $tanggal_masuk = $_POST['tanggal_masuk'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                if ($id_atk) {
                    // Update data yang sudah ada
                    $success = Atk::updateData(
                        $conn,
                        $id_atk,
                        $kode_atk,
                        $nama_atk,
                        $merk,
                        $jumlah,
                        $satuan,
                        $kondisi,
                        $lokasi,
                        $tanggal_masuk,
                        $keterangan
                    );
                } else {
                    // Simpan data baru
                    $success = Atk::storeData(
                        $conn,
                        $kode_atk,
                        $nama_atk,
                        $merk,
                        $jumlah,
                        $satuan,
                        $kondisi,
                        $lokasi,
                        $tanggal_masuk,
                        $keterangan
                    );
                }

                if ($success) {
                    header('Location: /admin/sarana/alat-tulis-kantor');
                    exit();
                } else {
                    $this->renderView('atk', [
                        'atkData' => $atkData,
                        'error' => 'Gagal menyimpan atau mengupdate data ATK.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('atk', [
                    'atkData' => $atkData,
                    'error' => 'Error database: ' . $e->getMessage()
                ]);
                return;
            }
        }

        // Handle delete request
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id_atk = $_GET['delete'];
            Atk::deleteData($conn, $id_atk);
            header('Location: /admin/sarana/alat-tulis-kantor');
            exit();
        }

        // Render default view
        $this->renderView('atk', [
            'atkData' => $atkData,
            'kondisiOptions' => ['Baik', 'Rusak Ringan', 'Rusak Berat']
        ]);
    }
    public function elektronik()
    {
        global $conn;

        // Ambil data barang elektronik dan ruangan
        $barangElektronikData = BarangElektronik::getAllData($conn);
        $ruanganList = Ruangan::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id_be = $_POST['id_be'] ?? null;
            $kode_be = $_POST['kode_be'];
            $nama_be = $_POST['nama_be'];
            $kategori_be = $_POST['kategori_be'];
            $status = $_POST['status'];
            $merk = $_POST['merk'];
            $tipe_model = $_POST['tipe_model'];
            $tahun_perolehan = $_POST['tahun_perolehan'] ?? null;
            $kondisi = $_POST['kondisi'];
            $id_ruangan = $_POST['id_ruangan'];
            $jumlah = $_POST['jumlah'];
            $satuan = $_POST['satuan'];

            try {
                if ($id_be) {
                    // Update data
                    $success = BarangElektronik::updateData(
                        $conn,
                        $id_be,
                        $kode_be,
                        $nama_be,
                        $kategori_be,
                        $status,
                        $merk,
                        $tipe_model,
                        $tahun_perolehan,
                        $kondisi,
                        $id_ruangan,
                        $jumlah,
                        $satuan
                    );
                } else {
                    // Simpan data baru
                    $success = BarangElektronik::storeData(
                        $conn,
                        $kode_be,
                        $nama_be,
                        $kategori_be,
                        $status,
                        $merk,
                        $tipe_model,
                        $tahun_perolehan,
                        $kondisi,
                        $id_ruangan,
                        $jumlah,
                        $satuan
                    );
                }

                if ($success) {
                    // Redirect ke halaman barang elektronik
                    header('Location: /admin/sarana/elektronik');
                    exit();
                } else {
                    // Tampilkan error jika gagal
                    $this->renderView('elektronik', [
                        'barangElektronikData' => $barangElektronikData,
                        'ruanganList' => $ruanganList,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                // Tampilkan error database
                $this->renderView('elektronik', [
                    'barangElektronikData' => $barangElektronikData,
                    'ruanganList' => $ruanganList,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }

        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            // Hapus data
            $id_be = $_GET['delete'];
            BarangElektronik::deleteData($conn, $id_be);
            header('Location: /admin/sarana/elektronik');
            exit();
        }

        // Render default view
        $this->renderView('elektronik', [
            'barangElektronikData' => $barangElektronikData,
            'ruanganList' => $ruanganList
        ]);
    }
    public function listPenempatan()
    {
        global $conn;

        // Ambil data penempatan, ruangan, dan kondisi
        $penempatanData = PenempatanBarang::getAllData($conn);
        $ruanganList = Ruangan::getAllData($conn);
        $kondisiList = KondisiBarang::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id = $_POST['id_penempatan'] ?? null;
            $id_barang = $_POST['id_barang'];
            $jenis_barang = $_POST['jenis_barang'];
            $id_ruangan = $_POST['id_ruangan'];
            $tanggal_penempatan = $_POST['tanggal_penempatan'];
            $id_kondisi_barang = $_POST['id_kondisi_barang'];
            $keterangan = $_POST['keterangan'];

            try {
                if ($id) {
                    // Update data
                    $success = PenempatanBarang::updateData(
                        $conn,
                        $id,
                        $id_barang,
                        $jenis_barang,
                        $id_ruangan,
                        $tanggal_penempatan,
                        $id_kondisi_barang,
                        $keterangan
                    );
                } else {
                    // Simpan data baru
                    $success = PenempatanBarang::storeData(
                        $conn,
                        $id_barang,
                        $jenis_barang,
                        $id_ruangan,
                        $tanggal_penempatan,
                        $id_kondisi_barang,
                        $keterangan
                    );
                }

                if ($success === true) {
                    header('Location: /admin/penempatan/list');
                    exit();
                } else {
                    $this->renderView('penempatan', [
                        'penempatanData' => $penempatanData,
                        'ruanganList' => $ruanganList,
                        'kondisiList' => $kondisiList,
                        'error' => $success // Menampilkan pesan error dari model
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('penempatan', [
                    'penempatanData' => $penempatanData,
                    'ruanganList' => $ruanganList,
                    'kondisiList' => $kondisiList,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }

        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            // Hapus data
            $id = $_GET['delete'];
            $success = PenempatanBarang::deleteData($conn, $id);
            if ($success) {
                header('Location: /admin/penempatan/list');
                exit();
            } else {
                $this->renderView('penempatan', [
                    'penempatanData' => $penempatanData,
                    'ruanganList' => $ruanganList,
                    'kondisiList' => $kondisiList,
                    'error' => 'Gagal menghapus data.'
                ]);
                return;
            }
        }

        // Render view default
        $this->renderView('penempatan', [
            'penempatanData' => $penempatanData,
            'ruanganList' => $ruanganList,
            'kondisiList' => $kondisiList
        ]);
    }
    public function formPenempatan()
    {
        $this->renderView('formPenempatan');
    }
    public function detailPenempatan()
    {
        $this->renderView('detailPenempatan');
    }
    public function daftarKondisi()
    {
        $this->renderView('daftarKondisi');
    }
}
