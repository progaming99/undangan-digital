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
                                        <h6 class="m-0 font-weight-bold text-primary">Data Mempelai Pria</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="m-0 font-weight-bold text-gray-800">Informasi</p>
                                        <p>Disarankan untuk melakukan kompresi pada foto yang akan diunggah, ukuran maksimal per file foto adalah 2MB</p>
                                    </div>
                                </div>
                                <form class="user" action="<?= base_url('pernikahan/nm_mempelai_pria/'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('assets/images/pernikahan/pria.jpg'); ?>" class="picture-src" id="wizardPicturePreview" <?= set_value('image'); ?>>
                                            <input type="file" id="wizard-picture" name="image" class="">
                                        </div>
                                        <h6>Pilih Foto</h6>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Panggilan</div>
                                        <input type="text" class="form-control form-control-user" id="np_pria" name="np_pria" placeholder="Nama Panggilan Pria" value="<?= set_value('np_pria'); ?>">
                                        <?= form_error('np_pria', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Lengkap</div>
                                        <input type="text" class="form-control form-control-user" id="nl_pria" name="nl_pria" placeholder="Nama Lengkap Pria" value="<?= set_value('nl_pria'); ?>">
                                        <?= form_error('nl_pria', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Ayah</div>
                                        <input type="text" class="form-control form-control-user" id="na_pria" name="na_pria" placeholder="Nama Ayah" value="<?= set_value('na_pria'); ?>">
                                        <?= form_error('na_pria', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Ibu</div>
                                        <input type="text" class="form-control form-control-user" id="ni_pria" name="ni_pria" placeholder="Nama Ibu" value="<?= set_value('ni_pria'); ?>">
                                        <?= form_error('ni_pria', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Urutan Anak</div>
                                        <input type="text" class="form-control form-control-user" id="urutan_pria" name="urutan_pria" placeholder="Anak ke berapa?" value="<?= set_value('urutan_pria'); ?>">
                                        <?= form_error('urutan_pria', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Username Instagram</div>
                                        <input type="text" class="form-control form-control-user" id="i_pria" name="i_pria" placeholder="Instagram" value="<?= set_value('i_pria'); ?>">
                                        <?= form_error('i_pria', '<small class="text-danger pl-3">', '</small>'); ?>
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