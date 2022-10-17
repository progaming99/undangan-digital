<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-0">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-1">
                                <form class="user" action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $amplop['id']; ?>">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Isi Metode Pembayaran</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Nama Bank</div>
                                                <input type="text" class="form-control form-control-user" name="nama_bank" placeholder="BRI/DANA/ShopeePay/OVO" value="<?= $amplop['nama_bank']; ?>">
                                                <?= form_error('nama_bank', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">No Rekening</div>
                                                <input type="text" class="form-control form-control-user" name="no_rek" placeholder="No Rekening/No Dana/ShopeePay" value="<?= $amplop['no_rek']; ?>"></input>
                                                <?= form_error('no_rek', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Atas Nama</div>
                                                <input type="text" class="form-control form-control-user" name="an" placeholder="Atas Nama" value="<?= $amplop['an']; ?>"></input>
                                                <?= form_error('an', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">No HP</div>
                                                <input type="text" class="form-control form-control-user" name="no_hp" placeholder="No Handphone" value="<?= $amplop['no_hp']; ?>"></input>
                                                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Alamat Kirim Hadiah</div>
                                                <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Jl. Pandanaran Simpang KM7 no.8" value="<?= $amplop['alamat']; ?>">
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