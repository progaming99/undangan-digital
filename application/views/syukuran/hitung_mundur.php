<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-0">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-1">
                                <form class="user" action="<?= base_url('Syukuran/hitung_mundur'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Hitung Mundur</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Tahun</div>
                                                <input type="number" class="form-control form-control-user" id="tahun" name="tahun" placeholder="2022" value="<?= set_value('tahun'); ?>">
                                                <?= form_error('tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Bulan</div>
                                                <input type="number" class="form-control form-control-user" id="bulan" name="bulan" placeholder="05" value="<?= set_value('bulan'); ?>">
                                                <?= form_error('bulan', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Tanggal</div>
                                                <input type="number" class="form-control form-control-user" id="hari" name="hari" placeholder="30" value="<?= set_value('hari'); ?>">
                                                <?= form_error('hari', '<small class="text-danger pl-3">', '</small>'); ?>
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
                </div>
            </div>
        </div>
    </div>
</div>