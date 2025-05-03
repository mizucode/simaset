<?php

require_once __DIR__ . '/../Models/PenempatanBarang.php';
require_once __DIR__ . '/../Models/BarangElektronik.php';

class PenempatanController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/PenempatanBarang/{$view}.php";
    }

    public function Create()
    {
        global $conn;
        $barangElektronik = BarangElektronik::getAllData($conn);
        $this->renderView('create', [
            'barangElektronik' => $barangElektronik
        ]);
    }

    public function PenempatanBarang()
    {
        global $conn;
        $penempatanBarang = PenempatanBarang::getAllData($conn);
        $this->renderView('index', [
            'penempatanBarang' => $penempatanBarang,
        ]);
    }
}
