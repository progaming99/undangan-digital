<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-gift"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kreativa</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('DashboardPernikahan'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('DashboardPernikahan/pengaturan'); ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span>
        </a>
    </li>

    <!-- Heading -->


    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('DashboardPernikahan/upgrade_paket'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Upgrade Paket</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('DashboardPernikahan/status_pembayaran'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Status Pembayaran</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('DashboardPernikahan/kirim_masukan'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Kirim Masukan</span></a>
    </li>

</ul>
<!-- End of Sidebar -->