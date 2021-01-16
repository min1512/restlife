<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>
	<!--	css 파일-->
	<link rel="stylesheet" href="../lsm/css/style.css">
	<link rel="stylesheet" href="../lsm/css/_sub.css">

	<link rel="stylesheet" href="../lsm/css/firstSlider.css">
	<link rel="stylesheet" href="../lsm/css/main1.css">
	<link rel="stylesheet" href="../lsm/css/main2.css">
	<link rel="stylesheet" href="../lsm/css/owl/owl.carousel.css">
	<link rel="stylesheet" href="../lsm/ckeditor/skins/moono-lisa/editor.css">
	<link rel="stylesheet" href="../lsm/ckeditor/skins/moono-lisa/dialog.css">
	<link rel="stylesheet" href="../lsm/css/footer.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">

	<title>Rest Life</title>
	<!--	script 파일-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="../lsm/js/main.js" defer></script>
	<script src="../lsm/js/owl/owl.carousel.min.js"></script>
	<script src="../lsm/js/webfontloader.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>

	<script type="text/javascript" src="../lsm/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="../lsm/ckeditor/styles.js"></script>
	<script type="text/javascript" src="../lsm/ckeditor/config.js"></script>
	<script type="text/javascript" src="../lsm/ckeditor/build-config.js"></script>
	<script type="text/javascript">

		function LoadPage() {
			CKEDITOR.replace('contents',{
				'filebrowserUploadUrl' : './upload', contentsCss:'p{margin:0;}',
				height: 600
			});
		}

		function FormSubmit(f) {
			var title = $('#title').val();
			var content = CKEDITOR.instances.contents.getData();

			if(title == ""){
				alert("제목을 입력하세요.");
				title.focus();
				return false;
			}else if(content == ""){
				alert("내용을 입력하세요.");
				title.focus();
				return false;
			}else{
				EditorForm.method = "post";
				EditorForm.action = './uploadForm';
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
			<a class="btn_sub" href="#">글쓰기 <i class="fas fa-caret-right"></i></a>
		</div>
		<div class="swiper-container">
			<div>
				<form id="EditorForm" name="EditorForm" enctype="multipart/form-data" method="post">
					<div>
						<a style="font-family: 'Lato', sans-serif; color: #0A246A; font-size: 15px;">제목 : &nbsp;&nbsp;</a>
						<input type="text" id="title" placeholder="제목" name="title" size="40" />
					</div>
					<div>
						<a style="font-family: 'Lato', sans-serif; color: #0A246A; font-size: 15px;">비밀번호<a style="font-family: 'Lato', sans-serif; color: red; font-size: 15px;">(글 수정 할때 사용, 필수 아님)</a><a style="font-family: 'Lato', sans-serif; color: #0A246A; font-size: 15px;"> : &nbsp;&nbsp;</a></a>
						<input type="password" id="password" placeholder="비밀번호" name="password" maxlength="10" />
					</div>
					<div>
						<textarea id="contents" placeholder="본문" name="contents"></textarea>
					</div>
					<div style="margin: auto">
						<input type="button" value="전송" onclick="FormSubmit()">
					</div>
				</form>
			</div>
		</div>


	</div>

</div>



