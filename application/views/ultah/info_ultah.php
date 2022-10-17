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
                                <form class="user" action="<?= base_url('ulangtahun/info_ultah'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="<?= base_url('assets/images/pernikahan/pria.jpg'); ?>" class="picture-src" id="wizardPicturePreview">
                                            <input type="file" id="wizard-picture" name="image" class="">
                                        </div>
                                        <h6>Pilih Foto</h6>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Panggilan</div>
                                        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Panggilan" value="<?= set_value('nama'); ?>">
                                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Lengkap</div>
                                        <input type="text" class="form-control form-control-user" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= set_value('nama_lengkap'); ?>">
                                        <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Ayah</div>
                                        <input type="text" class="form-control form-control-user" id="nm_ayah" name="nm_ayah" placeholder="Nama Ayah" value="<?= set_value('nm_ayah'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Nama Ibu</div>
                                        <input type="text" class="form-control form-control-user" id="nm_ibu" name="nm_ibu" placeholder="Nama Ibu" value="<?= set_value('nm_ibu'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Jenis Kelamin</div>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                            <?php foreach ($jenkel as $j) : ?>
                                                <?php if ($j == $ultah['jenkel']) : ?>
                                                    <option value="<?= $j; ?>" selected><?= $j; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $j ?>"><?= $j; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Urutan Anak</div>
                                        <input type="text" class="form-control form-control-user" id="urutan" name="urutan" placeholder="Anak Ke Berapa?" value="<?= set_value('urutan'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Ulang Tahun</div>
                                        <input type="text" class="form-control form-control-user" id="ultah_ke" name="ultah_ke" placeholder="Ulang Tahun Ke Berapa?" value="<?= set_value('ultah_ke'); ?>">
                                        <?= form_error('ultah_ke', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="small mb-1 ml-3">Ucapan Tambahan</div>
                                        <input type="text" class="form-control form-control-user" id="uc_tambahan" name="uc_tambahan" placeholder="Ucapan Tambahan" value="<?= set_value('uc_tambahan'); ?>">
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