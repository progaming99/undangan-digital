<div class="row">
    <div class="col-lg-8">
        <div class="p-5">
            <div class="text-left">
                <h1 class="h4 text-gray-900 mb-4">Form Tambah Lowongan Kerja</h1>
            </div>
            <form method="POST" action="<?= base_url('admin/tambahkerja'); ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="judul1">Judul Lowongan</label>
                    <input type="text" class="form-control form-control-user" id="judul1" name="judul1">
                    <?= form_error('judul1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="judul2">Jabatan</label>
                    <input type="text" class="form-control form-control-user" id="judul2" name="judul2">
                    <?= form_error('judul2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="tentang_perusahaan">Tentang Perusahaan</label>
                    <textarea class="form-control" id="tentang_perusahaan" name="tentang_perusahaan" rows="10" cols="10"></textarea>
                    <?= form_error('tentang_perusahaan', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Pilih Gambar</label>
                </div>
                <div class="form-group mt-3">
                    <textarea class="form-control" id="editor" name="kualifikasi" rows="10" cols="10"></textarea>
                    <?= form_error('kualifikasi', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-success my-3">
                    Tambah
                </button>
                <a class="btn btn-info text-decoration-none" href="<?= base_url('admin/carikerja') ?>"> Kembali</a>
            </form>
            <hr>
        </div>
    </div>
</div>