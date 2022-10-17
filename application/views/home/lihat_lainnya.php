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
                            <li><a href="<?= base_url('Home/beranda'); ?>" class="current">Home</a></li>
                            <li><a href="<?= base_url('Auth'); ?>">Masuk</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- Work Section -->
    <div class="wrap white recent-wrap" id="desain">
        <section class="grid grid-pad">
            <div class="col-ml-1">
                <h3>Pilihan Desain</h3>
                <p>Pilih dan gunakan tema undangan pernikahan yang menarik serta unik</p>
                <div class="portfolio-items">

                    <div class="row">
                        <?php foreach ($pernikahan as $d) : ?>
                            <div class="col-6 col-md-6 mb-3 col-lg-3 mix illustration">
                                <div class="content">
                                    <div class="recent-work">
                                        <img src="<?= base_url('assets/images/pernikahan/desain/') . $d['gambar']; ?>" alt="" width="auto" height="300">
                                        <div class="overlay">
                                            <h2>
                                                <a href="<?= base_url('Lihat_pernikahan'); ?>">Undangan Pernikahan</a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php foreach ($ultah as $d) : ?>
                            <div class="col-6 col-md-6 mb-3 col-lg-3 mix illustration">
                                <div class="content">
                                    <div class="recent-work">
                                        <img src="<?= base_url('assets/images/ultah/desain/') . $d['gambar']; ?>" alt="" width="150" height="300">
                                        <div class="overlay">
                                            <h2>
                                                <a href="<?= base_url('Lihat_ultah'); ?>">Undangan Ulang Tahun</a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php foreach ($halal as $d) : ?>
                            <div class="col-6 col-md-6 mb-3 col-lg-3 mix illustration">
                                <div class="content">
                                    <div class="recent-work">
                                        <img src="<?= base_url('assets/images/halal/desain/') . $d['gambar']; ?>" alt="" width="150" height="300">
                                        <div class="overlay">
                                            <h2>
                                                <a href="<?= base_url('Lihat_halal'); ?>">Undangan Halal bi Halal</a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php foreach ($syukuran as $d) : ?>
                            <div class="col-6 col-md-6 mb-3 col-lg-3 mix illustration">
                                <div class="content">
                                    <div class="recent-work">
                                        <img src="<?= base_url('assets/images/syukuran/desain/') . $d['gambar']; ?>" alt="" width="150" height="300">
                                        <div class="overlay">
                                            <h2>
                                                <a href="<?= base_url('Lihat_syukuran'); ?>">Undangan Syukuran</a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <div class="col-1-1"><a class="btn" href="<?= base_url('Home/beranda'); ?>">Kembali</a></div>
        </section>
    </div>

    <!-- End Work Section -->
    <svg class="curveDownColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M0 0 C 50 100 80 100 100 0 Z"></path>
    </svg>
    <!-- CurveDown -->

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
                            <a href="#0"><i class="icon-facebook"></i></a>
                            <a href="#0"><i class="icon-twitter"></i></a>
                            <a href="#0"><i class="icon-instagram"></i></a>
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