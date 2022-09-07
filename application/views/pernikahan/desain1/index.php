<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Wedding &mdash; 100% Free Fully Responsive HTML5 Template by FREEHTML5.co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

	<!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="" />
	<meta property="og:image" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:description" content="" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="<?= base_url('assets/'); ?>css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?= base_url('assets/'); ?>css/icomoon2.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap2.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="<?= base_url('assets/'); ?>css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="<?= base_url('assets/'); ?>css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/'); ?>css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style2.css">

	<!-- Modernizr JS -->
	<script src="<?= base_url('assets/'); ?>js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>

	<div class="fh5co-loader"></div>

	<div id="page">
		<nav class="fh5co-nav" role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-xs-2">
						<div id="fh5co-logo"><a href="index.html">Wedding<strong>.</strong></a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li class="active"><a href="index.html">Home</a></li>
							<li><a href="about.html">Story</a></li>
							<li class="has-dropdown">
								<a href="services.html">Services</a>
								<ul class="dropdown">
									<li><a href="#">Web Design</a></li>
									<li><a href="#">eCommerce</a></li>
									<li><a href="#">Branding</a></li>
									<li><a href="#">API</a></li>
								</ul>
							</li>
							<li class="has-dropdown">
								<a href="gallery.html">Gallery</a>
								<ul class="dropdown">
									<li><a href="#">HTML5</a></li>
									<li><a href="#">CSS3</a></li>
									<li><a href="#">Sass</a></li>
									<li><a href="#">jQuery</a></li>
								</ul>
							</li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div>
				</div>

			</div>
		</nav>

		<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url(<?= base_url('assets/images/pernikahan/desain1/img_bg_2.jpg'); ?>);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<div class="display-t">
							<div class="display-tc animate-box" data-animate-effect="fadeIn">
								<h1><?= $nama['np_pria']; ?> &amp; <?= $nama['np_wanita']; ?></h1>
								<h2>We Are Getting Married</h2>
								<div class="simply-countdown simply-countdown-one"></div>
								<p><a href="#" class="btn btn-default btn-sm">Save the date</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div id="fh5co-couple">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
						<h2>Hello!</h2>
						<h3>November 28th, 2016 New York, USA</h3>
						<p>We invited you to celebrate our wedding</p>
					</div>
				</div>
				<div class="couple-wrap animate-box">
					<div class="couple-half">
						<div class="groom">
							<img src="<?= base_url('assets/images/pernikahan/') . $nama['image']; ?>" alt="groom" class="img-responsive">
						</div>
						<div class="desc-groom">
							<h3><?= $nama['nl_pria']; ?></h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove</p>
						</div>
					</div>
					<p class="heart text-center"><i class="icon-heart2"></i></p>
					<div class="couple-half">
						<div class="bride">
							<img src="<?= base_url('assets/images/pernikahan/') . $nama['image2']; ?>" alt="groom" class="img-responsive">
						</div>
						<div class="desc-bride">
							<h3><?= $nama['nl_wanita']; ?></h3>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-event" class="fh5co-bg" style="background-image:url(images/img_bg_3.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
						<span>Hari Yang Kita Tunggu</span>
						<h2>Acara Pernikahan</h2>
					</div>
				</div>
				<div class="row">
					<div class="display-t">
						<div class="display-tc">
							<div class="col-md-10 col-md-offset-1">
								<div class="col-md-6 col-sm-6 text-center">
									<div class="event-wrap animate-box">
										<h3><?= $lokasi['judul_acara']; ?></h3>
										<div class="event-col">
											<i class="icon-clock"></i>
											<span><?= $lokasi['w_mulai']; ?> <?= $lokasi['z_waktu']; ?></span>
											<span><?= $lokasi['w_selesai']; ?> <?= $lokasi['z_waktu']; ?></span>
										</div>
										<div class="event-col">
											<i class="icon-calendar"></i>
											<span><?= $lokasi['tgl_pernikahan']; ?></span>
										</div>
										<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 text-center">
									<div class="event-wrap animate-box">
										<h3><?= $lokasi['judul_acara2']; ?></h3>
										<div class="event-col">
											<i class="icon-clock"></i>
											<span><?= $lokasi['w_mulai2']; ?> <?= $lokasi['z_waktu2']; ?></span>
											<span><?= $lokasi['w_selesai2']; ?> <?= $lokasi['z_waktu2']; ?></span>
										</div>
										<div class="event-col">
											<i class="icon-calendar"></i>
											<span><?= $lokasi['tgl_pernikahan2']; ?></span>
										</div>
										<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-gallery" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
						<span>Our Memories</span>
						<h2>Wedding Gallery</h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row row-bottom-padded-md">
					<div class="col-md-12">
						<ul id="fh5co-gallery-list">
							<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?= base_url('assets/images/pernikahan/gallery/') . $gallery['image']; ?>); ">
								<a href="images/gallery-1.jpg">
									<div class="case-studies-summary">
										<span>14 Photos</span>
										<h2>Two Glas of Juice</h2>
									</div>
								</a>
							</li>

							<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?= base_url('assets/images/pernikahan/gallery/') . $gallery['image2']; ?>); ">
								<a href="#" class="color-2">
									<div class="case-studies-summary">
										<span>30 Photos</span>
										<h2>Timer starts now!</h2>
									</div>
								</a>
							</li>

							<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?= base_url('assets/images/pernikahan/gallery/') . $gallery['image3']; ?>); ">
								<a href="#" class="color-3">
									<div class="case-studies-summary">
										<span>90 Photos</span>
										<h2>Beautiful sunset</h2>
									</div>
								</a>
							</li>
							<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?= base_url('assets/images/pernikahan/gallery/') . $gallery['image4']; ?>); ">
								<a href="#" class="color-4">
									<div class="case-studies-summary">
										<span>12 Photos</span>
										<h2>Company's Conference Room</h2>
									</div>
								</a>
							</li>

							<li class="one-third animate-box" data-animate-effect="fadeIn" style="background-image: url(<?= base_url('assets/images/pernikahan/gallery/') . $gallery['image5']; ?>); ">
								<a href="#" class="color-3">
									<div class="case-studies-summary">
										<span>50 Photos</span>
										<h2>Useful baskets</h2>
									</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-testimonial">
			<div class="container">
				<div class="row">
					<div class="row animate-box">
						<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
							<span>Best Wishes</span>
							<h2>Friends Wishes</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 animate-box">
							<div class="wrap-testimony">
								<div class="owl-carousel-fullwidth">
									<div class="item">
										<div class="testimony-slide active text-center">
											<figure>
												<img src="images/couple-1.jpg" alt="user">
											</figure>
											<span><?= $quotes['nama']; ?></span>
											<blockquote>
												<p>"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics"</p>
											</blockquote>
										</div>
									</div>
									<div class="item">
										<div class="testimony-slide active text-center">
											<figure>
												<img src="images/couple-2.jpg" alt="user">
											</figure>
											<span>John Doe, via</span>
											<blockquote>
												<p>"Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, at the coast of the Semantics, a large language ocean."</p>
											</blockquote>
										</div>
									</div>
									<div class="item">
										<div class="testimony-slide active text-center">
											<figure>
												<img src="images/couple-3.jpg" alt="user">
											</figure>
											<span>John Doe, via <a href="#" class="twitter">Twitter</a></span>
											<blockquote>
												<p>"Far far away, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean."</p>
											</blockquote>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-services" class="fh5co-section-gray">
			<div class="container">

				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
						<h2>We Offer Services</h2>
						<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
							<span class="icon">
								<i class="icon-calendar"></i>
							</span>
							<div class="feature-copy">
								<h3>We Organized Events</h3>
								<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
							</div>
						</div>

						<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
							<span class="icon">
								<i class="icon-image"></i>
							</span>
							<div class="feature-copy">
								<h3>Photoshoot</h3>
								<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
							</div>
						</div>

						<div class="feature-left animate-box" data-animate-effect="fadeInLeft">
							<span class="icon">
								<i class="icon-video"></i>
							</span>
							<div class="feature-copy">
								<h3>Video Editing</h3>
								<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
							</div>
						</div>

					</div>

					<div class="col-md-6 animate-box">
						<div class="fh5co-video fh5co-bg" style="background-image: url(images/img_bg_3.jpg); ">
							<a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo"><i class="icon-video2"></i></a>
							<div class="overlay"></div>
						</div>
					</div>
				</div>


			</div>
		</div>


		<div id="fh5co-started" class="fh5co-bg" style="background-image:url(images/img_bg_4.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
						<h2>Are You Attending?</h2>
						<p>Please Fill-up the form to notify you that you're attending. Thanks.</p>
					</div>
				</div>
				<div class="row animate-box">
					<div class="col-md-10 col-md-offset-1">
						<form class="form-inline">
							<div class="col-md-4 col-sm-4">
								<div class="form-group">
									<label for="name" class="sr-only">Name</label>
									<input type="name" class="form-control" id="name" placeholder="Name">
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
								<div class="form-group">
									<label for="email" class="sr-only">Email</label>
									<input type="email" class="form-control" id="email" placeholder="Email">
								</div>
							</div>
							<div class="col-md-4 col-sm-4">
								<button type="submit" class="btn btn-default btn-block">I am Attending</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<footer id="fh5co-footer" role="contentinfo">
			<div class="container">

				<div class="row copyright">
					<div class="col-md-12 text-center">
						<p>
							<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small>
							<small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>
						</p>
						<p>
						<ul class="fh5co-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
						</p>
					</div>
				</div>

			</div>
		</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

	<!-- jQuery -->
	<script src="<?= base_url('assets/'); ?>js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="<?= base_url('assets/'); ?>js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="<?= base_url('assets/'); ?>js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="<?= base_url('assets/'); ?>js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="<?= base_url('assets/'); ?>js/jquery.countTo.js"></script>

	<!-- Stellar -->
	<script src="<?= base_url('assets/'); ?>js/jquery.stellar.min.js"></script>
	<!-- Magnific Popup -->
	<script src="<?= base_url('assets/'); ?>js/jquery.magnific-popup.min.js"></script>
	<script src="<?= base_url('assets/'); ?>js/magnific-popup-options.js"></script>

	<!-- // <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js"></script> -->
	<script src="<?= base_url('assets/'); ?>js/simplyCountdown.js"></script>
	<!-- Main -->
	<script src="<?= base_url('assets/'); ?>js/main2.js"></script>

	<script>
		var d = new Date(new Date().getTime() + 200 * 120 * 120 * 2000);

		// default example
		simplyCountdown('.simply-countdown-one', {
			year: d.getFullYear(),
			month: d.getMonth() + 1,
			day: d.getDate()
		});

		//jQuery example
		$('#simply-countdown-losange').simplyCountdown({
			year: d.getFullYear(),
			month: d.getMonth() + 1,
			day: d.getDate(),
			enableUtc: false
		});
	</script>

</body>

</html>