<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahmundurModal"> Tambah</button>
    </div>
    <?= $this->session->flashdata('pesan'); ?>

    <!-- Content Row -->
    <div class="row">

        <!-- Border Bottom Utilities -->
        <?php foreach ($hitung_mundur as $hm) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary"><?= $hm['tahun']; ?></h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="collapseCardExample">
                        <div class="card-body text-center">
                        </div>
                        <div class="card-body border-bottom-primary">
                            <label class="font-weight-bold" for="tahun">Tahun</label>
                            <p class="mb-4"><?= $hm['tahun']; ?> </p>

                            <label class="font-weight-bold" for="bulan">Bulan</label>
                            <p class="mb-4"><?= $hm['bulan']; ?> </p>

                            <label class="font-weight-bold" for="hari">Hari</label>
                            <p class="mb-4"><?= $hm['hari']; ?> </p>
                            <a class="btn btn-sm btn-primary" href=" <?= base_url('user/edit_mundur/') . $hm['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin');" href=" <?= base_url('user/delete_mundur/') . $hm['id']; ?>"><i class="fas fa-trash-alt"></i>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

</div>



<!-- Modal tambah contact -->
<div class="modal fade" id="tambahmundurModal" tabindex="-1" aria-labelledby="tambahmundurModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahmundurModalLabel">Tambah Tanggal Hitung Mundur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/mundur'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Tahun">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="bulan" name="bulan" placeholder="Bulan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="hari" name="hari" placeholder="Tanggal Acara">
                    </div>
                    <p class="text-right">Contoh :<span class="text-info"> 2021 08 10</span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>