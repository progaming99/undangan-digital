    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg">
                <div class="p-1">
                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pilih Metode Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="card shadow">
                                <div class="card-body">
                                    Total Pembayaran
                                    <br>
                                    <?= $harga['harga']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card shadow">
                                <div class="card-body">
                                    Metode Pembayaran
                                    <br>
                                    <a href="<?= base_url('dashboard/shopeepay'); ?>" class="mb-1"> <img src="<?= base_url('assets/images/shopee.png'); ?>" alt="" width="40px" class="mb-3"></a> ShopeePay
                                    <br>
                                    <a href="<?= base_url('dashboard/bri'); ?>"> <img src="<?= base_url('assets/images/bri.png'); ?>" alt="" width="30px"></a> Bank BRI
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>