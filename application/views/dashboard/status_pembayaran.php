                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-0">
                                    <!-- Basic Card Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Kirim bukti pembayaran dengan total pembayaran
                                                <br>
                                                <?= $harga['harga']; ?>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg mt-5">
                                                <form class="user" action="<?= base_url('dashboard/status_pembayaran'); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="picture-container">
                                                        <div class="picture">
                                                            <img src="<?= base_url('assets/images/nota.png'); ?>" class="picture-src" id="wizardPicturePreview">
                                                            <input type="file" id="wizard-picture" name="image">
                                                        </div>
                                                        <h6>Upload Bukti Pembayaran</h6>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="small mb-1 ml-3">Nama Pengirim</div>
                                                        <input type="text" class="form-control form-control-user" id="nama_pengirim" name="nama_pengirim" placeholder="Nama Lengkap" value="">
                                                        <?= form_error('nama_pengirim', '<small class="text-danger pl-3">', '</small>'); ?>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                                        Kirim
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-0">
                                    <!-- Basic Card Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Status Pembayaran</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="card">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Nama Pengirim : <?= $bukti['nama_pengirim']; ?></li>
                                                    <li class="list-group-item">Tanggal Kirim : <?= date('d F Y', $bukti['tanggal']); ?></li>
                                                    <li class="list-group-item font-weight-bold text-primary">Status Pembayaran : <?= $bukti['status']; ?></li>
                                                </ul>
                                            </div>
                                            <p>Pembayaran anda akan kami verfikasi dalam waktu 1x24 jam, undangan dapat anda lihat setelah pembayaran
                                                terverefikasi oleh admin dan status pembayaran berubah menjadi <i class="bolt"> LUNAS</i> </p>
                                            <a href="<?= base_url('dashboard/akhir'); ?>" class="btn btn-success btn-icon-split mt-2">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-arrow-right"></i>
                                                </span>
                                                <span class="text">Lihat Undangan</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>