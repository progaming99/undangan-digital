<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
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
                                        <p>Disarankan untuk melakukan kompresi pada foto yang akan diunggah, Extensi File JPG, PNG, Ukuran Maksimal File 2MB</p>
                                    </div>
                                </div>
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $gallery['id']; ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="nama" value="<?= $gallery['nama']; ?>" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-6 mb-3 col-lg-3">
                                            <a href="" class="card h-100 mb-0">
                                                <div class="card-body text-center">
                                                    <div class="picture-container">
                                                        <div class="picture">
                                                            <img src="<?= base_url('assets/images/pernikahan/gallery/') . $gallery['image']; ?>" class="picture-src" id="wizardPicturePreview" value="<?= $gallery['image']; ?>">
                                                            <input type="file" id="wizard-picture" name="image" class="">
                                                        </div>
                                                    </div>
                                                    <h6 class="font-weight-bold text-primary">Gambar 1</h6>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-6 col-md-6 mb-3 col-lg-3">
                                            <a href="" class="card h-100 mb-0">
                                                <div class="card-body text-center">
                                                    <div class="picture-container">
                                                        <div class="picture">
                                                            <img src="<?= base_url('assets/images/pernikahan/gallery/') . $gallery['image2']; ?>" class="picture-src" id="wizardPicturePreview2" value="<?= $gallery['image2']; ?>">
                                                            <input type="file" id="wizard-picture2" name="image2" class="">
                                                        </div>
                                                    </div>
                                                    <h6 class="font-weight-bold text-primary">Gambar 2</h6>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-6 col-md-6 mb-3 col-lg-3">
                                            <a href="" class="card h-100 mb-0">
                                                <div class="card-body text-center">
                                                    <div class="picture-container">
                                                        <div class="picture">
                                                            <img src="<?= base_url('assets/images/pernikahan/gallery/') . $gallery['image3']; ?>" class="picture-src" id="wizardPicturePreview" value="<?= $gallery['image3']; ?>">
                                                            <input type="file" id="wizard-picture" name="image3" class="">
                                                        </div>
                                                    </div>
                                                    <h6 class="font-weight-bold text-primary">Gambar 3</h6>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-6 col-md-6 mb-3 col-lg-3">
                                            <a href="" class="card h-100 mb-0">
                                                <div class="card-body text-center">
                                                    <div class="picture-container">
                                                        <div class="picture">
                                                            <img src="<?= base_url('assets/images/pernikahan/gallery/') . $gallery['image4']; ?>" class="picture-src" id="wizardPicturePreview" value="<?= $gallery['image4']; ?>">
                                                            <input type="file" id="wizard-picture" name="image4" class="">
                                                        </div>
                                                    </div>
                                                    <h6 class="font-weight-bold text-primary">Gambar 4</h6>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-6 col-md-6 mb-3 col-lg-3">
                                            <a href="" class="card h-100 mb-0">
                                                <div class="card-body text-center">
                                                    <div class="picture-container">
                                                        <div class="picture">
                                                            <img src="<?= base_url('assets/images/pernikahan/gallery/') . $gallery['image5']; ?>" class="picture-src" id="wizardPicturePreview" value="<?= $gallery['image5']; ?>">
                                                            <input type="file" id="wizard-picture" name="image5" class="">
                                                        </div>
                                                    </div>
                                                    <h6 class="font-weight-bold text-primary">Gambar 5</h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-icon-split col">
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