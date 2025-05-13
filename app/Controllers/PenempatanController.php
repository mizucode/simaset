<?php

require_once __DIR__ . '/../Models/PenempatanBarang.php';
require_once __DIR__ . '/../Models/BarangAtk.php';
require_once __DIR__ . '/../Models/BarangBergerak.php';
require_once __DIR__ . '/../Models/BarangElektronik.php';
require_once __DIR__ . '/../Models/BarangMebeler.php';
require_once __DIR__ . '/../Models/Gedung.php';
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/Lapang.php';

class PenempatanController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/PenempatanBarang/{$view}.php";
    }

    public function PenempatanBarang()
    {
        global $conn;
        $peminjaman = PenempatanBarang::getAllData($conn);
        $this->renderView('index', [
            'peminjaman' => $peminjaman,
        ]);
    }
    // public function daftarBarang()
    // {
    //     global $conn;
    //     $barangElektronik = BarangElektronik::getAllData($conn);
    //     $barangBergerak = BarangBergerak::getAllData($conn);

    //     $allBarang = array_merge($barangElektronik, $barangBergerak);

    //     $this->renderView('index', [
    //         'allBarang' => $allBarang
    //     ]);
    // }

    public function create()
    {
        global $conn;
        $barangAtk = BarangAtk::getAllData($conn);
        $barangBergerak = BarangBergerak::getAllData($conn);
        $barangElektronik = BarangElektronik::getAllData($conn);
        $barangMebeler = BarangMebeler::getAllData($conn);
        $penempatanBarang = PenempatanBarang::getAllData($conn);
        $gedung = Gedung::getAllData($conn);
        $lapang = Lapang::getAllData($conn);
        $ruang = Ruang::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Safely get POST data with null coalescing operator
            $nama_peminjam = $_POST['nama_peminjam'];
            $nik = $_POST['nik'];
            $jabatan = $_POST['jabatan'];
            $no_telepon = $_POST['no_telepon'];
            $nama_barang = $_POST['nama_barang'];
            $jumlah_barang = $_POST['jumlah_barang'];
            $kondisi = $_POST['kondisi'];
            $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
            $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
            $lokasi = $_POST['lokasi'];
            $status = $_POST['status'];
            $tujuan_peminjaman = $_POST['tujuan_peminjaman'];


            try {
                // Simpan data baru
                $success = PenempatanBarang::storeData(
                    $conn,
                    $nama_peminjam,
                    $nik,
                    $jabatan,
                    $no_telepon,
                    $nama_barang,
                    $jumlah_barang,
                    $kondisi,
                    $tanggal_peminjaman,
                    $tanggal_pengembalian,
                    $lokasi,
                    $status,
                    $tujuan_peminjaman
                );
                $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/penempatan/daftar-barang');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }

            // If not redirected, render view with current data
            $this->renderView('index', [
                'barangAtk' => $barangAtk,
                'barangBergerak' => $barangBergerak,
                'barangElektronik' => $barangElektronik,
                'barangMebeler' => $barangMebeler,
                'penempatanBarang' => $penempatanBarang,
                'gedung' => $gedung,
                'lapang' => $lapang,
                'ruang' => $ruang,
            ]);
            return;
        }



        // Render halaman create pertama kali (GET request)
        $this->renderView('create', [
            'barangAtk' => $barangAtk,
            'barangBergerak' => $barangBergerak,
            'barangElektronik' => $barangElektronik,
            'barangMebeler' => $barangMebeler,
            'penempatanBarang' => $penempatanBarang,
            'gedung' => $gedung,
            'lapang' => $lapang,
            'ruang' => $ruang,
        ]);
    }
    public function pengembalian()
    {
        global $conn;
        $barangAtk = BarangAtk::getAllData($conn);
        $barangBergerak = BarangBergerak::getAllData($conn);
        $barangElektronik = BarangElektronik::getAllData($conn);
        $barangMebeler = BarangMebeler::getAllData($conn);
        $penempatanBarang = PenempatanBarang::getAllData($conn);
        $gedung = Gedung::getAllData($conn);
        $lapang = Lapang::getAllData($conn);
        $ruang = Ruang::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Safely get POST data with null coalescing operator
            $nama_peminjam = $_POST['nama_peminjam'];
            $nik = $_POST['nik'];
            $jabatan = $_POST['jabatan'];
            $no_telepon = $_POST['no_telepon'];
            $nama_barang = $_POST['nama_barang'];
            $jumlah_barang = $_POST['jumlah_barang'];
            $kondisi = $_POST['kondisi'];
            $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
            $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
            $lokasi = $_POST['lokasi'];
            $status = $_POST['status'];
            $tujuan_peminjaman = $_POST['tujuan_peminjaman'];


            try {
                // Simpan data baru
                $success = PenempatanBarang::storeData(
                    $conn,
                    $nama_peminjam,
                    $nik,
                    $jabatan,
                    $no_telepon,
                    $nama_barang,
                    $jumlah_barang,
                    $kondisi,
                    $tanggal_peminjaman,
                    $tanggal_pengembalian,
                    $lokasi,
                    $status,
                    $tujuan_peminjaman
                );
                $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/penempatan/daftar-barang');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }

            // If not redirected, render view with current data
            $this->renderView('index', [
                'barangAtk' => $barangAtk,
                'barangBergerak' => $barangBergerak,
                'barangElektronik' => $barangElektronik,
                'barangMebeler' => $barangMebeler,
                'penempatanBarang' => $penempatanBarang,
                'gedung' => $gedung,
                'lapang' => $lapang,
                'ruang' => $ruang,
            ]);
            return;
        }



        // Render halaman create pertama kali (GET request)
        $this->renderView('create', [
            'barangAtk' => $barangAtk,
            'barangBergerak' => $barangBergerak,
            'barangElektronik' => $barangElektronik,
            'barangMebeler' => $barangMebeler,
            'penempatanBarang' => $penempatanBarang,
            'gedung' => $gedung,
            'lapang' => $lapang,
            'ruang' => $ruang,
        ]);
    }
}
