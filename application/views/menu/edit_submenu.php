<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="col-lg mb-4">
                                    <!-- Illustrations -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-1">
                                            <h6 class="m-0 font-weight-bold text-primary">Sub Menu</h6>
                                        </div>
                                    </div>
                                </div>
                                <form class="user" action="<?= base_url('menu/edit_sub_menu/') . $submenu['id']; ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $submenu['id']; ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="title" name="title" placeholder="Sub Menu" value="<?= $submenu['title']; ?>">
                                        <?= form_error('pesan', '<small class="text-danger pl-3">', '</small>'); ?>
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
                                        <input type="text" class="form-control form-control-user" id="url" name="url" placeholder="Ulang Tahun Ke.." value="<?= $submenu['url']; ?>">
                                        <?= form_error('pesan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="icon" name="icon" placeholder="Ucapan Tambahan" value="<?= $submenu['icon']; ?>">
                                        <?= form_error('pesan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                            <label class="form-check-label" for="is_active">Active ?</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Simpan
                                    </button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>