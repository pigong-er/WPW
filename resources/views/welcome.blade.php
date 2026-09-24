<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Alat Outdoor - GongStrak</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <style>
        :root {
            --brown-primary: #795548;
            --brown-dark: #5D4037;
            --brown-light: #EFEBE9;
            --brown-accent: #D7CCC8;
        }

        .text-success { color: var(--brown-primary) !important; }
        .bg-success { background-color: var(--brown-primary) !important; }
        .btn-success { background-color: var(--brown-primary) !important; border-color: var(--brown-primary) !important; color: white !important; }
        .btn-success:hover { background-color: var(--brown-dark) !important; }
        .btn-outline-success { color: var(--brown-primary) !important; border-color: var(--brown-primary) !important; }
        .btn-outline-success:hover { background-color: var(--brown-primary) !important; color: white !important; }

        .hero-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 90px 0;
            min-height: 70vh;
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
    </style>
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <div class="text-success fs-4"><i class="bi bi-tree-fill"></i></div>
                <span>GongStrak Outdoor</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active fw-medium" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#katalog">Katalog Alat</a></li>
                    <li class="nav-item"><a class="nav-link fw-medium" href="#kontak">Kontak</a></li>
                </ul>
                <a href="{{ url('/login') }}" class="btn btn-success px-4 rounded-pill shadow-sm d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i> Login Admin
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-extrabold mb-3 text-dark" style="font-weight: 800;">
                Sewa Alat Outdoor <span class="text-success">Cepat & Terjangkau</span>
            </h1>
            <p class="lead text-secondary mb-4 mx-auto" style="max-width: 600px;">
                Lengkapi kebutuhan petualangan Anda dengan peralatan camping dan hiking berkualitas tinggi.
            </p>
            <a href="#katalog" class="btn btn-success btn-lg rounded-pill px-5">
                Lihat Katalog Alat <i class="bi bi-arrow-down ms-2"></i>
            </a>
        </div>
    </section>

    <!-- Katalog Alat Section -->
    <section id="katalog" class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Katalog Peralatan Outdoor</h2>
                <p class="text-muted">Pilih alat yang Anda butuhkan untuk petualangan berikutnya.</p>
            </div>

            <div class="row g-4">
                @forelse($alat->filter(fn($item) => (int) $item->is_active === 1) as $item)
                <div class="col-md-4">
                    <div class="card feature-card h-100 border p-3">
                        @if($item->foto_alat)
                            <img src="{{ asset('storage/' . $item->foto_alat) }}" class="card-img-top rounded mb-3" alt="{{ $item->nama_alat }}" style="height: 220px; object-fit: cover;">
                        @else
                            <img src="https://images.unsplash.com/photo-1504280390467-336c7a40b904?w=500&auto=format" class="card-img-top rounded mb-3" alt="Default Image" style="height: 220px; object-fit: cover;">
                        @endif
                        <h5 class="fw-bold text-center">{{ $item->nama_alat }}</h5>
                        <p class="text-success fw-bold text-center fs-5 mb-3">
                            Rp {{ number_format($item->harga_sewa, 0, ',', '.') }} <small class="text-muted fs-6">/ hari</small>
                        </p>
                        <button class="btn btn-outline-success w-100 rounded-pill mt-auto" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                <!-- Modal Detail Alat -->
                <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-bold">Detail Alat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center pt-2">
                                @if($item->foto_alat)
                                    <img src="{{ asset('storage/' . $item->foto_alat) }}" class="img-fluid rounded mb-3" alt="{{ $item->nama_alat }}" style="max-height: 250px; object-fit: cover;">
                                @endif
                                <h4 class="fw-bold text-dark">{{ $item->nama_alat }}</h4>
                                <div class="p-2 my-2 rounded" style="background-color: var(--brown-light);">
                                    <h4 class="text-success fw-bold mb-0">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }} <span class="fs-6 text-muted">/ hari</span></h4>
                                </div>
                                <p class="text-secondary text-start mt-3">{{ $item->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}</p>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-success w-100 rounded-pill" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada katalog alat yang ditambahkan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="text-dark py-4" style="background-color: #D7CCC8;">
        <div class="container text-center">
            <h5 class="fw-bold mb-1"><i class="bi bi-tree-fill text-success me-2"></i> GongStrak Outdoor</h5>
            <p class="text-secondary small mb-0">&copy; 2026. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
