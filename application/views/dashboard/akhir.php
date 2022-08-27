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
                <br>Gunakan menu Pengaturan untuk melihat link undangan, merubah informasi dasar, lokasi, tema dan lainnya.
            </p>
            <div class="my-2"></div>
            <a href="<?= base_url('upernikahan'); ?>" class="btn btn-primary btn-icon-split col-lg-4">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-children"></i>
                </span>
                <span class="text">Lihat Undangan Pernikahan</span>
            </a>
            <!-- <div class="my-2"></div>
            <a href="#" class="btn btn-success btn-icon-split col-lg-4">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-cake-candles"></i>
                </span>
                <span class="text">Lihat Undangan Ulang Tahun</span>
            </a>
            <div class="my-2"></div>
            <a href="#" class="btn btn-info btn-icon-split col-lg-4">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-people-group"></i>
                </span>
                <span class="text">Lihat Undangan Halal Bi Halal</span>
            </a> -->
        </div>
    </div>

</div>