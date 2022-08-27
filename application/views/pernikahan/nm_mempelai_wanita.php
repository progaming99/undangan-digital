<?= $this->session->flashdata('pesan'); ?>
<div class="container">
    <div class="row justify-content-center">
        <h1 class="h3 mb-1 text-gray-800"></h1>
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
                                        <h6 class="m-0 font-weight-bold text-primary">Data Mempelai Wanita</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="m-0 font-weight-bold text-gray-800">Informasi</p>
                                        <p>Disarankan untuk melakukan kompresi pada foto yang akan diunggah, ukuran maksimal per file foto adalah 2MB</p>
                                    </div>
                                </div>
                                <form class="user" action="<?= base_url('pernikahan/nm_mempelai_wanita'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('assets/images/pernikahan/wanita.jpg'); ?>" class="picture-src" id="wizardPicturePreview" value="<?= base_url('assets/images/pernikahan/') . $nama['image2']; ?>">
                                            <input type="file" id="wizard-picture" name="image2" class="">
                                        </div>
                                        <h6>Pilih Foto</h6>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Panggilan</div>
                                        <input type="text" class="form-control form-control-user" id="np_wanita" name="np_wanita" placeholder="Nama Panggilan Wanita" value="<?= $nama['np_wanita']; ?>">
                                        <?= form_error('np_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Lengkap</div>
                                        <input type="text" class="form-control form-control-user" id="nl_wanita" name="nl_wanita" placeholder="Nama Lengkap Wanita" value="<?= $nama['nl_wanita']; ?>">
                                        <?= form_error('nl_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Ayah</div>
                                        <input type="text" class="form-control form-control-user" id="na_wanita" name="na_wanita" placeholder="Nama Ayah" value="<?= $nama['na_wanita']; ?>">
                                        <?= form_error('na_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Ibu</div>
                                        <input type="text" class="form-control form-control-user" id="ni_wanita" name="ni_wanita" placeholder="Nama Ibu" value="<?= $nama['ni_wanita']; ?>">
                                        <?= form_error('ni_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Username Instagram</div>
                                        <input type="text" class="form-control form-control-user" id="i_wanita" name="i_wanita" placeholder="Instagram" value="<?= $nama['i_wanita']; ?>">
                                        <?= form_error('i_wanita', '<small class="text-danger pl-3">', '</small>'); ?>
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