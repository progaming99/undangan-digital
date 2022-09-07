<div class="col-lg mb-4">
    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <div class="text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 8rem;" src="<?= base_url('assets/'); ?>images/banner.png" alt="">
            </div>
            <p class="text-center">Hai <?= $user['nama']; ?> 👋
                <br>Selamat datang di <a target="_blank" rel="nofollow" href="">Kreativa.id</a>
                <br>Lengkapi data undangan. Tenang data yang sudah tersimpan dapat berubah kapanpun tanpa batas
            </p>

            <div class="my-2 col-9 mx-auto">
                <a href="<?= base_url('Pernikahan/info_pernikahan'); ?>" class="btn btn-primary btn-icon-split">
                    <span class="text"><i class="fa-solid fa-children"></i> Undangan Pernikahan</span>
                </a>
            </div>
            <div class="my-2 col-9 mx-auto">
                <a href="<?= base_url('UlangTahun/info_ultah'); ?>" class="btn btn-success btn-icon-split">
                    <span class="text"><i class="fas fa-cake-candles"></i> Undangan Ulang Tahun</span>
                </a>
            </div>
            <div class="my-2 col-9 mx-auto">
                <a href="<?= base_url('bi_halal/info_bi_halal'); ?>" class="btn btn-info btn-icon-split">
                    <span class="text"><i class="fas fa-people-group"></i> Undangan Halal BI Halal</span>
                </a>
            </div>
        </div>
    </div>

</div>