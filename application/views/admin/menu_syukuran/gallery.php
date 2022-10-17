<div class="card shadow mb-4">
    <div class="card-header py-1">
        <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
    </div>
    <div class="card-body">
        <p>Disarankan untuk melakukan kompresi pada foto yang akan diunggah, Extensi File JPG, PNG, Ukuran Maksimal File 2MB</p>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-6 col-md-6 mb-3 col-lg-3">
            <a href="<?= base_url('Admin/edit_gallery_syukuran1/') . $gallery['id_user']; ?>" class="card h-100 mb-0">
                <div class="card-body text-center">
                    <div class="mb-1">
                        <img src="<?= base_url('assets/images/syukuran/gallery/') . $gallery['image']; ?>" height="72" width="72">
                    </div>
                    <h6 class="m-0 font-weight-bold text-primary">Foto 1</h6>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-6 mb-3 col-lg-3">
            <a href="<?= base_url('Admin/edit_gallery_syukuran2/') . $gallery['id_user']; ?>" class="card h-100 mb-0">
                <div class="card-body text-center">
                    <div class="mb-1">
                        <img src="<?= base_url('assets/images/syukuran/gallery/') . $gallery['image2']; ?>" height="72" width="72">
                    </div>
                    <h6 class="m-0 font-weight-bold text-primary">Foto 2</h6>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-6 mb-3 col-lg-3">
            <a href="<?= base_url('Admin/edit_gallery_syukuran3/') . $gallery['id_user']; ?>" class="card h-100 mb-0">
                <div class="card-body text-center">
                    <div class="mb-1">
                        <img src="<?= base_url('assets/images/syukuran/gallery/') . $gallery['image3']; ?>" height="72" width="72">
                    </div>
                    <h6 class="m-0 font-weight-bold text-primary">Foto 3</h6>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-6 mb-3 col-lg-3">
            <a href="<?= base_url('Admin/edit_gallery_syukuran4/') . $gallery['id_user']; ?>" class="card h-100 mb-0">
                <div class="card-body text-center">
                    <div class="mb-1">
                        <img src="<?= base_url('assets/images/syukuran/gallery/') . $gallery['image4']; ?>" height="72" width="72">
                    </div>
                    <h6 class="m-0 font-weight-bold text-primary">Foto 4</h6>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-6 mb-3 col-lg-3">
            <a href="<?= base_url('Admin/edit_gallery_syukuran5/') . $gallery['id_user']; ?>" class="card h-100 mb-0">
                <div class="card-body text-center">
                    <div class="mb-1">
                        <img src="<?= base_url('assets/images/syukuran/gallery/') . $gallery['image5']; ?>" height="72" width="72">
                    </div>
                    <h6 class="m-0 font-weight-bold text-primary">Foto 5</h6>
                </div>
            </a>
        </div>
    </div>
</div>