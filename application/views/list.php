

<head>
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/style.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/_sub.css">

	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/firstSlider.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/main1.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/main2.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/owl/owl.carousel.css">
	<link rel="stylesheet" href="http://min1512.cafe24.com/lsm/css/footer.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css">

	<title>Rest Life</title>

	<script src="https://kit.fontawesome.com/782926246a.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="http://min1512.cafe24.com/lsm/js/main.js" defer></script>
	<script src="http://min1512.cafe24.com/lsm/js/owl/owl.carousel.min.js"></script>
	<script src="http://min1512.cafe24.com/lsm/js/webfontloader.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>


</head>
<body>


<div class="all_wrap">

	<!-- main2 -->
	<div class="cpage main2" id="main2">
		<div class="loader tImg" style="background-image: url(lsm/img/travel/airplane.jpg);"></div>
		<div class="sub_title">
			<div class="eng TRAN">VIEWS</div>
			<div class="txt TRAN">남들과 차원이 다르고 <span>효율적이고 가치있는 휴식을 취하세요.</span></div>
			<a class="btn_sub" href="http://min1512.cafe24.com/Travel/write">글쓰기 <i class="fas fa-caret-right"></i></a>
		</div>
		<div class="list">
			<div class="lists" style="border: 0.5px solid #d6d6d6;">
				<div class="sub_title">
					<?php if($password == 'null' || empty($password)) {?>
						<a class="btn_sub" id="change_text" onclick="ChangeList()">글 수정</a>
					<?php }else{ ?>
						<a class="btn_sub" id="change_text" onclick="getInputValue()">글 수정</a>
						<input type="password" maxlength="10" name="change_text_pw_value" id="change_text_pw_value" placeholder="비밀번호를 입력하세요" />
					<?php } ?>
				</div>
				<?= $img_get[0]['content'] ?>
				<div>
					<a class="btn_sub" href="#" id="likeButton" onclick="likeButton( '<?= isset($session['session_id'])?$session['session_id']:"" ?>' )">공감 버튼 <i class="far fa-grin-hearts"></i> <a class="btn_sub" href="#" id="likeButton"> <?= isset($likeButtonCount)?$likeButtonCount:0 ?> </a></a>
				</div>
			</div>
		</div>

	</div>

</div>
<!--<div>-->
<!--	<div class="cpage main2" id="main3">-->
<!--		<div class="sub_title">-->
<!--			<div class="txt TRAN">인기 많은 글</div>-->
<!--		</div>-->
<!--		<div class="list">-->
<!--			<div class="lists">-->
<!--				<table>-->
<!--					--><?php //foreach ($tempImgGetAll as $k => $v) { ?>
<!--						--><?php //foreach ($v as $k2 => $v2) { ?>
<!--								--><?php //if($k2 == 'jpg_name'){
//									$jpg_name = $v2;
//								}else if ($k2 == 'jpg_src'){
//									$jpg_src = $v2;
//								}else if ($k2 == 'title'){
//									$title = $v2;
//									//$content = substr($content,0,20);
//								}else if($k2 == 'index'){
//									$index = $v2;
//								}else if($k2 == 'dir'){
//									$dir = $v2;
//								}
//								?>
<!--								<tr>-->
<!--									<td>-->
<!--										<div style="width: 150px; height: 150px">-->
<!--											--><?php //if(empty($jpg_name)) { ?>
<!--												<img src="--><?//= $jpg_src ?><!--" style="width: 150px; height: 150px;" >-->
<!--											--><?php //}else{ ?>
<!--												<img src="http://min1512.cafe24.com/lsm/img/food/--><?//= $jpg_name; ?><!--" style="width: 150px; height: 150px;">-->
<!--											--><?php //} ?>
<!--										</div>-->
<!--									</td>-->
<!--									<td>-->
<!--										<a href='min1512.cafe24.com/--><?//= $dir; ?><!--/lists/--><?//= $index; ?><!--'>--><?//= isset($title)?$title:"";  ?><!--</a>-->
<!--									</td>-->
<!--								</tr>-->
<!--						--><?// } ?>
<!--					--><?// } ?>
<!--				</table>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->

<script>
	function getInputValue()
	{
		var pw_value = $('input[name=change_text_pw_value]').val();
		$('#change_text_pw_value').show();
		$.ajax({
			url: 'http://www.restlife.shop/Update/password',
			type: 'post',
			data: { 'password' : pw_value, 'url' : '<?= $_SERVER['REQUEST_URI'] ?>' },
			dataType: 'text',
			success : function (result){
				console.log(result);
				if(result == 'fail'){
					alert('비밀 번호가 틀렸습니다.');
					return false;
				}else{
					let url = window.location.href;
					let dir = url.split('/');
					let href ="http://www.restlife.shop/"
					href += dir[3];
					href += '/';
					href += 'update/';
					href += result;
					location.href = href;
				}
			},
			error: function (result){
				console.log(result);
			}
		})
	}

	function ChangeList()
	{
		<?php
			$url = $_SERVER['PHP_SELF'];
			$url = explode('/',$url);
			$dir = $url[3];
			$index_map = $url[5];
		?>
		let href ='http://min1512.cafe24.com/';
		href += '<?= $dir; ?>';
		href += '/update/';
		href += '<?= $index_map; ?>';
		location.href = href;
	}

	function likeButton(session)
	{
		if(session == ''){
			alert('로그인 후 이용 부탁드립니다.');
			location.href = 'http://www.restlife.shop/Login';
		}else{
			<?php
				$url = $_SERVER['PHP_SELF'];
				$url = explode('/',$url);
				$dir = $url[3];
				$index_map = $url[5];
			?>
			$.ajax({
				url: 'http://www.restlife.shop/Update/LikeButton',
				type: 'post',
				data: { 'id' : session, 'index_map' : '<?= $index_map; ?>'  },
				dataType: 'text',
				success : function (result){
					console.log(result);
					if(result == 'sucess'){
						window.location.reload();
					}else{
						alert('Database error');
						return false;
					}
				},
				error: function (result){
					console.log(result);
					alert('Database error');
				}
			})
		}
	}

</script>
