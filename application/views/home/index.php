<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Kreativa</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/reset.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/simplegrid.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/icomoon.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/lightcase.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>js/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>js/owl-carousel/owl.theme.css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>js/owl-carousel/owl.transitions.css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style.css">

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link href="<?= base_url('assets/') ?>css/col.css" rel="stylesheet">

</head>

<body id="home">
    <!-- Header -->
    <header id="top-header" class="header-home">
        <div class="grid">
            <div class="col-1-1">
                <div class="content">
                    <div class="logo-wrap">
                        <a href="#0" class="logo">Kreativa</a>
                    </div>
                    <nav class="navigation">
                        <input type="checkbox" id="nav-button">
                        <label for="nav-button" onclick></label>
                        <ul class="nav-container">
                            <li><a href="#home" class="current">Home</a></li>
                            <li><a href="#fitur">Fitur</a></li>
                            <li><a href="#desain">Desain</a></li>
                            <li><a href="#harga">Harga</a></li>
                            <li><a href="<?= base_url('auth'); ?>">Masuk</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- Parallax Section -->
    <div class="parallax-section parallax1">
        <div class="grid grid-pad">
            <div class="col-1-1">
                <div class="content content-header">
                    <h2>Undangan Digital</h2>
                    <p>Dikemas dalam bentuk aplikasi yang menarik serta dapat dibagikan kapanpun dan dimanapun.
                        Simple, 15 menit undangan selesai 😉</p>
                    <a target="_blank" class="btn btn-ghost" href="<?= base_url('auth/registrasi'); ?>">Buat Undangan</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Parallax Section -->

    <!-- CurveUp -->
    <svg class="curveUpColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
    </svg>

    <div class="wrap services-wrap" id="fitur">
        <section class="grid grid-pad services">
            <h3>Fitur Terbaik</h3>
            <p>Fitur undangan pernikahan online unggulan yang siap Kamu gunakan</p>

            <div class="row">
                <div class="col-6 col-md-6 mb-3 col-lg-3 service-box service-1">
                    <div class="content">
                        <div class="service-icon">
                            <i class="circle-icon icon-users"></i>
                        </div>
                        <div class="service-entry">
                            <h4>Nama Tamu</h4>
                            <p>Menampilkan nama tamu yang diundang agar terasa lebih dekat</p>
                            <!-- <a class="btn read-more" href="#0">Read More</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 mb-3 col-lg-3 service-box service-2">
                    <div class="content">
                        <div class="service-icon">
                            <i class="circle-icon icon-address-book"></i>
                        </div>
                        <div class="service-entry">
                            <h4>Buku Tamu</h4>
                            <p>Dapat menerima ucapan dan doa serta status kehadiran dari tamu undangan</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 mb-3 col-lg-3 service-box service-3">
                    <div class="content">
                        <div class="service-icon">
                            <i class="circle-icon icon-gift"></i>
                        </div>
                        <div class="service-entry">
                            <h4>Amplop Digital</h4>
                            <p>Tamu dapat memberikan amplop langsung secara digital</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 mb-3 col-lg-3 service-box service-4">
                    <div class="content">
                        <div class="service-icon">
                            <i class="circle-icon icon-compass2"></i>
                        </div>
                        <div class="service-entry">
                            <h4>Penunjuk Lokasi</h4>
                            <p>Dapat menunjukkan dan mengarahkan tamu ke lokasi acara</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 mb-3 col-lg-3 service-box service-4">
                    <div class="content">
                        <div class="service-icon">
                            <i class="circle-icon icon-images"></i>
                        </div>
                        <div class="service-entry">
                            <h4>Galeri Foto</h4>
                            <p>Bagikan momen bahagia Kamu kepada tamu undangan</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 mb-3 col-lg-3 service-box service-4">
                    <div class="content">
                        <div class="service-icon">
                            <i class="circle-icon icon-music"></i>
                        </div>
                        <div class="service-entry">
                            <h4>Background Musik</h4>
                            <p>Hiasi undangan digital online dengan musik kesukaanmu</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- CurveDown -->
    <svg class="curveDownColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M0 0 C 50 100 80 100 100 0 Z"></path>
    </svg>
    <!-- tutorial undangan ----------------------------------------------------------------------------------------------------------------->
    <div class="wrap blog-grid grey" id="blog">
        <div class="grid grid-pad">
            <div class="content">
                <h3>Langkah Pembuatan Undangan</h3>
                <p>Hanya butuh beberapa langkah dan menit saja hingga undangan Kamu siap digunakan</p>
                <div class="col-1-2">
                    <article class="post-wrap">
                        <div class="post">
                            <h2 class="entry-title"><a href="#0">Registrasi</a></h2>
                            <p class="">Buat akun baru dengan cara mengisikan email dan password.</p>
                        </div>
                    </article>
                </div>
                <div class="col-1-2">
                    <article class="post-wrap">
                        <div class="post">
                            <h2 class="entry-title"><a href="#0">Isi Informasi</a></h2>
                            <p>Isi informasi mengenai biodata, lokasi, dan waktu acara, dan upload foto dari galeri</p>
                        </div>
                    </article>
                </div>
                <div class="col-1-2">
                    <article class="post-wrap">
                        <div class="post">
                            <h2 class="entry-title"><a href="#0">Bagikan & Pantau</a></h2>
                            <p>Setelah undangan selesai dibuat, Kamu dapat langsung menyebarkan ke keluarga atau kerabat lalu pantau kehadiran serta ucapan dari tamu</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>


    <!-- Work Section -->
    <div class="wrap grey recent-wrap" id="desain">
        <section class="grid grid-pad">
            <div class="col-ml-1">
                <h3>Pilihan Desain</h3>
                <p>Pilih dan gunakan tema undangan pernikahan yang menarik serta unik</p>
                <div class="portfolio-items">

                    <div class="row">
                        <div class="col-6 col-md-6 mb-3 col-lg-3 mix illustration">
                            <div class="content">
                                <div class="recent-work">
                                    <img src="<?= base_url('assets/'); ?>images/work/2.png" alt="">
                                    <div class="overlay">
                                        <h2><a href="<?= base_url('Lihat_pernikahan'); ?>">Undangan Pernikahan</a></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 mb-3 col-lg-3 mix photography">
                            <div class="content">
                                <div class="recent-work">
                                    <img src="<?= base_url('assets/'); ?>images/work/ultah.png" alt="">
                                    <div class="overlay">
                                        <h2><a href="<?= base_url('Lihat_ultah'); ?>">Undangan Ulang Tahun</a></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 mb-3 col-lg-3 mix web-design">
                            <div class="content">
                                <div class="recent-work">
                                    <img src="<?= base_url('assets/'); ?>images/work/halal.png" alt="">
                                    <div class="overlay">
                                        <h2><a href="<?= base_url('Lihat_halal'); ?>">Undangan Halal Bi Halal</a></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 mb-3 col-lg-3 mix web-design">
                            <div class="content">
                                <div class="recent-work">
                                    <img src="<?= base_url('assets/'); ?>images/syukuran/desain/d1.png" alt="">
                                    <div class="overlay">
                                        <h2><a href="<?= base_url('Lihat_syukuran'); ?>">Undangan Syukuran</a></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1-1"><a class="btn" href="<?= base_url('Home/lihat_lainnya'); ?>">Lihat Lainnya</a></div>
        </section>
    </div>
    <!-- End Work Section -->

    <!-- CurveUp -->
    <svg class="curveUpColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
    </svg>

    <!-- Quotes Section -->
    <div class="wrap services-wrap">
        <section class="grid grid-pad">
            <div class="col-1-1 service-box cl-client-carousel-container">
                <div class="content">
                    <div class="cl-client-carousel">

                        <?php foreach ($ulasan as $u) : ?>
                            <div class="item client-carousel-item">
                                <!-- Start of item -->
                                <div class="quotes-icon">
                                    <i class="icon-quotes-left"></i>
                                </div>
                                <p><?= $u['ulasan']; ?></p>
                                <h4><?= $u['nama']; ?></h4>
                            </div><!-- End of item -->
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- End Quotes Section -->
    <svg class="curveUpColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
    </svg>
    <!-- Pricing Section -->
    <div class="wrap" id="harga">
        <div class="grid grid-pad">
            <div class="content">
                <div class="col-1-1">
                    <section id="price-tables">
                        <h3>Harga Undangan</h3>
                        <p>Paket undangan digital online sesuai dengan kebutuhanmu, tenang harganya terjangkau banget 😉</p>
                        <ul id="">
                            <div class="row">
                                <?php foreach ($harga as $h) : ?>
                                    <li class="plan col-6 col-md-6 mb-3 col-lg-3">
                                        <ul class="plan-wrap">
                                            <li class="title">
                                                <h2><?= $h['nama_undangan']; ?></h2>
                                                <h4></h4>
                                            </li>
                                            <li class="price">
                                                <p><?= $h['harga']; ?></p>
                                            </li>
                                            <li>
                                                <ul class="options">
                                                    <li><?= $h['fitur1']; ?></li>
                                                    <li><?= $h['fitur2']; ?></li>
                                                    <li><?= $h['fitur3']; ?></li>
                                                    <li><?= $h['fitur4']; ?></li>
                                                    <li><?= $h['fitur5']; ?></li>
                                                    <li><?= $h['fitur6']; ?></li>
                                                    <li><?= $h['fitur7']; ?></li>
                                                    <li><?= $h['fitur8']; ?></li>
                                                    <li><?= $h['fitur9']; ?></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="btn btn-price" href="<?= base_url('auth/registrasi'); ?>">Pilih Paket</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endforeach; ?>
                            </div>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- End Pricing Section -->

    <!-- CurveUp -->
    <svg class="curveUpColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
    </svg>

    <!-- Parallax Section -->
    <div class="map">
        <div class="wrap">
            <section id="cd-google-map">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2356.031277444641!2d110.723469707284!3d-6.7262818750709235!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70ddfad6a4c115%3A0xdd79e1ce95ce8eb4!2sKREATIVA%20MEDIA%20PRINTING!5e0!3m2!1sid!2sid!4v1659769787400!5m2!1sid!2sid" width="768" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <a href="https://www.whatismyip-address.com/divi-discount/"></a><br>
                        <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                height: 500px;
                                width: 1920px;
                            }
                        </style><a href="https://www.embedgooglemap.net">google maps on your website</a>
                        <style>
                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                height: 500px;
                                width: 500px;
                            }
                        </style>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="wrap contact" id="contact">
        <div class="grid grid-pad">
            <h2>Pertanyaan Umum</h2>
            <div class="content address col-ml-2">
                <h4>Apakah bisa di edit lagi?</h3>
                    <p>Undangan digital online kreativa.id dapat di edit kapanpun tanpa ada batas</p>
                    <h4>Berapa lama proses pembuatannya?</h3>
                        <p>Untuk pembuatan undangan digital online membutuhkan waktu sekitar 15 menit untuk mengisi data dan sudah bisa langsung disebar setelahnya</p>
                        <h4>Apakah tema bisa di custom?</h3>
                            <p>Mohon maaf, untuk saat ini tema undangan tidak dapat di custom, tapi Kami akan selalu mengembangkan tema sesuai dengan masukan dari pengguna 😉</p>
            </div>
        </div>
    </div>
    <!-- End Contact Section -->

    <!-- CurveDown -->
    <svg class="curveDownColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M0 0 C 50 100 80 100 100 0 Z"></path>
    </svg>

    <!-- Footer -->
    <footer class="wrap">
        <div class="grid grid-pad">
            <div class="col-1-1">
                <div class="content">
                    <div class="footer-widget">
                        <h3>Kreativa</h3>
                        <div class="textwidget">
                            <p>Kreativa.id adalah layanan untuk membuat undangan digital secara online dengan mudah. Undangan yang dibuat akan berbentuk sebuah website/aplikasi yang dapat di akses dan dibagikan kapanpun.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="social-footer">
            <div class="grid grid-pad">
                <div class="col-1-1">
                    <div class="content">
                        <div class="social-set">
                            <!-- <a href="#0"><i class="icon-instagram"></i></a> -->
                        </div>
                        <p class="source-org copyright">© 2022 | All Rights Reserved Created By Progaming</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <div class="loader-overlay">
        <div class="loader">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </div>

    <!-- JS -->
    <script src="<?= base_url('assets/'); ?>js/jquery.js"></script>
    <script src="<?= base_url('assets/'); ?>js/main.js"></script>
    <script src="<?= base_url('assets/'); ?>js/mixitup.js"></script>
    <script src="<?= base_url('assets/'); ?>js/smoothscroll.js"></script>
    <script src="<?= base_url('assets/'); ?>js/jquery.nav.js"></script>
    <script src="<?= base_url('assets/'); ?>js/owl-carousel/owl.carousel.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/jquery.counterup.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/lightcase.min.js"></script>
</body>

</html>