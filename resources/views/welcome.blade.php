<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Gong Strak - Frontend</title>

    <!-- Favicon (Opsional) -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Memanggil CSS dari template Spark Admin -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <style>
        /* Override Tema Warna ke Brown */
        :root {
            --brown-primary: #795548;
            --brown-dark: #5D4037;
            --brown-light: #EFEBE9;
            --brown-accent: #D7CCC8;
        }

        .text-success { color: var(--brown-primary) !important; }
        .bg-success { background-color: var(--brown-primary) !important; }
        .border-success { border-color: var(--brown-primary) !important; }
        .btn-success { background-color: var(--brown-primary) !important; border-color: var(--brown-primary) !important; color: white !important; }
        .btn-success:hover { background-color: var(--brown-dark) !important; border-color: var(--brown-dark) !important; }
        .btn-outline-success { color: var(--brown-primary) !important; border-color: var(--brown-primary) !important; }
        .btn-outline-success:hover { background-color: var(--brown-primary) !important; color: white !important; }
        .alert-success { background-color: var(--brown-light) !important; border-color: var(--brown-accent) !important; color: var(--brown-dark) !important; }

        /* Custom Styling tambahan khusus untuk Frontend agar lebih manis */
        .hero-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 100px 0;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 1rem;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .icon-box {
            width: 60px;
            height: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background-color: #EFEBE9; /* Ubah ke cokelat muda */
            color: #795548; /* Ubah ke cokelat utama */
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .navbar-frontend {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-light">

    <!-- START: Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-frontend sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <div class="text-success fs-4"><i class="bi bi-shop"></i></div>
                <span>Gong Strak</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active fw-medium" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#fitur">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#kontak">Kontak</a></li>
                </ul>
                <div class="d-flex mt-3 mt-lg-0">
                    <a href="{{ url('/login') }}" class="btn btn-success px-4 rounded-pill shadow-sm d-flex align-items-center gap-2">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk ke Sistem
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Navbar -->

    <!-- START: Hero Section -->
    <section class="hero-section position-relative overflow-hidden">
        <div class="container relative z-index-2">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge bg-success bg-opacity-10 text-white mb-3 px-3 py-2 rounded-pill border border-success border-opacity-25">
                        <i class="bi bi-stars"></i> Versi 1.0 Dirilis
                    </span>
                    <h1 class="display-4 fw-extrabold mb-4 text-dark" style="font-weight: 800;">
                        Kelola Store Lebih <span class="text-success">Cepat & Akurat</span>
                    </h1>
                    <p class="lead text-secondary mb-5">
                        Sistem Point of Sale (POS) modern yang dirancang khusus untuk mempermudah pencatatan transaksi, manajemen stok barang, dan pemantauan status toko secara real-time.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="{{ url('/login') }}" class="btn btn-success btn-lg rounded-pill px-5">
                            Mulai Gunakan <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        <a href="#fitur" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                            Pelajari Fitur
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Ornamen visual yang memanfaatkan warna hijau khas template Anda -->
                    <div class="position-relative p-4 p-md-5 bg-white shadow-lg rounded-4 border-top border-success border-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Statistik Harian</h5>
                            <i class="bi bi-three-dots text-muted"></i>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <div class="text-muted small mb-1">Total Penjualan</div>
                                    <div class="fs-4 fw-bold text-success">Rp 4.250.000</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <div class="text-muted small mb-1">Transaksi</div>
                                    <div class="fs-4 fw-bold text-dark">142</div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-success d-flex align-items-center mb-0" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <div>Status Toko: <strong>Buka</strong> - Sistem berjalan lancar.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ornamen Background -->
        <div class="position-absolute top-0 end-0 opacity-25" style="transform: translate(20%, -20%); z-index: 1;">
            <svg width="400" height="400" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Ubah fill color ke cokelat utama -->
                <circle cx="50" cy="50" r="50" fill="#795548" />
            </svg>
        </div>
    </section>
    <!-- END: Hero Section -->

    <!-- START: Features Section -->
    <section id="fitur" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Fitur Utama Aplikasi</h2>
                <p class="text-muted">Semua yang Anda butuhkan untuk operasional kasir sehari-hari.</p>
            </div>

            <div class="row g-4">
                <!-- Fitur 1 -->
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-4">
                        <div class="icon-box">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <h5 class="fw-bold">Transaksi Cepat</h5>
                        <p class="text-muted mb-0">Antarmuka kasir yang responsif untuk memproses pembayaran pelanggan tanpa hambatan.</p>
                    </div>
                </div>
                <!-- Fitur 2 -->
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-4">
                        <div class="icon-box">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h5 class="fw-bold">Manajemen Stok</h5>
                        <p class="text-muted mb-0">Pantau ketersediaan barang secara akurat dan dapatkan notifikasi saat stok mulai menipis.</p>
                    </div>
                </div>
                <!-- Fitur 3 -->
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-4">
                        <div class="icon-box">
                            <i class="bi bi-clipboard-data"></i>
                        </div>
                        <h5 class="fw-bold">Laporan Terpusat</h5>
                        <p class="text-muted mb-0">Hasil rekap penjualan dan ringkasan operasional toko yang disajikan dalam dashboard yang rapi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: Features Section -->

    <!-- START: Footer -->
    <footer id="kontak" class="text-dark py-4"
    style="background-color: #D7CCC8";">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <h5 class="fw-bold mb-1"><i class="bi bi-shop text-success me-2"></i> Gong Strak</h5>
                    <p class="text-secondary small mb-0">&copy; 2026. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-secondary me-3 text-decoration-none"><i class="bi bi-github fs-5"></i></a>
                    <a href="#" class="text-secondary text-decoration-none"><i class="bi bi-globe fs-5"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- END: Footer -->

    <!-- Local Third-Party Libraries Script -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
