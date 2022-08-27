<div class="row">
    <div class="col-lg-10">
        <div class="p-5">
            <div class="text-left">
                <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
            </div>
            <form method="POST" action="<?= base_url('user/edit_mundur/') . $hitung_mundur['id']; ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $hitung_mundur['id']; ?>">
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="text" class="form-control form-control-user" id="tahun" name="tahun" value="<?= $hitung_mundur['tahun']; ?>">
                    <?= form_error('tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <input type="text" class="form-control form-control-user" id="bulan" name="bulan" value="<?= $hitung_mundur['bulan']; ?>">
                    <?= form_error('bulan', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="hari">Tanggal Acara</label>
                    <input type="text" class="form-control form-control-user" id="hari" name="hari" value="<?= $hitung_mundur['hari']; ?>">
                    <?= form_error('hari', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <p class="text-right">Contoh :<span class="text-info"> 2021 08 10</span></p>

                <a class="btn btn-sm btn-info text-decoration-none" href="<?= base_url('user/mundur') ?>"> Kembali</a>
                <button type="submit" class="btn btn-sm btn-success my-3">
                    Save
                </button>
            </form>
        </div>
    </div>
</div>