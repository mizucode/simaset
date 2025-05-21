<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Bantuan RuTiLahu - Perbaikan Rumah Untuk Layak Huni</title>
    <style>
        /* CSS Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Global Styles */
        body {
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        section {
            padding: 60px 0;
        }

        h1,
        h2,
        h3 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        p {
            margin-bottom: 15px;
        }

        ul {
            margin-bottom: 20px;
            padding-left: 20px;
        }

        li {
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #2980b9;
        }

        .text-center {
            text-align: center;
        }

        /* Header Styles */
        header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 20px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .logo span {
            color: #f1c40f;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #f1c40f;
        }

        /* Hero Section */
        .hero {
            background: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
            margin-top: 60px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: white;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        /* About Section */
        .about {
            background: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: #3498db;
            margin: 15px auto;
        }

        /* Target Section */
        .target {
            background: #f1f5f9;
        }

        .target-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .target-card {
            background: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .target-card:hover {
            transform: translateY(-10px);
        }

        .target-card h3 {
            color: #3498db;
        }

        /* Help Section */
        .help-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .help-item {
            background: #f8f9fa;
            padding: 20px;
            border-left: 4px solid #3498db;
        }

        /* Process Section */
        .process-steps {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .step {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .step-number {
            background: #3498db;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        /* Benefits Section */
        .benefits {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
        }

        .benefits h2,
        .benefits h3 {
            color: white;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .benefit-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 5px;
            backdrop-filter: blur(5px);
        }

        /* Implementation Section */
        .implementation {
            background: white;
        }

        /* CTA Section */
        .cta {
            background: #f1c40f;
            text-align: center;
            padding: 80px 0;
        }

        .cta h2 {
            color: #2c3e50;
        }

        .cta .btn {
            background: #2c3e50;
            font-size: 18px;
            padding: 15px 30px;
        }

        .cta .btn:hover {
            background: #34495e;
        }

        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            padding: 40px 0 20px;
            text-align: center;
        }

        .footer-logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer-logo span {
            color: #f1c40f;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
        }

        .footer-links a:hover {
            color: #f1c40f;
        }

        .copyright {
            margin-top: 20px;
            font-size: 14px;
            color: #bdc3c7;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
            }

            nav ul {
                margin-top: 20px;
            }

            nav ul li {
                margin: 0 10px;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero p {
                font-size: 18px;
            }

            section {
                padding: 40px 0;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">RuTi<span>Lahu</span></div>
            <nav>
                <ul>
                    <li><a href="#about">Tentang Program</a></li>
                    <li><a href="#target">Sasaran</a></li>
                    <li><a href="#help">Bantuan</a></li>
                    <li><a href="#process">Proses</a></li>
                    <li><a href="#contact">Kontak</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Program Bantuan RuTiLahu</h1>
            <p>Membantu keluarga kurang mampu di desa meningkatkan kualitas hidup dengan memperbaiki kondisi rumah mereka.</p>
            <a href="#contact" class="btn">Daftar Sekarang</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <h2 class="section-title">Tentang Program</h2>
            <p>Program Bantuan RuTiLahu (Rumah Tinggal Layak Huni) bertujuan untuk membantu keluarga kurang mampu di desa meningkatkan kualitas hidup mereka dengan memperbaiki kondisi rumah mereka. Program ini fokus pada perbaikan atap, lantai, dan dinding rumah, serta memberikan bantuan kepada keluarga yang terkena bencana.</p>
            <p>Dengan program ini, diharapkan keluarga kurang mampu di desa dapat memiliki rumah yang layak huni dan meningkatkan kualitas hidup mereka.</p>
        </div>
    </section>

    <!-- Target Section -->
    <section id="target" class="target">
        <div class="container">
            <h2 class="section-title">Sasaran Program</h2>
            <div class="target-grid">
                <div class="target-card">
                    <h3>Keluarga Kurang Mampu</h3>
                    <p>Keluarga kurang mampu di desa yang memiliki rumah dengan kondisi tidak layak huni. Program ini akan membantu mereka untuk memperbaiki kondisi rumah sehingga lebih nyaman dan aman untuk ditinggali.</p>
                </div>
                <div class="target-card">
                    <h3>Korban Bencana</h3>
                    <p>Keluarga yang terkena bencana dan membutuhkan bantuan untuk memperbaiki rumah mereka. Kami memberikan prioritas kepada keluarga yang rumahnya rusak akibat bencana alam.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Help Section -->
    <section id="help" class="help">
        <div class="container">
            <h2 class="section-title">Bentuk Bantuan</h2>
            <div class="help-items">
                <div class="help-item">
                    <h3>Perbaikan Atap</h3>
                    <p>Perbaikan atap rumah yang bocor atau rusak dengan material yang berkualitas untuk melindungi dari cuaca ekstrim.</p>
                </div>
                <div class="help-item">
                    <h3>Perbaikan Lantai</h3>
                    <p>Perbaikan lantai rumah yang rusak atau tidak rata untuk meningkatkan kenyamanan dan keamanan penghuni.</p>
                </div>
                <div class="help-item">
                    <h3>Perbaikan Dinding</h3>
                    <p>Perbaikan dinding rumah yang retak atau rusak untuk memperkuat struktur rumah.</p>
                </div>
                <div class="help-item">
                    <h3>Material & Tenaga Kerja</h3>
                    <p>Penyediaan material dan tenaga kerja untuk memperbaiki rumah sesuai dengan kebutuhan keluarga.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="process">
        <div class="container">
            <h2 class="section-title">Proses Seleksi</h2>
            <div class="process-steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Pendaftaran</h3>
                        <p>Keluarga yang ingin mendapatkan bantuan harus memenuhi kriteria yang ditentukan oleh desa dan mendaftarkan diri melalui perangkat desa.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Seleksi</h3>
                        <p>Keluarga yang memenuhi kriteria akan diseleksi berdasarkan kebutuhan dan prioritas oleh tim dari desa.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Penyaluran Bantuan</h3>
                        <p>Keluarga yang terpilih akan mendapatkan bantuan perbaikan rumah sesuai dengan kebutuhan mereka.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits">
        <div class="container">
            <h2 class="section-title">Manfaat Program</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h3>Kualitas Hidup Lebih Baik</h3>
                    <p>Meningkatkan kualitas hidup keluarga kurang mampu di desa dengan memberikan rumah yang layak huni.</p>
                </div>
                <div class="benefit-card">
                    <h3>Rumah yang Aman dan Nyaman</h3>
                    <p>Meningkatkan keamanan dan kenyamanan rumah keluarga kurang mampu sehingga mereka bisa hidup lebih tenang.</p>
                </div>
                <div class="benefit-card">
                    <h3>Pemulihan Pasca Bencana</h3>
                    <p>Membantu keluarga yang terkena bencana untuk memperbaiki rumah mereka dan kembali ke kehidupan normal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Implementation Section -->
    <section id="implementation" class="implementation">
        <div class="container">
            <h2 class="section-title">Implementasi Program</h2>
            <p>Program ini akan diimplementasikan oleh desa dengan bantuan tenaga kerja lokal dan material yang tersedia di desa. Desa akan memantau dan mengevaluasi program untuk memastikan bahwa bantuan yang diberikan efektif dan efisien.</p>
            <p>Kami juga melibatkan masyarakat dalam proses pelaksanaan program untuk menciptakan rasa memiliki dan keberlanjutan program.</p>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Siap Mengajukan Permohonan Bantuan?</h2>
            <p>Jika Anda atau keluarga Anda memenuhi kriteria, segera ajukan permohonan bantuan melalui perangkat desa setempat.</p>
            <a href="#contact" class="btn">Hubungi Kami</a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 class="section-title">Kontak Kami</h2>
            <div class="text-center">
                <p>Untuk informasi lebih lanjut tentang Program Bantuan RuTiLahu, silakan hubungi:</p>
                <p><strong>Kantor Desa setempat</strong></p>
                <p>Atau melalui email: <strong>rutilahu@desa.id</strong></p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-logo">RuTi<span>Lahu</span></div>
            <div class="footer-links">
                <a href="#about">Tentang</a>
                <a href="#target">Sasaran</a>
                <a href="#help">Bantuan</a>
                <a href="#process">Proses</a>
                <a href="#contact">Kontak</a>
            </div>
            <p class="copyright">&copy; 2023 Program Bantuan RuTiLahu. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>

</html>