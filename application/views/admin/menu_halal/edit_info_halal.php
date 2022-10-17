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
                                    <input type="hidden" name="id" value="<?= $info['id']; ?>">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('assets/images/halal/') . $info['image']; ?>" class="picture-src" id="wizardPicturePreview" value="<?= $info['image']; ?>">
                                            <input type="file" id="wizard-picture" name="image">
                                        </div>
                                        <h6>Pilih Cover</h6>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama</div>
                                        <input type="text" class="form-control form-control-user" id="nama_grub" name="nama_grub" placeholder="Nama Grub" value="<?= set_value('nama_grub'); ?><?= $info['nama_grub']; ?>">
                                        <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Judul Acara</div>
                                        <input type="text" class="form-control form-control-user" id="judul_acara" name="judul_acara" placeholder="Halal Bi Halal 2023" value="<?= set_value('judul_acara'); ?><?= $info['judul_acara']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Tanggal Acara</div>
                                        <input type="date" class="form-control form-control-user" id="tgl_acara" name="tgl_acara" value="<?= set_value('tgl_acara'); ?><?= $info['tgl_acara']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Waktu</div>
                                        <input type="time" class="form-control form-control-user" id="waktu" name="waktu" value="<?= set_value('waktu'); ?><?= $info['waktu']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Zona Waktu</div>
                                        <select name="zona_waktu" id="zona_waktu" class="form-control">
                                            <?php foreach ($zona as $z) : ?>
                                                <?php if ($z == $info['zona_waktu']) : ?>
                                                    <option value="<?= $z; ?>" selected><?= $z; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $z ?>"><?= $z; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Lokasi</div>
                                        <input type="text" class="form-control form-control-user" id="nm_lokasi" name="nm_lokasi" placeholder="Nama Gedung/Rumah" value="<?= set_value('nm_lokasi'); ?><?= $info['nm_lokasi']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Alamat Lengkap</div>
                                        <input type="text" class="form-control form-control-user" id="alamat_lengkap" name="alamat_lengkap" placeholder="Alamat Lokasi" value="<?= set_value('alamat_lengkap'); ?><?= $info['alamat_lengkap']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Bagikan Lokasi</div>
                                        <input type="text" class="form-control form-control-user" id="sharelok" name="sharelok" placeholder="https://sharelok.anda" value="<?= set_value('sharelok'); ?><?= $info['sharelok']; ?>">
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