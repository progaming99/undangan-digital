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

<div class="modal fade" id="submenubaruModal" tabindex="-1" aria-labelledby="submenubaruModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submenubaruModalLabel">Tambah SubMenu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="submenu">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Pilih Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="submenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="submenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">Active ?</label>
                        </div>
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