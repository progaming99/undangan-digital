<form class="user" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $lokasi['id']; ?>">
    <div class="card shadow mb-4 ml-3 mr-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Acara Utama</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="small mb-1 ml-3">Judul</div>
                <input type="text" class="form-control form-control-user" id="judul_acara" name="judul_acara" placeholder="Akad" value="<?= $lokasi['judul_acara']; ?>">
                <?= form_error('judul_acara', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Alamat</div>
                <input type="text" class="form-control form-control-user" id="alamat_acara" name="alamat_acara" placeholder="jl..." value="<?= $lokasi['alamat_acara']; ?>"></input>
                <?= form_error('alamat_acara', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Nama Lokasi</div>
                <input type="text" class="form-control form-control-user" id="nm_lokasi" name="nm_lokasi" placeholder="Rumah/Gedung" value="<?= $lokasi['nm_lokasi']; ?>">
                <?= form_error('nm_lokasi', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Tanggal Acara</div>
                <input type="date" class="form-control form-control-user" id="tgl_pernikahan" name="tgl_pernikahan" placeholder="Ucapan Tambahan" value="<?= $lokasi['tgl_pernikahan']; ?>"></input>
                <?= form_error('tgl_pernikahan', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Waktu Mulai Acara</div>
                <input type="time" class="form-control form-control-user" id="w_mulai" name="w_mulai" placeholder="Ucapan Tambahan" value="<?= $lokasi['w_mulai']; ?>"></input>
                <?= form_error('w_mulai', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Waktu Selesai Acara</div>
                <input type="time" class="form-control form-control-user" id="w_selesai" name="w_selesai" placeholder="Ucapan Tambahan" value="<?= $lokasi['w_selesai']; ?>"></input>
                <?= form_error('w_selesai', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Tampilan Zona Waktu</div>
                <select name="z_waktu" id="z_waktu" class="form-control form-control-user" value="<?= $lokasi['z_waktu']; ?>">
                    <?php foreach ($zona as $z) : ?>
                        <?php if ($z == $lokasi['zona']) : ?>
                            <option value="<?= $z; ?>" selected><?= $z; ?></option>
                        <?php else : ?>
                            <option value="<?= $z ?>"><?= $z; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?= form_error('z_waktu', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 ml-3 mr-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Acara Opsional</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="small mb-1 ml-3">Judul</div>
                <input type="text" class="form-control form-control-user" id="judul_acara2" name="judul_acara2" placeholder="Akad" value="<?= $lokasi['judul_acara2']; ?>">
                <?= form_error('judul_acara2', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Alamat</div>
                <input type="text" class="form-control form-control-user" id="alamat_acara2" name="alamat_acara2" placeholder="Jl..." value="<?= $lokasi['alamat_acara2']; ?>"></input>
                <?= form_error('alamat_acara2', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Nama Lokasi</div>
                <input type="text" class="form-control form-control-user" id="nm_lokasi2" name="nm_lokasi2" placeholder="Rumah/Gedung" value="<?= $lokasi['nm_lokasi2']; ?>">
                <?= form_error('nm_lokasi2', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Tanggal Acara</div>
                <input type="date" class="form-control form-control-user" id="tgl_pernikahan2" name="tgl_pernikahan2" placeholder="Ucapan Tambahan" value="<?= $lokasi['tgl_pernikahan2']; ?>"></input>
                <?= form_error('tgl_pernikahan2', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Waktu Mulai Acara</div>
                <input type="time" class="form-control form-control-user" id="w_mulai2" name="w_mulai2" placeholder="Ucapan Tambahan" value="<?= $lokasi['w_mulai2']; ?>"></input>
                <?= form_error('w_mulai2', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Waktu Selesai Acara</div>
                <input type="time" class="form-control form-control-user" id="w_selesai2" name="w_selesai2" placeholder="Ucapan Tambahan" value="<?= $lokasi['w_selesai2']; ?>"></input>
                <?= form_error('w_selesai2', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">Tampilan Zona Waktu</div>
                <select name="z_waktu2" id="z_waktu2" class="form-control form-control-user" value="<?= $lokasi['z_waktu2']; ?>">
                    <?php foreach ($zona as $z) : ?>
                        <?php if ($z == $lokasi['zona']) : ?>
                            <option value="<?= $z; ?>" selected><?= $z; ?></option>
                        <?php else : ?>
                            <option value="<?= $z ?>"><?= $z; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?= form_error('z_waktu2', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block ml-3 mr-3">
        Simpan
    </button>
</form>