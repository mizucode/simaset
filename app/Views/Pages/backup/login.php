<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>SIMASET | UM Kuningan</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/flaticon.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
  <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- main css -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/info.css" />
</head>

<body>
  <!--================ Start Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <div class="search_input" id="search_input_box">
        <div class="container">
          <form class="d-flex justify-content-between" method="" action="">
            <input
              type="text"
              class="form-control"
              id="search_input"
              placeholder="Cari Disini.." />
            <button type="submit" class="btn"></button>
            <span
              class="ti-close"
              id="close_search"
              title="Close Search"></span>
          </form>
        </div>
      </div>

      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.html"><img logo src="img/logo/sim.svg" alt="" /></a>

          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="icon-bar"></span> <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div
            class="collapse navbar-collapse offset"
            id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Beranda</a>
              </li>
              <!-- <li class="nav-item">
                  <a class="nav-link" href="about-us.html">Profil</a>
                </li> -->
              <li class="nav-item">
                <a class="nav-link" href="#">Informasi</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">FAQ</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link search" id="search">
                  <i class="ti-search"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>


  </header>
  <!--================ End Header Menu Area =================-->

  <div class="section_gap registration_area">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <div class="row clock_sec clockdiv" id="clockdiv">
            <div class="col-lg-12">
              <span class="mobile-break"></span>
              <h1 class="mb-3">Selamat Datang Di SIMASET</h1>
              <h6 class="si-text si-text__heading-6 si-text--bold m-0">Anda tetap dapat masuk dengan nama pengguna &amp; kata sandi
                yang sama</h6><br>
              Platform SIM hadir untuk mempermudah dalam pelaporan sesuai program kerja unit masing-masing.
              </p>
            </div>
          </div>

        </div>
        <div class="col-lg-4 offset-lg-1">
          <div class="register_form">
            <h3>Masuk Ke Akun</h3>
            <p>Sistem Aset dan Inventori</p>
            <?php if (isset($_SESSION['error'])): ?>
              <p style="color: red;"><?= $_SESSION['error'];
                                      unset($_SESSION['error']); ?></p>
            <?php endif; ?>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form class="form_area" action="/login" method="POST">
              <div class="row">
                <div class="col-lg-12 form_group">
                  <input name="username" placeholder="Nama Pengguna" required="" type="text">
                  <input name="password" placeholder="Kata Sandi" required="" type="password">
                  <!-- <div class="captcha_container">
                    <img src="captcha.php" alt="Captcha Image" class="captcha_image">

                    <button type="button" class="refresh_captcha">↻</button>
                    <input type="text" name="captcha_input" placeholder="Kode Verifikasi" required>
                  </div> -->

                </div>

                <div class="col-lg-12 text-center">
                  <button type="submit" class="primary-btn">Masuk</button>
                </div>

                <div class="col-lg-12 text-center mt-3">
                  <a href="#" class="btn btn-link">Panduan Penggunaan Aplikasi SIM</a>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="about_area section_gap">
    <div class="container">
      <div class="row h_blog_item">
        <div class="col-lg-6">
          <div class="h_blog_img">
            <img class="img-fluid" src="img/about-edit.png" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="h_blog_text">
            <div class="h_blog_text_inner left right">
              <h4>Sistem Informasi Manajemen (SIM)</h4>
              <p>
                Platform aplikasi yang dapat membantu proses ....
              </p>
              <p>
              <ul>
                <li>..</li>
                <li>..</li>
                <li>..</li>
                <li>..</li>
              </ul>
              </p>
              <a class="primary-btn" href="#">
                Info Selengkapnya <i class="ti-arrow-right ml-1"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Floating Notification -->
  <div id="notification" class="floating-alert alert alert-success " role="alert">
    <div>
      <!-- icon info -->
      <i class="fa fa-info-circle" aria-hidden="true"></i>
      <strong>Info!</strong> Pengisian sampai dengan 12 Februari 2025, Review 14 Februari - Revisi 15 Februari 2025.

      <!-- button -->
      <a href="https://example.com" class="btn btn-link" target="_blank">Selengkapnya<i class="ti-arrow-right ml-1"></i></a>
    </div>
    <br>

    <!-- close -->
    <button class="close-alert" onclick="closeNotification()">&times;</button>

  </div>

  <script>
    function closeNotification() {
      document.getElementById("notification").style.display = "none";
    }
  </script>


  <!--================ Start footer Area  =================-->
  <footer class="footer-area">
    <div class="container">

      <div class="row footer-bottom d-flex justify-content-between mt-0">
        <a href="https://www.umkuningan.ac.id">
          <img src="img/logo footer.png" alt="Situs Resmi" class="icon-footer-logo">
        </a>
        <p class="col-lg-8 col-sm-12 footer-text m-0 text-black">
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright ©<script>
            document.write(new Date().getFullYear());
          </script> Universitas Muhammadiyah Kuningan | Lembaga Pembangunan, Pengembangan Teknologi dan Sistem Informasi
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
        <div class="col-lg-4 col-sm-12 footer-social">
          <a href="https://www.facebook.com/umkuningan"><i class="ti-facebook"></i></a>
          <a href="https://www.instagram.com/umkuningan"><i class="ti-instagram"></i></a>
          <a href="https://www.x.com/umkuningan/">
            <img src="img/x-twitter.png" alt="Twitter" class="icon-x-twitter">
          </a>
          <a href="https://www.youtube.com/@umkuningan"><i class="ti-youtube"></i></a>
        </div>

      </div>
    </div>
  </footer>

  <!--================ End footer Area  =================-->


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="js/owl-carousel-thumb.min.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/mail-script.js"></script>
  <!--gmaps Js-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
  <script src="js/gmaps.min.js"></script>
  <script src="js/theme.js"></script>
  <script src="js/info.js"></script>

  <script>
    document.querySelector('.refresh_captcha').addEventListener('click', function() {
      const captchaImage = document.querySelector('.captcha_image');
      captchaImage.src = 'captcha.php?' + Date.now(); // Pakai timestamp untuk hindari cache
    });
  </script>


</body>

</html>