<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>


	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/firstSlider.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/main1.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/main2.css">
	<link rel="stylesheet" href="http://www.restlife.shop/lsm/css/owl/owl.carousel.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">

	<title>Rest Life</title>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script src="http://www.restlife.shop/lsm/js/owl/owl.carousel.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
	<script>
		$(function () {
			view_text = $('#view_text');
			swiper_container = $('#swiper_container');
			contents_inner = $('#contents_inner');
			contents_inner.addClass('hide');

			view_text.click(function (){
				scrollPostion = $('#view_text').offset();
				swiper_container.toggle(
						function (){swiper_container.addClass('hide')},
						function (){swiper_container.addClass('show')}
				)
				contents_inner.toggle(
						function (){contents_inner.addClass('show')},
						function (){contents_inner.addClass('hide')}
				)
				$('html').animate({
					scrollTop : scrollPostion.top
				},400);
			});

		});
	</script>
</head>

<?php
	if(!empty($session_id)){
		echo "<script>location.href='http://www.restlife.shop/'</script>";
	}
?>

<div class="all_wrap">

	<!-- main2 -->
	<div class="cpage main2" id="main2">
		<div class="loader tImg" style="background-image: url(lsm/img/travel/airplane.jpg);"></div>
		<div class="sub_title">
			<div class="eng TRAN">Login</div>
			<div class="txt TRAN">차원이 다른 휴식 공간에서 <span> 편히 쉴수 있습니다.</span></div>
<!--			<a class="btn_sub" href="http://www.restlife.shop/Foods/write">글쓰기 <i class="fa fa-caret-right"></i></a>-->
		</div>
<!--		<div class="sub_title">-->
<!--			<a class="btn_sub" href="#" id="view_text"><i class="fas fa-layer-group"></i></a>-->
<!--		</div>-->
		<div class="form">
			<form name="LOGIN_FORM" id="LOGIN_FORM" method="post">
				<div>
					<h3>
						<label for="ID">아이디</label>
					</h3>
					<span class="form box">
						<input type="text" name="ID" id="ID" class="form txt" placeholder="아이디" maxlength="20" />
					</span>
					<div id="ckId" class="form txt"></div>
				</div>
				<div>
					<h3>
						<label for="PW">비밀번호</label>
					</h3>
					<span class="form box">
						<input type="password" name="PW" id="PW" class="form txt" placeholder="비밀번호" maxlength="15" />
					</span>
				</div>
				<div id="btn_area">
					<input type="button" value="LOGIN" id="styled" onclick="checkLoginForm();" />
					<?php
					// 네이버 로그인 접근토큰 요청 예제
					$client_id = "DJm5Va3pFcDNfVgSYvuC";
					$redirectURI = urlencode("http://www.restlife.shop/Login/naverLogin");
					$state = "RAMDOM_STATE";
					$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;
					?>
					<a href="<?php echo $apiURL ?>"><img height="50" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	function checkLoginForm(){
		var id       = $('#ID').val();
		var pw       = $('#PW').val();

		if(id == ''){
			alert('아이디를 입력하세요.');
			return  false;
		}
		if(pw == ''){
			alert('비밀번호를 입력하세요.');
			return  false;
		}

		$(function (){
			$.ajax({
				type     : 'post',
				url      :  'http://www.restlife.shop/Login/checkLoginForm',
				data     : $('#LOGIN_FORM').serialize(),
				dataType : 'text' ,
				success  : function (result){
					if(result == 'sucess'){
						alert('반갑습니다.');
						location.href = '<?= $prevPage; ?>';
					}else if(result == 'fail'){
						alert('로그인 실패했습니다. 아이디 혹은 비밀번호 확인해주세요.');
						location.href = 'http://www.restlife.shop/Login';
					}
					console.log(result);
				},
				error   : function (result){
					console.log(result);
					alert(result);
				}
			});
		})
	}
</script>


