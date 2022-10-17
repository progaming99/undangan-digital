<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-0">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-1">
                                <form class="user" action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $lokasi['id']; ?>">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-1">
                                            <h6 class="m-0 font-weight-bold text-primary">Lokasi Ulang Tahun</h6>
                                        </div>
                                        <div class="form-group">
                                            <div class="small mb-1 ml-3">Judul</div>
                                            <input type="text" class="form-control form-control-user" id="judul_acara" name="judul_acara" placeholder="Judul Acara" value="<?= $lokasi['judul_acara']; ?>">
                                            <?= form_error('judul_acara', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="small mb-1 ml-3">Alamat</div>
                                            <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="jl..." value="<?= $lokasi['alamat']; ?>"></input>
                                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="small mb-1 ml-3">Nama Lokasi</div>
                                            <input type="text" class="form-control form-control-user" id="nm_lokasi" name="nm_lokasi" placeholder="Rumah/Gedung" value="<?= $lokasi['nm_lokasi']; ?>">
                                            <?= form_error('nm_lokasi', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="small mb-1 ml-3">Tanggal Acara</div>
                                            <input type="date" class="form-control form-control-user" id="tgl_acara" name="tgl_acara" placeholder="Ucapan Tambahan" value="<?= $lokasi['tgl_acara']; ?>"></input>
                                            <?= form_error('tgl_acara', '<small class="text-danger pl-3">', '</small>'); ?>
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
                                            <select name="z_waktu" id="z_waktu" class="form-control">
                                                <?php foreach ($zona as $j) : ?>
                                                    <?php if ($j == $lokasi['z_waktu']) : ?>
                                                        <option value="<?= $j; ?>" selected><?= $j; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $j ?>"><?= $j; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('z_waktu', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="small mb-1 ml-3">Bagikan Lokasi</div>
                                            <input type="text" class="form-control form-control-user" id="sharelok" name="sharelok" placeholder="Url Map" value="<?= $lokasi['sharelok']; ?>"></input>
                                        </div>
                                        <button type="submit" name="edit" class="btn btn-primary btn-user btn-block">
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