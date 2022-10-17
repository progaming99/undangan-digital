<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-0">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-1">
                                <!-- Illustrations -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-1">
                                        <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                                    </div>
                                    <div class="card-body">
                                        <p>Disarankan untuk melakukan kompresi pada foto yang akan diunggah, ukuran maksimal per file foto adalah 2MB</p>
                                    </div>
                                </div>
                                <form class="user" action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $mempelai['id']; ?>">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('assets/images/pernikahan/') . $mempelai['image2']; ?>" class="picture-src" id="wizardPicturePreview">
                                            <input type="file" id="wizard-picture" name="image2" class="">
                                        </div>
                                        <h6>Pilih Foto</h6>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Panggilan</div>
                                        <input type="text" class="form-control form-control-user" id="np_wanita" name="np_wanita" placeholder="Nama Panggilan" value="<?= $mempelai['np_wanita']; ?>">
                                        <?= form_error('np_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Lengkap Wanita</div>
                                        <input type="text" class="form-control form-control-user" id="nl_wanita" name="nl_wanita" placeholder="Nama Lengkap" value="<?= $mempelai['nl_wanita']; ?>">
                                        <?= form_error('nl_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Ayah Wanita</div>
                                        <input type="text" class="form-control form-control-user" id="na_wanita" name="na_wanita" placeholder="Nama Ayah" value="<?= $mempelai['na_wanita']; ?>">
                                        <?= form_error('na_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Ibu Wanita</div>
                                        <input type="text" class="form-control form-control-user" id="ni_wanita" name="ni_wanita" placeholder="Nama Ibu" value="<?= $mempelai['ni_wanita']; ?>">
                                        <?= form_error('ni_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Urutan Anak</div>
                                        <input type="text" class="form-control form-control-user" id="urutan_wanita" name="urutan_wanita" placeholder="Anak ke berapa?" value="<?= $mempelai['urutan_wanita']; ?>">
                                        <?= form_error('urutan_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Username Instagram Wanita</div>
                                        <input type="text" class="form-control form-control-user" id="i_wanita" name="i_wanita" placeholder="Instagram" value="<?= $mempelai['i_wanita']; ?>">
                                        <?= form_error('i_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>