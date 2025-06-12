<!DOCTYPE html>
<html lang="id" style="scroll-behavior: smooth;">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Sistem Informasi Manajemen Aset Universitas Muhammadiyah Kuningan">
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>SIMASET | UM Kuningan</title>

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

    .floating-alert {
      z-index: 1000;
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
          <a href="#beranda" class="px-3 py-2 text-sm font-medium text-primary border-b-2 border-primary">Beranda</a>
          <a href="/informasi" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary hover-underline-animation transition-colors">Informasi</a>
          <a href="#" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary hover-underline-animation transition-colors">FAQ</a>
          <a href="#" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary hover-underline-animation transition-colors">Kontak</a>

          <div class="relative ml-4">
            <button id="search_desktop_button" class="p-2 text-gray-500 hover:text-primary transition-colors">
              <i class="fas fa-search"></i>
            </button>
            <div id="search_desktop_dropdown" class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg z-20 hidden">
              <div class="p-3">
                <input type="text" placeholder="Cari..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
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
        <a href="index.html" class="block px-3 py-2 rounded-md text-base font-medium bg-blue-50 text-primary">Beranda</a>
        <a href="/informasi" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors">Informasi</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors">FAQ</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors">Kontak</a>

        <div class="relative mt-2">
          <input type="text" placeholder="Cari..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <!-- Hero Section -->
    <section class="py-16 md:py-20 lg:py-32 bg-primary">
      <div class="container mx-auto px-4 lg:px-32 lg:py-2">
        <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
          <!-- Left Content -->
          <div class="w-full lg:w-7/12 space-y-4 text-center lg:text-left">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white">Selamat Datang Di SIMASET</h1>
            <h2 class="text-lg font-semibold text-gray-200">
              Anda tetap dapat masuk dengan nama pengguna & kata sandi yang sama
            </h2>
            <p class="text-gray-300 leading-relaxed">
              Platform SIMASET hadir sebagai solusi digital dalam pengelolaan aset Universitas Muhammadiyah Kuningan secara efektif, efisien, dan transparan.
            </p>
          </div>

          <!-- Right Content - Login Form -->
          <div class="w-full lg:w-4/12">
            <div class="bg-white p-6 sm:p-8 lg:py-16 rounded-sm shadow-xl">
              <h3 class="text-2xl font-bold text-primary text-center mb-2">Masuk Ke Akun</h3>
              <p class="text-gray-600 text-center mb-6">Sistem Aset dan Inventori</p>

              <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                  <?= $_SESSION['error'];
                  unset($_SESSION['error']); ?>
                </div>
              <?php endif; ?>

              <form class="space-y-4" action="/login" method="POST">
                <div>
                  <input
                    name="username"
                    placeholder="Nama Pengguna"
                    required
                    type="text"
                    value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                  <input
                    name="password"
                    placeholder="Kata Sandi"
                    required
                    type="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                <button
                  type="submit"
                  class="w-full bg-primary hover:bg-primary-darker text-white font-medium py-3 px-6 rounded-md transition duration-300">
                  Masuk
                </button>

                <div class="text-center">
                  <a href="#" class="text-primary hover:text-primary-darker text-sm font-medium hover:underline">
                    Panduan Penggunaan Aplikasi SIM
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Information Section -->

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

  <!-- Notification -->
  <div id="notification" class="fixed bottom-5 right-5 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg max-w-xs hidden floating-alert">
    <div class="flex items-start gap-3">
      <i class="fas fa-info-circle mt-1 text-green-500"></i>
      <div>
        <p class="font-bold">Info Penting!</p>
        <p class="text-sm">Pengisian sampai dengan 12 Februari 2025.</p>
      </div>
      <button onclick="closeNotification()" class="ml-4 text-green-500 hover:text-green-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>

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

    // Notification
    function closeNotification() {
      document.getElementById('notification').classList.add('hidden');
    }

    setTimeout(() => {
      document.getElementById('notification').classList.remove('hidden');
    }, 1500);
  </script>
</body>

</html>