<div class="container-fluid">
    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center "><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg">
                    <?= form_open_multipart('user/edit'); ?>
                    <div class="picture-container">
                        <div class="picture">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="picture-src" id="wizardPicturePreview">
                            <input type="file" id="wizard-picture" name="image" class="">
                        </div>
                        <h6>Pilih Foto</h6>
                    </div>
                    <p class="card-text"><small class="text-muted">Member sejak <?= date('d F Y', $user['created_at']); ?></small></p>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-sm btn-info">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>