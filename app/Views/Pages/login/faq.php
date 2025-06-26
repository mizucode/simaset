<!DOCTYPE html>
<html lang="id" style="scroll-behavior: smooth;">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Sistem Informasi Manajemen Aset Universitas Muhammadiyah Kuningan">
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>FAQ | SIMASET | UM Kuningan</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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

    .sticky-header {
      position: sticky;
      top: 0;
      z-index: 10;
      background-color: white;
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

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-in-out, padding 0.3s ease-in-out;
    }

    .faq-item.active .faq-answer {
      max-height: 200px;
      /* Sesuaikan dengan tinggi konten Anda */
      padding-top: 1rem;
      padding-bottom: 1rem;
    }

    .faq-item.active .faq-icon {
      transform: rotate(180deg);
    }
  </style>
</head>

<body class="text-gray-700 font-poppins bg-gray-50">
  <header class="sticky top-0 z-50 bg-white shadow-header">
    <div class="container mx-auto px-4 lg:px-8 xl:px-16">
      <div class="flex justify-between items-center h-16 lg:h-20">
        <a href="index.html" class="flex items-center space-x-2">
          <img src="img/logo.png" alt="UM Kuningan" class="h-8 md:h-10">
        </a>

        <nav class="hidden md:flex items-center space-x-1 lg:space-x-6">
          <a href="/" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary hover-underline-animation transition-colors">Beranda</a>
          <a href="/informasi" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary hover-underline-animation transition-colors">Informasi</a>
          <a href="/faq" class="px-3 py-2 text-sm font-medium text-primary border-b-2 border-primary">FAQ</a>
          <a href="/kontak" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-primary hover-underline-animation transition-colors">Kontak</a>

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

        <button class="md:hidden p-2 rounded-md text-gray-700 hover:text-primary focus:outline-none transition-colors" id="mobile-menu-button">
          <i class="fas fa-bars text-xl" id="menu-icon"></i>
        </button>
      </div>
    </div>

    <div class="md:hidden max-h-0 overflow-hidden transition-all duration-300 ease-in-out" id="mobile-menu">
      <div class="px-4 pt-2 pb-4 space-y-2 bg-gray-50">
        <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors">Beranda</a>
        <a href="/informasi" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors">Informasi</a>
        <a href="/faq" class="block px-3 py-2 rounded-md text-base font-medium bg-blue-50 text-primary">FAQ</a>
        <a href="/kontak" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-gray-100 hover:text-primary transition-colors">Kontak</a>

        <div class="relative mt-2">
          <input type="text" placeholder="Cari aset..." class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>
      </div>
    </div>
  </header>

  <main>
    <section class="bg-gradient-to-r from-primary to-primary-dark text-white py-12">
      <div class="container mx-auto px-4 lg:px-8 xl:px-16 text-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Frequently Asked Questions (FAQ)</h1>
        <p class="text-lg md:text-xl max-w-3xl mx-auto opacity-90">Temukan jawaban untuk pertanyaan yang sering diajukan mengenai sistem manajemen aset kami.</p>
      </div>
    </section>

    <section class="py-12 md:py-20 bg-gray-50">
      <div class="container mx-auto px-4 lg:px-8 xl:px-16">
        <div class="max-w-4xl mx-auto">
          <div class="space-y-4">
            <div class="faq-item bg-white rounded-lg shadow-card overflow-hidden">
              <button class="faq-question w-full text-left p-6 flex justify-between items-center focus:outline-none">
                <span class="text-lg font-semibold text-gray-800">Apa itu SIMASET UM Kuningan?</span>
                <i class="fas fa-chevron-down faq-icon text-primary transition-transform duration-300"></i>
              </button>
              <div class="faq-answer px-6 text-gray-600">
                <p>SIMASET adalah singkatan dari Sistem Informasi Manajemen Aset. Ini adalah platform digital yang dirancang untuk mengelola, memantau, dan menyediakan informasi mengenai seluruh aset sarana dan prasarana yang dimiliki oleh Universitas Muhammadiyah Kuningan.</p>
              </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow-card overflow-hidden">
              <button class="faq-question w-full text-left p-6 flex justify-between items-center focus:outline-none">
                <span class="text-lg font-semibold text-gray-800">Siapa saja yang dapat menggunakan SIMASET?</span>
                <i class="fas fa-chevron-down faq-icon text-primary transition-transform duration-300"></i>
              </button>
              <div class="faq-answer px-6 text-gray-600">
                <p>SIMASET dapat diakses oleh seluruh civitas akademika Universitas Muhammadiyah Kuningan, termasuk mahasiswa, dosen, dan staf. Hak akses dan fitur yang tersedia mungkin berbeda tergantung pada peran pengguna.</p>
              </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow-card overflow-hidden">
              <button class="faq-question w-full text-left p-6 flex justify-between items-center focus:outline-none">
                <span class="text-lg font-semibold text-gray-800">Bagaimana cara meminjam aset melalui SIMASET?</span>
                <i class="fas fa-chevron-down faq-icon text-primary transition-transform duration-300"></i>
              </button>
              <div class="faq-answer px-6 text-gray-600">
                <p>Untuk meminjam aset, Anda perlu login ke sistem SIMASET menggunakan akun Anda. Setelah itu, cari aset yang ingin dipinjam pada halaman informasi, periksa ketersediaannya, dan ikuti prosedur peminjaman yang tertera. Anda mungkin perlu mengisi formulir peminjaman online dan menunggu persetujuan dari pihak terkait.</p>
              </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow-card overflow-hidden">
              <button class="faq-question w-full text-left p-6 flex justify-between items-center focus:outline-none">
                <span class="text-lg font-semibold text-gray-800">Apa yang harus saya lakukan jika aset yang saya pinjam rusak atau hilang?</span>
                <i class="fas fa-chevron-down faq-icon text-primary transition-transform duration-300"></i>
              </button>
              <div class="faq-answer px-6 text-gray-600">
                <p>Jika aset yang Anda pinjam mengalami kerusakan atau hilang, segera laporkan kepada bagian pengelola aset atau melalui fitur pelaporan di SIMASET. Anda akan dipandu mengenai prosedur selanjutnya, yang mungkin meliputi perbaikan atau penggantian sesuai dengan kebijakan universitas yang berlaku.</p>
              </div>
            </div>

            <div class="faq-item bg-white rounded-lg shadow-card overflow-hidden">
              <button class="faq-question w-full text-left p-6 flex justify-between items-center focus:outline-none">
                <span class="text-lg font-semibold text-gray-800">Bagaimana cara melihat status ketersediaan sebuah aset?</span>
                <i class="fas fa-chevron-down faq-icon text-primary transition-transform duration-300"></i>
              </button>
              <div class="faq-answer px-6 text-gray-600">
                <p>Anda dapat melihat status ketersediaan aset (Tersedia, Dipinjam, Dalam Perbaikan, dll.) pada halaman 'Informasi Aset'. Gunakan fitur pencarian atau filter untuk menemukan aset yang Anda cari dengan lebih cepat. Status akan diperbarui secara real-time oleh administrator.</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

  </main>

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

    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
      const question = item.querySelector('.faq-question');
      question.addEventListener('click', () => {
        // Tutup semua item lain
        faqItems.forEach(otherItem => {
          if (otherItem !== item) {
            otherItem.classList.remove('active');
          }
        });
        // Buka atau tutup item yang diklik
        item.classList.toggle('active');
      });
    });
  </script>
</body>

</html>