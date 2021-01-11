<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>
	<!--	css 파일-->
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/style.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/_sub.css">

	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/firstSlider.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/main1.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/main2.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/owl/owl.carousel.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/ckeditor/skins/moono-lisa/editor.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/ckeditor/skins/moono-lisa/dialog.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/footer.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">

	<title>Rest Life</title>
	<!--	script 파일-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="http://min1512.cafe24.com/lsm/js/main.js" defer></script>
	<script src="http://min1512.cafe24.com/lsm/js/owl/owl.carousel.min.js"></script>
	<script src="http://min1512.cafe24.com/lsm/js/webfontloader.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>

	<script type="text/javascript" src="http://min1512.cafe24.com/lsm/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="http://min1512.cafe24.com/lsm/ckeditor/styles.js"></script>
	<script type="text/javascript" src="http://min1512.cafe24.com/lsm/ckeditor/config.js"></script>
	<script type="text/javascript" src="http://min1512.cafe24.com/lsm/ckeditor/build-config.js"></script>
	<script type="text/javascript">

		function LoadPage() {
			CKEDITOR.replace('contents',{
				'filebrowserUploadUrl' : './upload', contentsCss:'p{margin:0;}',
				height: 600
			});
		}

		function FormSubmit(f) {
			var title          = $('#title').val();
			var content        = CKEDITOR.instances.contents.getData();
			var password       = $('#password').val();
			var password_check = $('#password_check').val();

			if(title == ""){
				alert("제목을 입력하세요.");
				title.focus();
				return false;
			}else if(content == ""){
				alert("내용을 입력하세요.");
				title.focus();
				return false;
			}else if( password != password_check ){
				alert("비밀번호 값이 두개가 일치 하지 않습니다.");
				return false;
			}else if( password == '' ){
				alert("비밀번호를 입력하세요.");
				return false;
			}else if( password_check == '' ){
				alert("비밀번호 확인을 입력하세요.");
				return false;
			}else{
				if(password == ""){
					var result = confirm("비밀번호를 입력을 하지 않으면 나중에 누구든지 수정을 할수 있습니다. 상관이 없습니까?");
					if(result != true){
						return false;
					}
				}
				EditorForm.method = "post";
				EditorForm.action = '../uploadForm';
				EditorForm.submit();
				return true;
			}
		}
	</script>

</head>
<body onload="LoadPage();">

<div class="all_wrap">

	<!-- main2 -->
	<div class="cpage main2" id="main2">
		<div class="loader tImg" style="background-image: url(../lsm/img/travel/airplane.jpg);"></div>
		<div class="sub_title">
			<div class="eng TRAN">VIEWS</div>
			<div class="txt TRAN">남들과 차원이 다르고 <span>효율적이고 가치있는 휴식을 취하세요.</span></div>
			<a class="btn_sub" href="http://min1512.cafe24.com/Travel/write">글쓰기 <i class="fas fa-caret-right"></i></a>
		</div>
		<div class="swiper-container">
			<div>
				<form id="EditorForm" name="EditorForm" enctype="multipart/form-data" method="post">
					<input type="hidden" name="update" value="update"/>
					<input type="hidden" name="index_map" value="<?= $_SERVER['PHP_SELF'] ?>">
					<div>
						<a style="font-family: 'Lato', sans-serif; color: #0A246A; font-size: 15px;">제목 : &nbsp;&nbsp;</a>
						<input type="text" id="title" placeholder="제목" name="title" size="40"  value="<?= $img_get[0]['title']?>" readonly/>
					</div>
					<div>
						<a style="font-family: 'Lato', sans-serif; color: #0A246A; font-size: 15px;">비밀번호<a style="font-family: 'Lato', sans-serif; color: red; font-size: 15px;">(글 수정 할때 사용, 필수 아님)</a><a style="font-family: 'Lato', sans-serif; color: #0A246A; font-size: 15px;"> : &nbsp;&nbsp;</a></a>
						<input type="password" id="password" placeholder="비밀번호" name="password" maxlength="10" />
					</div>
					<div>
						<a style="font-family: 'Lato', sans-serif; color: #0A246A; font-size: 15px;">비밀번호 확인: &nbsp;&nbsp;</a>
						<input type="password" id="password_check" placeholder="비밀번호 확인" name="password_check" maxlength="10" />
					</div>
					<div>
						<a style="font-family: 'Lato', sans-serif; color: #0A246A; font-size: 15px;">삭제여부<a style="font-family: 'Lato', sans-serif; color: red; font-size: 15px;">(삭제시 다시 복구는 안됩니다)</a> <a style="font-family: 'Lato', sans-serif; color: #0A246A; font-size: 15px;"> : &nbsp;&nbsp;</a></a>
						<input type="radio" name="use_yn" value="N"/><a style="font-family: 'Lato', sans-serif; color: red; font-size: 15px;">삭제</a>
						<input type="radio" name="use_yn" value="Y" checked/><a style="font-family: 'Lato', sans-serif; color: red; font-size: 15px;">삭제 안함</a>
					</div>
					<div>
						<textarea id="contents" placeholder="본문" name="contents"> <?= $img_get[0]['content'] ?> </textarea>
					</div>
					<div style="margin: auto">
						<input type="button" value="전송" onclick="FormSubmit()">
					</div>
				</form>
			</div>
		</div>


	</div>

</div>



