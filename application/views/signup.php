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



<div class="all_wrap">

	<!-- main2 -->
	<div class="cpage main2" id="main2">
		<div class="loader tImg" style="background-image: url(lsm/img/travel/airplane.jpg);"></div>
		<div class="sub_title">
			<div class="eng TRAN">SIGNUP</div>
			<div class="txt TRAN">쉽고 빠른 회원 가입 <span> 간편하고 효율적인 회원가입</span></div>
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
						<input type="text" name="ID" id="ID" class="form txt" placeholder="ID" maxlength="20" />
					</span>
					<div id="ckId" class="form txt"></div>
				</div>
				<div>
					<h3>
						<label for="PW">비밀번호</label>
					</h3>
					<span class="form box">
						<input type="password" name="PW" id="PW" class="form txt" placeholder="PW" maxlength="15" />
					</span>
				</div>
				<div>
					<h3>
						<label for="PW_CK">비밀번호 확인</label>
					</h3>
					<span class="form box">
						<input type="password" name="PW_CK" id="PW_CK" class="form txt" placeholder="PWCHECK" maxlength="15" />
					</span>
				</div>
				<div>
					<h3>
						<label for="name">이름</label>
					</h3>
					<span class="form box">
						<input type="text" name="NAME" id="NAME" class="form txt" placeholder="NAME" maxlength="15" />
					</span>
				</div>
				<div>
					<h3>
						<label for="">생년월일</label>
					</h3>
					<div id="bir_wrap">
						<div id="bir_yy">
							<span class="form box">
								<input type="text" name="YY" id="YY" class="form txt" placeholder="YEAR" maxlength="4" />
							</span>
						</div>
						<div id="bir_mm">
							<span class="form box">
								<select name="MM" id="MM">
										<option>월</option>
									<?php for($i=1; $i<=12; $i++) { ?>
										<option value="<?= $i; ?>" ><?= $i; ?></option>
									<?php } ?>
								</select>
							</span>
						</div>
						<div id="bir_dd">
							<span class="form box">
								<input type="text" name="DD" id="DD" class="form txt" placeholder="DAY" maxlength="2">
							</span>
						</div>
					</div>
				</div>
				<div>
					<h3>
						<label for="PHONE_TEL">휴대폰 번호</label>
					</h3>
					<span class="form box">
						<input type="text" name="PHONE_TEL" id="PHONE_TEL" class="form txt" placeholder="TEL" maxlength="20"/>
					</span>
				</div>
				<div id="btn_area">
					<input type="button" value="가입하기" id="styled" onclick="checkLoginForm();" />
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	function checkLoginForm(){
		var id       = $('#ID').val();
		var pw       = $('#PW').val();
		var pwCk     = $('#PW_CK').val();
		var name     = $('#NAME').val();
		var yy       = $('#YY').val();
		var mm       = $('#MM').val();
		var dd       = $('#DD').val();
		var phoneTel = $('#PHONE_TEL').val();
		var ckId     = $('#ckId').val();

		if(id == ''){
			alert('아이디를 입력하세요.');
			return  false;
		}
		if(ckId == 'fail'){
			alert('이미 등록이 되어 있는 아이디 입니다.');
			return  false;
		}
		if(pw == ''){
			alert('비밀번호를 입력하세요.');
			return  false;
		}
		if(pwCk == ''){
			alert('비밀번호 확인을 입력하세요.');
			return  false;
		}
		if(pw != pwCk){
			alert('비밀번호와 비밀번호 확인이 일치 하지 않습니다.');
			return  false;
		}
		if(name == ''){
			alert('이름을 입력하세요.');
			return  false;
		}
		if(yy == ''){
			alert('생년월일의 년도를 입력하세요.');
			return  false;
		}
		if(mm == ''){
			alert('생년월일의 월을 입력하세요.');
			return  false;
		}
		if(dd == ''){
			alert('생년월일의 일을 입력하세요.');
			return  false;
		}
		if(phoneTel == ''){
			alert('휴대폰 번호를 입력하세요.');
			return  false;
		}



		$(function (){
			$.ajax({
				type     : 'post',
				url      :  'http://www.restlife.shop/SignUp/checkLoginForm',
				data     : $('#LOGIN_FORM').serialize(),
				dataType : 'text' ,
				success  : function (result){
					if(result == 'sucess'){
						alert('회원가입에 성공하셨습니다.');
						location.href = 'http://www.restlife.shop/';
					}else if(result == 'fail'){
						alert('회원가입에 실패하셨습니다. 다시 시도해주세요.');
						location.href = 'http://www.restlife.shop/SignUp';
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

	$(function (){
		$('#ID').blur( function (){
			var ID = $('#ID').val();
			$.ajax({
				type     : 'post',
				url      : 'http://www.restlife.shop/SignUp/checkId',
				data     : { 'ID' : ID },
				dataType : 'text',
				success  : function (result){
					if(result == 'sucess'){
						$('#ckId').val('sucess');
						$('#ckId').text('사용할수 있는 아이디 입니다.');
					}else if(result == 'fail') {
						$('#ckId').val('fail');
						$('#ckId').text('사용할수 없는 아이디 입니다.');
					}
					console.log(result);
				},
				error    : function (result){
					alert(result);
					console.log(result);
				}
			})
		} );
	})
</script>


