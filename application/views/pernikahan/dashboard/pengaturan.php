<?= $this->session->flashdata('pesan'); ?>

<div class="row">
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardPernikahan/edit_mempelai_pria/') . $nm_pernikahan->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/pernikahan/mempelai_pria.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Mempelai Pria</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardPernikahan/edit_mempelai_wanita/') . $nm_pernikahan->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/pernikahan/mempelai_wanita.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Mempelai Wanita</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardPernikahan/edit_lok_pernikahan/') . $lok_mempelai->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/kalender.png'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Lokasi & Waktu</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardPernikahan/list_undangan'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/list_undangan.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Tamu Undangan</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardPernikahan/edit_cover_mempelai/') . $cover_mempelai->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/cover.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Cover</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardPernikahan/gallery_mempelai'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/gallery.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Gallery</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardPernikahan/tambah_musik/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/musik.png'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Musik</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardPernikahan/tambah_hitung/') . $hitung->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/hitung.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Hitung Mundur</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardPernikahan/tambah_amplop/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/amplop.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Amplop</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('DashboardPernikahan/desain/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/cover.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Desain</h6>
            </div>
        </a>
    </div>
</div>