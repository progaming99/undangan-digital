<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-7">
            <?= $this->session->flashdata('pesan'); ?>
            <form action="<?= base_url('user/gantipassword') ?>" method="POST">
                <div class="form-group">
                    <label for="password_lama">Password lama</label>
                    <input type="password" name="password_lama" class="form-control" id="password_lama">
                    <?= form_error('password_lama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="password1baru">Password baru</label>
                    <input type="password" name="password1baru" class="form-control" id="password1baru">
                    <?= form_error('password1baru', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="password2baru">Konfirmasi password</label>
                    <input type="password" name="password2baru" class="form-control" id="password2baru">
                    <?= form_error('password2baru', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Ganti Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->