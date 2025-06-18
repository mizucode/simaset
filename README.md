# 📦 Sistem Informasi Manajemen Aset

![Status](https://img.shields.io/badge/status-in%20progress-yellow)
![License](https://img.shields.io/badge/license-MIT-blue)
![Tech](https://img.shields.io/badge/tech-stack-blueviolet)
[![PHP](https://img.shields.io/badge/php-%23777BB4.svg?&logo=php&logoColor=white)](#)
![Last Update](https://img.shields.io/github/last-commit/mizucode/simaset?style=flat)

Sistem ini dirancang untuk membantu pengelolaan aset seperti barang elektronik dan tanah dalam suatu instansi, dilengkapi dengan fitur CRUD, penempatan barang, dan pengelompokan data aset.

---

## ✨ Fitur Terbaru

### ✅ Selesai

- **Menu Prasarana Tanah** sudah berfungsi dengan baik -> Penambahan bagian dokumen sertifikat.
- **Menu Prasarana Gedung** sudah berfungsi dengan baik ->
- **Menu Prasarana Ruang** sudah berfungsi dengan baik ->
- **Menu Prasarana Lapang** sudah berfungsi dengan baik ->
- **Menu Sarana Barang Bergerak** sudah berfungsi dengan baik ->
- **Menu Sarana Barang Mebelair** sudah berfungsi dengan baik ->
- **Menu Sarana Barang ATK** sudah berfungsi dengan baik ->
- **Menu Sarana Barang Elektronik** sudah berfungsi dengan baik -> CRUD telah direfactor.
- **Menu Barang Daftar Barang** sudah berfungsi dengan baik ->
- **Menu Barang Jenis Barang** sudah berfungsi dengan baik ->
- **Menu Transaksi Barang** sudah berfungsi dengan baik ->

#### Commit Version Menu:

- Commit Darurat Penggantian database

---

### 🚧 Dalam Proses

- Tidak ada fitur yang sedang dikerjakan saat ini.

---

## 🛠️ Tahap Pengerjaan

1. Masih Banyak Bug di **Menu Survey Semesteran**

---

## 📌 Rencana Selanjutnya

### Prasarana

- Tambahkan dokumen dan dokumentasi di semuah menu sarana dan prasarana.
- Gedung di rename jadi bangunan.
- Pada table ruangan tambahkan filed jenis ruangan.

### Sarana

- Jumlah pada barang bergerak hapus saja.
- Seluruh table brang beri [biaya pembelian, tangggal pembelian, dan dokumen serta dokumentasi].
- View barang bergerak dibuat persub jenis barang.
- Kondisi barang tambahkan hilang dan pemusnagan.

---

## ⚙️ Teknologi yang Digunakan

- **Frontend:** HTML, CSS, JavaScript, Bootstrap, Tailwind, DataTables
- **Backend:** PHP (OOP, MVC)
- **Database:** MySQL
- **Tools:** Git, Visual Studio Code

---

## 📁 Struktur Direktori (Contoh)

```
📦 simaset/
├── AdminLTE-3.2.0/        → Template AdminLTE
├── app/
│   ├── Controllers/        → Logika aplikasi
│   ├── Models/             → Logika database
│   └── Views/              → Tampilan antarmuka
├── config/                 → Konfigurasi (database, route, dll)
├── core/                   → Routing & autentikasi
├── css/                    → File CSS
├── fonts/                  → Font dan ikon
├── img/                    → Gambar & ikon
├── js/                     → File JavaScript
├── logs/                   → Log aplikasi
├── resource/               → Resource tambahan (admin, auth, dll)
├── scss/                   → Sumber file SCSS
├── storage/                → Penyimpanan dokumen & dokumentasi
├── vendors/                → Plugin & library pihak ketiga
├── 404.php
├── index.php
├── README.md
└── ...
```

---

> ✨ _Dokumentasi ini akan terus diperbarui seiring perkembangan fitur._

---
