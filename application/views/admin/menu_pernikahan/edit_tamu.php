<form class="user" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $list['id']; ?>">
    <div class="card shadow mb-4 ml-3 mr-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tamu Undangan</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="small mb-1 ml-3">Nama Tamu</div>
                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Tamu" value="<?= $list['nama']; ?>">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <div class="small mb-1 ml-3">No HP</div>
                <input type="text" class="form-control form-control-user" id="no_hp" name="no_hp" placeholder="no_hp" value="<?= $list['no_hp']; ?>">
                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block ml-3 mr-3">
            Simpan
        </button>
    </div>
</form>