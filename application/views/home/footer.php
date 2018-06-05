<!-- Start Section -->
<div class="section footer-scetion footer-particle section-pad-sm section-bg-dark">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-xl-4 res-l-bttm">
				<a class="footer-brand animated" data-animate="fadeInUp" data-delay="0" href="./">
					<img class="logo logo-light" alt="logo" src="<?php echo site_url(); ?>images/logo_kick.png" srcset="<?php echo site_url(); ?>images/logo_kick.png">
				</a>
				<ul class="social">
					<li class="animated" data-animate="fadeInUp" data-delay=".1"><a href="#"><em class="fa fa-facebook"></em></a></li>
					<li class="animated" data-animate="fadeInUp" data-delay=".2"><a href="#"><em class="fa fa-twitter"></em></a></li>
					<li class="animated" data-animate="fadeInUp" data-delay=".3"><a href="#"><em class="fa fa-youtube-play"></em></a></li>
					<li class="animated" data-animate="fadeInUp" data-delay=".4"><a href="#"><em class="fa fa-github"></em></a></li>
					<li class="animated" data-animate="fadeInUp" data-delay=".5"><a href="#"><em class="fa fa-bitcoin"></em></a></li>
					<li class="animated" data-animate="fadeInUp" data-delay=".6"><a href="#"><em class="fa fa-medium"></em></a></li>
				</ul>
			</div><!-- .col  -->
			<div class="col-sm-6 col-xl-4 res-l-bttm">
				<div class="footer-subscription">
					<h6 class="animated" data-animate="fadeInUp" data-delay=".6">Subscreve à nossa Newsletter</h6>
					<form id="subscribe-form" action="form/subscribe.php" method="post" class="subscription-form animated" data-animate="fadeInUp" data-delay=".7">
						<input type="text" name="youremail" class="input-round required email" placeholder="Enter your email" >
						<input type="text" class="d-none" name="form-anti-honeypot" value="">
						<button type="submit" class="btn btn-plane">Subscribe</button>
						<div class="subscribe-results"></div>
					</form>
				</div>
			</div><!-- .col  -->
			<div class="col-xl-4">
				<ul class="link-widget animated" data-animate="fadeInUp" data-delay=".8">
					<li><a href="#" class="menu-link">Home</a></li>
					<li><a href="#" class="menu-link">FAQ</a></li>
					<li><a href="#" class="menu-link">Comprar</a></li>
					<li><a href="#" class="menu-link">Roadmap</a></li>
					<li><a href="<?php echo base_url();?>assets/whitepaper_0.2.pdf" class="menu-link">Whitepaper</a></li>
					<li><a href="#" class="menu-link">Contacto</a></li>
					<li><a href="#" class="menu-link">Roadmap</a></li>
				</ul>
			</div><!-- .col  -->
		</div><!-- .row  -->
		<div class="gaps size-2x"></div>
		<div class="row">
			<div class="col-md-7">
				<span class="copyright-text animated" data-animate="fadeInUp" data-delay=".9">
					Copyright &copy; 2018, Kick Software Limited.
					<span>help@kicksportsmanager.com</span>
				</span>
			</div><!-- .col  -->
			<div class="col-md-5 text-right mobile-left">
				<ul class="footer-links animated" data-animate="fadeInUp" data-delay="1">
					<li><a href="#">Política de Privacidade</a></li>
					<li><a href="#">Termos &amp; Condições</a></li>
					<li>
						<div class="language-switcher">
							<a href="#" data-toggle="dropdown">PT</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="#">EN</a>
							</div>
						</div>
					</li>
				</ul>
			</div><!-- .col  -->
		</div><!-- .row  -->
	</div><!-- .container  -->
</div>
<!-- End Section -->

<!-- Preloader !remove please if you do not want -->
<div id="preloader">
	<div id="loader"></div>
	<div class="loader-section loader-top"></div>
	<div class="loader-section loader-bottom"></div>
</div>
<!-- Preloader End -->

<!-- JavaScript (include all script here) -->
<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/moment.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/moment-timezone.js"></script>
<script type='text/javascript' src="<?php echo site_url(); ?>assets/js/jquery.bundle.js?ver=113"></script>
<script type='text/javascript' src="<?php echo site_url(); ?>assets/js/script.js?ver=113"></script>

</body>
</html>
