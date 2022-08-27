<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahakadModal"> Tambah</button>
    </div>
    <?= $this->session->flashdata('pesan'); ?>

    <div class="row">

        <!-- Border Bottom Utilities -->
        <?php foreach ($akad as $a) : ?>
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary"><?= $a['judul']; ?></h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="collapseCardExample">
                        <div class="card-body text-center">
                            <div class="col-sm text-center">
                                <img src="<?= base_url('wedding-2/images/wedding/wedding-1/akad/') . $a['image']; ?>" class="img-thumbnail" alt="">
                            </div>
                        </div>
                        <div class="card-body border-bottom-primary">
                            <label class="font-weight-bold" for="judul">Judul</label>
                            <p class="mb-4"><?= $a['judul']; ?> </p>

                            <label class="font-weight-bold" for="jam">Jam</label>
                            <p class="mb-4"><?= $a['jam']; ?> </p>

                            <label class="font-weight-bold" for="alamat">Alamat</label>
                            <p class="mb-4"><?= $a['alamat']; ?> </p>

                            <label class="font-weight-bold" for="no_hp">No HP</label>
                            <p class="mb-4"><?= $a['no_hp']; ?> </p>

                            <label class="font-weight-bold" for="link_maps">Link Maps</label>
                            <p class="mb-4"><?= $a['link_maps']; ?> </p>

                            <a class="btn btn-sm btn-primary" href=" <?= base_url('user/edit_akad/') . $a['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin');" href=" <?= base_url('user/delete_akad/') . $a['id']; ?>"><i class="fas fa-trash-alt"></i>Delete</a>
                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>

    </div>

</div>



<!-- Modal tambah cv -->
<div class="modal fade" id="tambahakadModal" tabindex="-1" aria-labelledby="tambahakadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahakadModalLabel">Tambah akad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/akad'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul">
                    </div>
                    <div class="form-group">
                        <input type="time" class="form-control" id="jam" name="jam" placeholder="Jam Pelaksanaan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor HP">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="link_maps" name="link_maps" placeholder="link_maps">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Pilih Gambar</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>