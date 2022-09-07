<?= $this->session->flashdata('pesan'); ?>

<div class="row">
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('UlangTahun/edit_nama/') . $nama->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/nama.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Nama</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('UlangTahun/edit_lokasi/') . $lokasi->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/kalender.png'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Lokasi & Waktu</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('UlangTahun/tambah_list'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/list_undangan.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Tamu Undangan</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('UlangTahun/edit_cover/') . $cover->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/cover.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Cover</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('UlangTahun/gallery'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/gallery.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Gallery</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('UlangTahun/tambah_musik/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/musik.png'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Musik</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('UlangTahun/tambah_hitung/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/hitung.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Hitung Mundur</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('UlangTahun/tambah_amplop/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/amplop.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Amplop</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('UlangTahun/desain/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/cover.jpg'); ?>" height="72" width="72">
                </div>
                <h6 class="m-0 font-weight-bold text-primary">Desain</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                </div>
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
        </a>
    </div>
</div>