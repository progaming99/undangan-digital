<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahweddingdetailModal"> Tambah</button>
    </div>
    <?= $this->session->flashdata('pesan'); ?>


    <!-- Basic Card Example -->
    <div class="row">
        <div class="col-lg">
            <?php foreach ($wedding_detail as $wd) : ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?= $wd['judul']; ?></h6>
                    </div>
                    <div class="card-body text-info">
                        <?= $wd['text']; ?>
                    </div>
                    <div class="card-body">
                        <?= $wd['paragraph']; ?>
                    </div>
                    <a class="btn btn-sm btn-primary" href=" <?= base_url('admin/edit_wedding_detail/') . $wd['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>


</div>

</div>




<!-- Modal tambah about -->
<div class="modal fade" id="tambahweddingdetailModal" tabindex="-1" aria-labelledby="tambahweddingdetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahweddingdetailModalLabel">Tambah Wedding Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/wedding_detail'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="text" name="text" placeholder="Text">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="paragraph" id="paragraph" cols="10" rows="10"></textarea>
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