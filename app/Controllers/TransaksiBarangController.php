<?php

require_once __DIR__ . '/../Models/TransaksiBarang.php';
require_once __DIR__ . '/../Models/SaranaBergerak.php';
require_once __DIR__ . '/../Models/SaranaMebelair.php';
require_once __DIR__ . '/../Models/SaranaATK.php';
require_once __DIR__ . '/../Models/SaranaElektronik.php';
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/Gedung.php';
require_once __DIR__ . '/../Models/Lapang.php';


class TransaksiBarangController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Transaksi/{$view}.php";
    }

    public function index()
    {
        global $conn;
        $peminjamanData = TransaksiBarang::getAllData($conn);
        $pengembalianData = TransaksiBarang::getAllDataPengembalian($conn);

        $this->renderView('index', [
            'peminjamanData' => $peminjamanData,
            'pengembalianData' => $pengembalianData,
        ]);
    }




    public function createPeminjaman()
    {
        global $conn;
        $barangBergerak = SaranaBergerak::getAllData($conn);
        $barangMebelair = SaranaMebelair::getAllData($conn);
        $barangATK = SaranaATK::getAllData($conn);
        $barangElektronik = SaranaElektronik::getAllData($conn);
        $lapangData = Lapang::getAllData($conn);
        $gedungData = Gedung::getAllData($conn);
        $ruangData = Ruang::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_peminjam = $_POST['nama_peminjam'] ?? '';
            $nik = $_POST['nik'] ?? '';
            $jabatan = $_POST['jabatan'] ?? '';
            $no_telepon = $_POST['no_telepon'] ?? '';
            $nama_barang = $_POST['nama_barang'] ?? '';
            $jumlah_barang = $_POST['jumlah_barang'] ?? 1;
            $kondisi = $_POST['kondisi'] ?? '';
            $tanggal_peminjaman = $_POST['tanggal_peminjaman'] ?? '';
            $tanggal_pengembalian = $_POST['tanggal_pengembalian'] ?? '';
            $lokasi = $_POST['lokasi'] ?? '';
            $status = $_POST['status'] ?? 'Dipinjam'; // Default status
            $tujuan_peminjaman = $_POST['tujuan_peminjaman'] ?? '';

            try {
                $success = TransaksiBarang::storePeminjaman(
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

                $message = $success ? 'Data peminjaman berhasil ditambahkan.' : 'Gagal menambahkan data peminjaman.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/transaksi/riwayat-barang');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('Peminjaman/create', [
            "barangBergerak" => $barangBergerak,
            "barangMebelair" =>  $barangMebelair,
            "barangATK" =>  $barangATK,
            "barangElektronik" => $barangElektronik,
            "gedungData" => $gedungData,
            "lapangData" => $lapangData,
            "ruangData" => $ruangData,
        ]);
    }


    public function createPengembalian()
    {
        $this->renderView('Pengembalian/create', []);
    }
}
