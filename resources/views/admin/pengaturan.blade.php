<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengaturan Profil - GongStrak</title>

    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <style>
        :root {
            --brown-sidebar: #3E2723;
            --brown-hover: #4E342E;
            --brown-accent: #D7CCC8;
            --brown-primary: #795548;
        }

        /* =====================================================
           NAVBAR & MENTOK KANAN
        ====================================================== */
        .navbar-custom {
            position: relative !important;
            width: 100% !important;
        }

        .navbar-actions {
            position: absolute !important;
            right: -40px !important; /* Angka negatif ini yang membuatnya ditarik benar-benar mentok ke kanan */
            top: 50% !important;
            transform: translateY(-50%) !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* =====================================================
           SIDEBAR COLLAPSED & KONTEN UTAMA
        ====================================================== */
        .sidebar-wrapper {
            transition: all 0.3s ease;
            overflow-x: hidden;
            background-color: var(--brown-sidebar) !important;
        }

        .main-wrapper {
            transition: all 0.3s ease;
        }

        #sidebar.collapsed,
        .sidebar-wrapper.collapsed {
            width: 80px !important;
        }

        #sidebar.collapsed ~ .main-wrapper,
        .sidebar-wrapper.collapsed ~ .main-wrapper {
            margin-left: 80px !important;
            width: calc(100% - 80px) !important;
        }

        /* =====================================================
           MENGHILANGKAN TEKS & MEMUSATKAN IKON SAAT MENGECIL
        ====================================================== */
        #sidebar.collapsed .sidebar-brand span,
        #sidebar.collapsed .sidebar-menu-link span,
        #sidebar.collapsed .sidebar-menu-title,
        #sidebar.collapsed .sidebar-profile-info {
            display: none !important;
        }

        #sidebar.collapsed .sidebar-menu-list {
            padding-left: 0 !important;
            margin: 0 !important;
        }

        #sidebar.collapsed .sidebar-menu-item {
            display: flex !important;
            justify-content: center !important;
            width: 100% !important;
        }

        #sidebar.collapsed .sidebar-brand {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            width: 100% !important;
        }

        #sidebar.collapsed .sidebar-menu-link {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            padding: 0 !important;
            width: 45px !important;
            height: 45px !important;
            margin: 0 auto 10px auto !important;
            border-radius: 10px !important;
        }

        #sidebar.collapsed .sidebar-menu-link i {
            margin: 0 !important;
            font-size: 1.3rem !important;
        }

        #sidebar.collapsed .sidebar-profile {
            justify-content: center !important;
            padding: 15px 0 !important;
            width: 100% !important;
        }

        #sidebar.collapsed .profile-sidebar-image {
            margin: 0 !important;
            display: block !important;
        }

        /* =====================================================
           STYLING DASAR BAWAAN
        ====================================================== */
        body {
            background-color: #f4f6f9;
        }

        .sidebar-menu-link.active {
            background-color: var(--brown-hover) !important;
            border-left-color: var(--brown-accent) !important;
            color: white !important;
        }

        .sidebar-menu-link.active i {
            color: var(--brown-accent) !important;
        }

        .sidebar-brand i {
            color: var(--brown-accent) !important;
            animation: none !important;
            transform: none !important;
        }

        .text-main {
            color: var(--brown-primary) !important;
        }

        .profile-setting-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            border: none;
        }

        .profile-image {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-navbar-image {
            width: 35px;
            height: 35px;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-sidebar-image {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 50%;
        }

        .sidebar-logo {
            width: 42px;
            height: 42px;
            object-fit: contain;
            flex-shrink: 0;
        }
    </style>
</head>

<body>

    {{-- USER YANG SEDANG LOGIN --}}
    @php
        $user = auth()->user();
    @endphp

    {{-- =========================================================
        SIDEBAR
    ========================================================== --}}
    <div class="sidebar-wrapper" id="sidebar">

        {{-- BRAND --}}
        <a href="{{ url('/admin') }}"
            class="sidebar-brand text-decoration-none d-flex align-items-center">
            <img
                src="{{ asset('assets/logo/lg.png') }}"
                alt="Logo GongStrak"
                class="sidebar-logo"
            >
            <span>GongStrak</span>
        </a>

        {{-- MENU --}}
        <div class="flex-grow-1 overflow-y-auto">

            {{-- MENU --}}
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title text-light opacity-75">
                    Menu
                </div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ url('/admin') }}" class="sidebar-menu-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- COMPONENTS --}}
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title text-light opacity-75">
                    Components
                </div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ url('/admin/katalog') }}" class="sidebar-menu-link">
                            <i class="bi bi-box-seam"></i>
                            <span>Katalog Alat</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- PAGES --}}
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title text-light opacity-75">
                    Pages
                </div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.pengaturan') }}" class="sidebar-menu-link active">
                            <i class="bi bi-person-gear"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ url('/login') }}" class="sidebar-menu-link">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Login Screen</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        {{-- PROFILE SIDEBAR DINAMIS --}}
        <div class="sidebar-profile d-flex align-items-center">
            @if($user && $user->foto_profil)
                <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Profile" class="profile-sidebar-image me-3">
            @else
                <i class="bi bi-person-circle fs-1 text-light opacity-50 me-3"></i>
            @endif

            <div class="sidebar-profile-info">
                <div class="sidebar-profile-name text-truncate" style="max-width: 120px;">
                    {{ $user->name ?? 'Administrator' }}
                </div>
                <div class="sidebar-profile-email text-truncate" style="max-width: 120px;">
                    {{ $user->username ?? 'admin' }}
                </div>
            </div>
        </div>

    </div>

    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <div class="main-wrapper">

        {{-- NAVBAR --}}
        <header class="navbar-custom">
            <div class="navbar-left">
                {{-- DESKTOP TOGGLE --}}
                <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
                    id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
                    <i class="bi bi-chevron-bar-left"></i>
                </button>

                {{-- MOBILE TOGGLE --}}
                <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            {{-- NAVBAR ACTIONS --}}
            <div class="navbar-actions">
                {{-- FULLSCREEN --}}
                <button class="navbar-action-btn me-1" aria-label="Toggle Fullscreen" id="btn-fullscreen">
                    <i class="bi bi-arrows-fullscreen"></i>
                </button>

                {{-- PROFILE DROPDOWN --}}
                <div class="dropdown ms-2">
                    <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" id="profile-dropdown">

                        @if($user && $user->foto_profil)
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Profile Image" class="navbar-profile-img profile-navbar-image">
                        @else
                            <i class="bi bi-person-circle fs-3 text-secondary"></i>
                        @endif

                        <span class="navbar-profile-name d-none d-md-inline">
                            {{ $user->name ?? 'Administrator' }}
                        </span>
                        <i class="bi bi-chevron-down navbar-profile-caret"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
                        <li class="dropdown-header">Welcome!</li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.pengaturan') }}">
                                <i class="bi bi-person"></i> My Account
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.pengaturan') }}">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-lock"></i> Lock Screen
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        {{-- PAGE CONTENT --}}
        <div class="p-4 mt-2">
            <div class="row">
                <div class="col-xl-8 col-lg-10 mx-auto">

                    {{-- SUCCESS --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- ERROR --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- PROFILE CARD --}}
                    <div class="card profile-setting-card">
                        <div class="card-body p-4 p-md-5">
                            <h4 class="fw-bold mb-2" style="color: #2b3445;">Pengaturan Akun</h4>
                            <p class="text-muted mb-4">Perbarui informasi profil dan kata sandi akun Anda di sini.</p>

                            <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- FOTO PROFIL --}}
                                <div class="d-flex align-items-center gap-4 mb-4 pb-4 border-bottom">
                                    <div>
                                        @if($user && $user->foto_profil)
                                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" class="profile-image shadow-sm">
                                        @else
                                            <i class="bi bi-person-circle" style="font-size: 5.5rem; color: #ced4da;"></i>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-2">Foto Profil</h6>
                                        <input type="file" class="form-control form-control-sm @error('foto_profil') is-invalid @enderror"
                                            name="foto_profil" accept="image/jpeg,image/png,image/jpg">
                                        @error('foto_profil')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted mt-2 d-block">Format: JPG, PNG, JPEG. Maksimal 2MB.</small>
                                    </div>
                                </div>

                                {{-- INFORMASI DASAR --}}
                                <h6 class="fw-bold mb-3 text-main">Informasi Dasar</h6>
                                <div class="row g-3 mb-4 pb-4 border-bottom">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                            value="{{ old('nama', $user->name ?? '') }}" placeholder="Masukkan nama lengkap" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Username</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username', $user->username ?? '') }}" placeholder="Masukkan username" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- PASSWORD --}}
                                <h6 class="fw-bold mb-3 text-main">Keamanan</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Kata Sandi Baru</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Kosongkan jika tidak ingin diubah">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Konfirmasi Kata Sandi Baru</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi baru">
                                    </div>
                                </div>

                                {{-- BUTTON --}}
                                <div class="mt-5 d-flex justify-content-end gap-2">
                                    <button type="reset" class="btn btn-light px-4">Batal</button>
                                    <button type="submit" class="btn btn-primary px-4" style="background-color: var(--brown-primary); border: none;">
                                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- BOOTSTRAP --}}
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- SCRIPT DASHBOARD BAWAAN (Fungsi toggle & fullscreen tersinkron dengan Admin) --}}
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

</body>
</html>
