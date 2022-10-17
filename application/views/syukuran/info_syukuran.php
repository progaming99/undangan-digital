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
                                <form class="user" action="<?= base_url('Syukuran/info_syukuran'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('assets/images/cover.jpg'); ?>" class="picture-src" id="wizardPicturePreview">
                                            <input type="file" id="wizard-picture" name="image" class="">
                                        </div>
                                        <h6>Pilih Cover</h6>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama</div>
                                        <input type="text" class="form-control form-control-user" id="nm_panggilan" name="nm_panggilan" placeholder="Nama Panggilan" value="<?= set_value('nm_panggilan'); ?><?= $halal['nm_panggilan']; ?>">
                                        <?= form_error('nm_panggilan', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Lengkap</div>
                                        <input type="text" class="form-control form-control-user" id="nm_lengkap" name="nm_lengkap" placeholder="Nama Lengkap" value="<?= set_value('nm_lengkap'); ?><?= $halal['nm_lengkap']; ?>">
                                        <?= form_error('nm_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Jenis Kelamin</div>
                                        <select name="jenkel" id="jenkel" class="form-control">
                                            <?php foreach ($jk as $j) : ?>
                                                <?php if ($j == $info['jenkel']) : ?>
                                                    <option value="<?= $j; ?>" selected><?= $j; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $j ?>"><?= $j; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Tanggal Acara</div>
                                        <input type="date" class="form-control form-control-user" id="tgl_acara" name="tgl_acara" value="<?= set_value('tgl_acara'); ?><?= $halal['tgl_acara']; ?>">
                                        <?= form_error('tgl_acara', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Waktu Mulai</div>
                                        <input type="time" class="form-control form-control-user" id="w_mulai" name="w_mulai" value="<?= set_value('w_mulai'); ?><?= $halal['w_mulai']; ?>">
                                        <?= form_error('w_mulai', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Waktu Selesai</div>
                                        <input type="time" class="form-control form-control-user" id="w_selesai" name="w_selesai" value="<?= set_value('w_selesai'); ?><?= $halal['w_selesai']; ?>">
                                        <?= form_error('w_selesai', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Zona Waktu</div>
                                        <select name="z_waktu" id="z_waktu" class="form-control">
                                            <?php foreach ($zona as $z) : ?>
                                                <?php if ($z == $info['z_waktu']) : ?>
                                                    <option value="<?= $z; ?>" selected><?= $z; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $z ?>"><?= $z; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Lokasi</div>
                                        <input type="text" class="form-control form-control-user" id="nm_lokasi" name="nm_lokasi" placeholder="Nama Gedung/Rumah" value="<?= set_value('nm_lokasi'); ?><?= $halal['nm_lokasi']; ?>">
                                        <?= form_error('nm_lokasi', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Alamat Lengkap</div>
                                        <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Alamat Lokasi" value="<?= set_value('alamat'); ?><?= $halal['alamat']; ?>">
                                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
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