<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Bayar IDR <?= $harga['harga']; ?> Dengan <img src="<?= base_url('assets/images/bri.png'); ?>" alt="" width="40px" class="mb-3"></h6>
    </div>
    <div class="card-body text-center">
        Nomor Rekening
        <br>
        <?= $bayar['no_rek']; ?>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <h6 class="font-weight-bold text-primary">Penting!</h6>
        <br>
        * Transfer dengan jumlah yang tepat hingga 3 digit terakhir.
        <br>
        * Demi keamanan transaksi, jangan berikan bukti transfer kepada siapapun.
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        1. Lakukan pembayaran melalui ATM / mobile banking / internet banking / SMS banking / kantor bank terdekat.
        <br>
        2. Isi nomor rekening tujuan sesuai yang ada di halaman, menunggu, pembayaran (a.n Kreativa).
        <br>
        3. Masukan nominal pembayaran sesuai jumlah tagihanmu, terimasuk 3 digit terakhir.
        <br>
        4. Pembayaran akan di verifikasi oleh Kreativa paling lambat 1x24 jam untuk sesama bank, dan 2-24 jam di hari kerja jika antar bank yang berbeda.
    </div>
</div>

<a href="<?= base_url('DashboardPernikahan/status_pembayaran'); ?>" class="btn btn-info btn-icon-split">
    <span class="icon text-white-50">
        <i class="fas fa-info-circle"></i>
    </span>
    <span class="text">Bayar</span>
</a>