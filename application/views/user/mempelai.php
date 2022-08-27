<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahmempelaiModal"> Tambah</button>
    </div>
    <?= $this->session->flashdata('pesan'); ?>

    <div class="row">

        <!-- Border Bottom Utilities -->
        <?php foreach ($mempelai as $m) : ?>
            <div class="col-xl col-md mb-4">
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary"><?= $m['save_the_date']; ?></h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse" id="collapseCardExample">
                        <div class="card-body text-center">
                            <div class="col-sm text-center">
                                <img src="<?= base_url('wedding-2/images/wedding/wedding-1/mempelai/') . $m['image']; ?>" class="img-thumbnail" alt="">
                            </div>
                        </div>
                        <div class="card-body border-bottom-primary">
                            <label class="font-weight-bold" for="nama_lk">Mempelai Laki</label>
                            <p class="mb-4"><?= $m['nama_lk']; ?> </p>

                            <label class="font-weight-bold" for="nama_pr">Mempelai Perempuan</label>
                            <p class="mb-4"><?= $m['nama_pr']; ?> </p>

                            <label class="font-weight-bold" for="save_the_date">Save The Date</label>
                            <p class="mb-4"><?= $m['save_the_date']; ?> </p>

                            <label class="font-weight-bold" for="tanggal">Tanggal Acara</label>
                            <p class="mb-4"><?= $m['tanggal']; ?> </p>

                            <label class="font-weight-bold" for="alamat">Alamat</label>
                            <p class="mb-4"><?= $m['alamat']; ?> </p>

                            <a class="btn btn-sm btn-primary" href=" <?= base_url('user/edit_mempelai/') . $m['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin');" href=" <?= base_url('user/delete_mempelai/') . $m['id']; ?>"><i class="fas fa-trash-alt"></i>Delete</a>
                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>

    </div>

</div>



<!-- Modal tambah cv -->
<div class="modal fade" id="tambahmempelaiModal" tabindex="-1" aria-labelledby="tambahmempelaiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahmempelaiModalLabel">Tambah Mempelai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/mempelai'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_lk" name="nama_lk" placeholder="Nama Laki Laki">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_pr" name="nama_pr" placeholder="Nama Perempuan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="save_the_date" name="save_the_date" placeholder="Save The Date">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Acara">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="alamat" name="alamat" placeholder="Alamat Acara">
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