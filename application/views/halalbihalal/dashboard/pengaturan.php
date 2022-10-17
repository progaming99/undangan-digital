<?= $this->session->flashdata('pesan'); ?>

<div class="row">
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardHalal/edit_info_halal/') . $info->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/nama.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Info Halal bi Halal</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardHalal/tamu_undangan'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/list_undangan.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Tamu Undangan</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardHalal/edit_foto/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/cover.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Cover</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardHalal/gallery'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/gallery.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Gallery</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardHalal/tambah_musik/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/musik.png'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Musik</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardHalal/edit_hitung_mundur/') . $hitung->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/hitung.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Hitung Mundur</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardHalal/pembayaran/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/amplop.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardHalal/desain/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/cover.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Desain</h6>
            </div>
        </a>
    </div>
</div>