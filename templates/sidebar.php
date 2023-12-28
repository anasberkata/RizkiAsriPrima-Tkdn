<div class="container-scroller">

    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="../view_admin/dashboard.php"><img
                    src="../assets/images/logo-text-white.png" alt="logo" /></a>
            <a class="sidebar-brand brand-logo-mini" href="../view_admin/dashboard.php"><img
                    src="../assets/images/logo-pic.png" alt="logo" /></a>
        </div>
        <ul class="nav">
            <li class="nav-item nav-category">
                <span class="nav-link">Dashboard</span>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="../view_admin/dashboard.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-speedometer"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">
                <span class="nav-link">Data</span>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="menu-icon">
                        <i class="mdi mdi-file-document-box"></i>
                    </span>
                    <span class="menu-title">Master Data</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="../view_master/bahan_baku.php">Data
                                Bahan Baku</a></li>
                        <li class="nav-item"> <a class="nav-link" href="../view_master/karyawan.php">Data
                                Karyawan</a></li>
                        <li class="nav-item"> <a class="nav-link" href="../view_master/produsen.php">Data
                                Produsen</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="../view_pengguna/pengguna.php">Data
                                Pengguna</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="../view_dkb/produk.php">
                    <span class="menu-icon">
                        <i class="mdi mdi-playlist-play"></i>
                    </span>
                    <span class="menu-title">DKB</span>
                </a>
            </li>

            <li class="nav-item nav-category">
                <span class="nav-link">Logout</span>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="../logout.php" onclick="return confirm('Yakin ingin keluar dari aplikasi?');">
                    <span class="menu-icon">
                        <i class="mdi mdi-logout"></i>
                    </span>
                    <span class="menu-title">Logout</span>
                </a>
            </li>
        </ul>
    </nav>