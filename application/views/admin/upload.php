<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('pesan'); ?>

    <div class="card-header py-3">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahdemoModal"> Tambah</button>
    </div>
    <?php foreach ($upload as $u) : ?>
        <img src="<?= base_url('assets/img/upload/') . $u['image']; ?>" width="300" alt="">
    <?php endforeach; ?>


    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<!-- Modal tambah demo web -->
<div class="modal fade" id="tambahdemoModal" tabindex="-1" aria-labelledby="tambahdemoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahdemoModalLabel">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/upload'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="judul">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image[]" name="image[]" multiple>
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