<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-8">
            <form method="POST" action="<?= base_url('DashboardHalal/tambah_musik'); ?>" enctype="multipart/form-data">
                <div class="row mb-2">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="1. <?= $musik_data['musik']; ?>" readonly>
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="name" class="col-sm-2 col-form-label">Musik</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="file" class="form-control" name="musik">
                            <label class="input-group-text" for="image">Upload</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>