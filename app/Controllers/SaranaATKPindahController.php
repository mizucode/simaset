<?php
require_once __DIR__ . '/../Models/SaranaATK.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/DokumenSaranaATK.php';

class SaranaATKPindahController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Pindah/SaranaATK/{$view}.php";
    }



    public function update($id)
    {
        global $conn;
        $sarana = SaranaATK::getById($conn, $id);
        $kategoriList = KategoriBarang::getAllData($conn);
        $barangList = Barang::getAllData($conn);
        $kondisiList = KondisiBarang::getAllData($conn);
        $lapangData = Lapang::getAllData($conn);
        $ruangData = Ruang::getAllData($conn);

        if (!$sarana) {
            $_SESSION['error'] = 'Data sarana ATK tidak ditemukan.';
            header('Location: /admin/sarana/atk');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kategori_barang_id = $_POST['kategori_barang_id'];
            $barang_id = $_POST['barang_id'];
            $kondisi_barang_id = $_POST['kondisi_barang_id'];
            $nama_detail_barang = $_POST['nama_detail_barang'];
            $merk = $_POST['merk'] ?? null;
            $spesifikasi = $_POST['spesifikasi'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;
            $satuan = $_POST['satuan'] ?? 'Unit';
            $lokasi = $_POST['lokasi'] ?? null;
            $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
            $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;


            try {
                $success = SaranaATK::updateData(
                    $conn,
                    $id,
                    $kategori_barang_id,
                    $barang_id,
                    $kondisi_barang_id,
                    $sarana['no_registrasi'], // Keep existing registration number
                    $nama_detail_barang,
                    $merk,
                    $spesifikasi,
                    $jumlah,
                    $satuan,
                    $lokasi,
                    $biaya_pembelian,
                    $tanggal_pembelian,
                    $keterangan,

                );

                $message = $success ? 'Data sarana ATK berhasil diperbarui.' : 'Gagal memperbarui data sarana ATK.';
                $_SESSION['update'] = $message;

                header('Location: /admin/sarana/atk?detail=' . $id);
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('update', [
            'sarana' => $sarana,
            'kategoriList' => $kategoriList,
            'barangList' => $barangList,
            'kondisiList' => $kondisiList,
            'lapangData' => $lapangData,
            'ruangData' => $ruangData
        ]);
    }



    public function index()
    {
        global $conn;
        $saranaData = SaranaATK::getAllData($conn);

        $this->renderView('index', [
            'saranaData' => $saranaData,
        ]);
    }
}
