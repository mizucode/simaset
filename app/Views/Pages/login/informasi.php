<!DOCTYPE html>
<html lang="id" style="scroll-behavior: smooth;">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Sistem Informasi Manajemen Aset Universitas Muhammadiyah Kuningan">
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>Informasi Aset | SIMASET | UM Kuningan</title>

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'primary': '#002F6C',
            'primary-dark': '#001F4C',
            'secondary': '#F8B739',
            'accent': '#00A0E3',
          },
          fontFamily: {
            'poppins': ['Poppins', 'sans-serif'],
          },
          boxShadow: {
            'card': '0 4px 20px rgba(0, 0, 0, 0.08)',
            'header': '0 2px 10px rgba(0, 0, 0, 0.05)'
          }
        }
      }
    }
  </script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      -webkit-font-smoothing: antialiased;
    }

    .table-responsive {
      min-height: 300px;
    }

    .sticky-header {
      position: sticky;
      top: 0;
      z-index: 10;
      background-color: white;
    }

    .pagination .active {
      background-color: #002F6C;
      color: white;
    }

    .hover-underline-animation {
      position: relative;
    }

    .hover-underline-animation::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -2px;
      left: 0;
      background-color: #002F6C;
      transition: width 0.3s ease;
    }

    .hover-underline-animation:hover::after {
      width: 100%;
    }
  </style>
</head>

<body class="text-gray-700 font-poppins bg-gray-50">
  <!-- Header -->
  <header class="sticky top-0 z-50 bg-white shadow-header">
    <div class="container mx-auto px-4 lg:px-8 xl:px-16">
      <div class="flex justify-between items-center h-16 lg:h-20">
        <!-- Logo -->
        <a href="index.html" class="flex items-center space-x-2">
          <img src="img/logo.png" alt="UM Kuningan" class="h-8 md:h-10">
        </a>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center space-x-1 lg:space-x-6">
          <a href="/" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary hover-underline-animation transition-colors">Beranda</a>
          <a href="/informasi" class="px-3 py-2 text-sm font-medium text-primary border-b-2 border-primary">Informasi</a>
          <a href="#" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary hover-underline-animation transition-colors">FAQ</a>
          <a href="#" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary hover-underline-animation transition-colors">Kontak</a>

          <div class="relative ml-4">
            <button id="search_desktop_button" class="p-2 text-gray-500 hover:text-primary transition-colors">
              <i class="fas fa-search"></i>
            </button>
            <div id="search_desktop_dropdown" class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg z-20 hidden">
              <div class="p-3">
                <input type="text" placeholder="Cari aset..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
              </div>
            </div>
          </div>
        </nav>

        <!-- Mobile menu button -->
        <button class="md:hidden p-2 rounded-md text-gray-700 hover:text-primary focus:outline-none transition-colors" id="mobile-menu-button">
          <i class="fas fa-bars text-xl" id="menu-icon"></i>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden max-h-0 overflow-hidden transition-all duration-300 ease-in-out" id="mobile-menu">
      <div class="px-4 pt-2 pb-4 space-y-2 bg-gray-50">
        <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors">Beranda</a>
        <a href="informasi_aset.html" class="block px-3 py-2 rounded-md text-base font-medium bg-blue-50 text-primary">Informasi</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors">FAQ</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors">Kontak</a>

        <div class="relative mt-2">
          <input type="text" placeholder="Cari aset..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>
      </div>
    </div>
  </header>

  <!-- Breadcrumb -->


  <!-- Main Content -->
  <main>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-primary-dark text-white py-12">
      <div class="container mx-auto px-4 lg:px-8 xl:px-16 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Informasi Aset Sarana dan Prasarana</h1>
        <p class="text-lg md:text-xl max-w-3xl mx-auto opacity-90">Temukan informasi lengkap tentang aset yang tersedia di Universitas Muhammadiyah Kuningan</p>
      </div>
    </section>

    <!-- Information Section -->
    <section class="py-12 bg-white">
      <div class="container mx-auto px-4 lg:px-8 xl:px-16">
        <!-- Filter Section -->


        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow-card overflow-hidden">
          <!-- Table Header -->
          <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <div>
              <h3 class="text-xl font-bold text-gray-800">Daftar Barang Dipinjam</h3>
              <p class="text-gray-600 mt-1">Total <?php echo count($saranaDataPinjam); ?> aset ditemukan</p>
            </div>
            <div class="flex items-center space-x-2">
              <div class="relative">
                <select class="appearance-none bg-gray-50 border border-gray-300 text-gray-700 py-2 pl-3 pr-8 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                  <option>10 per halaman</option>
                  <option>25 per halaman</option>
                  <option>50 per halaman</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <i class="fas fa-chevron-down text-xs"></i>
                </div>
              </div>
              <button class="bg-primary hover:bg-primary-dark text-white p-2 rounded-md transition-colors">
                <i class="fas fa-download"></i>
              </button>
            </div>
          </div>

          <!-- Table Content -->
          <div class="overflow-x-auto table-responsive">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50 sticky-header">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    <div class="flex items-center">
                      No

                    </div>
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    <div class="flex items-center">
                      Nama Barang

                    </div>
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    <div class="flex items-center">
                      Kategori

                    </div>
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    <div class="flex items-center">
                      Status

                    </div>
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    <div class="flex items-center">
                      Lokasi

                    </div>
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    Nama Peminjam
                  </th>

                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($saranaDataPinjam)): ?>
                  <?php foreach ($saranaDataPinjam as $index => $barang): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $index + 1; ?></td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($barang['nama_detail_barang']); ?></div>
                        <div class="text-xs text-gray-500">Kode: <?php echo htmlspecialchars($barang['no_registrasi'] ?? '-'); ?></div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs"><?php echo htmlspecialchars($barang['kategori'] ?? '-'); ?></span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <?php
                        // On this page, $barang['status'] is expected to be 'Dipinjam'
                        // due to the controller logic (PagesController@informasi).
                        $status_text = htmlspecialchars($barang['status'] ?? 'Status Tidak Diketahui');
                        $status_class = 'bg-yellow-100 text-yellow-800'; // Class for 'Dipinjam'
                        ?>
                        <span class="px-2 py-1 <?php echo $status_class; ?> rounded-full text-xs"><?php echo $status_text; ?></span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        <div class="flex items-center">
                          <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                          <?php echo htmlspecialchars($barang['lokasi']); ?>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        <?php echo htmlspecialchars($barang['nama_peminjam'] ?? '-'); ?>
                      </td>

                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                      <div class="flex flex-col items-center justify-center text-gray-500">
                        <i class="fas fa-box-open text-4xl mb-4 opacity-50"></i>
                        <p class="text-lg font-medium">Tidak ada data aset yang ditemukan</p>
                        <p class="text-sm mt-1">Coba gunakan filter yang berbeda atau <a href="#" class="text-primary hover:underline">reset filter</a></p>
                      </div>
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <!-- Table Footer -->
          <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0">
              <p class="text-sm text-gray-600">
                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium"><?php echo count($saranaDataPinjam); ?></span> hasil
              </p>
            </div>

          </div>
        </div>
        <div class="bg-white rounded-lg shadow-card overflow-hidden mt-10">
          <!-- Table Header -->
          <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <div>
              <h3 class="text-xl font-bold text-gray-800">Daftar Barang Tersedia</h3>
              <p class="text-gray-600 mt-1">Total <?php echo count($saranaDataTersedia); ?> aset ditemukan</p>
            </div>
            <div class="flex items-center space-x-2">
              <div class="relative">
                <select class="appearance-none bg-gray-50 border border-gray-300 text-gray-700 py-2 pl-3 pr-8 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                  <option>10 per halaman</option>
                  <option>25 per halaman</option>
                  <option>50 per halaman</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <i class="fas fa-chevron-down text-xs"></i>
                </div>
              </div>
              <button class="bg-primary hover:bg-primary-dark text-white p-2 rounded-md transition-colors">
                <i class="fas fa-download"></i>
              </button>
            </div>
          </div>

          <!-- Table Content -->
          <div class="overflow-x-auto table-responsive">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50 sticky-header">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    <div class="flex items-center">
                      No
                    </div>
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    <div class="flex items-center">
                      Nama Barang
                    </div>
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    <div class="flex items-center">
                      Kategori
                    </div>
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    <div class="flex items-center">
                      Status
                    </div>
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    <div class="flex items-center">
                      Lokasi
                    </div>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($saranaDataTersedia)): ?>
                  <?php foreach ($saranaDataTersedia as $index => $barang): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $index + 1; ?></td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($barang['nama_detail_barang']); ?></div>
                        <div class="text-xs text-gray-500">Kode: <?php echo htmlspecialchars($barang['no_registrasi'] ?? '-'); ?></div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs"><?php echo htmlspecialchars($barang['kategori'] ?? '-'); ?></span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <?php
                        // On this page, $barang['status'] is expected to be 'Dipinjam'
                        // due to the controller logic (PagesController@informasi).
                        $status_text = htmlspecialchars($barang['status'] ?? 'Status Tidak Diketahui');
                        $status_class = 'bg-yellow-100 text-yellow-800'; // Class for 'Dipinjam'
                        ?>
                        <span class="px-2 py-1 <?php echo $status_class; ?> rounded-full text-xs"><?php echo $status_text; ?></span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        <div class="flex items-center">
                          <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                          <?php echo htmlspecialchars($barang['lokasi']); ?>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                      <div class="flex flex-col items-center justify-center text-gray-500">
                        <i class="fas fa-box-open text-4xl mb-4 opacity-50"></i>
                        <p class="text-lg font-medium">Tidak ada data aset yang ditemukan</p>
                        <p class="text-sm mt-1">Coba gunakan filter yang berbeda atau <a href="#" class="text-primary hover:underline">reset filter</a></p>
                      </div>
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <!-- Table Footer -->
          <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0">
              <p class="text-sm text-gray-600">
                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium"><?php echo count($saranaDataTersedia); ?></span> hasil
              </p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Stats Section -->

  </main>

  <!-- Footer -->
  <footer class="bg-[#002347] text-white pt-12 pb-6">
    <div class="container mx-auto px-4 lg:px-8 xl:px-16">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
        <div>
          <h4 class="text-lg font-semibold mb-4">SIMASET</h4>
          <p class="text-sm text-gray-300 mb-4">
            Sistem Informasi Manajemen Aset Universitas Muhammadiyah Kuningan
          </p>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-300 hover:text-white transition-colors">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-gray-300 hover:text-white transition-colors">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="text-gray-300 hover:text-white transition-colors">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-sm text-gray-300 hover:text-white transition-colors">Beranda</a></li>
            <li><a href="#" class="text-sm text-gray-300 hover:text-white transition-colors">Informasi Aset</a></li>
            <li><a href="#" class="text-sm text-gray-300 hover:text-white transition-colors">Peminjaman</a></li>
            <li><a href="#" class="text-sm text-gray-300 hover:text-white transition-colors">FAQ</a></li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-4">Kontak</h4>
          <ul class="space-y-2">
            <li class="flex items-start">
              <i class="fas fa-map-marker-alt mt-1 mr-3 text-gray-300"></i>
              <span class="text-sm text-gray-300">Jl. Moertasim Soepomo No.28, Kuningan, Jawa Barat</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-phone-alt mr-3 text-gray-300"></i>
              <span class="text-sm text-gray-300">(0232) 874085</span>
            </li>
            <li class="flex items-center">
              <i class="fas fa-envelope mr-3 text-gray-300"></i>
              <span class="text-sm text-gray-300">simaset@umkuningan.ac.id</span>
            </li>
          </ul>
        </div>
        <div>
          <h4 class="text-lg font-semibold mb-4">Jam Operasional</h4>
          <ul class="space-y-2 text-sm text-gray-300">
            <li class="flex justify-between">
              <span>Senin - Jumat</span>
              <span>08:00 - 16:00</span>
            </li>

          </ul>
        </div>
      </div>
      <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
          <a href="https://www.umkuningan.ac.id">
            <img src="img/logo-footer.png" alt="UM Kuningan" class="h-8">
          </a>
        </div>
        <div class="text-center md:text-right">
          <p class="text-xs text-gray-400">
            Copyright ©<script>
              document.write(new Date().getFullYear());
            </script> Universitas Muhammadiyah Kuningan
            <br class="sm:hidden">
            <span class="hidden sm:inline">|</span> Lembaga Pembangunan, Pengembangan Teknologi dan Sistem Informasi
          </p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Back to Top Button -->
  <button id="back-to-top" class="fixed bottom-6 right-6 bg-primary text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 hover:bg-primary-dark">
    <i class="fas fa-arrow-up"></i>
  </button>

  <script>
    // Mobile Menu Toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');

    mobileMenuButton.addEventListener('click', () => {
      const isOpen = mobileMenu.classList.toggle('max-h-0');
      mobileMenu.classList.toggle('max-h-screen');
      mobileMenu.classList.toggle('py-4');
      menuIcon.classList.toggle('fa-bars');
      menuIcon.classList.toggle('fa-times');
    });

    // Search Dropdown Toggle
    const searchDesktopButton = document.getElementById('search_desktop_button');
    const searchDesktopDropdown = document.getElementById('search_desktop_dropdown');

    searchDesktopButton.addEventListener('click', () => {
      searchDesktopDropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
      if (!searchDesktopButton.contains(e.target) && !searchDesktopDropdown.contains(e.target)) {
        searchDesktopDropdown.classList.add('hidden');
      }
    });

    // Back to Top Button
    const backToTopButton = document.getElementById('back-to-top');

    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 300) {
        backToTopButton.classList.remove('opacity-0', 'invisible');
        backToTopButton.classList.add('opacity-100', 'visible');
      } else {
        backToTopButton.classList.add('opacity-0', 'invisible');
        backToTopButton.classList.remove('opacity-100', 'visible');
      }
    });

    backToTopButton.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    // Add hover effect to table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
      row.addEventListener('mouseenter', () => {
        row.classList.add('bg-gray-50');
      });
      row.addEventListener('mouseleave', () => {
        row.classList.remove('bg-gray-50');
      });
    });
  </script>
</body>

</html>