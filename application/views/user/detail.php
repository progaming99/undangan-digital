<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card mb-3 bg-dark" style="max-width: 740px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/cv/') . $datacv['image']; ?>" class="card-img" alt="cvcreatorpro">
            </div>
            <div class="col-lg-8">
                <div class="card-body text-white">
                    <h5 class="card-title"><?= $datacv['judul']; ?></h5>
                    <p class="card-text"><?= $datacv['tentang']; ?></p>
                    <p class="card-text"><?= $datacv['harga']; ?></p>
                    <p class="card-text"><?= $datacv['metode_pembayaran']; ?></p>
                    <hr>
                    <p class="card-text"><small class="text-muted">Diposting pada : <?= date('D F Y', $datacv['created_at']); ?></small></p>
                    <p class="card-text"><small class="text-muted">Dibuat oleh : <?= $user['nama']; ?></small></p>
                    <a class="btn btn-sm btn-success" href="<?= $datacv['whatsapp']; ?>"><i class="fab fa-whatsapp"></i> Pesan CV</a>
                    <a class="btn btn-sm btn-primary" href="<?= base_url('admin/cv') ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>


    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->