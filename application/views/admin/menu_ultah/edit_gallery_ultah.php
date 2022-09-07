<?= $this->session->flashdata('pesan'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Gallery</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6 col-md-6 mb-3 col-lg-3">
                <a href="<?= base_url('Admin/edit_gallery1/') . $gallery['id_user']; ?>" class="card h-100 mb-0">
                    <div class="card-body text-center">
                        <div class="mb-1">
                            <img src="<?= base_url('assets/images/ultah/gallery/') . $gallery['image']; ?>" height="72" width="72">
                        </div>
                        <h6 class="m-0 font-weight-bold text-primary">Foto 1</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-6 mb-3 col-lg-3">
                <a href="<?= base_url('Admin/edit_gallery2/') . $gallery['id_user']; ?>" class="card h-100 mb-0">
                    <div class="card-body text-center">
                        <div class="mb-1">
                            <img src="<?= base_url('assets/images/ultah/gallery/') . $gallery['image2']; ?>" height="72" width="72">
                        </div>
                        <h6 class="m-0 font-weight-bold text-primary">Foto 2</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-6 mb-3 col-lg-3">
                <a href="<?= base_url('Admin/edit_gallery3/') . $gallery['id_user']; ?>" class="card h-100 mb-0">
                    <div class="card-body text-center">
                        <div class="mb-1">
                            <img src="<?= base_url('assets/images/ultah/gallery/') . $gallery['image3']; ?>" height="72" width="72">
                        </div>
                        <h6 class="m-0 font-weight-bold text-primary">Foto 3</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-6 mb-3 col-lg-3">
                <a href="<?= base_url('Admin/edit_gallery4/') . $gallery['id_user']; ?>" class="card h-100 mb-0">
                    <div class="card-body text-center">
                        <div class="mb-1">
                            <img src="<?= base_url('assets/images/ultah/gallery/') . $gallery['image4']; ?>" height="72" width="72">
                        </div>
                        <h6 class="m-0 font-weight-bold text-primary">Foto 4</h6>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-6 mb-3 col-lg-3">
                <a href="<?= base_url('Admin/edit_gallery5/') . $gallery['id_user']; ?>" class="card h-100 mb-0">
                    <div class="card-body text-center">
                        <div class="mb-1">
                            <img src="<?= base_url('assets/images/ultah/gallery/') . $gallery['image5']; ?>" height="72" width="72">
                        </div>
                        <h6 class="m-0 font-weight-bold text-primary">Foto 5</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>