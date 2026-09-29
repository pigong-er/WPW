<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Alat - Admin Rental</title>

  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

  <style>
    /* TEMA BROWN */
    :root {
        --brown-sidebar: #3E2723;
        --brown-hover: #4E342E;
        --brown-accent: #D7CCC8;
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

    /* Override Navbar / Utils */
    .text-main { color: var(--brown-primary) !important; }

    /* Custom Table Styling */
    .table-container {
        background: #fff;
        padding: 24px;
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(62, 39, 35, 0.08);
        border: 1px solid #eee7e4;
    }

    .catalog-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 18px;
    }

    .catalog-title {
        margin: 0;
        color: #2b3445;
        font-size: 1.35rem;
        font-weight: 700;
    }

    .catalog-add-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-width: 104px;
        border-radius: 9px;
        padding: 9px 16px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.18);
    }

    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e7e9ec;
    }

    .table-custom {
        margin-bottom: 0 !important;
    }

    .table-custom th {
        background-color: #f7f8fa;
        color: #596273;
        font-weight: 600;
        white-space: nowrap;
        font-size: 0.78rem;
        letter-spacing: 0.03em;
        padding: 14px 12px;
    }

    .table-custom td {
        vertical-align: middle;
        padding: 14px 12px;
        border-color: #eceff2;
    }

    .table-custom tbody tr {
        transition: background-color 0.15s ease;
    }

    .table-custom tbody tr:hover {
        background-color: #fcfaf9;
    }

    /* Search & Pagination */
    .catalog-pagination .page-link {
        color: var(--brown-primary);
        border-color: #dee2e6;
        cursor: pointer;
    }
    .catalog-pagination .page-item.active .page-link {
        background-color: var(--brown-primary);
        border-color: var(--brown-primary);
        color: #fff;
    }
    .catalog-pagination .page-item.disabled .page-link {
        cursor: not-allowed;
        opacity: .6;
    }

    .btn-action-edit { background-color: #795548; color: #fff; border: none; font-size: 0.85rem; padding: 6px 11px; border-radius: 7px; }
    .btn-action-edit:hover { background-color: #795548; color: #fff; }
    .btn-action-delete { background-color: #dc3545; color: #fff; border: none; font-size: 0.85rem; padding: 6px 11px; border-radius: 7px; }
    .btn-action-delete:hover { background-color: #c82333; color: #fff; }

    .pagination-wrapper {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 18px;
        padding-bottom: 2px;
    }

    @media (max-width: 768px) {
        .catalog-header {
            flex-direction: column;
            align-items: stretch;
        }

        .catalog-add-btn {
            width: 100%;
        }

        .pagination-wrapper {
            justify-content: center;
        }
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

  @php
      $user = auth()->user();
  @endphp

  <!-- ==========================================
         START: Sidebar Component
         ========================================== -->
  <div class="sidebar-wrapper" id="sidebar">
    <a href="{{ url('/admin') }}"
        class="sidebar-brand text-decoration-none d-flex align-items-center">
        <img
            src="{{ asset('assets/logo/lg.png') }}"
            alt="Logo GongStrak"
            class="sidebar-logo"
        >
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
            <a href="{{ url('/admin/katalog') }}" class="sidebar-menu-link active" title="Katalog Alat">
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
            <a href="{{ url('/admin/pengaturan') }}" class="sidebar-menu-link" title="Pengaturan Profil">
              <i class="bi bi-person-gear"></i>
              <span>Pengaturan</span>
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

        <!-- Sidebar Profile Card (Dynamic Footer) -->
    <div class="sidebar-profile">
      @if($user && $user->foto_profil)
        <img
          src="{{ asset('storage/' . $user->foto_profil) }}"
          alt="Profile"
          class="sidebar-profile-img">
      @else
        <img
          src="{{ asset('assets/images/profile.jpg') }}"
          alt="Profile"
          class="sidebar-profile-img">
      @endif

      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name text-truncate">
          {{ $user->name ?? 'Administrator' }}
        </div>
        <div class="sidebar-profile-email text-truncate">
          {{ $user->username ?? 'admin' }}
        </div>
      </div>
    </div>
  </div>

  <!-- ==========================================
         START: Main Content Area
         ========================================== -->
  <div class="main-wrapper">

    <!-- START: Top Navbar Component (DISAMAKAN DENGAN DASHBOARD) -->
    <header class="navbar-custom">
      <div class="navbar-left">
        <!-- Desktop sidebar toggle -->
        <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
          id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
          <i class="bi bi-chevron-bar-left"></i>
        </button>
        <!-- Mobile sidebar toggle -->
        <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
          <i class="bi bi-list"></i>
        </button>
      </div>

      <!-- Mid navbar: search pill -->
      <div class="navbar-search-wrapper">
        <input type="text" class="navbar-search-input" placeholder="Cari nama produk..." id="main-search" autocomplete="off">
        <button class="navbar-search-btn" aria-label="Search">
          <i class="bi bi-search"></i>
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
            @if($user && $user->foto_profil)
              <img
                src="{{ asset('storage/' . $user->foto_profil) }}"
                alt="Profile Image"
                class="navbar-profile-img">
            @else
              <img
                src="{{ asset('assets/images/profile.jpg') }}"
                alt="Profile Image"
                class="navbar-profile-img">
            @endif
            <span class="navbar-profile-name d-none d-md-inline">
              {{ $user->name ?? 'Administrator' }}
            </span>
            <i class="bi bi-chevron-down navbar-profile-caret"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
            <li class="dropdown-header">Welcome !</li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> My Account</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-lock"></i> Lock Screen</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="{{ url('/') }}"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </header>
    <!-- END: Top Navbar Component -->

    <!-- Page Content -->
    <div class="p-4">

      <!-- Breadcrumb & Header -->
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb text-muted mb-0 small">
          <li class="breadcrumb-item"><i class="bi bi-house"></i> Home</li>
          <li class="breadcrumb-item">Products</li>
          <li class="breadcrumb-item active" aria-current="page">Table Product</li>
        </ol>
      </nav>

      <div class="table-container">
        <div class="catalog-header">
          <h4 class="catalog-title">Data Produk</h4>

          <button id="addProductButton" class="btn btn-primary catalog-add-btn" style="background-color: #4E342E; border: none;" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah
          </button>
        </div>

        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <div class="table-responsive">
          <table class="table table-bordered table-hover table-custom align-middle mb-0">
            <thead>
              <tr>
                <th width="5%">ID</th>
                <th width="15%">Nama Alat</th>
                <th width="25%">Deskripsi</th>
                <th width="15%">Harga Sewa/Hari</th>
                <th width="10%" class="text-center">Is Active</th>
                <th width="10%" class="text-center">Foto</th>
                <th width="15%" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody id="productTableBody">
              @forelse($alat as $item)
              <tr class="product-row" data-search="{{ strtolower($item->id . ' ' . $item->nama_alat . ' ' . ($item->deskripsi ?? '')) }}" data-created-at="{{ optional($item->created_at)->timestamp ?? 0 }}">
                <td>{{ $alat->count() - $loop->iteration + 1 }}</td>
                <td class="fw-medium">{{ $item->nama_alat }}</td>
                <td><small class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</small></td>
                <td>{{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                <td class="text-center">
                    @if($item->is_active == 1)
                        <span class="badge bg-light text-dark border">Yes</span>
                    @else
                        <span class="badge bg-light text-muted border">No</span>
                    @endif
                </td>
                <td class="text-center">
                  @if($item->foto_alat)
                      <img src="{{ asset('storage/' . $item->foto_alat) }}" class="rounded shadow-sm" alt="img" style="width: 50px; height: 50px; object-fit: cover;">
                  @else
                      <span class="text-muted small">No Image</span>
                  @endif
                </td>
                <td class="text-center">
                  <div class="d-flex justify-content-center gap-1">
                    <button class="btn btn-action-edit rounded" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                      <i class="bi bi-pencil-square"></i> Edit
                    </button>
                    <form action="{{ route('katalog.destroy', $item->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-action-delete rounded" onclick="return confirm('Yakin ingin menghapus alat ini?')">
                        <i class="bi bi-trash"></i> Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content border-0 shadow">
                    <div class="modal-header">
                      <h5 class="modal-title fw-bold">Edit Data Alat</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('katalog.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="modal-body text-start">
                        <div class="mb-3">
                          <label class="form-label fw-bold">Nama Alat</label>
                          <input type="text" class="form-control" name="nama_alat" value="{{ $item->nama_alat }}" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-bold">Harga Sewa Per Hari (Rp)</label>
                          <input type="number" class="form-control" name="harga_sewa" value="{{ $item->harga_sewa }}" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-bold">Status (Is Active)</label>
                          <select name="is_active" class="form-select">
                            <option value="1" {{ $item->is_active == 1 ? 'selected' : '' }}>Yes (Aktif)</option>
                            <option value="0" {{ $item->is_active == 0 ? 'selected' : '' }}>No (Nonaktif)</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-bold">Foto Alat</label>
                          <input type="file" class="form-control" name="foto_alat" accept="image/*">
                          <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto.</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-bold">Deskripsi Alat</label>
                          <textarea class="form-control" name="deskripsi" rows="3">{{ $item->deskripsi }}</textarea>
                        </div>
                      </div>
                      <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" style="background-color: var(--brown-primary); border: none;">Update Data</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              @empty
              <tr>
                  <td colspan="7" id="emptyDataMessage" class="text-center py-4 text-muted">Belum ada data alat. Silakan tambah data baru.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Pagination katalog: 5 data per halaman, urut terbaru -->
        <div class="pagination-wrapper" id="pagination-wrapper">
          <nav aria-label="Pagination Katalog">
            <ul class="pagination pagination-sm mb-0 catalog-pagination" id="catalog-pagination"></ul>
          </nav>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal Tambah Data -->
  <div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header">
          <h5 class="modal-title fw-bold">Tambah Alat Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('katalog.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body text-start">
            <div class="mb-3">
              <label class="form-label fw-bold">Nama Alat</label>
              <input type="text" class="form-control" name="nama_alat" placeholder="Misal: Tenda Dome 4 Orang" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Harga Sewa Per Hari (Rp)</label>
              <input type="number" class="form-control" name="harga_sewa" placeholder="45000" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Status (Is Active)</label>
              <select name="is_active" class="form-select">
                <option value="1" selected>Yes (Aktif)</option>
                <option value="0">No (Nonaktif)</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Foto/Image</label>
              <input type="file" class="form-control" name="foto_alat" accept="image/*" required>
              <div class="form-text">Format didukung: JPG, PNG, JPEG.</div>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Deskripsi Alat</label>
              <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsikan barang..."></textarea>
            </div>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" style="background-color: var(--brown-primary); border: none;">Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Script Libraries Bootstrap (Wajib untuk Dropdown Profil & Modal) -->
  <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Script bawaan template untuk interaksi dashboard -->
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>

  <!-- Script Tambahan Manual (Berjaga-jaga jika dashboard.js tidak berjalan) -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {

        // 1. Fungsi Toggle Sidebar (Desktop & Mobile)
        const desktopToggle = document.getElementById('desktop-sidebar-toggle');
        const mobileToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');

        function toggleSidebar() {
            // Logika sederhana: menambah/menghapus class khusus
            if(sidebar) {
                // Jika di mobile biasanya pakai class 'show' atau mengubah margin
                if (window.innerWidth < 1200) {
                    sidebar.classList.toggle('d-none'); // atau class yang sesuai dengan main.css Anda
                } else {
                    sidebar.classList.toggle('collapsed');
                }
            }
        }

        if(desktopToggle) desktopToggle.addEventListener('click', toggleSidebar);
        if(mobileToggle) mobileToggle.addEventListener('click', toggleSidebar);

        // 2. Fungsi Fullscreen
        const btnFullscreen = document.getElementById('btn-fullscreen');
        if (btnFullscreen) {
            btnFullscreen.addEventListener('click', function() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen().catch(err => {
                        console.log(`Error attempting to enable fullscreen: ${err.message}`);
                    });
                    // Ubah icon ke mode exit fullscreen
                    this.innerHTML = '<i class="bi bi-fullscreen-exit"></i>';
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    }
                    // Kembalikan icon ke mode fullscreen
                    this.innerHTML = '<i class="bi bi-arrows-fullscreen"></i>';
                }
            });
        }

        // 3. Fungsi Search & Pagination Katalog
        const searchBtn = document.querySelector('.navbar-search-btn');
        const searchInput = document.getElementById('main-search');
        const tableBody = document.getElementById('productTableBody');
        const pagination = document.getElementById('catalog-pagination');
        const perPage = 5;
        let currentPage = 1;
        let filteredRows = [];

        if (searchBtn && searchInput) {
            searchBtn.addEventListener('click', function() {
                searchInput.focus();
            });

            // Search navbar langsung memfilter katalog produk
            searchInput.addEventListener('input', applyCatalogSearch);

            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    applyCatalogSearch();
                }
            });
        }

        function getProductRows() {
            return tableBody ? Array.from(tableBody.querySelectorAll('.product-row')) : [];
        }

        function applyCatalogSearch() {
            const keyword = (searchInput?.value || '').trim().toLowerCase();
            const rows = getProductRows();

            filteredRows = rows.filter(function(row) {
                const text = row.getAttribute('data-search') || row.textContent.toLowerCase();
                return text.includes(keyword);
            });

            currentPage = 1;
            renderCatalogPage();
        }

        function renderCatalogPage() {
            const rows = getProductRows();
            const totalPages = Math.max(1, Math.ceil(filteredRows.length / perPage));

            if (currentPage > totalPages) currentPage = totalPages;

            rows.forEach(function(row) {
                row.style.display = 'none';
            });

            const start = (currentPage - 1) * perPage;
            const end = start + perPage;

            filteredRows.slice(start, end).forEach(function(row) {
                row.style.display = '';
            });

            // Tampilkan pesan jika hasil pencarian kosong
            const emptyDataMessage = document.getElementById('emptyDataMessage');
            if (emptyDataMessage) {
                emptyDataMessage.parentElement.style.display = getProductRows().length === 0 ? '' : 'none';
                if (filteredRows.length > 0) {
                    emptyDataMessage.parentElement.style.display = 'none';
                }
            }

            let noResultRow = document.getElementById('noSearchResultRow');
            if (!noResultRow && tableBody) {
                noResultRow = document.createElement('tr');
                noResultRow.id = 'noSearchResultRow';
                noResultRow.innerHTML = '<td colspan="7" class="text-center py-4 text-muted">Produk tidak ditemukan.</td>';
                noResultRow.style.display = 'none';
                tableBody.appendChild(noResultRow);
            }
            if (noResultRow) {
                noResultRow.style.display = filteredRows.length === 0 ? '' : 'none';
            }

            renderPagination(totalPages);
        }

        function renderPagination(totalPages) {
            if (!pagination) return;
            pagination.innerHTML = '';

            // Pagination hanya muncul jika produk lebih dari 10 data
            if (filteredRows.length <= perPage) {
                pagination.parentElement.parentElement.style.display = 'none';
                return;
            }

            pagination.parentElement.parentElement.style.display = 'flex';

            // Tombol sebelumnya
            const prev = document.createElement('li');
            prev.className = 'page-item' + (currentPage === 1 ? ' disabled' : '');
            prev.innerHTML = '<button type="button" class="page-link" aria-label="Previous">&laquo;</button>';
            prev.querySelector('button').addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    renderCatalogPage();
                }
            });
            pagination.appendChild(prev);

            // Nomor halaman 1, 2, 3, dst.
            for (let page = 1; page <= totalPages; page++) {
                const li = document.createElement('li');
                li.className = 'page-item' + (page === currentPage ? ' active' : '');
                li.innerHTML = `<button type="button" class="page-link">${page}</button>`;
                li.querySelector('button').addEventListener('click', function() {
                    currentPage = page;
                    renderCatalogPage();
                });
                pagination.appendChild(li);
            }

            // Tombol berikutnya
            const next = document.createElement('li');
            next.className = 'page-item' + (currentPage === totalPages ? ' disabled' : '');
            next.innerHTML = '<button type="button" class="page-link" aria-label="Next">&raquo;</button>';
            next.querySelector('button').addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderCatalogPage();
                }
            });
            pagination.appendChild(next);
        }

        // Inisialisasi: data terbaru tampil lebih dahulu, 5 data per halaman
        if (tableBody) {
            filteredRows = getProductRows();
            renderCatalogPage();
        }
    });
  </script>
</body>
</html>
