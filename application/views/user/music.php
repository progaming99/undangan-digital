<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahmusicModal"> Tambah</button>
    </div>
    <?= $this->session->flashdata('pesan'); ?>

    <!-- Content Row -->
    <div class="row">

        <!-- Border Bottom Utilities -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $music['nama']; ?></h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="collapseCardExample">
                    <div class="card-body text-center">
                    </div>
                    <div class="card-body border-bottom-primary">
                        <label class="font-weight-bold" for="nama">Nama Music</label>
                        <p class="mb-4"><?= $music['nama']; ?> </p>

                        <label class="font-weight-bold" for="id_music">ID Music</label>
                        <p class="mb-4"><?= $music['id_music']; ?> </p>

                        <a class="btn btn-sm btn-primary" href=" <?= base_url('user/edit_music/') . $music['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                        <a class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin');" href=" <?= base_url('user/delete_music/') . $music['id']; ?>"><i class="fas fa-trash-alt"></i>Delete</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>



<!-- Modal tambah contact -->
<div class="modal fade" id="tambahmusicModal" tabindex="-1" aria-labelledby="tambahmusicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahmusicModalLabel">Tambah Music</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/music'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Music">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="id_music" id="id_music" cols="10" rows="10"></textarea>
                    </div>
                    <p class="text-right">More Music ? <a href="https://soundcloud.com/discover" target="_blank">SoundCloud Music</a></p>

                    <p class="text-right text-danger mb-2">Contoh</p>
                    <p class="text-right mb-2">[Ashes Remain]<a href="#" target="_blank"> 183235744 </a></p>
                    <p class="text-right mb-2"> [Christina Perry New]<a href="#" target="_blank"> 66810925</a></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>