<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-0">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-1">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-1">
                                        <h6 class="m-0 font-weight-bold text-primary text-center">Fitur Yang di Dapatkan</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-center"><?= $harga['fitur1']; ?></p>
                                        <p class="text-center"><?= $harga['fitur2']; ?></p>
                                        <p class="text-center"><?= $harga['fitur3']; ?></p>
                                        <p class="text-center"><?= $harga['fitur4']; ?></p>
                                        <p class="text-center"><?= $harga['fitur5']; ?></p>
                                        <p class="text-center"><?= $harga['fitur6']; ?></p>
                                        <p class="text-center"><?= $harga['fitur7']; ?></p>
                                        <p class="text-center"><?= $harga['fitur8']; ?></p>
                                        <p class="text-center"><?= $harga['fitur9']; ?></p>
                                        <p class="text-center font-weight-bold"><?= $harga['harga']; ?></p>
                                        <a href="<?= base_url('DashboardHalal/metode_pembayaran'); ?>" class="btn btn-google btn-block">Bayar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>