<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>Informasi Aset | SIMASET | UM Kuningan</title> <!-- Judul diubah -->

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN via Play CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'custom-blue': '#002F6C',
            'custom-blue-darker': '#001F4C',
          },
          fontFamily: {
            'poppins': ['Poppins', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="text-gray-800 font-poppins">
  <!-- Header -->
  <header class="sticky top-0 z-50 bg-white shadow-md">
    <div class="container mx-auto px-4 lg:px-32 lg:py-2">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <a href="index.html" class="flex-shrink-0"> <!-- Asumsi index.html adalah halaman utama -->
          <img src="img/logo.png" alt="Logo" class="h-8 md:h-10">
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center space-x-1 lg:space-x-4">
          <a href="index.html" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-custom-blue">Beranda</a> <!-- Link ke Beranda -->
          <a href="informasi_aset.html" class="px-3 py-2 rounded-md text-md font-medium text-yellow-400">Informasi</a> <!-- Link ke Informasi (halaman ini, dibuat aktif) -->
          <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-custom-blue">FAQ</a>
          <button id="search_desktop_button" class="p-2 text-gray-500 hover:text-custom-blue">
            <i class="fas fa-search"></i>
          </button>
        </div>

        <!-- Mobile menu button -->
        <button class="md:hidden p-2 rounded-md text-gray-700 hover:text-custom-blue focus:outline-none" id="mobile-menu-button">
          <i class="fas fa-bars text-xl" id="menu-icon"></i>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden h-0 overflow-hidden transition-all duration-300 ease-in-out" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="index.html" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-custom-blue">Beranda</a>
        <a href="informasi_aset.html" class="block px-3 py-2 rounded-md text-base font-medium bg-blue-50 text-custom-blue">Informasi</a> <!-- Link ke Informasi (halaman ini, dibuat aktif) -->
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-custom-blue">FAQ</a>
        <button id="search_mobile_button" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-custom-blue">
          <i class="fas fa-search mr-2"></i>Cari
        </button>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <!-- Information Section -->
    <section id="informasi-aset" class="py-12 md:py-16 bg-gray-50">
      <div class="container mx-auto px-4 lg:px-32">
        <h2 class="text-3xl font-bold text-custom-blue mb-8 text-center">Informasi Aset Sarana dan Prasarana</h2>

        <!-- Total Aset Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
          <!-- Card Prasarana -->
          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="flex justify-center items-center mb-3">
              <i class="fas fa-building text-4xl text-custom-blue"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Total Aset Prasarana</h3>
            <p class="text-3xl font-bold text-custom-blue">120 Unit</p> <!-- Ganti dengan data dinamis jika perlu -->
            <p class="text-sm text-gray-500 mt-1">(Contoh: Gedung, Ruangan, Tanah)</p>
          </div>
          <!-- Card Sarana -->
          <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="flex justify-center items-center mb-3">
              <i class="fas fa-couch text-4xl text-custom-blue"></i> <!-- Ikon bisa diganti sesuai -->
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Total Aset Sarana</h3>
            <p class="text-3xl font-bold text-custom-blue">1.500 Unit</p> <!-- Ganti dengan data dinamis jika perlu -->
            <p class="text-sm text-gray-500 mt-1">(Contoh: Meja, Kursi, Komputer)</p>
          </div>
        </div>

        <!-- Tabel Barang Tersedia -->
        <div>
          <h3 class="text-2xl font-bold text-custom-blue mb-6 text-center md:text-left">Daftar Barang Tersedia di Sarpras</h3>
          <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-100">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">No</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama Barang</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Jumlah</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kondisi</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Lokasi</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Keterangan</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <!-- Contoh Baris Data (ganti dengan data dinamis jika perlu) -->
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">1</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Meja Dosen Kayu</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">50</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Baik</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Gedung Rektorat Lt. 2</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">-</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">2</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Kursi Kuliah Lipat</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">200</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Baik</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Gedung A R.101-105</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">10 perlu perbaikan minor</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">3</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Proyektor LCD</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">15</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Perlu Perbaikan</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Gudang Sarpras</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">2 unit mati total</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">4</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Komputer All-in-One</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">25</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Baik</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Lab Komputer 1 & 2</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">-</td>
                </tr>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">5</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Lemari Arsip Besi</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">10</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rusak Berat</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Gudang Belakang</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Akan dihapusbukukan</td>
                </tr>
                <!-- Tambahkan baris data lainnya sesuai kebutuhan -->
              </tbody>
            </table>
          </div>
          <p class="mt-4 text-sm text-gray-600 text-center md:text-left">*Data pada tabel bersifat contoh dan akan diisi sesuai dengan data aktual dari sistem SIMASET.</p>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-[#002347] py-8 text-white">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
          <a href="https://www.umkuningan.ac.id">
            <img src="img/logo footer.png" alt="UM Kuningan" class="h-10">
          </a>
        </div>
        <div class="text-center md:text-left">
          <p class="text-sm ">
            Copyright ©<script>
              document.write(new Date().getFullYear());
            </script> Universitas Muhammadiyah Kuningan
            <br class="sm:hidden">
            <span class="hidden sm:inline">|</span>
            Lembaga Pembangunan, Pengembangan Teknologi dan Sistem Informasi
          </p>
        </div>
        <div class="flex gap-4">
          <a href="#" class=" hover:text-custom-blue"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class=" hover:text-custom-blue"><i class="fab fa-instagram"></i></a>
          <a href="#" class=" hover:text-custom-blue"><i class="fab fa-twitter"></i></a>
          <a href="#" class=" hover:text-custom-blue"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Notification (Jika masih diperlukan di halaman ini) -->
  <!-- <div id="notification" class="fixed bottom-5 right-5 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg max-w-xs hidden"> ... </div> -->

  <script>
    // Mobile Menu Toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');

    mobileMenuButton.addEventListener('click', () => {
      const isOpen = mobileMenu.classList.toggle('h-0');
      menuIcon.classList.toggle('fa-bars');
      menuIcon.classList.toggle('fa-times');
      mobileMenu.classList.toggle('py-2');
    });

    // Jika notifikasi masih digunakan di halaman ini, uncomment script di bawah
    /*
    function closeNotification() {
      document.getElementById('notification').classList.add('hidden');
    }

    setTimeout(() => {
      if (document.getElementById('notification')) { // Cek jika elemen ada
        document.getElementById('notification').classList.remove('hidden');
      }
    }, 1500);
    */
  </script>
</body>

</html>