<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kasir Sewa Alat - GongStrak</title>

    <!-- Logo -->
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/lg.png') }}">

    <!-- Local Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <style>
        /* =========================================================
           TEMA BROWN - GONGSTRAK (KONSISTEN DENGAN ADMIN)
        ========================================================= */
        :root {
            --brown-sidebar: #3E2723;
            --brown-hover: #4E342E;
            --brown-accent: #D7CCC8;
            --brown-primary: #795548;
            --brown-light: #EFEBE9;
        }

        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ---------------- SIDEBAR ---------------- */
        .sidebar-wrapper {
            background-color: var(--brown-sidebar) !important;
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

        .sidebar-logo {
            width: 42px;
            height: 42px;
            object-fit: contain;
            flex-shrink: 0;
        }

        /* ---------------- NAVBAR ---------------- */
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

        /* ---------------- TEXT UTILS ---------------- */
        .text-main { color: var(--brown-primary) !important; }
        .bg-lime-accent { background-color: var(--brown-accent) !important; }
        .bg-forest-light { background-color: var(--brown-light) !important; }

        /* =========================================================
           KHUSUS HALAMAN KASIR
        ========================================================= */
        .pos-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(62, 39, 35, 0.06);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .pos-card-header {
            background-color: var(--brown-sidebar);
            color: #fff;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Search */
        .product-results {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #fff;
            border: 1px solid #e0d7d2;
            border-radius: 8px;
            max-height: 260px;
            overflow-y: auto;
            z-index: 1050;
            display: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .product-item {
            padding: 10px 15px;
            border-bottom: 1px solid #f1ecea;
            cursor: pointer;
            transition: background 0.15s ease;
        }

        .product-item:hover {
            background-color: var(--brown-light);
        }

        .product-item:last-child {
            border-bottom: none;
        }

        /* Cart Table */
        .cart-table {
            margin-bottom: 0;
        }

        .cart-table th {
            background-color: var(--brown-light);
            color: var(--brown-sidebar);
            font-size: 0.78rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.03em;
            padding: 12px;
            border-bottom: 1px solid #e7e0dc;
        }

        .cart-table td {
            padding: 12px;
            vertical-align: middle;
            border-color: #f4f0ee;
        }

        .qty-control {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .qty-control button {
            width: 28px;
            height: 28px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-control input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 4px;
        }

        /* Summary */
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        .summary-row input {
            width: 115px;
            text-align: right;
            border: 1px solid #e0d7d2;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 0.9rem;
        }

        .summary-row input:focus {
            outline: none;
            border-color: var(--brown-primary);
            box-shadow: 0 0 0 3px rgba(121, 85, 72, 0.15);
        }

        .total-box {
            background-color: var(--brown-light);
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            border-left: 5px solid var(--brown-primary);
        }

        .total-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--brown-sidebar);
            margin-top: 2px;
        }

        /* Payment method */
        .payment-method {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .payment-method button {
            flex: 1 0 30%;
            font-size: 0.8rem;
            padding: 7px;
            border: 1px solid #ddd;
            background: #fff;
            border-radius: 6px;
            transition: all 0.2s ease;
            color: #555;
        }

        .payment-method button:hover {
            background-color: var(--brown-light);
        }

        .payment-method button.active {
            background-color: var(--brown-primary) !important;
            color: #fff !important;
            border-color: var(--brown-primary) !important;
        }

        /* Change box */
        .change-box {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 10px;
            margin-top: 15px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .change-box.short-payment {
            background-color: #f8d7da;
            color: #721c24;
        }

        .change-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .change-value {
            font-size: 1.25rem;
            font-weight: bold;
        }

        /* Buttons */
        .btn-pay {
            background-color: #198754;
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            padding: 12px;
            border-radius: 8px;
            border: none;
        }

        .btn-pay:hover {
            background-color: #146c43;
            color: #fff;
        }

        .btn-pay:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }

        /* Nota Header */
        .nota-header {
            background: #fff;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(62, 39, 35, 0.06);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .navbar-actions {
                right: 15px !important;
            }
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
        <a href="{{ url('/admin') }}" class="sidebar-brand text-decoration-none d-flex align-items-center">
            <img src="{{ asset('assets/logo/lg.png') }}" alt="Logo GongStrak" class="sidebar-logo">
            <span>GongStrak</span>
        </a>

        <div class="flex-grow-1 overflow-y-auto">
            <!-- Menu -->
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title text-light opacity-75">Menu</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-link" title="Dashboard">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Components -->
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title text-light opacity-75">Components</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.katalog.index') }}" class="sidebar-menu-link" title="Katalog Alat">
                            <i class="bi bi-box-seam"></i>
                            <span>Katalog Alat</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.kasir') }}" class="sidebar-menu-link active" title="Kasir Sewa">
                            <i class="bi bi-cart-check"></i>
                            <span>Transaksi Sewa</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Pages -->
            <div class="sidebar-menu-section">
                <div class="sidebar-menu-title text-light opacity-75">Pages</div>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('admin.pengaturan') }}" class="sidebar-menu-link" title="Pengaturan">
                            <i class="bi bi-person-gear"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item">
                        <a href="{{ url('/login') }}" class="sidebar-menu-link" title="Login Page">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Login Screen</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Profile -->
        <div class="sidebar-profile">
            @if($user && $user->foto_profil)
                <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Profile" class="sidebar-profile-img">
            @else
                <img src="{{ asset('assets/images/profile.jpg') }}" alt="Profile" class="sidebar-profile-img">
            @endif
            <div class="sidebar-profile-info">
                <div class="sidebar-profile-name text-truncate">{{ $user->name ?? 'Administrator' }}</div>
                <div class="sidebar-profile-email text-truncate">{{ $user->username ?? 'admin' }}</div>
            </div>
        </div>
    </div>
    <!-- END: Sidebar -->

    <!-- ==========================================
         START: Main Content Area
         ========================================== -->
    <div class="main-wrapper">

        <!-- NAVBAR -->
        <header class="navbar-custom">
            <div class="navbar-left">
                <button class="btn-desktop-toggle d-none d-xl-flex align-items-center justify-content-center me-3"
                    id="desktop-sidebar-toggle" aria-label="Minimize Sidebar">
                    <i class="bi bi-chevron-bar-left"></i>
                </button>
                <button class="sidebar-toggle-btn me-2" id="sidebar-toggle" aria-label="Toggle Navigation">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <div class="navbar-actions">
                <button class="navbar-action-btn me-1" aria-label="Toggle Fullscreen" id="btn-fullscreen">
                    <i class="bi bi-arrows-fullscreen"></i>
                </button>

                <div class="dropdown ms-2">
                    <button class="navbar-profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" id="profile-dropdown">
                        @if($user && $user->foto_profil)
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Profile Image" class="navbar-profile-img">
                        @else
                            <img src="{{ asset('assets/images/profile.jpg') }}" alt="Profile Image" class="navbar-profile-img">
                        @endif
                        <span class="navbar-profile-name d-none d-md-inline">{{ $user->name ?? 'Administrator' }}</span>
                        <i class="bi bi-chevron-down navbar-profile-caret"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profile-dropdown">
                        <li class="dropdown-header">Welcome!</li>
                        <li><a class="dropdown-item" href="{{ route('admin.pengaturan') }}"><i class="bi bi-person"></i> My Account</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.pengaturan') }}"><i class="bi bi-gear"></i> Settings</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-lock"></i> Lock Screen</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="{{ url('/') }}"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <div class="p-4">

            <!-- HEADER NOTA SEWA -->
            <div class="nota-header">
                <div>
                    <h4 class="mb-0 fw-bold" style="color: var(--brown-primary);">GongStrak</h4>
                    <small class="text-muted">Dusun Jatigunung, Klenang Kidul, Kec. Banyuanyar • Probolinggo • Telp. 0851-6312-5566</small>
                </div>
                <div class="text-end mt-2 mt-md-0">
                    <div class="text-muted small">No. Nota Sewa</div>
                    <div class="fw-bold text-dark" id="transactionNumber">INV-...</div>
                    <div class="text-muted small" id="currentDate"></div>
                </div>
            </div>

            <div class="row g-4">
                <!-- =========================================================
                     KOLOM KIRI: PENCARIAN & DAFTAR SEWA
                ========================================================= -->
                <div class="col-lg-8">

                    <!-- CARD PENCARIAN -->
                    <div class="pos-card">
                        <div class="pos-card-header">Tambah Alat Sewa</div>
                        <div class="card-body p-3">
                            <div class="d-flex gap-2 mb-3">
                                <div class="position-relative flex-grow-1">
                                    <input type="text" id="searchProduct" class="form-control"
                                        placeholder="Cari nama alat / kode..." autocomplete="off">
                                    <div class="product-results" id="productResults"></div>
                                </div>
                                <button class="btn btn-primary" style="background-color: var(--brown-primary); border-color: var(--brown-primary);">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Penyewa</label>
                                    <select class="form-select" id="customerType">
                                        <option value="Umum">Umum / Non-Member</option>
                                        <option value="Member">Anggota GongStrak</option>
                                        <option value="VIP">Anggota VIP</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">No. Identitas (KTP/SIM)</label>
                                    <input type="text" class="form-control" id="customerIdentity" placeholder="Wajib diisi untuk jaminan">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD DAFTAR SEWA -->
                    <div class="pos-card">
                        <div class="pos-card-header">
                            <span>Daftar Alat Disewa</span>
                            <span class="badge bg-light text-dark" id="itemCount">0 Alat</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table cart-table">
                                <thead>
                                    <tr>
                                        <th width="40">No</th>
                                        <th>Nama Alat</th>
                                        <th width="110">Harga / Hari</th>
                                        <th width="140" class="text-center">Durasi (Hari)</th>
                                        <th width="130" class="text-end">Subtotal</th>
                                        <th width="50"></th>
                                    </tr>
                                </thead>
                                <tbody id="cartBody">
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="bi bi-backpack fs-1 d-block mb-2"></i>
                                            Belum ada alat yang disewa.<br>Silakan cari alat untuk ditambahkan.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- =========================================================
                     KOLOM KANAN: RINGKASAN & PEMBAYARAN
                ========================================================= -->
                <div class="col-lg-4">

                    <div class="pos-card">
                        <div class="pos-card-header">Ringkasan Pembayaran Sewa</div>
                        <div class="card-body p-3">

                            <div class="summary-row">
                                <span>Total Alat</span>
                                <strong id="totalQty">0</strong>
                            </div>
                            <div class="summary-row">
                                <span>Subtotal Sewa</span>
                                <strong id="subtotal">Rp 0</strong>
                            </div>
                            <div class="summary-row">
                                <span>Diskon (%)</span>
                                <input type="number" id="discountPercent" value="0" min="0" max="100" onchange="calculateTotal()">
                            </div>
                            <div class="summary-row">
                                <span>Diskon (Rp)</span>
                                <input type="number" id="discountAmount" value="0" min="0" onchange="calculateTotal()">
                            </div>
                            <div class="summary-row">
                                <span>Jaminan / Deposit</span>
                                <input type="number" id="jaminan" value="0" min="0" onchange="calculateTotal()">
                            </div>
                            <div class="summary-row">
                                <span>Biaya Lain</span>
                                <input type="number" id="otherFee" value="0" min="0" onchange="calculateTotal()">
                            </div>

                            <div class="total-box">
                                <div class="text-uppercase small fw-bold text-muted">Total Akhir</div>
                                <div class="total-value" id="grandTotal">Rp 0</div>
                            </div>

                            <hr>

                            <div class="mb-2">
                                <label class="form-label small fw-bold">Uang Dibayar (DP/Lunas)</label>
                                <input type="number" id="payment" class="form-control form-control-lg text-end fw-bold"
                                    placeholder="0" oninput="calculateChange()">
                            </div>

                            <label class="form-label small fw-bold mt-2">Metode Pembayaran</label>
                            <div class="payment-method" id="paymentMethodGroup">
                                <button type="button" class="active" data-method="Tunai">Tunai</button>
                                <button type="button" data-method="QRIS">QRIS</button>
                                <button type="button" data-method="Transfer">Transfer</button>
                                <button type="button" data-method="Debit">Debit</button>
                            </div>

                            <div class="change-box" id="changeBox">
                                <div class="change-label" id="changeLabel">KEMBALIAN</div>
                                <div class="change-value" id="change">Rp 0</div>
                            </div>
                        </div>
                    </div>

                    <!-- AKSI -->
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <button class="btn btn-warning w-100 fw-bold text-white" onclick="holdTransaction()">
                                <i class="bi bi-pause-circle"></i> Tahan
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger w-100 fw-bold" onclick="cancelTransaction()">
                                <i class="bi bi-x-circle"></i> Batal
                            </button>
                        </div>
                    </div>

                    <button class="btn btn-pay w-100" id="btnProcessPayment" onclick="processPayment(event)">
                        <i class="bi bi-check-circle"></i> BAYAR & CETAK NOTA
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ==========================================
         SCRIPTS
         ========================================== -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    <script>
        /* =========================================================
           DATA ALAT DARI DATABASE (Dikirim oleh KasirController)
        ========================================================= */
        const products = @json($products);
        let cart = [];

        /* =========================================================
           INIT
        ========================================================= */
        document.addEventListener('DOMContentLoaded', function () {
            // Tanggal & nomor nota (preview)
            const now = new Date();
            document.getElementById('currentDate').innerText = now.toLocaleString('id-ID', {
                day: '2-digit', month: '2-digit', year: 'numeric',
                hour: '2-digit', minute: '2-digit'
            });
            document.getElementById('transactionNumber').innerText =
                'INV-' + now.toISOString().slice(0, 10).replace(/-/g, '') + '-XXX';

            // Payment method listener
            document.querySelectorAll('#paymentMethodGroup button').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.querySelectorAll('#paymentMethodGroup button').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            renderCart();
        });

        /* =========================================================
           FORMAT RUPIAH
        ========================================================= */
        function formatRupiah(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency', currency: 'IDR', maximumFractionDigits: 0
            }).format(value);
        }

        /* =========================================================
           PENCARIAN ALAT
        ========================================================= */
        const searchInput = document.getElementById('searchProduct');
        searchInput.addEventListener('input', searchProduct);

        function searchProduct() {
            const keyword = searchInput.value.toLowerCase().trim();
            const resultBox = document.getElementById('productResults');

            if (!keyword) { resultBox.style.display = 'none'; return; }

            const results = products.filter(p =>
                p.name.toLowerCase().includes(keyword) ||
                p.code.toLowerCase().includes(keyword)
            );

            if (results.length === 0) {
                resultBox.innerHTML = '<div class="product-item text-muted">Alat tidak ditemukan</div>';
            } else {
                resultBox.innerHTML = results.map(p => `
                    <div class="product-item" onclick="addToCart(${p.id})">
                        <div class="fw-bold" style="color: var(--brown-primary);">${p.name}</div>
                        <div class="small text-muted">${p.code} — ${formatRupiah(p.price)} / hari</div>
                    </div>
                `).join('');
            }
            resultBox.style.display = 'block';
        }

        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !document.getElementById('productResults').contains(e.target)) {
                document.getElementById('productResults').style.display = 'none';
            }
        });

        /* =========================================================
           TAMBAH KE KERANJANG
        ========================================================= */
        function addToCart(productId) {
            const product = products.find(p => p.id === productId);
            const existing = cart.find(item => item.id === productId);

            if (existing) {
                existing.qty++;
            } else {
                cart.push({ ...product, qty: 1 });
            }

            searchInput.value = '';
            document.getElementById('productResults').style.display = 'none';
            renderCart();
            searchInput.focus();
        }

        /* =========================================================
           RENDER KERANJANG
        ========================================================= */
        function renderCart() {
            const body = document.getElementById('cartBody');

            if (cart.length === 0) {
                body.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-backpack fs-1 d-block mb-2"></i>
                            Belum ada alat yang disewa.<br>Silakan cari alat untuk ditambahkan.
                        </td>
                    </tr>`;
                calculateTotal();
                return;
            }

            body.innerHTML = cart.map((item, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td>
                        <div class="fw-bold">${item.name}</div>
                        <div class="small text-muted">${item.code}</div>
                    </td>
                    <td>${formatRupiah(item.price)}</td>
                    <td>
                        <div class="qty-control">
                            <button class="btn btn-sm btn-outline-secondary" onclick="changeQty(${item.id}, -1)">−</button>
                            <input type="number" value="${item.qty}" min="1" onchange="updateQty(${item.id}, this.value)">
                            <button class="btn btn-sm btn-outline-secondary" onclick="changeQty(${item.id}, 1)">+</button>
                        </div>
                    </td>
                    <td class="text-end fw-bold">${formatRupiah(item.price * item.qty)}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-danger" onclick="removeItem(${item.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
            calculateTotal();
        }

        /* =========================================================
           UBAH QTY
        ========================================================= */
        function changeQty(id, delta) {
            const item = cart.find(i => i.id === id);
            if (!item) return;
            item.qty += delta;
            if (item.qty <= 0) removeItem(id);
            else renderCart();
        }

        function updateQty(id, val) {
            const item = cart.find(i => i.id === id);
            if (!item) return;
            item.qty = Math.max(1, parseInt(val) || 1);
            renderCart();
        }

        function removeItem(id) {
            cart = cart.filter(i => i.id !== id);
            renderCart();
        }

        /* =========================================================
           KALKULASI TOTAL
        ========================================================= */
        function calculateTotal() {
            let totalQty = 0, subtotal = 0;
            cart.forEach(item => {
                totalQty += item.qty;
                subtotal += item.price * item.qty;
            });

            const discountPercent = parseFloat(document.getElementById('discountPercent').value) || 0;
            const manualDiscount  = parseFloat(document.getElementById('discountAmount').value) || 0;
            const jaminan         = parseFloat(document.getElementById('jaminan').value) || 0;
            const otherFee        = parseFloat(document.getElementById('otherFee').value) || 0;

            const percentDiscount = subtotal * (discountPercent / 100);
            const totalDiscount = percentDiscount + manualDiscount;
            const grandTotal = Math.max(0, subtotal - totalDiscount + jaminan + otherFee);

            document.getElementById('totalQty').innerText = totalQty;
            document.getElementById('itemCount').innerText = totalQty + ' Alat';
            document.getElementById('subtotal').innerText = formatRupiah(subtotal);
            document.getElementById('grandTotal').innerText = formatRupiah(grandTotal);

            calculateChange();
        }

        function getGrandTotal() {
            let subtotal = 0;
            cart.forEach(item => { subtotal += item.price * item.qty; });

            const discountPercent = parseFloat(document.getElementById('discountPercent').value) || 0;
            const discountAmount  = parseFloat(document.getElementById('discountAmount').value) || 0;
            const jaminan         = parseFloat(document.getElementById('jaminan').value) || 0;
            const otherFee        = parseFloat(document.getElementById('otherFee').value) || 0;

            const discount = (subtotal * discountPercent) / 100 + discountAmount;
            return Math.max(0, subtotal - discount + jaminan + otherFee);
        }

        /* =========================================================
           KALKULASI KEMBALIAN
        ========================================================= */
        function calculateChange() {
            const grandTotal = getGrandTotal();
            const payment = parseFloat(document.getElementById('payment').value) || 0;
            const change = payment - grandTotal;
            const changeBox = document.getElementById('changeBox');
            const changeElement = document.getElementById('change');
            const changeLabel = document.getElementById('changeLabel');

            if (payment === 0) {
                changeBox.classList.remove('short-payment');
                changeElement.innerHTML = formatRupiah(0);
                changeLabel.innerText = 'KEMBALIAN';
                return;
            }

            if (change >= 0) {
                changeBox.classList.remove('short-payment');
                changeElement.innerHTML = formatRupiah(change);
                changeLabel.innerText = 'KEMBALIAN';
            } else {
                changeBox.classList.add('short-payment');
                changeElement.innerHTML = formatRupiah(Math.abs(change));
                changeLabel.innerText = 'UANG KURANG';
            }
        }

        /* =========================================================
           AKSI: TAHAN
        ========================================================= */
        function holdTransaction() {
            if (cart.length === 0) {
                alert('Tidak ada transaksi untuk ditahan.');
                return;
            }
            alert('Transaksi sewa berhasil ditahan (fitur hold belum tersimpan ke database).');
        }

        /* =========================================================
           AKSI: BATAL
        ========================================================= */
        function cancelTransaction() {
            if (cart.length === 0) return;
            if (!confirm('Batalkan transaksi sewa ini?')) return;

            cart = [];
            document.getElementById('payment').value = '';
            document.getElementById('discountPercent').value = 0;
            document.getElementById('discountAmount').value = 0;
            document.getElementById('jaminan').value = 0;
            document.getElementById('otherFee').value = 0;
            document.getElementById('customerIdentity').value = '';
            renderCart();
        }

        /* =========================================================
           AKSI: BAYAR & CETAK → SIMPAN KE DATABASE
        ========================================================= */
        function processPayment(event) {
            if (cart.length === 0) {
                alert('Belum ada alat yang disewa.');
                return;
            }

            const total = getGrandTotal();
            const payment = parseFloat(document.getElementById('payment').value) || 0;

            if (payment < total) {
                alert('Uang pembayaran masih kurang.');
                return;
            }

            const paymentMethod = document.querySelector('#paymentMethodGroup button.active').dataset.method;

            const payload = {
                customer_type: document.getElementById('customerType').value,
                customer_identity: document.getElementById('customerIdentity').value,
                payment_method: paymentMethod,
                paid_amount: payment,
                discount_percent: parseFloat(document.getElementById('discountPercent').value) || 0,
                discount_amount: parseFloat(document.getElementById('discountAmount').value) || 0,
                jaminan: parseFloat(document.getElementById('jaminan').value) || 0,
                other_fee: parseFloat(document.getElementById('otherFee').value) || 0,
                items: cart.map(item => ({ id: item.id, qty: item.qty }))
            };

            const btn = document.getElementById('btnProcessPayment');
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';

            fetch('{{ route('admin.kasir.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-check-circle"></i> BAYAR & CETAK NOTA';

                if (data.success) {
                    // Buka nota di tab baru
                    window.open(data.print_url, '_blank');

                    // Reset
                    cart = [];
                    document.getElementById('payment').value = '';
                    document.getElementById('discountPercent').value = 0;
                    document.getElementById('discountAmount').value = 0;
                    document.getElementById('jaminan').value = 0;
                    document.getElementById('otherFee').value = 0;
                    document.getElementById('customerIdentity').value = '';
                    renderCart();

                    // Update nomor nota
                    document.getElementById('transactionNumber').innerText = data.transaction_number;
                } else {
                    alert('❌ ' + (data.message || 'Terjadi kesalahan.'));
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-check-circle"></i> BAYAR & CETAK NOTA';
                console.error(err);
                alert('❌ Gagal memproses transaksi. Cek console untuk detail.');
            });
        }

        /* =========================================================
           SHORTCUT KEYBOARD
        ========================================================= */
        document.addEventListener('keydown', function (event) {
            if (event.key === 'F2') {
                event.preventDefault();
                searchInput.focus();
            }
            if (event.key === 'F4') {
                event.preventDefault();
                document.getElementById('payment').focus();
            }
            if (event.key === 'Escape') {
                cancelTransaction();
            }
        });
    </script>

</body>
</html>
