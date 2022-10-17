<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <h4>Pilih Cover</h4>
            <div class="card o-hidden border-0 shadow-lg my-0">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <?= $this->session->flashdata('pesan'); ?>
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
                                <form method="POST" action="<?= base_url('Pernikahan/cover_pernikahan'); ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="cover" name="cover" placeholder="isi bebas" value="cover" readonly>
                                        <?= form_error('pesan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('assets/images/pernikahan/cover_pernikahan/cover.jpg'); ?>" class="picture-src" id="wizardPicturePreview" value="<?= set_value('image'); ?>">
                                            <input type="file" id="wizard-picture" name="image" class="">
                                        </div>
                                        Extensi File JPG, PNG, Ukuran Maksimal File 2MB
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-icon-split col-lg">
                                        <span class="text"><i class="fas fa-check"></i> Simpan</span>
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