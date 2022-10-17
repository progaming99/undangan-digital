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
                                        <h6 class="m-0 font-weight-bold text-primary">Edit Cover Undangan</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="m-0 font-weight-bold text-grey">Informasi</p>
                                        <p>Disarankan untuk melakukan kompresi pada foto yang akan diunggah, ukuran maksimal per file foto adalah 2MB</p>
                                    </div>
                                </div>
                                <form method="POST" action="<?= base_url('DashboardUltah/edit_cover/') . $cover['id_user']; ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="cover" name="cover" placeholder="cover" value="<?= $cover['cover']; ?>" readonly>
                                    </div>
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('assets/images/ultah/cover_ultah/') . $cover['image']; ?>" class="picture-src" id="wizardPicturePreview" value="<?= $cover['image']; ?>">
                                            <input type="file" id="wizard-picture" name="image" class="">
                                        </div>
                                        Extensi File JPG, PNG, Ukuran Maksimal File 2MB
                                    </div>
                                    <button type="submit" class="btn btn-success btn-icon-split col-lg">
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