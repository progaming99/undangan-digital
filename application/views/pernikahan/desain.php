<?= $this->session->flashdata('pesan'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pilih Desain Undangan</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6 col-md-6 mb-3 col-lg-3">
                <a href="<?= base_url('UPernikahan') . $desain->id_user; ?>" class="card">
                    <div class="card-body text-center">
                        <div class="mb-1">
                            <img src="<?= base_url('assets/images/pernikahan/desain/d2.png'); ?>" width="100">
                        </div>
                        <h6>Gambar 1</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-6 mb-3 col-lg-3">
                <a href="<?= base_url('UPernikahan/undangan2'); ?>" class="card">
                    <div class="card-body text-center">
                        <div class="mb-1">
                            <img src="<?= base_url('assets/images/pernikahan/desain/d1.png'); ?>" width="100">
                        </div>
                        <h6>Gambar 2</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-6 mb-3 col-lg-3">
                <a href="<?= base_url('UPernikahan/undangan3'); ?>" class="card">
                    <div class="card-body text-center">
                        <div class="mb-1">
                            <img src="<?= base_url('assets/images/pernikahan/desain/.png'); ?>" width="100">
                        </div>
                        <h6>Gambar 3</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-6 mb-3 col-lg-3">
                <a href="<?= base_url('UPernikahan/undangan4'); ?>" class="card h-100 mb-0">
                    <div class="card-body text-center">
                        <div class="mb-1">
                            <img src="<?= base_url('assets/images/plus.png'); ?>" height="72" width="72">
                        </div>
                        <h6>Gambar 4</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-6 mb-3 col-lg-3">
                <a href="<?= base_url('UPernikahan/undangan5'); ?>" class="card h-100 mb-0">
                    <div class="card-body text-center">
                        <div class="mb-1">
                            <img src="<?= base_url('assets/images/plus.png'); ?>" height="72" width="72">
                        </div>
                        <h6>Gambar 5</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>