<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kirim Ulasan</h6>
    </div>
    <div class="card-body">
        <form class="user" action="<?= base_url('DashboardSyukuran/ulasan'); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Tulis Sesuatu..." value="<?= $user['nama']; ?>">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="ulasan" name="ulasan" placeholder="Tulis Sesuatu..." value="">
                <?= form_error('ulasan', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Simpan
            </button>
        </form>
    </div>
</div>