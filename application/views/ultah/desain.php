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
                                <div class="picture-container">
                                    <div class="picture">
                                        <img src="" class="picture-src">
                                        <input type="file" id="image" name="image" class="">
                                    </div>
                                    Extensi File JPG, PNG, Ukuran Maksimal File 2MB
                                </div>
                                <button type="submit" class="btn btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">Simpan</span>
                                </button>
                                <hr>
                                <p class="text-center">Pilih Desain</p>
                                <hr>

                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="col-md-4">
                                            <a href="">
                                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
                                            </a>
                                        </div>
                                        <hr>
                                        <h6 class="text-center m-0 font-weight-bold text-primary">Informasi</h6>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>