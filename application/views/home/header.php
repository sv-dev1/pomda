<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Softnio">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="ICO Crypto is a modern and elegant landing page, created for ICO Agencies and digital crypto currency investment website.">
	<!-- Fav Icon  -->
	<link rel="shortcut icon" href="<?php echo site_url(); ?>images/favicon_kick.png">
	<!-- Site Title  -->
	<title>Kick Sports Manager - Já deste o teu kick?</title>
	<!-- Vendor Bundle CSS -->
	
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/vendor.bundle.css">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/theme-java.css">
	<!-- Custom styles for this template -->
	<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>assets/css/style.css"> 
	<link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>assets/css/jquery.popVideo.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!--script src="<?php echo site_url() ?>assets/js/jquery.popVideo.js"></script-->
	<!--script type="text/javascript" src="<?php echo site_url(); ?>assets/js/ethwebpage/bower_components/web3/dist/web3.min.js"></script-->


	<body class="theme-dark io-azure io-azure-pro" data-spy="scroll" data-target="#mainnav" data-offset="80">

		<!-- Header --> 
		<header class="site-header is-sticky">

			<!-- Place Particle Js -->
			<div id="particles-js" class="particles-container particles-js"></div>

			<!-- Navbar -->
			<div class="navbar navbar-expand-lg is-transparent" id="mainnav">
				<nav class="container">

					<a class="navbar-brand animated" data-animate="fadeInDown" data-delay=".65" href="./">
						<img class="logo logo-dark" alt="logo" src="<?php echo site_url(); ?>images/logo.png" srcset="<?php echo site_url(); ?>images/logo2x.png 2x">
						<img class="logo logo-light" alt="logo" src="<?php echo site_url(); ?>images/logo_kick.png" srcset="<?php echo site_url(); ?>images/logo_kick.png">
					</a>

					<div class="language-switcher animated" data-animate="fadeInDown" data-delay=".75">

						<a href="" data-toggle="dropdown"><i class="flag en"><img src="<?php echo site_url(); ?>images/gb.png" /></i><i class="fa fa-angle-down"></i></a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<ul class="locales">
								<li><a href="<?php echo BASE_URL()?>/LangSwitch/switchLanguage/portuguese" class="item active"><i class="flag en"><img src="<?php echo site_url(); ?>images/gb.png" /></i><span class="title">Português</span></a></li>
								<li><a href="<?php echo BASE_URL()?>/LangSwitch/switchLanguage/english" class="item "><i class="flag1"><img src="<?php echo site_url(); ?>images/2.png" /></i><span class="title">English</span></a></li>
								<!-- <li><a class="item "><i class="flag1"><img src="<?php echo site_url(); ?>images/3.png" /></i><span class="title">हिन्दी</span></a></li>
								<li><a class="item "><i class="flag1"><img src="<?php echo site_url(); ?>images/4.png" /></i><span class="title">简体中文</span></a></li>
								<li><a class="item "><i class="flag1"><img src="<?php echo site_url(); ?>images/5.png" /></i><span class="title">Bahasa Indonesia</span></a></li>
								<li><a class="item "><i class="flag1"><img src="<?php echo site_url(); ?>images/6.png" /></i><span class="title">繁體中文</span></a></li>
								<li><a class="item "><i class="flag1"><img src="<?php echo site_url(); ?>images/7.png" /></i><span class="title">Malay</span></a></li>
								<li><a class="item "><i class="flag1"><img src="<?php echo site_url(); ?>images/8.png" /></i><span class="title">ภาษาไทย</span></a></li>
								<li><a class="item "><i class="flag1"><img src="<?php echo site_url(); ?>images/9.png" /></i><span class="title">Tiếng Việt</span></a></li>
								<li><a class="item "><i class="flag1"><img src="<?php echo site_url(); ?>images/10.png" /></i><span class="title">Tagalog</span></a></li>
								
								<li><a class="item "><i class="flag1"><img src="<?php echo site_url(); ?>images/11.png" /></i><span class="title">Español</span></a></li>
								<li><a class="item "><i class="flag1"><img src="<?php echo site_url(); ?>images/12.png" /></i><span class="title">Español</span></a></li>
							-->
						</ul>	
					</div>
				</div>



				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle">
					<span class="navbar-toggler-icon">
						<span class="ti ti-align-justify"></span>
					</span>
				</button>

				<div class="collapse navbar-collapse justify-content-end" id="navbarToggle">
					<ul class="navbar-nav animated remove-animation" data-animate="fadeInDown" data-delay=".9">
						<!--li class="nav-item"><a class="nav-link menu-link" href="#intro">What is ICO<span class="sr-only">(current)</span></a></li>
						<li class="nav-item"><a class="nav-link menu-link" href="#tokenSale">Token Sale</a></li>
						<li class="nav-item"><a class="nav-link menu-link" href="#roadmap">Roadmap</a></li>
						<li class="nav-item"><a class="nav-link menu-link" href="#apps">Apps</a></li>
						<li class="nav-item"><a class="nav-link menu-link" href="#team">Team</a></li-->
							<!-- <li class="nav-item"><a class="nav-link menu-link" href="#faq">MVP</a></li> -->
							<li class="nav-item"><a class="nav-link menu-link" href="<?php echo site_url() ?>assets/whitepaper_0.1.pdf"><?php echo $this->lang->line("whitepaper");?></a></li>
						</ul>
						<?php if (!$this->ion_auth->logged_in()){ ?>
						<ul class="navbar-nav navbar-btns animated remove-animation" data-animate="fadeInDown" data-delay="1.15">
							<!--li class="nav-item"><a class="nav-link btn btn-sm btn-outline menu-link" href="#" data-toggle="modal" data-target="#registerModal">Sign up</a></li-->
							<li class="nav-item"><a class="nav-link btn btn-sm btn-outline menu-link main_imp" href="#" data-toggle="modal" data-target="#loginModal"><?php echo $this->lang->line("buy_tokens");?></a></li>
						</ul>
						<?php }else{ ?>
						<ul class="navbar-nav navbar-btns animated remove-animation" data-animate="fadeInDown" data-delay="1.15">
							<li class="nav-item"><a class="nav-link btn btn-sm btn-outline menu-link" href="<?php echo site_url() ?>dashboard"><?php echo $this->lang->line("buy_tokens");?></a></li>
						</ul>
						<?php } ?>
					</div>

				</nav>
			</div>
			<!-- End Navbar -->

			<!-- Banner/Slider -->
			<div id="header" class="banner banner-full banner-tokensale d-flex align-items-center custom-header">
				<div class="container">
					<div class="banner-content">
						<div class="row align-items-center mobile-center">
							<div class="col-lg-6 col-md-12 order-lg-first lft">
								<div class="header-txt">
									<h1 class="animated" data-animate="fadeInUp" data-delay="1.55">Kick Sports Manager <br class="d-none d-xl-block">Quantos kicks tens?<br class="d-none d-xl-block"> Reserva a tua!</h1>
									<p class="lead animated" data-animate="fadeInUp" data-delay="1.65">A altura de ser agente de futebol chegou.<br class="d-none d-xl-block"> Estás preparado? </p>
									<ul class="btns animated" data-animate="fadeInUp" data-delay="1.75">
										<?php if (!$this->ion_auth->logged_in()){ ?>
										<li><a href="#" class="btn"><?php echo $this->lang->line("join_us");?></a></li>
										<?php } else{ ?>
										<li><a href="<?php echo site_url() ?>dashboard" class="btn"><?php echo $this->lang->line("join_us");?></a></li>
										<?php } ?>
										<li><a href="<?php echo site_url() ?>assets/whitepaper_0.1.pdf" target="_blank" class="btn btn-alt"><?php echo $this->lang->line("whitepaper");?></a></li>


									</ul>
								</div>
							</div><!-- .col  -->
							<div class="col-lg-6 col-md-12 order-first res-m-bttm-lg">
								<div class="header-image-alt animated" data-animate="fadeInRight" data-delay="1.25">
									<img class="test_visible" src="<?php echo site_url(); ?>images/header-image-blue.png" alt="header">
								</div>
								<div class="countdown-box countdown-transparent text-center animated" data-animate="fadeIn" data-delay="1.85">
									<span class="extra-line"></span>
									<h6 class="animated" data-animate="fadeInUp" data-delay="1.95"><?php echo $this->lang->line("ico_sale_is_open");?></h6>
									<div class="token-countdown d-flex align-content-stretch animated" data-animate="fadeInUp" data-delay="2.05" data-date="2018/06/08"></div>
									<div class="token-status-bar animated" data-animate="fadeInUp" data-delay="2.15">
										<div class="token-status-percent" style="width:75%;"></div>
										<span class="token-status-point token-status-point-1" style="left:25%;"><?php echo $this->lang->line("pre_sale");?></span>
										<span class="token-status-point token-status-point-2" style="left:55%;"><?php echo $this->lang->line("soft_cap");?></span>
										<span class="token-status-point token-status-point-3" style="left:80%;"><?php echo $this->lang->line("bonus");?></span>
									</div>
									<div class="animated" data-animate="fadeInUp" data-delay="2.25">
										<?php if (!$this->ion_auth->logged_in()){ ?>
										<a href="#" class="btn btn-alt btn-sm"><?php echo $this->lang->line("purchase_kick_now");?></a>
										<?php } else{ ?>
										<a href="<?php echo site_url(); ?>dashboard" class="btn btn-alt btn-sm"><?php echo $this->lang->line("purchase_kick_now");?></a>
										<?php } ?>
									</div>
								</div>
							</div><!-- .col  -->
						</div><!-- .row  -->
					</div><!-- .banner-content  -->
				</div><!-- .container  -->
			</div>
			<!-- End Banner/Slider -->
			<div class="header-partners">
				<div class="container">
					<div class="row align-items-center">
						<ul class="partner-list-s2 d-flex flex-wrap align-items-center">
							<li class="animated for-text" data-animate="fadeInUp" data-delay="1.85"><?php echo $this->lang->line("our_partners");?></li>
							<li class="animated" data-animate="fadeInUp" data-delay="1.9"><a href="#"><img src="<?php echo site_url(); ?>images/partner-nike.png" alt="partner"></a></li>
							<li class="animated" data-animate="fadeInUp" data-delay="1.95"><a href="#"><img src="<?php echo site_url(); ?>images/partner-adidas.png" alt="partner"></a></li>
							<li class="animated" data-animate="fadeInUp" data-delay="2"><a href="#"><img src="<?php echo site_url(); ?>images/partner-puma.png" alt="partner"></a></li>
							<li class="animated" data-animate="fadeInUp" data-delay="2.05"><a href="#"><img src="<?php echo site_url(); ?>images/partner-sport.png" alt="partner"></a></li>

						</ul>
					</div><!-- .row  -->
				</div><!-- .container  -->
			</div><!-- .header-partners  -->
			<a href="#intro" class="scroll-down menu-link">SCROLL DOWN</a>
		</header>
		<!-- End Header -->

		<!--- Login Modal -->
		<div id="loginModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<!--<h4 class="modal-title">Login</h4>-->
						<div class="tab-bar-new">
							<div id="tabl" class="tab2 active">
								<span id="log_in"><?php echo $this->lang->line("Login");?></span>
							</div>
							<div id="tabr" class="tab2">
								<span id="reg_win"><?php echo $this->lang->line("Register");?></span>
							</div>
						</div>
					</div>
					<div class="modal-body" id="log_win">
						<div id="infoMessage"><?php echo $this->session->flashdata('message');?></div>
						<?php echo form_open("login",array('id' => 'loginSubmit'));?>      
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Email" required="required" name="identity">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password" required="required" name="password">
						</div>
						<!-- <div class="check-row"><a href="/password-reset-init"><span>Forgot password?</span></a></div> -->
						<div class="form-group">
							<button type="button" class="btn btn-primary btn-block" onclick="submitForm();"><div class="loader" style="display:none;"></div><?php echo  $this->lang->line('Login');?></button>
						</div>
						<?php echo form_close();?>
					</div>
					<div style="display:none" class="modal-body" id="reg_form">
						<h1></h1>
						<div id="infoMessage1"></div>
						<?php echo form_open("register",array('id' => 'registerSubmit'));?>
						<?php
						?>     
						<input type="hidden" value="<?php if(isset($_GET['r_id'])){ echo $ref_id = $_GET['r_id'];}else{ echo $ref = 0;}?>" name="link">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Email" required="required" name="identity">
						</div>
						<div id="infoMessage2"></div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password" required="required" name="password">
						</div>
						<div id="infoMessage3"></div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Confirm Password" required="required" name="password_confirm">
						</div> 
						<div class="check-row"><span class=""><input type="checkbox" class="checkbox" name="agree" id="chk-agree"><label for="chk-agree"><span class="agree-text"><span><?php echo $this->lang->line("confirm");?><a target="_blank" href="/terms">
							<?php echo $this->lang->line("term_conditions");?></a>,<?php echo $this->lang->line("legal_age");?></span></span></label></span></div>
							<div class="form-group">
								<button type="button" class="btn btn-primary btn-block" onclick="registerForm();"><div class="loader" style="display:none;"></div><?php echo $this->lang->line("Register");?><?php //echo  lang('create_user_submit_btn') ?></button>
							</div>
							<?php echo form_close();?>
						</div>
					</div>
				</div>
			</div>
<style>
.loader {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 1px;
    height: 1px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
			<!--Script starts here -->
<script>
$('#reg_win').click(function(){
$('#reg_form').show();
$('#log_win').hide(); 
$('#tabl').removeClass('active');
$('#tabr').addClass('active');


});
$('#log_in').click(function(){
$('#log_win').show();
$('#reg_form').hide();
$('#tabl').addClass('active');
$('#tabr').removeClass('active');
});

function submitForm(){
//$(".loader").show();
$.ajax({
type : "POST",
url : "<?php echo site_url(); ?>login",
data : $("#loginSubmit").serialize(), // Add your form data as inputname1=value1&inputname2=value2....
success : function(data) {
//	$(".loader").hide();
$("#infoMessage").html(data);

if(data == 1){

window.location = "<?php echo site_url(); ?>dashboard";

}

}	
});
}

function registerForm(){
$('#infoMessage1').html('');
var chk_val = $('#chk-agree').prop('checked');

if(chk_val == false){

$('#infoMessage1').html('<div class="alert alert-warning"><strong>Accept Terms & Conditions before registration</strong></div>');
$(".alert-warning").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-warning").slideUp(500);
});
}else{	
$(".loader").show();
$.ajax({
type : "POST",
url : "<?php echo site_url(); ?>register",
data : $("#registerSubmit").serialize(), // Add your form data as inputname1=value1&inputname2=value2....
success : function(data) {
	$(".loader").hide();
if(data=='registered'){
$("#tabr").removeClass("active");
$("#tabl").addClass("active");
$("#log_win").show();
$("#reg_form").hide();



}
var data1 = JSON.parse(data);
//alert(data1.message);

$("#infoMessage1").html('<div class="alert alert-warning"><strong>'+data1.message+'</strong></div>');
$(".alert-warning").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-warning").slideUp(500);
});

}	
});

}
}
</script>
