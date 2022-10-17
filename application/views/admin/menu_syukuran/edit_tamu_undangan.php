<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-0">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-1">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Tamu Undangan</h6>
                                    </div>
                                    <div class="card-body">
                                        <form class="user" action="" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?= $list['id']; ?>">
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Nama Tamu</div>
                                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama" value="<?= $list['nama']; ?>">
                                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">No HP</div>
                                                <input type="text" class="form-control form-control-user" id="no_hp" name="no_hp" placeholder="no_hp" value="<?= $list['no_hp']; ?>">
                                                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Simpan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>