<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-0">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-1">
                                <?= $this->session->flashdata('pesan'); ?>
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Daftar Tamu Undangan</h6>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">No HP</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                                <th scope="col">WA</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($undangan as $l) : ?>
                                                <tr>
                                                    <th scope="row"><?= ++$start; ?></th>
                                                    <td><?= $l['nama']; ?></td>
                                                    <td><?= $l['no_hp']; ?></td>
                                                    <td><?= $l['status'] == 0 ? "<span class='badge badge-warning'>Belum Diundang</span>" : "<span class='badge badge-success'>Sudah Diundang</span>"; ?></td>
                                                    <td>
                                                        <a href="<?= base_url(); ?>pernikahan/edit_list_undangan/<?= $l['id']; ?>" class="badge rounded-pill bg-warning">Edit</a>
                                                        <a href="<?= base_url(); ?>pernikahan/hapus_list_undangan/<?= $l['id']; ?>" class="badge rounded-pill bg-danger" onclick="return confirm('Apa anda yakin?');">Hapus</a>
                                                    </td>
                                                    <td><button type="button" onclick="sendWa(<?= $l['id'] ?>,<?= $l['no_hp'] ?>, '<?= $l['nama'] ?>')" class="btn btn-success">Success</button></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php if (empty($undangan)) : ?>
                                    <div class="alert alert-warning" role="alert">
                                        Daftar Tamu Masih Kosong!
                                    </div>
                                <?php endif; ?>
                                <form class="user" action="<?= base_url('pernikahan/list_undangan'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Tambah Tamu</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="small mb-1 ml-3">Nama Tamu</div>
                                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama" value="<?= set_value('nama'); ?>">
                                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>

                                                <div class="small mb-1 ml-3">No HP</div>
                                                <input type="text" class="form-control form-control-user" id="no_hp" name="no_hp" placeholder="No HP" value="<?= set_value('no_hp'); ?>">
                                                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>

                                                <div class="small mb-1 ml-3">Kalimat Undangan</div>
                                                <input type="text" class="form-control form-control-user" id="pesan" name="pesan" placeholder="pesan" value="<?= set_value('nama'); ?>">

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

<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>

<script>
    function sendWa(id, hp, nm) {
        $.ajax({
            url: "<?= base_url() . 'pernikahan/update_status_kirim_wa?id=' ?>" + id,
            type: "GET",
        });
        let pesan = $('#pesan').val();
        let url = "<?= base_url() ?>";
        pesan += url;
        pesan += 'Upernikahan?to=' + nm;
        window.open('https://api.whatsapp.com/send/?phone=' + hp + '&text=' + pesan, '_blank');
    }
</script>