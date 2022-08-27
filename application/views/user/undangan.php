<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


<div class="card shadow mb-1">
    <div class="card-body">
        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= basename('assets/'); ?>img/d_hbd1.png" alt="">
        </div>
        <p>Selamat datang di Kreativa.id 🎉
            Yuk lengkapi data undangan digital Kamu. Tenang data yang sudah tersimpan dapat dirubah kapanpun tanpa batas 😉</p>
        <?php $i = 1; ?>
        <?php foreach ($role as $r) : ?>
            <a href="<?= base_url('user/jenis_undangan/') . $r['id']; ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-flag"></i>
                </span>
                <span class="text">Buat Undangan</span>
            </a>
        <?php endforeach; ?>
    </div>
</div>