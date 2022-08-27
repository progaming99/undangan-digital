<form class="" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $pembayaran['id_user']; ?>">
    <div class="card shadow mb-4 ml-3 mr-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Status Pembayaran</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="small mb-1 ml-3">Nama Pengirim</div>
                <input type="text" class="form-control form-control-user" id="nama_pengirim" name="nama_pengirim" placeholder="Akad" value="<?= $pembayaran['nama_pengirim']; ?>" readonly>
            </div>
            <img src="<?= base_url('assets/images/pembayaran/') . $pembayaran['image']; ?>" class="img-fluid" width="500px" alt="...">
            <div class="form-group">
                <div class="small mb-1 ml-3">Status Pembayaran</div>
                <select name="status" id="status" class="form-control form-control-user" value="<?= $pembayaran['status']; ?>">
                    <?php foreach ($status as $s) : ?>
                        <?php if ($s == $pembayaran['status']) : ?>
                            <option value="<?= $s; ?>" selected><?= $s; ?></option>
                        <?php else : ?>
                            <option value="<?= $s ?>"><?= $s; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block ml-3 mr-3">
        Simpan
    </button>
</form>