<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-1">
                                <div class="col-lg mb-4">
                                    <!-- Illustrations -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-1">
                                            <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                                        </div>
                                        <div class="card-body">
                                            <p>Disarankan untuk melakukan kompresi pada foto yang akan diunggah, ukuran maksimal per file foto adalah 2MB</p>
                                        </div>
                                    </div>
                                </div>
                                <?= $this->session->flashdata('pesan'); ?>
                                <form method="POST" action="<?= base_url('DashboardPernikahan/tambah_gallery3'); ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="nama" placeholder="isi bebas" value="gallery" readonly>
                                    </div>
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('assets/images/gallery1.jpg'); ?>" class="picture-src" id="wizardPicturePreview" value="<?= set_value('image3'); ?>">
                                            <input type="file" id="wizard-picture" name="image3" class="">
                                        </div>
                                        Extensi File JPG, PNG, Ukuran Maksimal File 2MB
                                    </div>
                                    <button type="submit" class="btn btn-success col">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Simpan</span>
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