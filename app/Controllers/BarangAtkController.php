<?php

require_once __DIR__ . '/../Models/BarangAtk.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';


class BarangAtkController
{

    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/BarangAtk/{$view}.php";
    }

    public function atk()
    {

        global $conn;

        $barangAtkData = BarangAtk::getAllData($conn);
        $barangData = Barang::getAllData($conn);
        $kategoriList = KategoriBarang::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Safely get POST data with null coalescing operator
            $id = $_POST['id'] ?? null;
            $kode_barang_atk = $_POST['kode_barang_atk'];
            $nama_barang_atk = $_POST['nama_barang_atk'];
            $barang_id = $_POST['barang_id'];
            $kategori_id = $_POST['kategori_id']; // Add this line

            try {
                if ($id) {
                    // Update data
                    $success = BarangAtk::updateData(
                        $conn,
                        $id,
                        $kode_barang_atk,
                        $nama_barang_atk,
                        $barang_id,
                        $kategori_id // Add this parameter
                    );
                    $message = $success ? 'Data berhasil diperbarui.' : 'Gagal memperbarui data.';
                    $_SESSION['update'] = $message;
                } else {
                    // Simpan data baru
                    $success = BarangAtk::storeData(
                        $conn,
                        $kode_barang_atk,
                        $nama_barang_atk,
                        $barang_id,
                        $kategori_id // Add this parameter
                    );
                    $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
                    $_SESSION['update'] = $message;
                }

                if ($success) {
                    header('Location: /admin/sarana/atk');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }

            // If not redirected, render view with current data
            $this->renderView('index', [
                'barangAtkData' => $barangAtkData,
                'barangData' => $barangData,
                'kategoriList' => $kategoriList,
            ]);
            return;
        }

        // Handle delete request
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id = $_GET['delete'];
            if (BarangAtk::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }
            header('Location: /admin/sarana/atk');
            exit();
        }

        // Render view
        $this->renderView('index', [
            'barangAtkData' => $barangAtkData,
            'barangData' => $barangData,
            'kategoriList' => $kategoriList,
            'flashMessage' => $_SESSION['update'] ?? null,
            'flashError' => $_SESSION['error'] ?? null
        ]);

        // Clear flash messages after displaying
        unset($_SESSION['update']);
        unset($_SESSION['error']);
    }
}
