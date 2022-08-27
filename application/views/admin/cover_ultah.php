<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <h1>Desain Undangan</h1>
            <h4>Pilih Cover</h4>
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
                                <form method="POST" action="<?= base_url('admin/edit_cover/') . $foto['id']; ?>" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $foto['id']; ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="cover" name="cover" placeholder="cover" value="<?= $foto['cover']; ?>">
                                        <?= form_error('pesan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('/assets/img/cover_ultah/') . $foto['image']; ?>" class="picture-src" value="<?= $foto['image']; ?>">
                                            <input type="file" name="image" class="">
                                        </div>
                                        Extensi File JPG, PNG, Ukuran Maksimal File 2MB
                                    </div>
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('/assets/img/cover_ultah/') . $foto['image2']; ?>" class="picture-src" value="<?= $foto['image2']; ?>">
                                            <input type="file" id="image2" name="image2" class="">
                                        </div>
                                        Extensi File JPG, PNG, Ukuran Maksimal File 2MB
                                    </div>
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('/assets/img/cover_ultah/') . $foto['image3']; ?>" class="picture-src" value="<?= $foto['image3']; ?>">
                                            <input type="file" id="image3" name="image3" class="">
                                        </div>
                                        Extensi File JPG, PNG, Ukuran Maksimal File 2MB
                                    </div>
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('/assets/img/cover_ultah/') . $foto['image4']; ?>" class="picture-src" value="<?= $foto['image4']; ?>">
                                            <input type="file" id="image4" name="image4" class="">
                                        </div>
                                        Extensi File JPG, PNG, Ukuran Maksimal File 2MB
                                    </div>
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('/assets/img/cover_ultah/') . $foto['image5']; ?>" class="picture-src" value="<?= $foto['image5']; ?>">
                                            <input type="file" id="image5" name="image5" class="">
                                        </div>
                                        Extensi File JPG, PNG, Ukuran Maksimal File 2MB
                                    </div>
                                    <button type="submit" class="btn btn-success btn-icon-split">
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