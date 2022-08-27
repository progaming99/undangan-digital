<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
        <a class="nav-link" href="<?= base_url('dashboard/akhir'); ?>">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List:</h6>
                <a class="collapse-item" href="<?= base_url('pernikahan/pengaturan'); ?>">Menu</a>
            </div>
        </div>
    </li>

    <!-- Heading -->


    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/upgrade_paket'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Upgrade Paket</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/status_pembayaran'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Status Pembayaran</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/kirim_masukan'); ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Kirim Masukan</span></a>
    </li>

</ul>
<!-- End of Sidebar -->