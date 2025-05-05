<?php

require_once __DIR__ . '/../Models/BarangElektronik.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';


class BarangElektronikController
{

    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/BarangElektronik/{$view}.php";
    }
    public function elektronik()
    {
        global $conn;

        // Ambil data barang elektronik dan ruangan
        $barangElektronikData = BarangElektronik::getAllData($conn);
        $statusOptions = BarangElektronik::getStatusOptions($conn);
        $typeOptions = BarangElektronik::getTypeOptions($conn);
        $kondisiTerakhirOptions = BarangElektronik::getKondisiTerakhirOptions($conn);
        $barangData = Barang::getAllData($conn);
        $ruanganList = Ruang::getAllData($conn);
        $kategoriList = KategoriBarang::getAllData($conn);
        // Tambahkan ini jika diperlukan

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id = $_POST['id'] ?? null;
            $barang_id = $_POST['barang_id'];
            $kategori_id = $_POST['kategori_id'];
            $status = $_POST['status'];
            $spesifikasi = $_POST['spesifikasi'];
            $merk = $_POST['merk'];
            $tipe_model = $_POST['tipe_model'];
            $jumlah = $_POST['jumlah'];
            $satuan = $_POST['satuan'];
            $kondisi_terakhir = $_POST['kondisi_terakhir'];
            $keterangan = $_POST['keterangan'];

            try {
                if ($id) {
                    // Update data
                    $success = BarangElektronik::updateData(
                        $conn,
                        $id,
                        $barang_id,
                        $kategori_id,
                        $status,
                        $spesifikasi,
                        $merk,
                        $tipe_model,
                        $jumlah,
                        $satuan,
                        $kondisi_terakhir,
                        $keterangan
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil diperbarui.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                } else {
                    // Simpan data baru
                    $success = BarangElektronik::storeData(
                        $conn,
                        $barang_id,
                        $kategori_id,
                        $status,
                        $spesifikasi,
                        $merk,
                        $tipe_model,
                        $jumlah,
                        $satuan,
                        $kondisi_terakhir,
                        $keterangan
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil ditambahkan.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                }

                if ($success) {
                    header('Location: /admin/sarana/elektronik');
                    exit();
                } else {
                    // Tampilkan error jika gagal
                    $this->renderView('index', [
                        'barangElektronikData' => $barangElektronikData,
                        'ruanganList' => $ruanganList,
                        'barangData' => $barangData,
                        'kategoriList' => $kategoriList,
                        'statusOptions' => $statusOptions,
                        'kondisiTerakhirOptions' => $kondisiTerakhirOptions,
                        'typeOptions' => $typeOptions,
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                // Tampilkan error database
                $this->renderView('index', [
                    'barangElektronikData' => $barangElektronikData,
                    'ruanganList' => $ruanganList,
                    'barangData' => $barangData,
                    'kategoriList' => $kategoriList,
                    'statusOptions' => $statusOptions,
                    'kondisiTerakhirOptions' => $kondisiTerakhirOptions,
                    'typeOptions' => $typeOptions,
                    'error' => 'Error menghapus data: ' . $e->getMessage()
                ]);
                return;
            }
        }



        // Handle delete request
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id = $_GET['delete'];
            if (BarangElektronik::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }
            header('Location: /admin/sarana/elektronik');
            exit();
        }

        // Tampilkan pesan flash jika ada
        $flashMessage = $_SESSION['flash_message'] ?? null;
        $flashError = $_SESSION['flash_error'] ?? null;
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_error']);

        // Render view
        $this->renderView('index', [
            'barangElektronikData' => $barangElektronikData,
            'ruanganList' => $ruanganList,
            'barangData' => $barangData,
            'statusOptions' => $statusOptions,
            'typeOptions' => $typeOptions,
            'kondisiTerakhirOptions' => $kondisiTerakhirOptions,
            'kategoriList' => $kategoriList,
            'flashMessage' => $flashMessage,
            'flashError' => $flashError
        ]);
    }
}
