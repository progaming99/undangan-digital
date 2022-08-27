<div class="container">
    <div class="row justify-content-center">
        <h1 class="h5 mb-1 text-gray-800">Lokasi Acara</h1>
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-0">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-1">
                                <?= $this->session->flashdata('pesan'); ?>
                                <form class="user" action="<?= base_url('pernikahan/info_lokasi'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Acara Utama</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Judul</div>
                                                <input type="text" class="form-control form-control-user" id="judul_acara" name="judul_acara" placeholder="Akad" value="<?= set_value('judul_acara'); ?>">
                                                <?= form_error('judul_acara', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Alamat</div>
                                                <input type="text" class="form-control form-control-user" id="alamat_acara" name="alamat_acara" placeholder="jl..." value="<?= set_value('alamat_acara'); ?>"></input>
                                                <?= form_error('alamat_acara', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Nama Lokasi</div>
                                                <input type="text" class="form-control form-control-user" id="nm_lokasi" name="nm_lokasi" placeholder="Rumah/Gedung" value="<?= set_value('nm_lokasi'); ?>">
                                                <?= form_error('nm_lokasi', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Tanggal Acara</div>
                                                <input type="date" class="form-control form-control-user" id="tgl_pernikahan" name="tgl_pernikahan" value="<?= set_value('tgl_pernikahan'); ?>"></input>
                                                <?= form_error('tgl_pernikahan', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Waktu Mulai Acara</div>
                                                <input type="time" class="form-control form-control-user" id="w_mulai" name="w_mulai" value="<?= set_value('w_mulai'); ?>"></input>
                                                <?= form_error('w_mulai', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Waktu Selesai Acara</div>
                                                <input type="time" class="form-control form-control-user" id="w_selesai" name="w_selesai" value="<?= set_value('w_selesai'); ?>"></input>
                                                <?= form_error('w_selesai', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Tampilan Zona Waktu</div>
                                                <select name="z_waktu" id="z_waktu" class="form-control">
                                                    <?php foreach ($z_waktu as $w) : ?>
                                                        <?php if ($w == $lokasi['z_waktu']) : ?>
                                                            <option value="<?= $w; ?>" selected><?= $w; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $w ?>"><?= $w; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Acara Opsional</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Judul</div>
                                                <input type="text" class="form-control form-control-user" id="judul_acara2" name="judul_acara2" placeholder="Resepsi" value="<?= set_value('judul_acara2'); ?>">
                                                <?= form_error('judul_acara2', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Alamat</div>
                                                <input type="text" class="form-control form-control-user" id="alamat_acara2" name="alamat_acara2" placeholder="jl..." value="<?= set_value('alamat_acara2'); ?>"></input>
                                                <?= form_error('alamat_acara2', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Nama Lokasi</div>
                                                <input type="text" class="form-control form-control-user" id="nm_lokasi2" name="nm_lokasi2" placeholder="Rumah/Gedung" value="<?= set_value('nm_lokasi2'); ?>">
                                                <?= form_error('nm_lokasi2', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Tanggal Acara</div>
                                                <input type="date" class="form-control form-control-user" id="tgl_pernikahan2" name="tgl_pernikahan2" value="<?= set_value('tgl_pernikahan2'); ?>"></input>
                                                <?= form_error('tgl_pernikahan2', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Waktu Mulai Acara</div>
                                                <input type="time" class="form-control form-control-user" id="" name="w_mulai2" value="<?= set_value('w_mulai2'); ?>"></input>
                                                <?= form_error('w_mulai2', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Waktu Selesai Acara</div>
                                                <input type="time" class="form-control form-control-user" id="w_selesai2" name="w_selesai2" value="<?= set_value('w_selesai2'); ?>"></input>
                                                <?= form_error('w_selesai2', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Tampilan Zona Waktu</div>
                                                <select name="z_waktu2" id="z_waktu2" class="form-control">
                                                    <?php foreach ($z_waktu as $w) : ?>
                                                        <?php if ($w == $lokasi['z_waktu2']) : ?>
                                                            <option value="<?= $w; ?>" selected><?= $w; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $w ?>"><?= $w; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Share Lokasi</div>
                                                <input type="text" class="form-control form-control-user" id="sharelok" name="sharelok" value="<?= set_value('sharelok'); ?>"></input>
                                                <?= form_error('sharelok', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
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