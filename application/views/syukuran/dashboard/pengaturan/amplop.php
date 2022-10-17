<div class="row">
    <div class="col-lg">
        <div class="p-1">
            <form class="user" action="<?= base_url('DashboardSyukuran/amplop'); ?>" method="POST" enctype="multipart/form-data">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Isi Data Amplop</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="small mb-1 ml-3">Nama Bank</div>
                            <input type="text" class="form-control form-control-user" name="nama_bank" placeholder="BRI/DANA/ShopeePay/OVO" value="<?= set_value('nama_bank'); ?><?= $amplop['nama_bank']; ?>">
                            <?= form_error('nama_bank', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="small mb-1 ml-3">No Rekening</div>
                            <input type="text" class="form-control form-control-user" name="no_rek" placeholder="No Rekening/No Dana/ShopeePay" value="<?= set_value('no_rek'); ?><?= $amplop['no_rek']; ?>"></input>
                            <?= form_error('no_rek', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="small mb-1 ml-3">Atas Nama</div>
                            <input type="text" class="form-control form-control-user" name="an" placeholder="No Rekening/No Dana/ShopeePay" value="<?= set_value('an'); ?><?= $amplop['an']; ?>"></input>
                            <?= form_error('an', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="small mb-1 ml-3">Alamat Kirim Hadiah</div>
                            <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Jl. Pandanaran Simpang KM7 no.8" value="<?= set_value('alamat'); ?><?= $amplop['alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <div class="small mb-1 ml-3">No HP</div>
                            <input type="number" class="form-control form-control-user" id="no_hp" name="no_hp" placeholder="No hp penerima hadiah (paket)" value="<?= set_value('no_hp'); ?><?= $amplop['no_hp']; ?>">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Simpan
                </button>
            </form>
            <hr>
        </div>
    </div>
</div>