<?php

require_once __DIR__ . '/../Models/BarangElektronik.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/Ruangan.php';
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
        $barangData = Barang::getAllData($conn);
        $ruanganList = Ruangan::getAllData($conn);
        $kategoriList = KategoriBarang::getAllData($conn);
        // Tambahkan ini jika diperlukan

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validasi input
            $requiredFields = [
                'kode_be',
                'nama_be',
                'kategori_id',
                'status',
                'jenis_elektronik',
                'merk',
                'tipe_model',
                'kondisi_terakhir',
                'id_ruangan',
                'jumlah',
                'satuan'
            ];

            $missingFields = [];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    $missingFields[] = $field;
                }
            }

            if (!empty($missingFields)) {
                $this->renderView('index', [
                    'barangElektronikData' => $barangElektronikData,
                    'ruanganList' => $ruanganList,
                    'barangData' => $barangData,
                    'kategoriList' => $kategoriList,
                    'statusOptions' => $statusOptions,
                    'typeOptions' => $typeOptions,
                    'error' => 'Field berikut harus diisi: ' . implode(', ', $missingFields),
                    'formData' => $_POST
                ]);
                return;
            }

            // Siapkan data untuk model
            $data = [
                'barang_id' => $_POST['kode_be'], // Sesuaikan dengan struktur tabel
                'kategori_id' => $_POST['kategori_id'],
                'status' => $_POST['status'],
                'jenis_elektronik' => $_POST['jenis_elektronik'],
                'merk' => $_POST['merk'],
                'tipe_model' => $_POST['tipe_model'],
                'jumlah' => (int)$_POST['jumlah'],
                'satuan' => $_POST['satuan'],
                'kondisi_terakhir' => $_POST['kondisi_terakhir'],
                'id_ruangan' => $_POST['id_ruangan'],
                'tahun_perolehan' => $_POST['tahun_perolehan'] ?? null,
                'keterangan' => $_POST['keterangan'] ?? null
            ];

            try {
                if (!empty($_POST['id'])) {
                    // Update data yang sudah ada
                    $success = BarangElektronik::updateData($conn, $_POST['id'], $data);
                    $action = 'diupdate';
                } else {
                    // Simpan data baru
                    $success = BarangElektronik::storeData($conn, $data);
                    $action = 'ditambahkan';
                }

                if ($success) {
                    $_SESSION['flash_message'] = "Data berhasil $action";
                    header('Location: /admin/sarana/elektronik');
                    exit();
                } else {
                    throw new Exception("Gagal menyimpan data");
                }
            } catch (Exception $e) {
                $this->renderView('index', [
                    'barangElektronikData' => $barangElektronikData,
                    'ruanganList' => $ruanganList,
                    'barangData' => $barangData,
                    'kategoriList' => $kategoriList,
                    'typeOptions' => $typeOptions,
                    'error' => 'Error: ' . $e->getMessage(),
                    'formData' => $_POST
                ]);
                return;
            }
        }

        // Handle delete request
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            try {
                $success = BarangElektronik::deleteData($conn, $_GET['delete']);

                if ($success) {
                    $_SESSION['flash_message'] = "Data berhasil dihapus";
                } else {
                    $_SESSION['flash_error'] = "Gagal menghapus data";
                }

                header('Location: /admin/sarana/elektronik');
                exit();
            } catch (Exception $e) {
                $this->renderView('index', [
                    'barangElektronikData' => $barangElektronikData,
                    'ruanganList' => $ruanganList,
                    'barangData' => $barangData,
                    'kategoriList' => $kategoriList,
                    'statusOptions' => $statusOptions,
                    'typeOptions' => $typeOptions,
                    'error' => 'Error menghapus data: ' . $e->getMessage()
                ]);
                return;
            }
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
            'kategoriList' => $kategoriList,
            'flashMessage' => $flashMessage,
            'flashError' => $flashError
        ]);
    }
}
