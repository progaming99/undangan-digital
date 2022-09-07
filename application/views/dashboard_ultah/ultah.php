<?= $this->session->flashdata('pesan'); ?>
<div class="col-lg mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="<?= base_url('assets/'); ?>images/banner.png" alt="">
            </div>
            <p class="text-center">Hallo <?= $user['nama']; ?>
                <br>Gunakan menu pengaturan untuk mengubah informasi undangan digital, mengubah informasi dasar, lokasi, musik dan lainnya.
            </p>
            <div class="my-2"></div>
            <a href="<?= base_url('UUlangtahun'); ?>" class="btn btn-success btn-icon-split col-lg">
                <span class="text"><i class="fas fa-cake-candles"></i> Undangan Ulang Tahun</span>
            </a>
        </div>
    </div>

</div>