<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GongStrak - Premium Bootstrap 5 Admin Dashboard Template</title>

  <!-- SEO Optimization -->
  <meta name="description" content="GongStrak - Premium Bootstrap 5 Admin Dashboard Template">
  <meta name="author" content="GongStrak Team">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/images/favicon.ico">

  <!-- Local Third-Party Libraries (100% Offline Compatible) -->
  <link rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/libs/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/libs/apexcharts/apexcharts.css">
  <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css">

  <!-- Main Design System & Custom Stylesheet -->
  <link rel="stylesheet" href="assets/css/main.css">

  <style>
    /* TEMA BROWN UNTUK DASHBOARD ADMIN */
    :root {
        --brown-sidebar: #3E2723;
        --brown-hover: #4E342E;
        --brown-accent: #D7CCC8; /* Warna Cream */
        --brown-primary: #795548;
    }

    /* Sidebar Area */
    .sidebar-wrapper { background-color: var(--brown-sidebar) !important; }

    .sidebar-menu-link.active {
        background-color: var(--brown-hover) !important;
        border-left-color: var(--brown-accent) !important;
        color: white !important;
    }

    /* Mengubah warna icon menjadi cream saat menu aktif/dipencet */
    .sidebar-menu-link.active i {
        color: var(--brown-accent) !important;
    }

    .sidebar-brand i {
        color: var(--brown-accent) !important;
        animation: none !important;
        transform: none !important;
    }

    /* Utilities & Overrides */
    .text-main { color: var(--brown-primary) !important; }
    .text-muted-green { color: #8D6E63 !important; }
    .bg-lime-accent { background-color: var(--brown-accent) !important; }
    .bg-forest-light { background-color: #EFEBE9 !important; }
    .text-lime { color: var(--brown-sidebar) !important; }
    .bg-forest-medium { background-color: var(--brown-primary) !important; }

    /* Dashboard specific elements */
    .alert-green-card { background-color: var(--brown-primary) !important; }
    .alert-green-badge { background-color: var(--brown-sidebar) !important; color: white !important;}
    .promo-banner-card { background-color: var(--brown-sidebar) !important; color: white; }
    .btn-promo { background-color: var(--brown-accent) !important; color: var(--brown-sidebar) !important; }

    .btn-quick-action:hover,
    .btn-quick-action:focus,
    .btn-quick-action[aria-expanded="true"] {
        background-color: var(--brown-hover) !important;
        color: white !important;
    }

    .navbar-custom {
        position: relative !important;
        width: 100% !important;
    }

    .navbar-actions {
        position: absolute !important;
        right: -40px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        margin: 0 !important;
        padding: 0 !important;
    }
  </style>
</head>

<body>

  <!-- ==========================================
         START: Sidebar Component
         ========================================== -->
  <div class="sidebar-wrapper" id="sidebar">
    <!-- Brand Logo / Identity -->
    <a href="index.html" class="sidebar-brand text-decoration-none">
      <i class="bi bi-shop"></i>
      <span>GongStrak</span>
    </a>

    <!-- Navigation Menu -->
    <div class="flex-grow-1 overflow-y-auto">
      <!-- Group: Menu -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title text-light opacity-75">Menu</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="index.html" class="sidebar-menu-link active" id="menu-overview" title="Overview">
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Group: Components -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title text-light opacity-75">Components</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ url('/admin/katalog') }}" class="sidebar-menu-link" id="menu-katalog" title="Katalog Alat">
              <i class="bi bi-box-seam"></i>
              <span>Katalog Alat</span>
            </a>
          </li>
        </ul>
      </div>

      <!-- Group: Pages -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title text-light opacity-75">Pages</div>
        <ul class="sidebar-menu-list">
          <!-- Menu Baru: Pengaturan Profil -->
          <li class="sidebar-menu-item">
            <a href="{{ url('/admin/pengaturan') }}" class="sidebar-menu-link" id="menu-pengaturan" title="Pengaturan Profil">
              <i class="bi bi-person-gear"></i>
              <span>Pengaturan Profil</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ url('/login') }}" class="sidebar-menu-link" id="menu-loginpage" title="Login Page">
              <i class="bi bi-box-arrow-in-right"></i>
              <span>Login Screen</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Sidebar Profile Card (Dynamic Footer) -->
    <div class="sidebar-profile">
      <img src="assets/images/avatar.png" alt="Administrator" class="sidebar-profile-img"
        onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name">Administrator</div>
        <div class="sidebar-profile-email">admin@email.com</div>
      </div>
    </div>
  </div>
  <!-- ==========================================
         END: Sidebar Component
         ========================================== -->


  <!-- ==========================================
         START: Main Content Area
         ========================================== -->
  <div class="main-wrapper">

    <!-- START: Top Navbar Component -->
    <header class="navbar-custom">
      <div class="navbar-left">
        <!-- Desktop sidebar toggle (visible on large screens only) -->
        <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
          id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
          <i class="bi bi-chevron-bar-left"></i>
        </button>
        <!-- Mobile sidebar toggle -->
        <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
          <i class="bi bi-list"></i>
        </button>
      </div>

      <!-- Right actions -->
      <div class="navbar-actions">
        <!-- Fullscreen Toggle -->
        <button class="navbar-action-btn me-1" aria-label="Toggle Fullscreen" id="btn-fullscreen">
          <i class="bi bi-arrows-fullscreen"></i>
        </button>

        <!-- Profile Dropdown -->
        <div class="dropdown ms-2">
          <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false" id="profile-dropdown">
            <img src="assets/images/avatar.png" alt="Profile Image" class="navbar-profile-img">
            <span class="navbar-profile-name d-none d-md-inline">Administrator</span>
            <i class="bi bi-chevron-down navbar-profile-caret"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
            <li class="dropdown-header">Welcome !</li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> My Account</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-lock"></i> Lock Screen</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <!-- Ubah href di baris ini untuk kembali ke Frontend -->
            <li><a class="dropdown-item text-danger" href="{{ url('/') }}"><i class="bi bi-box-arrow-right"></i>
              Logout</a></li>
        </ul>
        </div>
      </div>
    </header>
    <!-- END: Top Navbar Component -->

    <!-- START: Dashboard Header Banner -->
    <div class="page-header">
      <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">An easy way to manage sales with care and precision.</p>
      </div>
      <button class="btn-date-picker" type="button" id="date-picker-trigger">
        <i class="bi bi-calendar4-event"></i>
        <span id="selected-date-range">January 12, 2026 - January 23, 2026</span>
        <i class="bi bi-chevron-down ms-1"></i>
      </button>
    </div>
    <!-- END: Dashboard Header Banner -->

    <!-- START: Main Layout Grid (1 Column: Top Dashboard Stat) -->
    <div class="row g-4">

      <!-- TOP AREA: Quick Info Stat Cards Row (Full Width) -->
      <div class="col-12">
        <div class="row g-4">

          <!-- Stat Card 1: Total Web Dilihat -->
          <div class="col-md-4">
            <div class="card bg-forest-light border-0 shadow-sm p-4 h-100" style="border-left: 5px solid var(--brown-primary) !important;">
                <div class="d-flex align-items-center gap-4 h-100">
                    <div class="bg-white p-3 rounded-circle text-center d-flex align-items-center justify-content-center shadow-sm" style="color: var(--brown-primary); width: 65px; height: 65px;">
                        <i class="bi bi-eye-fill fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-medium text-uppercase">Total Web Dilihat</span>
                        <h2 class="fw-bold mb-0 text-dark mt-1">1.452 <small class="fs-6 fw-normal text-muted">Kali</small></h2>
                    </div>
                </div>
            </div>
          </div>

        </div>
      </div>
      <!-- END: TOP AREA -->

    </div>
    <!-- END: Main Layout Grid -->

  </div>
  <!-- ==========================================
         END: Main Content Area
         ========================================== -->

  <!-- Local Third-Party Libraries Script dependencies -->
  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
  <script src="assets/libs/flatpickr/flatpickr.min.js"></script>

  <!-- Local dashboard interactions controller -->
  <script src="assets/js/dashboard.js"></script>
</body>

</html>
