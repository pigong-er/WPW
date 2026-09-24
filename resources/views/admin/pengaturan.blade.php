<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengaturan Profil - Admin Rental</title>

  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

  <style>
    /* TEMA BROWN UNTUK DASHBOARD ADMIN */
    :root {
        --brown-sidebar: #3E2723;
        --brown-hover: #4E342E;
        --brown-accent: #D7CCC8; /* Cream */
        --brown-primary: #795548;
    }

    body { background-color: #f4f6f9; }

    /* Sidebar Area */
    .sidebar-wrapper { background-color: var(--brown-sidebar) !important; }
    .sidebar-menu-link.active {
        background-color: var(--brown-hover) !important;
        border-left-color: var(--brown-accent) !important;
        color: white !important;
    }

    /* Mengubah warna icon menjadi cream saat menu aktif */
    .sidebar-menu-link.active i { color: var(--brown-accent) !important; }
    .sidebar-brand i {
        color: var(--brown-accent) !important;
        animation: none !important;
        transform: none !important;
    }

    /* Override */
    .text-main { color: var(--brown-primary) !important; }

    /* Custom Profile Card */
    .profile-setting-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border: none;
    }
  </style>
</head>

<body>
  <!-- Mengambil data user yang sedang login -->
  @php $user = auth()->user(); @endphp

  <!-- ==========================================
         START: Sidebar Component
         ========================================== -->
  <div class="sidebar-wrapper" id="sidebar">
    <a href="{{ url('/admin') }}" class="sidebar-brand text-decoration-none">
      <i class="bi bi-shop"></i>
      <span>GongStrak</span>
    </a>

    <div class="flex-grow-1 overflow-y-auto">
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title text-light opacity-75">Menu</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ url('/admin') }}" class="sidebar-menu-link" title="Dashboard">
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title text-light opacity-75">Components</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ url('/admin/katalog') }}" class="sidebar-menu-link" title="Katalog Alat">
              <i class="bi bi-box-seam"></i>
              <span>Katalog Alat</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title text-light opacity-75">Pages</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('admin.pengaturan') }}" class="sidebar-menu-link active" title="Pengaturan Profil">
              <i class="bi bi-person-gear"></i>
              <span>Pengaturan Profil</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ url('/login') }}" class="sidebar-menu-link" title="Login Screen">
              <i class="bi bi-box-arrow-in-right"></i>
              <span>Login Screen</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Sidebar Profile Card (Dinamis) -->
    <div class="sidebar-profile d-flex align-items-center">
      @if($user && $user->foto_profil)
          <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Profile" class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
      @else
          <i class="bi bi-person-circle fs-1 text-light opacity-50 me-3"></i>
      @endif
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name text-truncate" style="max-width: 120px;">{{ $user->name ?? 'Administrator' }}</div>
        <div class="sidebar-profile-email text-truncate" style="max-width: 120px;">{{ $user->username ?? 'admin' }}</div>
      </div>
    </div>
  </div>

  <!-- ==========================================
         START: Main Content Area
         ========================================== -->
  <div class="main-wrapper">

    <!-- START: Top Navbar Component -->
    <header class="navbar-custom">
      <div class="navbar-left">
        <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3" id="desktop-sidebar-toggle">
          <i class="bi bi-chevron-bar-left"></i>
        </button>
        <button class="sidebar-toggle-btn me-2" id="sidebar-toggle">
          <i class="bi bi-list"></i>
        </button>
      </div>

      <div class="navbar-search-wrapper">
        <input type="text" class="navbar-search-input" placeholder="Search anything in Spark..." id="main-search">
        <button class="navbar-search-btn"><i class="bi bi-search"></i></button>
      </div>

      <div class="navbar-actions">
        <button class="navbar-action-btn me-1" id="btn-fullscreen">
          <i class="bi bi-arrows-fullscreen"></i>
        </button>

        <div class="dropdown ms-2">
          <button class="navbar-profile-btn dropdown-toggle d-flex align-items-center gap-2 border-0 bg-transparent" type="button" data-bs-toggle="dropdown">
            @if($user && $user->foto_profil)
                <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Profile" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
            @else
                <i class="bi bi-person-circle fs-3 text-secondary"></i>
            @endif
            <span class="navbar-profile-name d-none d-md-inline">{{ $user->name ?? 'Administrator' }}</span>
            <i class="bi bi-chevron-down navbar-profile-caret"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile">
            <li class="dropdown-header">Welcome !</li>
            <li><a class="dropdown-item" href="{{ route('admin.pengaturan') }}"><i class="bi bi-person"></i> My Account</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.pengaturan') }}"><i class="bi bi-gear"></i> Settings</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-lock"></i> Lock Screen</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="{{ url('/') }}"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <div class="p-4">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb text-muted mb-0 small">
          <li class="breadcrumb-item"><i class="bi bi-house"></i> Home</li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active" aria-current="page">Pengaturan Profil</li>
        </ol>
      </nav>

      <div class="row">
        <!-- Kolom Utama Form Pengaturan -->
        <div class="col-xl-8 col-lg-10 mx-auto">

          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <div class="card profile-setting-card">
            <div class="card-body p-4 p-md-5">
              <h4 class="fw-bold mb-4" style="color: #2b3445;">Pengaturan Akun</h4>
              <p class="text-muted mb-4">Perbarui informasi profil dan kata sandi akun Anda di sini.</p>

              <!-- Form Update Profil -->
              <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Section Foto Profil -->
                <div class="d-flex align-items-center gap-4 mb-4 pb-4 border-bottom">
                  <div class="position-relative">
                    @if($user && $user->foto_profil)
                      <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" class="rounded-circle shadow-sm" style="width: 90px; height: 90px; object-fit: cover;">
                    @else
                      <i class="bi bi-person-circle" style="font-size: 5.5rem; color: #ced4da;"></i>
                    @endif
                  </div>
                  <div class="flex-grow-1">
                    <h6 class="fw-bold mb-2">Foto Profil</h6>
                    <input type="file" class="form-control form-control-sm w-100 @error('foto_profil') is-invalid @enderror" name="foto_profil" accept="image/*">
                    @error('foto_profil') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted mt-2 d-block">Format didukung: JPG, PNG, atau JPEG. Ukuran maksimal 2MB.</small>
                  </div>
                </div>

                <!-- Section Informasi Akun -->
                <h6 class="fw-bold mb-3 text-main">Informasi Dasar</h6>
                <div class="row g-3 mb-4 pb-4 border-bottom">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $user->name ?? '') }}" placeholder="Masukkan nama lengkap" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username ?? '') }}" placeholder="Masukkan username" required>
                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                </div>

                <!-- Section Kata Sandi -->
                <h6 class="fw-bold mb-3 text-main">Keamanan (Ubah Kata Sandi)</h6>
                <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Kata Sandi Baru</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Kosongkan jika tidak ingin diubah">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi kata sandi baru">
                  </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-5 d-flex justify-content-end gap-2">
                  <button type="reset" class="btn btn-light px-4">Batal</button>
                  <button type="submit" class="btn btn-primary px-4" style="background-color: var(--brown-primary); border: none;">
                    Simpan Perubahan
                  </button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Script Fallback UI -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const desktopToggle = document.getElementById('desktop-sidebar-toggle');
        const mobileToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');

        function toggleSidebar() {
            if(sidebar) {
                if (window.innerWidth < 1200) {
                    sidebar.classList.toggle('d-none');
                } else {
                    sidebar.classList.toggle('collapsed');
                }
            }
        }
        if(desktopToggle) desktopToggle.addEventListener('click', toggleSidebar);
        if(mobileToggle) mobileToggle.addEventListener('click', toggleSidebar);

        const btnFullscreen = document.getElementById('btn-fullscreen');
        if (btnFullscreen) {
            btnFullscreen.addEventListener('click', function() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                    this.innerHTML = '<i class="bi bi-fullscreen-exit"></i>';
                } else {
                    if (document.exitFullscreen) document.exitFullscreen();
                    this.innerHTML = '<i class="bi bi-arrows-fullscreen"></i>';
                }
            });
        }
    });
  </script>
</body>
</html>
