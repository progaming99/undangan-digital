<?= $this->session->flashdata('pesan'); ?>

<style>
    .card-input-element:checked+.card-input {
        border: 2px solid #48ABF7;
    }

    .card-input-element {
        display: none;
    }

    .card-input:hover {
        cursor: pointer;
    }
</style>
</head>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pilih Desain Undangan</h6>
    </div>
    <div class="row">
        <?php foreach ($template_pernikahan as $temp) : ?>
            <div class="col-6 col-md-6 mb-3 col-lg-3">
                <label>
                    <input type="radio" class="card-input-element" id="radio_card" name="selected_theme" value="<?= $temp->id; ?>" required>
                    <div class="card-body text-center card h-100 mb-0 card-input">
                        <div class="mb-1">
                            <img class="card" src='<?= base_url() . "assets/images/pernikahan/desain/$temp->gambar" ?>' alt="<?= $temp->nama_template; ?>" width="136" height="270">
                        </div>
                        <h6>
                            <?= $temp->nama_template; ?>
                        </h6>
                    </div>
                </label>
            </div>
        <?php endforeach; ?>
    </div>
    <a onclick="simpanDesain()" class="btn btn-info rounded d-block">simpan</a>
</div>

<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function simpanDesain() {
        const id_template = $("input[type='radio']:checked").val();
        $.ajax({
            url: '<?= base_url() . "DashboardPernikahan/simpanTemplate" ?>',
            type: "POST",
            dataType: "JSON",
            data: {
                id_template: id_template
            },
            success: function(res) {

                if (res.success) {
                    Swal.fire({
                        // position: 'top-end',
                        icon: 'success',
                        title: 'Desain berhasil di pilih',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        // position: 'top-end',
                        icon: 'danger',
                        title: 'Gagal memilih desain',
                        // showConfirmButton: false,
                        // timer: 1500
                    })
                }
            }
        })

    }
</script>