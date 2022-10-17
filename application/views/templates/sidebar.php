<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('auth'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-gift"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kreativa</div>
    </a>

    <div class="sidebar-heading">
        Admin
    </div>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('Admin') ?>">
            <i class="fas fa-fw fa-tachometer-alt" data-dismiss="modal"></i>
            <span>Dashboard</span></a>
        <a class="nav-link pb-0" href="<?= base_url('Admin/role') ?>">
            <i class="fas fa-fw fa-user-cog" data-dismiss="modal"></i>
            <span>Role</span></a>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Menu
    </div>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('Menu') ?>">
            <i class="fas fa-fw fa-folder" data-dismiss="modal"></i>
            <span>Menu</span></a>
        <a class="nav-link pb-0" href="<?= base_url('Menu/submenu') ?>">
            <i class="fas fa-fw fa-folder-open" data-dismiss="modal"></i>
            <span>SubMenu</span></a>
        <a class="nav-link pb-0" href="<?= base_url('Menu/status_pembayaran') ?>">
            <i class="fa-solid fa-money-bills" data-dismiss="modal"></i>
            <span>Status Pembayaran</span></a>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Pernikahan
    </div>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('Admin/daftar_mempelai') ?>">
            <i class="fa-solid fa-address-card" data-dismiss="modal"></i>
            <span>Daftar User</span></a>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        UlangTahun
    </div>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('Admin/daftar_ultah') ?>">
            <i class="fa-solid fa-address-card" data-dismiss="modal"></i>
            <span>Daftar User</span></a>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Halal bi Halal
    </div>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('Admin/daftar_halal') ?>">
            <i class="fa-solid fa-address-card" data-dismiss="modal"></i>
            <span>Daftar User</span></a>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Syukuran
    </div>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('Admin/daftar_syukuran') ?>">
            <i class="fa-solid fa-address-card" data-dismiss="modal"></i>
            <span>Daftar User</span></a>
    </li>
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Sign out
    </div>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('auth/logout') ?>">
            <i class="fas fa-fw fa-sign-out-alt" data-dismiss="modal"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->