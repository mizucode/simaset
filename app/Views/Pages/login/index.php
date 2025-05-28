<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>SIMASET | UM Kuningan</title>

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

    .floating-alert {
      z-index: 1000;
    }
  </style>
</head>

<body class="text-gray-800 font-poppins">
  <!-- Header -->
  <header class="sticky top-0 z-50 bg-white shadow-md">
    <div class="container mx-auto px-4 lg:px-32 lg:py-2">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <a href="index.html" class="flex-shrink-0">
          <img src="img/logo.png" alt="Logo" class="h-8 md:h-10">
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center space-x-1 lg:space-x-4">
          <a href="#beranda" class="px-3 py-2 rounded-md text-md font-medium text-yellow-400">Beranda</a>
          <a href="#informasi" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-custom-blue">Informasi</a>
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
        <a href="index.html" class="block px-3 py-2 rounded-md text-base font-medium bg-blue-50 text-custom-blue">Beranda</a>
        <a href="#informasi" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-custom-blue">Informasi</a>
        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-custom-blue">FAQ</a>
        <button id="search_mobile_button" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-custom-blue">
          <i class="fas fa-search mr-2"></i>Cari
        </button>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <!-- Hero Section -->
    <section class="py-16 md:py-20 lg:py-32 bg-custom-blue">
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
              <h3 class="text-2xl font-bold text-custom-blue text-center mb-2">Masuk Ke Akun</h3>
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
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-custom-blue">
                </div>
                <div>
                  <input
                    name="password"
                    placeholder="Kata Sandi"
                    required
                    type="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-custom-blue">
                </div>

                <button
                  type="submit"
                  class="w-full bg-custom-blue hover:bg-custom-blue-darker text-white font-medium py-3 px-6 rounded-md transition duration-300">
                  Masuk
                </button>

                <div class="text-center">
                  <a href="#" class="text-custom-blue hover:text-custom-blue-darker text-sm font-medium hover:underline">
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

  <!-- Notification -->
  <div id="notification" class="fixed bottom-5 right-5 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg max-w-xs hidden">
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
      const isOpen = mobileMenu.classList.toggle('h-0');
      menuIcon.classList.toggle('fa-bars');
      menuIcon.classList.toggle('fa-times');
      mobileMenu.classList.toggle('py-2');
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