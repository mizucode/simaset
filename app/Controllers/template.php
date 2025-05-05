<?php
require_once __DIR__ . '/../Models/Tanah.php';
require_once __DIR__ . '/../Models/Lokasi.php';

class TanahController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Tanah/{$view}.php";
    }
    public function tanah()
    {


        $this->renderView('index', []);
    }
}
