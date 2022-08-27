<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Tamu Undangan</h6>
                                    </div>
                                    <div class="card-body">
                                        <form class="user" action="<?= base_url('ulangtahun/edit_tamu/') . $list['id']; ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?= $list['id']; ?>">
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Nama Tamu</div>
                                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama" value="<?= $list['nama']; ?>">
                                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Simpan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>

<script>
    function sendWa() {
        let pesan = $('#pesan').val();
        pesan += '%0A %0A %0A http://localhost/kreativa2/pernikahan/hasil'
        window.open('https://api.whatsapp.com/send/?phone=6285742144699&text=' + pesan, '_blank');
    }
</script>