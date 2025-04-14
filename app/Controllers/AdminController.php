<?php

class AdminController
{
    private function renderView(string $view)
    {
        require_once __DIR__ . "/../Views/{$view}.php";
    }

    public function index()
    {
        $this->renderView('admin');
    }

    public function barang()
    {
        $this->renderView('barang');
    }

    public function tanah()
    {
        $this->renderView('tanah');
    }

    public function gedung()
    {
        $this->renderView('gedung');
    }

    public function ruangan()
    {
        $this->renderView('ruangan');
    }

    public function lapang()
    {
        $this->renderView('lapang');
    }
    public function bergerak()
    {
        $this->renderView('bergerak');
    }
    public function mebeler()
    {
        $this->renderView('mebeler');
    }
    public function atk()
    {
        $this->renderView('atk');
    }
    public function elektronik()
    {
        $this->renderView('elektronik');
    }
    public function listPenempatan()
    {
        $this->renderView('listPenempatan');
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
