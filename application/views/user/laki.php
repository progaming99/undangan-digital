<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahlakiModal"> Tambah</button>
    </div>
    <?= $this->session->flashdata('pesan'); ?>

    <!-- Content Row -->
    <div class="row">

        <!-- Border Bottom Utilities -->
        <?php foreach ($laki as $lk) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary"><?= $lk['nama']; ?></h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="collapseCardExample">
                        <div class="card-body text-center">
                            <div class="col-sm text-center">
                                <img src="<?= base_url('wedding-2/images/wedding/wedding-1/laki-laki/') . $lk['image']; ?>" class="img-thumbnail" alt="">
                            </div>
                        </div>
                        <div class="card-body border-bottom-primary">
                            <label class="font-weight-bold" for="nama">Nama Pihak Laki-laki</label>
                            <p class="mb-4"><?= $lk['nama']; ?> </p>


                            <a class="btn btn-sm btn-primary" href=" <?= base_url('admin/edit_laki/') . $lk['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin');" href=" <?= base_url('admin/delete_laki/') . $lk['id']; ?>"><i class="fas fa-trash-alt"></i>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

</div>



<!-- Modal tambah contact -->
<div class="modal fade" id="tambahlakiModal" tabindex="-1" aria-labelledby="tambahlakiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahlakiModalLabel">Tambah Pihak Laki-laki</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/laki'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pihak Laki-laki">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Pilih Gambar</label>
                    </div>

                    <p class="text-right text-danger mt-3">Usahakan mengambil gambar/foto yang bagus <a href="#" target="_blank"></a></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>