<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('auth'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-gift"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kreativa</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('DashboardHalal'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('DashboardHalal/pengaturan'); ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('DashboardHalal/upgrade_paket'); ?>">
            <i class="fa-solid fa-cash-register"></i>
            <span>Upgrade Paket</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('DashboardHalal/status_pembayaran'); ?>">
            <i class="fa-solid fa-file-invoice"></i>
            <span>Status Pembayaran</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('DashboardHalal/ulasan'); ?>">
            <i class="fa-regular fa-comment-dots"></i>
            <span>Kirim Masukan</span></a>
    </li>
</ul>