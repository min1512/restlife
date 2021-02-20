<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="naver-site-verification" content="b6dc5cc3adc33ec88401d199ee9799a36cd15e84" />
	<meta name="naver-site-verification" content="3a8d72dc6912139cb945fc9fa11c0d5c032cf8de" />
	<meta name="description" content="휴식,rest,카페,일상,음식,강아지,여행">
	<meta property="og:type" content="website">
	<meta property="og:title" content="휴식 공간">
	<meta property="og:description" content="REST LIFE">
	<meta property="og:image" content="http://www.restlife.shop/lsm/img/rest1.jpg">
	<meta property="og:url" content="http://www.restlife.shop/">
	<meta name = "viewport"content = "width = device-width, initial-scale = 1">

	<meta name="google-site-verification" content="jS9K1Y3zZENkl8O6XWdU5vlrWCtrcDAmNcnSxVJ0DpA" />

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/style.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/_sub.css">

	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/firstSlider.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/main1.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/main2.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/owl/owl.carousel.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/footer.css">
	<link rel="icon" href="http://www.restlife.shop/lsm/img/favicon.ico">

	<title>Rest Life</title>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="http://www.restlife.shop/lsm/js/main.js" defer></script>
	<script src="http://www.restlife.shop/lsm/js/owl/owl.carousel.js"></script>
	<script src="http://www.restlife.shop/lsm/js/owl/owl.carousel.min.js"></script>
	<script src="http://www.restlife.shop/lsm/js/webfontloader.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
<!--	구글 에드센스-->
	<script data-ad-client="ca-pub-6721127615303797" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-F5EFZHR0VW"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-F5EFZHR0VW');
	</script>
</head>
<body>
<nav class="navbar">
	<div class="navbar_log">
		<i class="fa fa-adn"></i>
		<a href="http://www.restlife.shop">Main</a>
	</div>
	<ul class="navbar_menu">
		<li><a href="http://www.restlife.shop"><i class="fa fa-home">Home</i></li>
		<li><a href="http://www.restlife.shop/Travel/listAll"><i class="fa fa-bus">Travel</i></li>
		<li><a href="http://www.restlife.shop/Foods/listAll"><i class="fas fa-utensils">Foods</i></li>
		<li><a href="http://www.restlife.shop/Photo/listAll"><i class="fa fa-camera">Photo</i></li>
		<li><a href="http://www.restlife.shop/Cafe/listAll"><i class="fa fa-coffee">Cafe</i></li>
<!--		<li><a href="http://www.restlife.shop/Shopping"><i class="fa fa-coffee">Shopping</i></li>-->
		<li><a href="http://www.restlife.shop/SignUp"><i class="fas fa-sign-in-alt">SignUp</i></li>
		<li><a href="http://www.restlife.shop/Login"><i class="fas fa-sign-in-alt">LOGIN</i></li>
	</ul>
	<ul class="navbar_icons">
		<?php if(!empty($sessions['session_id'])) { ?>
			<li><a href="http://www.restlife.shop/Main/Logout" id="logout"><?= $sessions['session_id']; ?></a></li>
		<?php } ?>
		<li><i class="fa fa-twitter"></i></li>
		<li><i class="fa fa-facebook-f"></i></li>
	</ul>
	<a class="navbar_toogleBtn">
		<i class="fa fa-bars"></i>
	</a>
</nav>

<script>
	$(function (){
		$('#logout').click(function (){
			var result = confirm('로그아웃 하시겠습니다?');
			if(result == true){
				return  true;
			}else if(result == false){
				return false;
			}
		})
	})

	// Hide Header on on scroll down
	var didScroll;
	var lastScrollTop = 0;
	var delta = 5;
	var navbarHeight = $('nav').outerHeight();
	$(window).scroll(function(event){
		didScroll = true;
	});

	setInterval(function() {
		if (didScroll) {
			hasScrolled();
			didScroll = false;
		}
	}, 250);

	function hasScrolled() {
		var st = $(this).scrollTop();
		// Make sure they scroll more than delta
		if(Math.abs(lastScrollTop - st) <= delta) return;
		// If they scrolled down and are past the navbar, add class .nav-up.
		// This is necessary so you never see what is "behind" the navbar.
		if (st > lastScrollTop && st > navbarHeight){
			// Scroll Down
			$('nav').removeClass('nav-down').addClass('nav-up');
		} else {
			// Scroll Up
			if(st + $(window).height() < $(document).height()) {
				$('nav').removeClass('nav-up').addClass('nav-down');
			}
		}
		lastScrollTop = st;
	}



</script>


