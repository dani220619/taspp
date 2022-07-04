<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <!-- <div class="sidebar-brand-icon">
            <i class="fas fa-mosque"></i>
        </div> -->
        <div class="sidebar-brand-text mx-3">Komplek L</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <?php if ($_SESSION["role_id"] == ("1" and "2")) { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('dashboard'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
    <?php } ?>
    <?php if ($_SESSION["role_id"] == ("2")) { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('user'); ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Admin</span>
            </a>
        </li>
    <?php } ?>
    <?php if ($_SESSION["role_id"] == ("1" and "2")) { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('santri'); ?>">
                <i class="fas fa-user"></i>
                <span>Data Pribadi Santri</span>
            </a>
        </li>
    <?php } ?>
    <?php if ($_SESSION["role_id"] == ("1" and "2")) { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('santri/data_santri'); ?>">
                <i class="fas fa-user"></i>
                <span>Data Pengajian Santri</span>
            </a>
        </li>
    <?php } ?>
    <?php if ($_SESSION["role_id"] == ("1")) { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('kas/kas_masuk'); ?>">
                <i class="fas fa-fw fa-hand-holding-usd"></i>
                <span>Kas Masuk</span>
            </a>
        </li>
    <?php } ?>
    <?php if ($_SESSION["role_id"] == ("1")) { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('kas/kas_keluar'); ?>">
                <i class="fas fa-hand-holding"></i>
                <span>Kas Keluar</span>
            </a>
        </li>
    <?php } ?>
    <?php if ($_SESSION["role_id"] == ("1")) { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('pembayaran'); ?>">
                <i class="fas fa-fw fa-money-bill-wave"></i>
                <span>Pembayaran</span>
            </a>
        </li>
    <?php } ?>

    <?php if ($_SESSION["role_id"] == ("1" and "2")) { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" DATA-toggle="collapse" DATA-target="#collap" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Laporan Keuangan</span>
            </a>
            <DIV id="collap" class="collapse" aria-labelledby="headingUtilities" DATA-parent="#accordionSidebar">
                <DIV class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">DATA MASTER:</h6>
                    <a class="collapse-item" href="<?= base_url('laporan/laporan_spp'); ?>">Laporan Keuangan Spp</a>
                    <a class="collapse-item" href="<?= base_url('laporan/laporan_lainya'); ?>">Laporan Keuangan Lainya</a>
                    <a class="collapse-item" href="<?= base_url('laporan/laporan_kas'); ?>">Laporan Keuangan Kas</a>
                    <a class="collapse-item" href="<?= base_url('laporan/laporan_tunggakan'); ?>">Laporan Tunggakan</a>

                </DIV>
            </DIV>
        </li>
    <?php } ?>
    <?php if ($_SESSION["role_id"] == "1") { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" DATA-toggle="collapse" DATA-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Pengaturan</span>
            </a>
            <DIV id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" DATA-parent="#accordionSidebar">
                <DIV class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">DATA MASTER:</h6>
                    <a class="collapse-item" href="<?= base_url('th_ajaran'); ?>">Tahun ajaran</a>
                    <a class="collapse-item" href="<?= base_url('th_aktif'); ?>">Tahun aktif</a>
                    <a class="collapse-item" href="<?= base_url('jenis_pembayaran'); ?>">Jenis Pembayaran</a>
                    <a class="collapse-item" href="<?= base_url('pembayaran/index_bulanan'); ?>">Pembayaran Bulanan</a>
                    <a class="collapse-item" href="<?= base_url('pembayaran/index_lainya'); ?>">Pembayaran Lainya</a>
                    <a class="collapse-item" href="<?= base_url('ngaji/pengampu'); ?>">Pengampu</a>
                    <a class="collapse-item" href="<?= base_url('ngaji/jenis'); ?>">Jenis Ngaji</a>
                    <a class="collapse-item" href="<?= base_url('ngaji/surat'); ?>">Surat</a>
                    <a class="collapse-item" href="<?= base_url('ngaji/wali_kelas'); ?>">Wali Kelas</a>
                    <a class="collapse-item" href="<?= base_url('pengguna'); ?>">Pengguna</a>
                    <a class="collapse-item" href="<?= base_url('menu'); ?>">Menu Management</a>
                    <a class="collapse-item" href="<?= base_url('menu/submenu'); ?>">Submenu Management</a>
                    <a class="collapse-item" href="<?= base_url('menu/user_access_menu'); ?>">User Access Management</a>

                </DIV>
            </DIV>
        </li>
    <?php } ?>


    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->