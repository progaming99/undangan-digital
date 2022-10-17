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
            <p class="text-center">Undangan Digital <?= $user['nama']; ?>
                <br>
                Gunakan menu Pengaturan untuk melihat link undangan, merubah informasi dasar, lokasi, tema dan lainnya.
            </p>
            <div class="my-2"></div>
            <a href="<?= base_url('UPernikahan'); ?>" class="btn btn-primary col-lg">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-children"></i>
                </span>
                <span class="text">Lihat Undangan</span>
            </a>
        </div>
    </div>

</div>