<?= $this->session->flashdata('pesan'); ?>

<div class="row">
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('ulangtahun/edit_nama/') . $nama->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/nama.jpg'); ?>" height="72" width="72">
                </div>
                <h6>Nama</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('ulangtahun/edit_lokasi/') . $lokasi->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/kalender.png'); ?>" height="72" width="72">
                </div>
                <h6>
                    Lokasi & Waktu
                </h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('ulangtahun/tambah_list'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/list_undangan.jpg'); ?>" height="72" width="72">
                </div>
                <h6>Tamu Undangan</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('ulangtahun/edit_cover/') . $cover->id_user; ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/cover.jpg'); ?>" height="72" width="72">
                </div>
                <h6>Cover</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('ulangtahun/gallery'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/gallery.jpg'); ?>" height="72" width="72">
                </div>
                <h6>Gallery</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('ulangtahun/tambah_musik/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/musik.png'); ?>" height="72" width="72">
                </div>
                <h6>Musik</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('ulangtahun/tambah_hitung/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/hitung.jpg'); ?>" height="72" width="72">
                </div>
                <h6>Hitung Mundur</h6>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-6 mb-3 col-lg-3">
        <a href="<?= base_url('ulangtahun/tambah_amplop/'); ?>" class="card h-100 mb-0">
            <div class="card-body text-center">
                <div class="mb-1">
                    <img src="<?= base_url('assets/images/amplop.jpg'); ?>" height="72" width="72">
                </div>
                <h6>Amplop</h6>
            </div>
        </a>
    </div>
</div>