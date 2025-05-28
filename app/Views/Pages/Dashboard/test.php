<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>InventaSyst - Solusi Manajemen Aset Anda</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- Custom CSS (Opsional) -->
  <style>
    .hero-section {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8YXNzZXQlMjBtYW5hZ2VtZW50fGVufDB8fDB8fHww&auto=format&fit=crop&w=800&q=60') no-repeat center center;
      background-size: cover;
      color: white;
      padding: 100px 0;
    }

    .section-title {
      margin-bottom: 50px;
      font-weight: 700;
    }

    .feature-icon {
      font-size: 3rem;
      color: var(--bs-primary);
    }

    .card-feature {
      transition: transform 0.3s ease-in-out;
    }

    .card-feature:hover {
      transform: translateY(-10px);
    }

    .cta-section {
      background-color: #f8f9fa;
      /* Light grey background */
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">
        <i class="bi bi-box-seam-fill me-2"></i>InventaSyst
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#fitur">Fitur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#manfaat">Manfaat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#kontak">Kontak</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary ms-lg-2 mt-2 mt-lg-0" href="#">Daftar / Masuk</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="hero-section text-center">
    <div class="container">
      <h1 class="display-4 fw-bold">Kelola Aset Bisnis Anda dengan Mudah & Efisien</h1>
      <p class="lead my-4">
        InventaSyst adalah solusi manajemen inventaris aset modern yang membantu Anda melacak, memantau, dan mengoptimalkan seluruh aset berharga perusahaan.
      </p>
      <a href="#" class="btn btn-primary btn-lg me-2">Mulai Uji Coba Gratis</a>
      <a href="#fitur" class="btn btn-outline-light btn-lg">Pelajari Lebih Lanjut</a>
    </div>
  </header>

  <!-- Fitur Section -->
  <section id="fitur" class="py-5">
    <div class="container">
      <h2 class="text-center section-title">Fitur Unggulan InventaSyst</h2>
      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 text-center p-4 card-feature shadow-sm">
            <div class="feature-icon mb-3"><i class="bi bi-hdd-stack-fill"></i></div>
            <h5 class="card-title">Pelacakan Aset Real-time</h5>
            <p class="card-text">Ketahui lokasi dan status setiap aset Anda secara akurat dan terkini.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 text-center p-4 card-feature shadow-sm">
            <div class="feature-icon mb-3"><i class="bi bi-tools"></i></div>
            <h5 class="card-title">Manajemen Pemeliharaan</h5>
            <p class="card-text">Jadwalkan dan lacak aktivitas pemeliharaan untuk menjaga aset tetap optimal.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 text-center p-4 card-feature shadow-sm">
            <div class="feature-icon mb-3"><i class="bi bi-bar-chart-line-fill"></i></div>
            <h5 class="card-title">Laporan Komprehensif</h5>
            <p class="card-text">Dapatkan wawasan mendalam melalui laporan yang dapat disesuaikan.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 text-center p-4 card-feature shadow-sm">
            <div class="feature-icon mb-3"><i class="bi bi-shield-lock-fill"></i></div>
            <h5 class="card-title">Keamanan Data Terjamin</h5>
            <p class="card-text">Data aset Anda aman dengan sistem enkripsi dan backup rutin.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 text-center p-4 card-feature shadow-sm">
            <div class="feature-icon mb-3"><i class="bi bi-qr-code-scan"></i></div>
            <h5 class="card-title">Scan QR & Barcode</h5>
            <p class="card-text">Identifikasi dan perbarui data aset dengan cepat menggunakan pemindaian.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 text-center p-4 card-feature shadow-sm">
            <div class="feature-icon mb-3"><i class="bi bi-cloud-arrow-up-fill"></i></div>
            <h5 class="card-title">Berbasis Cloud</h5>
            <p class="card-text">Akses data inventaris Anda kapan saja, di mana saja, dari perangkat apa pun.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Manfaat Section -->
  <section id="manfaat" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center section-title">Mengapa Memilih InventaSyst?</h2>
      <div class="row align-items-center">
        <div class="col-lg-6">
          <img src="https://images.unsplash.com/photo-1542744095-291d1f67b221?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGJ1c2luZXNzJTIwbWVldGluZ3xlbnwwfHwwfHx8MA&auto=format&fit=crop&w=800&q=60" alt="Manfaat InventaSyst" class="img-fluid rounded shadow">
        </div>
        <div class="col-lg-6 mt-4 mt-lg-0">
          <ul class="list-unstyled">
            <li class="mb-3 d-flex align-items-start">
              <i class="bi bi-check-circle-fill text-success fs-4 me-2"></i>
              <div>
                <h5 class="fw-semibold">Optimalkan Penggunaan Aset</h5>
                <p>Maksimalkan nilai aset dan kurangi pemborosan dengan pemantauan yang lebih baik.</p>
              </div>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <i class="bi bi-check-circle-fill text-success fs-4 me-2"></i>
              <div>
                <h5 class="fw-semibold">Kurangi Kehilangan Aset</h5>
                <p>Minimalkan risiko kehilangan atau pencurian aset dengan pelacakan yang akurat.</p>
              </div>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <i class="bi bi-check-circle-fill text-success fs-4 me-2"></i>
              <div>
                <h5 class="fw-semibold">Tingkatkan Efisiensi Operasional</h5>
                <p>Hemat waktu dan sumber daya dengan proses manajemen aset yang terotomatisasi.</p>
              </div>
            </li>
            <li class="d-flex align-items-start">
              <i class="bi bi-check-circle-fill text-success fs-4 me-2"></i>
              <div>
                <h5 class="fw-semibold">Pengambilan Keputusan Lebih Baik</h5>
                <p>Gunakan data akurat untuk membuat keputusan strategis terkait aset Anda.</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action Section -->
  <section id="kontak" class="cta-section py-5 text-center">
    <div class="container">
      <h2 class="section-title">Siap Mengoptimalkan Manajemen Aset Anda?</h2>
      <p class="lead mb-4">
        Bergabunglah dengan ratusan bisnis yang telah mempercayakan InventaSyst untuk mengelola aset mereka.
      </p>
      <a href="#" class="btn btn-success btn-lg">Hubungi Tim Sales Kami</a>
      <a href="#" class="btn btn-outline-dark btn-lg ms-2">Lihat Demo</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-4">
    <div class="container">
      <p class="mb-0">© <script>
          document.write(new Date().getFullYear())
        </script> InventaSyst. Hak Cipta Dilindungi.</p>
      <p class="mb-0">
        <a href="#" class="text-white text-decoration-none">Kebijakan Privasi</a> |
        <a href="#" class="text-white text-decoration-none">Syarat & Ketentuan</a>
      </p>
    </div>
  </footer>

  <!-- Bootstrap JS Bundle (Popper.js included) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>